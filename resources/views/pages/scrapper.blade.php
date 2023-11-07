@extends('layouts.master')

@section('title', 'О нас')

@section('content')


    <div class="page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">

                    @foreach($titles as $title)
                        <div class="page-item">
                            <div class="title">{{ $title }} <br></div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

@endsection
