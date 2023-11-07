@extends('layouts.master')

@section('title', 'Прямой эфир')

@section('content')

    @if (Auth::user())
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

        <div class="page">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/3Z9XOg-XPuI?si={{
                        $page->description }}" title="YouTube video player" frameborder="0" allow="accelerometer;
                        autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <style>
                        iframe{
                            width: 100%;
                            height: 400px;
                        }
                    </style>
                    <div class="col-md-4">
                        <form action="{{ route('liveform') }}">
                            <input type="hidden" name="link" value="{{ $page->description }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="user_name" value="{{ Auth::user()->name }}">
                            <input type="hidden" name="user_phone" value="{{ Auth::user()->phone }}">
                            <input type="hidden" name="user_email" value="{{ Auth::user()->email }}">
                            <input type="hidden" name="user_address" value="{{ Auth::user()->address }}">
                            <input type="hidden" name="user_passport_id" value="{{ Auth::user()->passport_id }}">
                            <div class="form-group">
                                <label for="message">@lang('main.message')</label>
                                <textarea name="message" id="message" rows="6" required></textarea>
                            </div>
                            @csrf
                            <button class="more" id="send">@lang('product.send')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        Pleas auth
                    </div>
                </div>
            </div>
        </div>
    @endif



@endsection


