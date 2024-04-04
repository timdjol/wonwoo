@extends('layouts.master')

@section('title', 'Каталог')

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
                            <li>@lang('main.catalog')</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page products category catalog">
        <div class="container">
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="filters">--}}
{{--                        --}}{{--                                    <div class="form-group form-label">--}}
{{--                        --}}{{--                                        <label for="">Выбрать категорию</label>--}}
{{--                        --}}{{--                                        <select name="category_id" id="">--}}
{{--                        --}}{{--                                            @foreach($categories as $category)--}}
{{--                        --}}{{--                                                <option--}}
{{--                        --}}{{--                                                        value="{{ $category->id }}"--}}
{{--                        --}}{{--                                                        @if(@isset(request()->category_id))--}}
{{--                        --}}{{--                                                            @if(request()->category_id == $category->id) selected @endif--}}
{{--                        --}}{{--                                                        @endif--}}
{{--                        --}}{{--                                                >--}}{{--}}--}}
{{--                        --}}{{--                                                $category->title--}}
{{--                        --}}{{--                                                }}</option>--}}
{{--                        --}}{{--                                            @endforeach--}}
{{--                        --}}{{--                                        </select>--}}
{{--                        --}}{{--                                    </div>--}}
{{--                        <div class="form-group form-label">--}}
{{--                            <label for="price_from">@lang('main.price_from')</label>--}}
{{--                            <input type="text" name="price_from" id="price_from"--}}
{{--                                   value="{{ request()->price_from }}">--}}
{{--                        </div>--}}
{{--                        <div class="form-group form-label">--}}
{{--                            <label for="price_to">@lang('main.price_to')</label>--}}
{{--                            <input type="text" name="price_to" label="price_to" value="{{ request()--}}
{{--                                        ->price_to }}">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <input type="checkbox" id="hit" name="hit" @if(request()->has('hit')) checked--}}
{{--                                    @endif>--}}
{{--                            <label for="hit">@lang('product.properties.hit')</label>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <input type="checkbox" id="recommend" name="recommend" @if(request()->has--}}
{{--                                        ('recommend'))--}}
{{--                                checked @endif>--}}
{{--                            <label for="recommend">@lang('product.properties.recommend')</label>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <input type="checkbox" id="newProd" name="new" @if(request()->has('new')) checked--}}
{{--                                    @endif>--}}
{{--                            <label for="newProd">@lang('product.properties.new')</label>--}}
{{--                        </div>--}}

{{--                        <div class="form-group btn-wrap">--}}
{{--                            <button class="more">@lang('main.filter')</button>--}}
{{--                            <a href="{{ route('catalog') }}" class="reset">@lang('main.reset')</a>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div id="search">
                <div class="row">
                    @foreach($products as $product)
                        @include('layouts.card')
                    @endforeach
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script>
                $(document).ready(function () {
                    //let newProd = $('#newProd').val();
                    $('#newProd').click(function () {
                        if ($('#newProd').prop('checked') == true) {

                        }
                    });

                    $('#price_from').change(function () {
                        let price_from = $('#price_from').val();
                        //alert(price_from);
                        $.ajax({
                            url: "{{ route('catalog') }}",
                            method: "GET",
                            data: {
                                price_from: price_from,
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: (data) => {
                                let positionParametres = location.pathname.indexOf('?');
                                let url = location.pathname.substring(positionParametres, location.pathname.length);
                                let newUrl = url + '?';
                                newUrl += 'price_from=' + price_from + '&page={{ isset($_GET['page']) ? $_GET['page']
                                 : 1}}';
                                history.pushState({}, '', newUrl);
                                $('#search').html(data);
                            },
                        });
                    });


                    $('.product_sorting_btn').click(function () {
                        let orderBy = $(this).data('order');
                        $.ajax({
                            url: "{{ route('catalog') }}",
                            method: "GET",
                            data: {
                                orderBy: orderBy,
                                page: {{ isset($_GET['page']) ? $_GET['page'] : 1}},
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: (data) => {
                                let positionParametres = location.pathname.indexOf('?');
                                let url = location.pathname.substring(positionParametres, location.pathname.length);
                                let newUrl = url + '?';
                                newUrl += 'orderBy=' + orderBy + '&page={{ isset($_GET['page']) ? $_GET['page'] : 1}}';
                                history.pushState({}, '', newUrl);
                                $('#search').html(data);
                            },
                        });
                    });
                });
            </script>
            <div class="row">
                <div class="col-md-12">
                    {{ $products->appends(request()->query())->links('layouts.paginate') }}
                </div>
            </div>
        </div>
    </div>

@endsection

