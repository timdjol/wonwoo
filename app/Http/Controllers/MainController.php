<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Facades\ParserService;
use App\Http\Requests\ProductsFilterRequest;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Image;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

class MainController extends Controller
{
    public function index()
    {
        //echo ParserService::parser();
        $sliders = Slider::get();
        $categories = Category::get();
        $news = Product::query()->where('category_id', 21)->get();
        $elec = Product::query()->where('category_id', 22)->get();
        $access = Product::query()->where('category_id', 23)->get();
        return view('index', compact('sliders', 'categories', 'news', 'elec', 'access'));
    }

    public function catalog(ProductsFilterRequest $request)
    {
        $paginate = 30;
        $products = Product::paginate($paginate);
        $product = Product::get();

        if (isset($request->price_from)) {
            $products = Product::where('price', '>=', $request->price_from)->paginate($paginate);
        }

        if (isset($request->orderBy)) {
            if ($request->orderBy == 'price-low-high') {
                $products = Product::orderBy('price')->paginate($paginate);
            }
            if ($request->orderBy == 'price-high-low') {
                $products = Product::orderBy('price', 'desc')->paginate($paginate);
            }
            if ($request->orderBy == 'name-a-z') {
                $products = Product::orderBy('title', 'asc')->paginate($paginate);
            }
            if ($request->orderBy == 'name-z-a') {
                $products = Product::orderBy('title', 'desc')->paginate($paginate);
            }
        }

        if ($request->ajax()) {
            return view('layouts.cart', compact('products'))->render();
        }

        return view('catalog', compact('products', 'product'));
    }


    public function categories()
    {
        return view('categories');
    }

    public function category($code)
    {
        $category = Category::where('code', $code)->first();

        return view('category', compact('category'));
    }

    public function product($category, $productCode)
    {
        $product = Product::withTrashed()->byCode($productCode)->firstOrFail();
        $images = Image::where('product_id', $product->id)->get();
        //related

        return view('product', compact('product', 'images'));
    }

    public function search()
    {
        $title = $_GET['search'];
        $search = Product::query()
            ->where('title', 'like', '%' . $title . '%')
            ->get();
        return view('search', compact('search'));
    }

//    public function product($categoryCode, $productCode)
//    {
//        $product = Product::first();
//
//        if ($product->code != $productCode) {
//            abort(404, 'Продукция не найдена');
//        }
//        if ($product->category->code != $categoryCode) {
//            abort(404, 'Категория не найдена');
//        }
//        $images = Image::where('product_id', $product->id)->get();
//
//        //related
//        $category = Category::where('code', $categoryCode)->first();
//
//        return view('product', compact('product', 'images', 'category'));
//    }

    public function changeLocale($locale)
    {
        $availableLocales = ['ru', 'en'];
        if (!in_array($locale, $availableLocales)) {
            $locale = config('app.locale');
        }
        session(['locale' => $locale]);
        App::setLocale($locale);
        return redirect()->back();
    }

    public function changeCurrency($currencyCode)
    {
        $currency = Currency::byCode($currencyCode)->firstOrFail();
        session(['currency' => $currency->code]);
        return redirect()->back();
    }

    public function paybox(Request $request)
    {
        if ($request->type_payment == 'Наличными') {
            $basket = new Basket();

            if ($basket->getOrder()->hasCoupon() && !$basket->getOrder()->coupon->availableForUse()) {
                $basket->clearCoupon();
                session()->flash('warning', __('basket.coupon_unavailable'));
                return redirect()->route('basket');
            }

            $email = Auth::check() ? Auth::user()->email : $request->email;

            if ($basket->saveOrder($request->name, $request->phone, $email, $request->type_address, $request->address,
                $request->comment, $request->type_payment)) {
                session()->flash('success', __('basket.processed'));
            } else {
                session()->flash('warning', __('basket.unavailable_full'));
            }

            return redirect()->route('index');
        } else {
            $pg_merchant_id = 554297;
            $secret_key = '7y1b70pFRP5XblFW';

            $req = $requestForSignature = [
                'pg_order_id' => 2,
                'pg_merchant_id' => $pg_merchant_id,
                'pg_amount' => $request->price,
                'pg_description' => $request->name,
                'pg_salt' => 'randwonwoo',
                'pg_currency' => 'KGS',
                'pg_check_url' => route('check_page'),
                'pg_result_url' => 'https://wonwookorea.com/result',
                'pg_request_method' => 'POST',
                'pg_success_url' => route('success_page'),
                'pg_failure_url' => route('failure_page'),
                'pg_success_url_method' => 'GET',
                'pg_failure_url_method' => 'GET',
                'pg_state_url' => route('state_page'),
                'pg_state_url_method' => 'GET',
                'pg_site_url' => 'https://wonwookorea.com/return',
                //'pg_payment_system' => 'EPAYWEBKZT',
                'pg_lifetime' => '86400',
                'pg_user_phone' => $request->phone,
                'pg_user_contact_email' => $request->email,
                'pg_user_ip' => $_SERVER['REMOTE_ADDR'],
                'pg_language' => 'ru',
                'pg_testing_mode' => '1',
            ];

            /**
             * Функция превращает многомерный массив в плоский
             */
            function makeFlatParamsArray($arrParams, $parent_name = '')
            {
                $arrFlatParams = [];
                $i = 0;
                foreach ($arrParams as $key => $val) {
                    $i++;
                    /**
                     * Имя делаем вида tag001subtag001
                     * Чтобы можно было потом нормально отсортировать и вложенные узлы не запутались при сортировке
                     */
                    $name = $parent_name . $key . sprintf('%03d', $i);
                    if (is_array($val)) {
                        $arrFlatParams = array_merge($arrFlatParams, makeFlatParamsArray($val, $name));
                        continue;
                    }
                    $arrFlatParams += array($name => (string)$val);
                }

                return $arrFlatParams;
            }

// Превращаем объект запроса в плоский массив
            $requestForSignature = makeFlatParamsArray($requestForSignature);

// Генерация подписи
            ksort($requestForSignature); // Сортировка по ключю
            array_unshift($requestForSignature, 'init_payment.php'); // Добавление в начало имени скрипта
            array_push($requestForSignature, $secret_key); // Добавление в конец секретного ключа


            $req['pg_sig'] = md5(implode(';', $requestForSignature)); // Полученная подпись

            unset($req[0], $req[1]);

            $query = http_build_query($req);


            return Redirect::to('https://api.freedompay.kz/init_payment.php?' . $query);

        }

    }

}
