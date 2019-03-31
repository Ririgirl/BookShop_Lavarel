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
                        <form action = "{{ action('HomeController@edit') }}" method = "post">
                            {{ csrf_field() }}
                            <input type="hidden" name='_method' value='post'/>
                            <div class="row">
                                <div class="col-md-3"><p><strong>Фамилия: </strong></p></div>
                                <div class="col-md-9"><input type="text" class="form-control" value='{{ Auth::user()->fname }}' name = 'fname'></div>
                                <div class="col-md-3"><p><strong>Имя: </strong></p></div>
                                <div class="col-md-9"><input type="text" class="form-control" value='{{ Auth::user()->name }}' name = 'name'></div>
                                <div class="col-md-3"><p><strong>Отчество: </strong></p></div>
                                <div class="col-md-9"><input type="text" class="form-control" value='{{ Auth::user()->oname }}' name = 'oname'></div>
                                <div class="col-md-3"><p><strong>E-mail: </strong></p></div>
                                <div class="col-md-9"><input type="text" class="form-control" value='{{ Auth::user()->email }}' name = 'email'></div>
                                <div class="col-md-3"><p><strong>Адрес доставки: </strong></p></div>
                                <div class="col-md-9"><input type="text" class="form-control" value='{{ Auth::user()->adr }}' name = 'adr'></div>
                                <div class="col-md-3"><p><strong>Телефон: </strong></p></div>
                                <div class="col-md-9"><input type="number" class="form-control" value='{{ Auth::user()->tel }}' name = 'tel'></div>
                            </div><br/>
                            <input class="btn btn-primary float-right" value='Сохранить' type='submit'>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection