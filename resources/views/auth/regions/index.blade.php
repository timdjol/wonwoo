@extends('auth.layouts.master')

@section('title', 'Регионы')

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
                            <h2>Регионы</h2>
                        </div>
                        <div class="col-md-5">
                            <a href="{{ route('regions.create') }}" class="btn add">Добавить</a>
                        </div>
                    </div>
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Страна</th>
                            <th>Регион</th>
                            <th>Действия</th>
                        </tr>
                        @foreach($regions as $region)
                            <tr>
                                <td>{{ $region->id }}</td>
                                <td>{{ $region->country->title }}</td>
                                <td>{{ $region->title }}</td>
                                <td>
                                    <form action="{{ route('regions.destroy', $region) }}" method="post">
                                        <ul>
                                            <li><a class="btn view" href="{{ route('regions.show', $region)
                                            }}">Открыть</a></li>
                                            <li><a class="btn edit" href="{{ route('regions.edit', $region)
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
                    {{ $regions->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection
