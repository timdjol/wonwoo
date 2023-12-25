@extends('auth.layouts.master')

@isset($region)
    @section('title', 'Редактировать регион')
@else
    @section('title', 'Добавить регион')
@endisset

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @isset($region)
                        <h1>Редактировать регион</h1>
                    @else
                        <h1>Добавить регион</h1>
                    @endisset
                    <form method="post"
                          @isset($region)
                              action="{{ route('regions.update', $region) }}"
                          @else
                              action="{{ route('regions.store') }}"
                            @endisset
                    >
                        @isset($region)
                            @method('PUT')
                        @endisset
                        @include('auth.layouts.error', ['fieldname' => 'country_id'])
                        <div class="form-group">
                            <label for="">Страна</label>
                            <select name="country_id">
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}"
                                            @isset($region)
                                                @if($region->country_id == $country->id)
                                                    selected
                                            @endif
                                            @endisset
                                    >{{ $country->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'title'])
                        <div class="form-group">
                            <label for="">Регион</label>
                            <input type="text" name="title" value="{{ old('title', isset($region) ? $region->title :
                            null)
                            }}">
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
