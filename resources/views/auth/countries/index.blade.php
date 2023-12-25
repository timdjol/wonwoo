@extends('auth.layouts.master')

@section('title', 'Страны')

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @if(session()->has('success'))
                        <p class="alert alert-success">{{ session()->get('success') }}</p>
                    @endif
                    @if(session()->has('warning'))
                        <p class="alert alert-warning">{{ session()->get('warning') }}</p>
                    @endif
                    <div class="row">
                        <div class="col-md-7">
                            <h2>Страны</h2>
                        </div>
                        <div class="col-md-5">
                            <a href="{{ route('countries.create') }}" class="btn add">Добавить</a>
                        </div>
                    </div>
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Код</th>
                            <th>Страна</th>
                            <th>Действия</th>
                        </tr>
                        @foreach($countries as $country)
                            <tr>
                                <td>{{ $country->id }}</td>
                                <td>{{ $country->code }}</td>
                                <td>{{ $country->title }}</td>
                                <td>
                                    <form action="{{ route('countries.destroy', $country) }}" method="post">
                                        <ul>
                                            <li><a class="btn view" href="{{ route('countries.show', $country)
                                            }}">Открыть</a></li>
                                            <li><a class="btn edit" href="{{ route('countries.edit', $country)
                                            }}">Редактировать</a></li>
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn delete">Удалить</button>
                                        </ul>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
