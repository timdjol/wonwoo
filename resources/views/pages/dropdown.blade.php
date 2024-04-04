@extends('layouts.master')

@section('title', 'Доставка')

@section('content')

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form>
                    <div class="form-group mb-3">
                        <select id="country-dropdown" class="form-control">
                            <option value="">Выбрать страну</option>
                            @foreach ($countries as $data)
                                <option value="{{$data->id}}">{{$data->title}}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="form-group mb-3">

                        <select id="state-dropdown" class="form-control"></select>

                    </div>


                </form>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                <script>
                    $(document).ready(function () {
                        $('#country-dropdown').on('change', function () {
                            var idCountry = this.value;
                            $("#state-dropdown").html('');
                            $.ajax({
                                url: "{{url('api/fetch-states')}}",
                                type: "POST",
                                data: {
                                    country_id: idCountry,
                                    _token: '{{csrf_token()}}'
                                },
                                dataType: 'json',
                                success: function (result) {
                                    $('#state-dropdown').html('<option value="">Выберите область</option>');
                                    $.each(result.states, function (key, value) {
                                        $("#state-dropdown").append('<option value="' + value.id + '">' + value.title + '</option>');
                                    });
                                }
                            });
                        });
                    });
                </script>

            </div>

        </div>

    </div>

@endsection