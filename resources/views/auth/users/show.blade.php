@extends('auth.layouts.master')

@section('title', 'Пользователь ' . $user->name)

@section('content')

    <div class="page">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    <h1>{{ $user->name }}</h1>
                    <table class="table">
                        <tr>
                            <td>ID</td>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <td>Номер телефона</td>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>Адрес</td>
                            <td>{{ $user->address }}</td>
                        </tr>
                        <tr>
                            <td>ID паспорт</td>
                            <td>{{ $user->passport_id }}</td>
                        </tr>
                        <tr>
                            <td>ИНН</td>
                            <td>{{ $user->passport_inn }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
