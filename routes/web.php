<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('locale/{locale}', 'App\Http\Controllers\MainController@changeLocale')->name('locale');
Route::get('currency/{currencyCode}', 'App\Http\Controllers\MainController@changeCurrency')->name('currency');
Route::get('/logout', 'App\Http\Controllers\ProfileController@logout')->name('get-logout');


Route::middleware('set_locale')->group(function(){
    Route::middleware('auth')->group(function()
    {
        Route::group([
            "prefix" => "person",
            "as" => "person.",
        ], function ()
        {
            Route::get('/orders', [\App\Http\Controllers\Person\OrderController::class, 'index'])->name('orders.index');
            Route::get('/orders/{order}',
                [\App\Http\Controllers\Person\OrderController::class, 'show'])->name('orders.show');
        });

        Route::group([
            "prefix" => "admin"
        ], function ()
        {
            Route::group(["middleware" => "is_admin"], function ()
            {
                Route::get('/dashboard',
                    [App\Http\Controllers\Admin\OrderController::class, 'dashboard'])->name('dashboard');
                Route::resource("orders", "App\Http\Controllers\Admin\OrderController");
                Route::resource('categories', 'App\Http\Controllers\Admin\CategoryController');
                Route::resource('products', 'App\Http\Controllers\Admin\ProductController');
                Route::resource("contacts", "App\Http\Controllers\Admin\ContactController");
                Route::resource("pages", "App\Http\Controllers\Admin\PageController");
                Route::resource("coupons", "App\Http\Controllers\Admin\CouponController");
                Route::resource("sliders", "App\Http\Controllers\Admin\SliderController");
                Route::resource("lives", "App\Http\Controllers\Admin\LiveController");
                Route::resource("users", "App\Http\Controllers\Admin\UserController");
            });
        });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';


    Route::get('/', [MainController::class, 'index'])->name('index');
    Route::get('/catalog', [MainController::class, 'catalog'])->name('catalog');
    Route::get('/categories', [MainController::class, 'categories'])->name('categories');
    Route::get('/delivery', [PageController::class, 'delivery'])->name('delivery');
    Route::get('/payment', [PageController::class, 'payment'])->name('payment');
    Route::get('/refund', [PageController::class, 'refund'])->name('refund');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contactspage', [PageController::class, 'contacts'])->name('contactspage');
    Route::get('/policy', [PageController::class, 'policy'])->name('policy');
    Route::get('/search', [MainController::class, 'search'])->name('search');
    Route::get('/lives', [PageController::class, 'live'])->name('lives');
    Route::get('/liveform', [PageController::class, 'liveform'])->name('liveform');
    Route::get('/scrapper', [PageController::class, 'scrapper'])->name('scrapper');

    Route::group([], function (){
        Route::post('/basket/add/{product?}', 'App\Http\Controllers\BasketController@basketAdd')->name('basket-add');
        Route::get('/basket/reset', 'App\Http\Controllers\BasketController@resetBasket')->name('basket-reset');
        Route::group(['middleware' => 'basket_not_empty'], function (){
            Route::get('/basket', [BasketController::class, 'basket'])->name('basket');
            Route::get('/order', [BasketController::class, 'order'])->name('order');
            Route::post('/order/confirm', [BasketController::class, 'orderConfirm'])->name('order-confirm');
            Route::post('/basket/remove/{product}', 'App\Http\Controllers\BasketController@basketRemove')->name('basket-remove');
            Route::post('/basket/coupon', 'App\Http\Controllers\BasketController@setCoupon')->name('set-coupon');
        });
    });

    Route::get('/{category}', [MainController::class, 'category'])->name('category');
    Route::get('/{category}/{product}', [MainController::class, 'product'])->name('product');

});

