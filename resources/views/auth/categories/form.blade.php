@extends('auth.layouts.master')

@isset($category)
    @section('title', 'Редактировать категорию ' . $category->name)
@else
    @section('title', 'Создать категорию')
@endisset

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @isset($category)
                        <h1>Редактировать категорию {{ $category->title }}</h1>
                    @else
                        <h1>Создать категорию</h1>
                    @endisset
                    <form method="post" enctype="multipart/form-data"
                          @isset($category)
                              action="{{ route('categories.update', $category) }}"
                          @else
                              action="{{ route('categories.store') }}"
                            @endisset
                    >
                        @isset($category)
                            @method('PUT')
                        @endisset
                        @error('code')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Код</label>
                            <input type="text" name="code" value="{{ old('code', isset($category) ? $category->code :
                             null) }}">
                        </div>
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Заголовок</label>
                            <input type="text" name="title" value="{{ old('title', isset($category) ? $category->title :
                             null) }}">
                        </div>
                        <div class="form-group">
                            <label for="">Заголовок EN</label>
                            <input type="text" name="title_en" value="{{ old('title_en', isset($category) ?
                                $category->title_en :
                             null) }}">
                        </div>
                        <div class="form-group">
                            <label for="">Изображение</label>
                            <input type="file" name="image">
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
