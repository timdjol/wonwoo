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
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ strip_tags($page->description) }}" title="YouTube
                        video player" frameborder="0" allow="accelerometer;
                        autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <style>
                        iframe{
                            width: 100%;
                            height: 400px;
                        }
                    </style>
                    <div class="col-md-4">
                        <div class="logos">
                            <div class="logos-item">
                                <a target="_blank" href="https://www.coupang.com/"><div class="img"
                                                                                     style="background-image:
                                url(https://www.ezcomsoftware.com/wp-content/uploads/2021/04/Coupang.png)"></div></a>
                            </div>
                            <div class="logos-item">
                                <a target="_blank" href="https://gmarket.co.kr/"><div class="img"
                                                                                     style="background-image:
                                url(https://au.buynship.com/contents/uploads/2020/06/logo-gmarket.jpg)"></div></a>
                            </div>
                            <div class="logos-item">
                                <a target="_blank" href="https://www.tmon.co.kr/"><div class="img"
                                                                                     style="background-image:
                                url(https://images.crunchbase.com/image/upload/c_lpad,f_auto,q_auto:eco,dpr_1/v1430122036/tbuocqgjjfzlafqphvpx.jpg)"></div></a>
                            </div>
                            <div class="logos-item">
                                <a target="_blank" href="https://encar.com/"><div class="img" style="background-image:
                                url(https://www.encar.com/images/common/icon/brand_logo_400x400_v2.jpg?200526)"></div></a>
                            </div>
                            <div class="logos-item">
                                <a target="_blank" href="https://www.danawa.com/"><div class="img"
                                                                                     style="background-image:
                                url(data:image/jpeg;base64,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)"></div></a>
                            </div>
                        </div>
                        <form action="{{ route('liveform') }}">
                            <input type="hidden" name="link" value="{{ $page->description }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
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
                        <h3>Пожалуйста пройдите <a href="{{ route('login') }}">авторизацию</a></h3>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <style>
        .logos-item{
            display: inline-block;
            margin: 5px;
        }
        .img{
            width: 80px;
            height: 80px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            border: 1px solid #ddd;
            border-radius: 100%;
            background-color: #fff;
        }
    </style>



@endsection


