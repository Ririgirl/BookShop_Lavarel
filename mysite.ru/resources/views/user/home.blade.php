@extends('layouts.app')
@section('title', '| Регистрация')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Личный кабинет</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3"><p><strong>Фамилия: </strong></p></div>
                            <div class="col-md-9">{{ Auth::user()->fname }}</div>
                            <div class="col-md-3"><p><strong>Имя: </strong></p></div>
                            <div class="col-md-9">{{ Auth::user()->name }}</div>
                            <div class="col-md-3"><p><strong>Отчество: </strong></p></div>
                            <div class="col-md-9">{{ Auth::user()->oname }}</div>
                            <div class="col-md-3"><p><strong>E-mail: </strong></p></div>
                            <div class="col-md-9">{{ Auth::user()->email }}</div>
                            <div class="col-md-3"><p><strong>Адрес доставки: </strong></p></div>
                            <div class="col-md-9">{{ Auth::user()->adr }}</div>
                            <div class="col-md-3"><p><strong>Телефон: </strong></p></div>
                            <div class="col-md-9">{{ Auth::user()->tel }}</div>
                        </div>
                        <a class="btn btn-primary float-right" href="{{ action('HomeController@update') }}" role="button">Изменить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
