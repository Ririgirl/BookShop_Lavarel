@extends('layouts.app')
@section('title', '| Корзина')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Корзина</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container">
                        @if(Session::has('cart'))
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class='list-group'>
                                        @foreach($products as $product)
                                        <li class='list-group-item'>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <strong>{{ $product['item']['name_book'] }}</strong>
                                                </div>
                                                <div class="col-md-2">
                                                    <span class='badge'>Количество: {{ $product['qty'] }}</span>
                                                </div>
                                                <div class="col-md-2">
                                                    <span class='label label-success'>Цена: {{$product['price']}}</span>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="dropdown"></div>
                                                        <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Удалить <span class='caret'></span></button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a href="{{ action('HomeController@deleteoneincart', ['id' => $product['item']['id']])}}" class="dropdown-item">Удалить 1 шт</a>
                                                            <a href="{{ action('HomeController@removeincart', ['id' => $product['item']['id']])}}" class="dropdown-item">Удалить все</a>
                                                        </div>
                                            </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>  
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12"><br>
                                    <strong class="float-right">Итог: {{ $totalPrice }}</strong><br/>
                                    <a href="{{ action('HomeController@getCheckout')}}" class="btn btn-primary float-right">Купить</a>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-12"><br>
                                    <h3>Нет товаров в корзине!</h3>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
