@extends('auth.layouts.master')

@isset($life)
    @section('title', 'Прямой эфир')
@endisset

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    <h1>Прямой эфир</h1>
                    <form method="post" action="{{ route('lives.update', $life) }}">
                        @isset($life)
                            @method('PUT')
                        @endisset
                        @error('link')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">ID youtube</label>
                            <input type="text" name="link" value="{{ old('link', isset($life) ? $life->link : null) }}">
                        </div>
                        @csrf
                        <button class="more">Сохранить</button>
                        <a href="{{url()->previous()}}" class="btn delete cancel">Отмена</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
