@extends('layouts.master')

@section('title', 'Главная страница')

@section('content')

    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar">
                        <ul>
                            @foreach($categories as $category)
                                <li><a href="{{ route('category', $category->code) }}">{{ $category->__('title')
                                }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="slider">
                        <div class="owl-carousel owl-slider">
                            @foreach($sliders as $slider)
                                <div class="slider-item" style="background-image: url({{ Storage::url($slider->image) }})">
{{--                                    <div class="container">--}}
{{--                                        <div class="text-wrap">--}}
{{--                                            <h2>{{ $slider->__('title') }}</h2>--}}
{{--                                            @if($slider->link)--}}
{{--                                                <div class="btn-wrap">--}}
{{--                                                    <a href="{{ $slider->link }}" class="more">@lang('main.readmore')</a>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="vantage">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="vantage-item">
                        <img src="img/van1.png" alt="">
                        <h5>Проверка</h5>
                        <p>Проверка целостности товара перед отправкой
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="vantage-item">
                        <img src="img/van2.png" alt="">
                        <h5>Оперативность
                        </h5>
                        <p>Быстрое оформление заказа

                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="vantage-item">
                        <img src="img/van3.png" alt="">
                        <h5>Доставка</h5>
                        <p>Курьерская служба осуществляет доставку по всему Кыргызстану

                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="vantage-item">
                        <img src="img/van4.png" alt="">
                        <h5>Безопасность</h5>
                        <p>Мы гарантируем безопасную оплату</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="products novelties">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>@lang('main.news')</h2>
                    <div class="owl-carousel owl-products">
                        @foreach($news as $product)
                            @include('layouts.cart', compact('product'))
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="products novelties" style="padding: 0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Аксессуары</h2>
                    <div class="owl-carousel owl-products">
                        @foreach($access as $product)
                            @include('layouts.cart', compact('product'))
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="products novelties">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Электроника</h2>
                    <div class="owl-carousel owl-products">
                        @foreach($elec as $product)
                            @include('layouts.cart', compact('product'))
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
