@extends('auth.layouts.master')

@isset($user)
    @section('title', 'Редактировать пользователя')
@else
    @section('title', 'Добавить пользователя')
@endisset

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @isset($user)
                        <h1>Редактировать пользователя</h1>
                    @else
                        <h1>Добавить пользователя</h1>
                    @endisset
                    <form method="post"
                          @isset($user)
                              action="{{ route('users.update', $user) }}"
                          @else
                              action="{{ route('users.store') }}"
                            @endisset
                    >
                        @isset($user)
                            @method('PUT')
                        @endisset
                        @include('auth.layouts.error', ['fieldname' => 'name'])
                        <div class="form-group">
                            <label for="">ФИО</label>
                            <input type="text" name="name" value="{{ old('name', isset($user) ? $user->name : null) }}">
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'value'])
                        <div class="form-group">
                            <label for="">Номер телефона</label>
                            <input type="text" name="phone" value="{{ old('value', isset($user) ? $user->phone :
                             null) }}">
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'email'])
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" value="{{ old('value', isset($user) ? $user->email :
                             null) }}">
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'country'])
                        <div class="form-group">
                            <label for="">Страна</label>
                            <select id="country_id" name="country" class="form-control">
                                @foreach ($countries as $country)
                                    <option value="{{$country->id}}"
                                    @isset($user->country)
                                        @if($user->country == $country->id)
                                            selected
                                            @endif
                                        @endisset
                                    >{{$country->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'region'])
                        <div class="form-group">
                            <label for="">Регион</label>
                            <select name="region" id="region_id">
                                @isset($user->region)
                                    <option value="{{ $user->region }}">{{ $user->region }}</option>
                                @endisset
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
                        @include('auth.layouts.error', ['fieldname' => 'address'])
                        <div class="form-group">
                            <label for="">Адрес</label>
                            <input type="text" name="address" value="{{ old('description', isset($user) ?
                                $user->address : null) }}">
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'passport_inn'])
                        <div class="form-group">
                            <label for="">ИНН</label>
                            <input type="text" name="passport_inn" value="{{ old('passport_inn', isset($user) ?
                                $user->passport_inn : null) }}">
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'passport_id'])
                        <div class="form-group">
                            <label for="">ID Паспорт</label>
                            <input type="text" name="passport_id" value="{{ old('passport_id', isset($user) ?
                                $user->passport_id : null) }}">
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'password'])
                        <div class="form-group">
                            <label for="">Пароль</label>
                            <input type="password" name="password"
                                   value="{{ old('password', isset($user) ? $user->password : null) }}">
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
