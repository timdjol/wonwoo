<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Image;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Support\Facades\App;

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
        $paginate = 30;
        $products = Product::paginate($paginate);
        $product = Product::get();

        if(isset($request->price_from)){
            $products = Product::where('price', '>=', $request->price_from)->paginate($paginate);
        }

        if(isset($request->orderBy)){
            if($request->orderBy == 'price-low-high'){
                $products = Product::orderBy('price')->paginate($paginate);
            }
            if($request->orderBy == 'price-high-low'){
                $products = Product::orderBy('price', 'desc')->paginate($paginate);
            }
            if($request->orderBy == 'name-a-z'){
                $products = Product::orderBy('title', 'asc')->paginate($paginate);
            }
            if($request->orderBy == 'name-z-a'){
                $products = Product::orderBy('title', 'desc')->paginate($paginate);
            }
        }

        if($request->ajax()){
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
            ->where('title', 'like', '%'.$title.'%')
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

}
