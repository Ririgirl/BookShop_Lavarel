<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\books;
use Auth;
use App\Cart;
use Session;
use DB;
class HomeController extends Controller
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
        return view('user.home');
    }
    public function update()
    {
        return view('user.update');
    }
    public function edit(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->fname = $request->get('fname');
        $user->name = $request->get('name');
        $user->oname = $request->get('oname');
        $user->email = $request->get('email');
        $user->adr = $request->get('adr');
        $user->tel = $request->get('tel');
        $user->save();
        return redirect()->route('home');
    }
    public function addtocard(Request $request, $id)
    {
        $product = books::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return redirect()->route('card');
    }
    public function getCart()
    {
        if (!Session::has('cart')){
            return view('user.cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('user.cart',['products' => $cart->items, 'totalPrice'=>$cart->totalPrice]);
    }
    public function deleteoneincart($id){
         $oldCart = Session::has('cart') ? Session::get('cart') : null;
         $cart = new Cart($oldCart);
         $cart->deleteone($id);

         Session::put('cart', $cart);
         return redirect()->route('card');
    }
    public function removeincart($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        Session::put('cart', $cart);
        return redirect()->route('card');
    }
    public function getCheckout(){
        if (!Session::has('cart')){
            return view('user.cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('user.checkout', ['total' => $total, 'products' => $cart->items]);
    }
    public function saveOrder(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->fname = $request->get('fname');
        $user->name = $request->get('name');
        $user->oname = $request->get('oname');
        $user->email = $request->get('email');
        $user->adr = $request->get('adr');
        $user->tel = $request->get('tel');
        $user->save();

        DB::table('orders')->insert(
          ['id_user' => $user->id ]
        );

        $lastorder = DB::table('orders')
        ->select('id')
        ->orderBy('id', 'desc')
        ->value('id');

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $products = $cart->items;

        foreach($products as $product){
            DB::table('orders_lists')->insert(
              [ 'kol_vo' =>  $product['qty'],
                'id_order'=> $lastorder ,
                'id_book' => $product['item']['id']]
            );
        }
        return redirect()->route('home');
    }
}
