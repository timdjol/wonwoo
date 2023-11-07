<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Image;
use App\Models\Page;
use App\Models\Product;
use App\Models\Review;
use App\Models\Sku;
use App\Models\Slider;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $sliders = Slider::get();
        $categories = Category::get();
        $news = Product::query()->where('category_id', 21)->get();
        $elec = Product::query()->where('category_id', 22)->get();
        $access = Product::query()->where('category_id', 23)->get();
        return view('index', compact('sliders', 'categories', 'news', 'elec', 'access'));
    }

    public function catalog(ProductsFilterRequest $request)
    {
        $productQuery = Product::query();

        $productsQuery = Product::with('category');

        if ($request->filled('price_from')) {
            $productsQuery->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $productsQuery->where('price', '<=', $request->price_to);
        }

        foreach (['hit', 'new', 'recommend'] as $field) {
            if ($request->has($field)) {
                $productsQuery->$field();
            }
        }

        $products = $productQuery->paginate(20)->withPath("?".$request->getQueryString());

        $product = Product::get();


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

    public function search()
    {
        $title = $_GET['search'];
        $search = Product::query()
            ->where('title', 'like', '%'.$title.'%')
            ->orWhere('title_en', 'like', '%'.$title.'%')
            ->get();
        return view('search', compact('search'));
    }

}
