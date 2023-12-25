@extends('auth.layouts.master')

@isset($country)
    @section('title', 'Редактировать страну')
@else
    @section('title', 'Добавить страну')
@endisset

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @isset($country)
                        <h1>Редактировать страну</h1>
                    @else
                        <h1>Добавить страну</h1>
                    @endisset
                    <form method="post"
                          @isset($country)
                              action="{{ route('countries.update', $country) }}"
                          @else
                              action="{{ route('countries.store') }}"
                            @endisset
                    >
                        @isset($country)
                            @method('PUT')
                        @endisset
                        @include('auth.layouts.error', ['fieldname' => 'title'])
                        <div class="form-group">
                            <label for="">Страна</label>
                            <input type="text" name="title" value="{{ old('title', isset($country) ? $country->title :
                            null)
                            }}">
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'code'])
                        <div class="form-group">
                            <label for="">Код</label>
                            <input type="text" name="code" value="{{ old('code', isset($country) ? $country->phone :
                             null) }}">
                        </div>
                        @csrf
                        <button class="more">Отправить</button>
                        <a href="{{url()->previous()}}" class="btn delete cancel">Отмена</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
