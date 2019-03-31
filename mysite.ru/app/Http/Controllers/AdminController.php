<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\books;
use App\authors;
use App\authors_books;
use App\orders;
use DB;
use App\Image;
use Intervention\Image\Facades\Image as ImageInt;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = DB::table('books')
        ->join('authors_books', 'books.id', '=', 'authors_books.books_id')
        ->join('authors', 'authors_books.author_id', '=', 'authors.id')
        ->select('authors.fname', 'authors.name', 'authors.oname', 'books.name_book', 'books.year', 'books.price', 'books.id')
        ->paginate(10);
        return view('admin.admin', compact('books'));
    }
    public function orders()
    {
        $orders = DB::table('orders')
        ->join('users', 'users.id', '=', 'orders.id_user')
        ->select('orders.date', 'users.adr', 'users.tel', 'orders.id')
        ->orderBy('orders.date', 'desc')
        ->limit(100)
        ->get();
        $orders_lists = DB::table('orders_lists')
        ->join('books', 'orders_lists.id_book', '=', 'books.id')
        ->join('orders', 'orders_lists.id_order', '=', 'orders.id')
        ->select('books.name_book', 'orders_lists.kol_vo')
        ->where('orders_lists.id_order', '=', 'orders.id')
        ->get();
        return view('admin.table_orders', compact('orders'));
    }
    public function newbook()
    {
        return view('admin.create_newbook', compact('books'));
    }
    public function store(Request $request)
    {
        $path =public_path('upload\\');
        $file = $request->file('file');
        foreach ($file as $f) {
            $filename = str_random(20) .'.' . $f->getClientOriginalExtension() ?: 'png';
            $img = ImageInt::make($f);
            $img->resize(200,300)->save($path . $filename);
            Image::create(['img' => $filename]);
        }
        return redirect()->route('newcard');
    }
    public function createcardbook()
    {
        return view('admin.create_card_newbook', compact('books'));
    }
    public function createsave(Request $request)
    {
        $img = DB::table('images')
        ->select('id')
        ->orderBy('id', 'desc')
        ->value('id');
        $book = new books;
        $book->name_book = $request->get('name_book');
        $book->year = $request->get('year');
        $book->price = $request->get('price');
        $book->description = $request->get('description');
        $book->img_id = $img;
        $book->save();
        return redirect()->route('addauth');
    }
    public function createconst()
    {
        $authors = DB::table('authors')
        ->select('fname', 'name', 'oname','id')
        ->get();
        return view('admin.create_const_book_aut', compact('authors'));
    }
    public function createnewaut()
    {
        $authors = DB::table('authors')
        ->select('fname', 'name', 'oname','id')
        ->get();
        return view('admin.create_new_aut', compact('authors'));
    }
    public function saveauth(Request $request)
    {
        $book = new authors;
        $book->fname = $request->get('fname');
        $book->name = $request->get('name');
        $book->oname = $request->get('oname');
        $book->save();
        return redirect()->route('addauth');
    }
    public function saveconstab(Request $request)
    {
        $book = DB::table('books')
        ->select('id')
        ->orderBy('id', 'desc')
        ->value('id');
        $authors_books = new authors_books;
        $authors_books->author_id = $request->get('num');
        $authors_books->books_id = $book;
        $authors_books->save();
        return redirect()->route('admin');
    }
    public function updatebook($id)
    {
        $book = DB::table('books')
        ->select('name_book', 'year', 'price','description','id')
        ->where('id','=', $id)
        ->first();
        return view('admin.update_book', compact('book'));
    }
    public function updatebooksave(Request $request, $id)
    {
        $book = books::find($id);
        $book->name_book = $request->get('name_book');
        $book->year = $request->get('year');
        $book->price = $request->get('price');
        $book->description = $request->get('description');
        $book->save();
        return redirect()->route('admin');
    }
    public function deletebook($id)
    {
       $book_auth_id = DB::table('authors_books')
       ->select('id')
       ->where('books_id','=', $id)
       ->value('id');
       $book_auth = authors_books::find($book_auth_id);
       $book_auth->delete();
       $book = books::find($id);
       $book->delete();
       return redirect()->route('admin'); 
    }
    public function seeorder($id)
    {
        $orders_lists = DB::table('orders_lists')
        ->join('books', 'orders_lists.id_book', '=', 'books.id')
        ->join('orders', 'orders_lists.id_order', '=', 'orders.id')
        ->select('books.name_book', 'orders_lists.kol_vo')
        ->where('orders_lists.id_order', '=', $id)
        ->get();
        return view('admin.seeorder', compact('orders_lists'));
    }
}
