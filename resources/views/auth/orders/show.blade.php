@extends('auth/layouts.master')

@section('title', 'Заказ # ' . $order->id)

@section('content')

    <div class="page admin order">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth/layouts.sidebar')
                </div>
                <div class="col-md-9">
                    <h1>Заказ #{{ $order->id }}</h1>
                    <p><b>Заказчик:</b> {{$order->name}}</p>
                    <p><b>Телефон:</b> <a href="tel:{{$order->phone}}">{{$order->phone}}</a></p>
                    <p><b>Способ доставки:</b> {{$order->type_address}}</p>
                    @if($order->type_address == 'Заказать через курьера')
                        <p><b>Адрес:</b> {{$order->address}}</p>
                        <p><b>Комментарий:</b> {{$order->comment}}</p>
                    @endif
                    <p><b>Способ оплаты:</b> {{$order->type_payment}}</p>
                    <p><b>Статус:</b> {{$order->label}}</p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th>Количество</th>
                            <th>Цена</th>
                            <th>Стоимость</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td><a href="{{ route('product', [$product->category->code, $product->code,
                                $product->id]) }}">
                                        <img src="{{ Storage::url($product->image) }}" alt="">
                                        <div class="descr">{{ $product->title }}</div>
                                    </a>
                                </td>
                                <td>{{ $product->pivot->count }}</td>
                                <td>{{ $product->pivot->price }} {{ $order->currency->symbol }}</td>
                                <td>{{ $product->pivot->price * $product->pivot->count }} {{
                                $order->currency->symbol }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4">Общая стоимость:</td>
                            <td>{{ $order->sum }} {{ $order->currency->symbol }}</td>
                        </tr>
                        @if($order->hasCoupon())
                            <tr>
                                <td colspan="4">Был использован купон:</td>
                                <td><a href="{{ route('coupons.show', $order->coupon)  }}">{{ $order->coupon->code
                                }}</a></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
