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
                        @include('auth.layouts.error', ['fieldname' => 'country_id'])
                            <div class="form-group">
                                <label for="">Страна</label>
                                <select name="country_id">
                                    @foreach($countries as $country)
                                        <option value="{{ $country->code }}"
                                                @isset($region)
                                                    @if($region->country_id == $country->id)
                                                        selected
                                                @endif
                                                @endisset
                                        >{{ $country->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @include('auth.layouts.error', ['fieldname' => 'city'])
                        <div class="form-group">
                            <label for="">Регион</label>
                            <select name="region_id" id="child_select">
                            </select>
                            <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                                    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
                                    crossorigin="anonymous"></script>
                            <script>
                                $(document).ready(function () {
                                    var kg = [{
                                        display: "Баткенская область",
                                        value: "1"
                                    }, {
                                        display: "Джалал-Абадская область",
                                        value: "Джалал-Абадская область"
                                    }, {
                                        display: "Иссык-Кульская область",
                                        value: "Иссык-Кульская область"
                                    }, {
                                        display: "Нарынская область",
                                        value: "Нарынская область"
                                    }, {
                                        display: "Ошская область",
                                        value: "Ошская область"
                                    }, {
                                        display: "Талаская область",
                                        value: "Талаская область"
                                    }, {
                                        display: "Чуйская область",
                                        value: "Чуйская область"
                                    }];

                                    var kz = [{
                                        display: "Астана",
                                        value: "Астана"
                                    }, {
                                        display: "Алма-Ата",
                                        value: "Алма-Ата"
                                    }, {
                                        display: "Абайская область",
                                        value: "Абайская область"
                                    }, {
                                        display: "Акмолинская область",
                                        value: "Акмолинская область"
                                    }, {
                                        display: "Актюбинская область",
                                        value: "Актюбинская область"
                                    }, {
                                        display: "Алматинская область",
                                        value: "Алматинская область"
                                    }, {
                                        display: "Атырауская область",
                                        value: "Атырауская область"
                                    }, {
                                        display: "Восточно-Казахстанская область",
                                        value: "Восточно-Казахстанская область"
                                    }, {
                                        display: "Жамбылская область",
                                        value: "Жамбылская область"
                                    }, {
                                        display: "Жетысуская область",
                                        value: "Жетысуская область"
                                    }, {
                                        display: "Западно-Казахстанская область",
                                        value: "Западно-Казахстанская область"
                                    }, {
                                        display: "Карагандинская область",
                                        value: "Карагандинская область"
                                    }, {
                                        display: "Абайская область",
                                        value: "Абайская область"
                                    }, {
                                        display: "Костанайская область",
                                        value: "Костанайская область"
                                    }, {
                                        display: "Кызылординская область",
                                        value: "Кызылординская область"
                                    }, {
                                        display: "Мангистауская область",
                                        value: "Мангистауская область"
                                    }, {
                                        display: "Павлодарская область",
                                        value: "Павлодарская область"
                                    }, {
                                        display: "Северо-Казахстанская область",
                                        value: "Северо-Казахстанская область"
                                    }, {
                                        display: "Туркестанская область",
                                        value: "Туркестанская область"
                                    }, {
                                        display: "Улытауская область",
                                        value: "Улытауская область"
                                    },];

                                    var ru = [{
                                        display: "Амурская область",
                                        value: "Амурская область"
                                    }, {
                                        display: "Архангельская область",
                                        value: "Архангельская область"
                                    }, {
                                        display: "Астраханская область",
                                        value: "Астраханская область"
                                    }, {
                                        display: "Белгородская область",
                                        value: "Белгородская область"
                                    }, {
                                        display: "Брянская область",
                                        value: "Брянская область"
                                    }, {
                                        display: "Владимирская область",
                                        value: "Владимирская область"
                                    }, {
                                        display: "Волгоградская область",
                                        value: "Волгоградская область"
                                    }, {
                                        display: "Вологодская область",
                                        value: "Вологодская область"
                                    }, {
                                        display: "Воронежская область",
                                        value: "Воронежская область"
                                    }, {
                                        display: "Ивановская область",
                                        value: "Ивановская область"
                                    }, {
                                        display: "Иркутская область",
                                        value: "Иркутская область"
                                    }, {
                                        display: "Калининградская область",
                                        value: "Калининградская область"
                                    }, {
                                        display: "Калужская область",
                                        value: "Калужская область"
                                    }, {
                                        display: "Кемеровская область",
                                        value: "Кемеровская область"
                                    }, {
                                        display: "Кировская область",
                                        value: "Кировская область"
                                    }, {
                                        display: "Костромская область",
                                        value: "Костромская область"
                                    }, {
                                        display: "Курганская область",
                                        value: "Курганская область"
                                    }, {
                                        display: "Курская область",
                                        value: "Курская область"
                                    }, {
                                        display: "Ленинградская область",
                                        value: "Ленинградская область"
                                    }, {
                                        display: "Липецкая область",
                                        value: "Липецкая область"
                                    }, {
                                        display: "Магаданская область",
                                        value: "Магаданская область"
                                    }, {
                                        display: "Московская область",
                                        value: "Московская область"
                                    }, {
                                        display: "Мурманская область",
                                        value: "Мурманская область"
                                    }, {
                                        display: "Нижегородская область",
                                        value: "Нижегородская область"
                                    }, {
                                        display: "Новгородская область",
                                        value: "Новгородская область"
                                    }, {
                                        display: "Новосибирская область",
                                        value: "Новосибирская область"
                                    }, {
                                        display: "Омская область",
                                        value: "Омская область"
                                    }, {
                                        display: "Оренбургская область",
                                        value: "Оренбургская область"
                                    }, {
                                        display: "Орловская область",
                                        value: "Орловская область"
                                    }, {
                                        display: "Пензенская область",
                                        value: "Пензенская область"
                                    }, {
                                        display: "Псковская область",
                                        value: "Псковская область"
                                    }, {
                                        display: "Ростовская область",
                                        value: "Ростовская область"
                                    }, {
                                        display: "Рязанская область",
                                        value: "Рязанская область"
                                    }, {
                                        display: "Самарская область",
                                        value: "Самарская область"
                                    }, {
                                        display: "Саратовская область",
                                        value: "Саратовская область"
                                    }, {
                                        display: "Сахалинская область",
                                        value: "Сахалинская область"
                                    }, {
                                        display: "Свердловская область",
                                        value: "Свердловская область"
                                    }, {
                                        display: "Смоленская область",
                                        value: "Смоленская область"
                                    }, {
                                        display: "Тамбовская область",
                                        value: "Тамбовская область"
                                    }, {
                                        display: "Тверская область",
                                        value: "Тверская область"
                                    }, {
                                        display: "Томская область",
                                        value: "Томская область"
                                    }, {
                                        display: "Тульская область",
                                        value: "Тульская область"
                                    }, {
                                        display: "Тюменская область",
                                        value: "Тюменская область"
                                    }, {
                                        display: "Ульяновская область",
                                        value: "Ульяновская область"
                                    }, {
                                        display: "Челябинская область",
                                        value: "Челябинская область"
                                    }, {
                                        display: "Ярославская область",
                                        value: "Ярославская область"
                                    }, {
                                        display: "Еврейская область",
                                        value: "Еврейская область"
                                    }];

                                    var uz = [{
                                        display: "Ташкент",
                                        value: "Ташкент"
                                    }, {
                                        display: "Республика Каракалпакстан",
                                        value: "Республика Каракалпакстан"
                                    }, {
                                        display: "Андижанская область",
                                        value: "Андижанская область"
                                    }, {
                                        display: "Бухарская область",
                                        value: "Бухарская область"
                                    }, {
                                        display: "Джизакская область",
                                        value: "Джизакская область"
                                    }, {
                                        display: "Кашкадарьинская область",
                                        value: "Кашкадарьинская область"
                                    }, {
                                        display: "Навоийская область",
                                        value: "Навоийская область"
                                    }, {
                                        display: "Наманганская область",
                                        value: "Наманганская область"
                                    }, {
                                        display: "Самаркандская область",
                                        value: "Самаркандская область"
                                    }, {
                                        display: "Сурхандарьинская область",
                                        value: "Сурхандарьинская область"
                                    }, {
                                        display: "Сырдарьинская область",
                                        value: "Сырдарьинская область"
                                    }, {
                                        display: "Ташкентская область",
                                        value: "Ташкентская область"
                                    }, {
                                        display: "Ферганская область",
                                        value: "Ферганская область"
                                    }, {
                                        display: "Хорезмская область",
                                        value: "Хорезмская область"
                                    }];

                                    //If parent option is changed
                                    $("#parent_select").change(function () {
                                        var parent = $(this).val(); //get option value from parent

                                        switch (parent) { //using switch compare selected option and populate child
                                            case 'kg':
                                                list(kg);
                                                break;
                                            case 'kz':
                                                list(kz);
                                                break;
                                            case 'ru':
                                                list(ru);
                                                break;
                                            case 'uz':
                                                list(uz);
                                                break;
                                            default: //default child option is blank
                                                $("#child_select").html('');
                                                break;
                                        }
                                    });

                                    //function to populate child select box
                                    function list(array_list) {
                                        $("#child_select").html(""); //reset child options
                                        $(array_list).each(function (i) { //populate child options
                                            $("#child_select").append("<option value=" + array_list[i].value + ">" + array_list[i].display + "</option>");
                                        });
                                    }

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
