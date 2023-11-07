@extends('layouts.master')

@section('title', $product->__('title'))

@section('content')


    <div class="pagetitle">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>@lang('main.catalog')</h1>

                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('index') }}">@lang('main.home')</a></li>
                            <li>/</li>
                            <li><a href="{{ route('category', $product->category->code) }}">{{
                    $product->category->__('title') }}</a></li>
                            <li>/</li>
                            <li>{{ $product->__('title') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="single">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="row gallery">
                        <div class="col-md-12 col-6">
                            <a href="{{ Storage::url($product->image) }}">
                                <div class="img" style="background-image: url({{ Storage::url($product->image) }})
                                "></div>
                            </a>
                        </div>
{{--                        @foreach($images as $image)--}}
{{--                            <div class="col-md-6">--}}
{{--                                <a href="{{ Storage::url($image->image) }}">--}}
{{--                                    <div class="img" style="background-image: url({{ Storage::url($image->image) }})--}}
{{--                                "></div>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
                    </div>
                </div>
                <div class="col-md-7">
                    <h1>{{ $product->__('title') }}</h1>
                    <div class="cat">
                        <a href="{{ route('category', $product->category->code) }}">{{
                    $product->category->__('title') }}</a>
                    </div>
                    <div class="price">{{ $product->price }} {{ $currencySymbol }}</div>
{{--                    @if($product->isAvailable() == 1)--}}
{{--                        <div class="stock in">@lang('product.stock')</div>--}}
{{--                    @endif--}}


                    <div class="btn-wrap">
                        <div class="buy">
                            <form action="{{ route('basket-add', $product) }}" method="post">
                                <button class="more" type="submit">@lang('product.addtocart')</button>
                                @csrf
                            </form>
                        </div>
                        <div class="click">
                            <a href="#click" class="more">@lang('product.click')</a>
                            <div class="hidden">
                                <form action="" class="form-callback" id="click">
                                    <h3>@lang('product.click')</h3>
                                    <img src="{{ Storage::url($product->image) }}" class="img" alt="">
                                    <input type="hidden" name="product" value="{{ $product->__('title') }}">
                                    <input type="hidden" name="price" value="{{ $product->price }} {{ $currencySymbol
                                    }}">
                                    <div class="form-group">
                                        <label for="">@lang('basket.your_name')</label>
                                        <input type="text" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">@lang('basket.phone')</label>
                                        <input type="number" id="phone" name="phone" value="{{ old('phone', isset
                                            ($order) ?
                            $order->phone : null) }}" required>
                                        <div id="output" class="error"></div>
                                    </div>
                                    <button id="send" class="more">@lang('product.send')</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tech" style="margin-top: 10px">
                        <ul>
                            @if($product->vendor)
                                <li>@lang('product.sku'): {{ $product->vendor }}</li>
                            @endif
                            @if($product->param)
                                <li>Вес: {{ $product->param }} kg</li>
                            @endif

                        </ul>
                    </div>
                    <div class="descr">
                        {!! $product->__('description') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>



{{--        <div class="products related">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <h2>@lang('product.related')</h2>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    @if($category->products->isNotEmpty())--}}
{{--                        @foreach($category->products as $product)--}}
{{--                            <div class="col-lg-3 col-md-4 col-6">--}}
{{--                                @include('layouts.cart', compact('product'))--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    @else--}}
{{--                        <h2>@lang('main.not_found')</h2>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}



@endsection

