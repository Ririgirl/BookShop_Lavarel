@extends('layouts.app')
@section('title', '| Оформление заказа')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Корзина</div>
                	<div class="card-body">
										<div class="row">
											<div class="col-md-5">
												<strong>Ваш заказ</strong><hr>
												@foreach($products as $product)
													<div class="row">
														<div class="col-md-6">
															{{ $product['item']['name_book'] }}
														</div>
														<div class="col-md-3">
															{{ $product['qty'] }} шт.
														</div>
														<div class="col-md-3">
															{{ $product['item']['price'] }} руб.
														</div>
													</div>
                          
                          <!-- {{ $product['item']['id'] }}
                          {{ $product['item']['year'] }}
                          {{ $product['item']['price'] }}
                          Количество: {{ $product['qty'] }}
                          Цена: {{$product['price']}} -->
                          @endforeach
                          <hr>
                          <strong>Сумма к оплате:</strong> {{$total}} руб.
											</div>
											<div class="col-md-7">
												<strong>Ваши данные</strong><hr>
												<div class="row">
													<div class="col-md-12">
														<form action="{{ action('HomeController@saveOrder') }}" method = "post">
															{{ csrf_field() }}
	                            <input type="hidden" name='_method' value='post'/>
	                            <div class="row">
	                                <div class="col-md-3"><p><strong>Фамилия:*</strong></p></div>
	                                <div class="col-md-9"><input type="text" class="form-control" value='{{ Auth::user()->fname }}' name = 'fname' required></div>
	                                <div class="col-md-3"><p><strong>Имя:* </strong></p></div>
	                                <div class="col-md-9"><input type="text" class="form-control" value='{{ Auth::user()->name }}' name = 'name' required></div>
	                                <div class="col-md-3"><p><strong>Отчество:* </strong></p></div>
	                                <div class="col-md-9"><input type="text" class="form-control" value='{{ Auth::user()->oname }}' name = 'oname' required></div>
	                                <div class="col-md-3"><p><strong>E-mail:* </strong></p></div>
	                                <div class="col-md-9"><input type="text" class="form-control" value='{{ Auth::user()->email }}' name = 'email' required></div>
	                                <div class="col-md-3"><p><strong>Адрес доставки:* </strong></p></div>
	                                <div class="col-md-9"><input type="text" class="form-control" value='{{ Auth::user()->adr }}' name = 'adr' required></div>
	                                <div class="col-md-3"><p><strong>Телефон:* </strong></p></div>
	                                <div class="col-md-9"><input type="number" class="form-control" value='{{ Auth::user()->tel }}' name = 'tel' required></div>
	                            </div><br/>
	                            <input class="btn btn-primary float-right" value='Сохранить' type='submit'>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
						</div>
        </div>                 
    </div>
</div>
@endsection