<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->active()->paginate(10);
        return view('auth.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $skus = $order->skus()->withTrashed()->get();
        return view('auth.orders.show', compact('order', 'skus'));
    }
}
