@extends('layouts.app')
<style>
	body{
		background-image:url('http://blog.payture.com/wp-content/uploads/2016/10/photo-knigi-marketing.jpg');
	}
</style>
@section('content')
	<div class="container">
		<div class="row book justify-content-center">
			<div class="card border-light mb-3" style="max-width: 25rem;"><br/>
			  <img class="card-img-top" src="{{ asset('upload/'.$book->img) }}" alt="Card image cap">
			  <!-- <img class="card-img-top" src="http://evonexus.org/wp-content/uploads/2013/12/dummy-200x200.png" alt="Card image cap"> -->
			</div>
			<div class="card border-light mb-3" style="max-width: 44rem;">
			  <!-- <img class="card-img-top" src="http://evonexus.org/wp-content/uploads/2013/12/dummy-200x200.png" alt="Card image cap"> -->
			  <div class="card-body">
			    <h5 class="card-title">{{ $book->name_book }}</h5>
			    <p class="card-text">{{ $book->description }}</p>
			    <p class="card-text"><strong>Автор:</strong> {{ $book->fname }} {{ $book->name }} {{ $book->oname }}</p>
			    <p class="card-text"><strong>Год:</strong> {{ $book->year }}</p>
			    <p class="card-text"><strong>Год:</strong> {{ $book->price }} руб.</p>
			  </div>
			  <div class="card-footer bg-transparent"><button class="btn btn-primary float-right">Добавить в корзину</button></div>
			</div>
		</div>
	</div>
@endsection('content')