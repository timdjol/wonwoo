@extends('layouts.master')

@section('title', 'Договор оферты')

@section('content')

    <div class="pagetitle">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $page->__('title') }}</h1>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('index') }}">@lang('main.home')</a></li>
                            <li>/</li>
                            <li>{{ $page->__('title') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page cooperation pt0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    {!! $page->__('description') !!}
                </div>
            </div>
        </div>
    </div>

@endsection
