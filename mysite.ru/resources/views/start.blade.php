@extends('layouts.app')
<style>
	body{
		background-image:url('http://blog.payture.com/wp-content/uploads/2016/10/photo-knigi-marketing.jpg');
	}
</style>
@section('content')
	<div class="container">
		<div class="row book justify-content-center">
			@FOREACH ($books as $book)
			<div class="card border-light mb-3" style="max-width: 14rem;">
			  <img class="card-img-top" src="{{ asset('upload/'.$book->img) }}" alt="Card image cap">
			  <div class="card-body">
			    <h5 class="card-title"><a href="/book/{{ $book->id }}">{{ $book->name_book }}</a></h5>
			    <p class="card-text">{{ str_limit($book->description, $limit = 100, $end = '...') }}</p>
			    <p class="card-text"><strong>Автор:</strong> {{ $book->fname }} {{ $book->name }} {{ $book->oname }}</p>
			    <p class="card-text"><strong>Год:</strong> {{ $book->year }}</p>
			    <p class="card-text"><strong>Цена:</strong> {{ $book->price }} руб.</p>
			  </div>
			  <div class="card-footer bg-transparent"><a href="{{ action('HomeController@addtocard', ['id' => $book->id ]) }}" class="btn btn-primary float-right">Добавить в корзину</a></div>
			</div>
		  @endFOREACH
		</div>
	</div>
	<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">

        @if($books->currentPage() == 1)
            <li class="page-item disabled">
                <a class="page-link" href="{{ $books->previousPageUrl() }}" tabindex="-1">Предидущая</a>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $books->previousPageUrl() }}" tabindex="-1">Предидущая</a>
            </li>
        @endif

        <li class="page-item"><a class="page-link" href="{{ $books->url(1) }}">1</a></li>
        <li class="page-item disabled"><p class="page-link">Вы на странице {{$books->currentPage()}}</p></li>
        <li class="page-item"><a class="page-link" href="{{ '/?page='.$books->lastPage() }}">{{ $books->lastPage() }}</a></li>

        @if($books->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $books->nextPageUrl() }}">Следующая</a>
            @else
                <li class="page-item disabled"><a class="page-link" href="{{ $books->nextPageUrl() }}">Следующая</a>
        @endif

        </li>
    </ul>
</nav>
@endsection('content')