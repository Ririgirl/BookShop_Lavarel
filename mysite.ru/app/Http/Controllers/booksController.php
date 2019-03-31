<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use DB;
use App\Image; //отображать фотки
use Intervention\Image\Facades\Image as ImageInt; //брать из бд фотки
class booksController extends Controller
{
    public function show() {
    	$books = DB::table('books')
        ->join('authors_books', 'books.id', '=', 'authors_books.books_id')
        ->join('authors', 'authors_books.author_id', '=', 'authors.id')
        ->join('images', 'books.img_id', '=', 'images.id')
        ->select('authors.fname', 'authors.name', 'authors.oname', 'books.name_book', 'books.description', 'books.year', 'books.price', 'books.id', 'images.img')
        ->paginate(10);
    	return view('start', compact('books'));
    }
    public function index($id) {
    	$book = DB::table('books')
        ->join('authors_books', 'books.id', '=', 'authors_books.books_id')
        ->join('authors', 'authors_books.author_id', '=', 'authors.id')
        ->join('images', 'books.img_id', '=', 'images.id')
        ->select('authors.fname', 'authors.name', 'authors.oname', 'books.name_book', 'books.description', 'books.year', 'books.price', 'books.id', 'images.img')
        ->where('books.id', '=', $id)
        ->first();	
    	return view('idbook', compact('book'));
    }
}
