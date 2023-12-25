@extends('auth.layouts.master')

@section('title', 'Заявки с прямого эфира')

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
                        <h2>Заявки с прямого эфира</h2>
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>Дата</th>
                            <th>Сообщение</th>
                            <th>ФИО</th>
                            <th>Телефон</th>
                            <th>Email</th>
                            <th>Адрес</th>
                            <th>Действия</th>
                        </tr>
                        @foreach($lives as $life)
                            <tr>
                                <td>{{ $life->created_at }}</td>
                                <td>{{ $life->message }}</td>
                                <td>{{ $life->user_name }}</td>
                                <td><a href="tel:{{ $life->user_phone }}">{{ $life->user_phone }}</a></td>
                                <td><a href="mailto:{{ $life->user_email }}">{{ $life->user_email }}</a></td>
                                <td>{{ $life->user_address }}</td>
                                <td>
                                    <form action="{{ route('lives.destroy', $life) }}" method="post">
                                        <ul>
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
