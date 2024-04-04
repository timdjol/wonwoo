@extends('layouts.master')

@section('title', 'Поиск')

@section('content')

    <div class="pagetitle">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>@lang('main.search')</h1>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('index') }}">@lang('main.home')</a></li>
                            <li>/</li>
                            <li>@lang('main.search')</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="products">
        <div class="container">
            <div class="row">
                @if($search)
                    @foreach($search as $product)
                        @include('layouts.card')
                    @endforeach
                @else
                    <h2>Продукции не найдены</h2>
                @endif
            </div>
        </div>
    </div>

@endsection
