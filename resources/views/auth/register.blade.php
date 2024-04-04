@extends('auth/layouts.master')

@section('title', 'Регистрация')

@section('content')

    <div class="page register">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-12">
                    <h3>Регистрация</h3>
                    <form method="POST" action="{{ route('register') }}">
                        @error ('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">ФИО</label>
                            <input type="text" name="name" value="{{ old('name', isset($order) ? $order->name :
                             null) }}">
                        </div>
                        @error ('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" value="{{ old('email', isset($order) ? $order->email :
                             null) }}">
                        </div>
                        @error ('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Номер телефона</label>
                            <input type="text" name="phone" value="{{ old('phone', isset($order) ? $order->phone :
                             null) }}">
                        </div>
                        @error ('passport_inn')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">ИНН</label>
                            <input type="text" name="passport_inn" value="{{ old('passport_inn', isset($order) ?
                            $order->passport_inn : null) }}">
                        </div>
                        @error ('passport_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">ID паспорт</label>
                            <input type="text" name="passport_id" value="{{ old('passport_id', isset($order) ?
                            $order->passport_id :
                             null) }}">
                        </div>
                        <div class="form-group">
                            <label for="">Страна</label>
                            <select id="country_id" name="country_id" class="form-control">
                                <option value="">Выбрать страну</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" @selected(old('country_id') == $country->id)>
                                        {{ $country->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Регион</label>
                            <select name="region" id="region_id">
                                
                            </select>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <script>
                                $(document).ready(function () {
                                    $('#country_id').on('change', function () {
                                        let idCountry = this.value;
                                        $("#region_id").html('');
                                        $.ajax({
                                            url: "{{url('api/fetch-states')}}",
                                            type: "POST",
                                            data: {
                                                country_id: idCountry,
                                                _token: '{{csrf_token()}}'
                                            },
                                            dataType: 'json',
                                            success: function (result) {
                                                $('#region_id').html('<option value="">Выберите область</option>');
                                                $.each(result.states, function (key, value) {
                                                    $("#region_id").append('<option value="' + value.title + '">' +
                                                        value
                                                            .title + '</option>');
                                                });
                                            }
                                        });
                                    });
                                });
                            </script>
                        </div>
                        @error ('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Адрес</label>
                            <input type="text" name="address" value="{{ old('address', isset($order) ? $order->address :
                             null) }}">
                        </div>
                        @error ('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Пароль</label>
                            <input type="password" name="password" value="{{ old('password', isset($order) ?
                            $order->password : null) }}">
                        </div>
                        @error ('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Подтверждение пароля</label>
                            <input type="password" name="password_confirmation" value="{{ old('password_confirmation', isset($order) ? $order->password_confirmation :
                             null) }}">
                        </div>
                        <div class="form-group">
                            <a href="{{ route('login') }}">
                                Уже зарегистрированы?
                            </a>
                        </div>
                        @csrf
                        <button class="more">Войти</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
