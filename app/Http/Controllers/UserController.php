<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Order;
use App\Order_item;
use App\Product;
use App\Cart;
use App\Rating;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use function Sodium\add;
use function Sodium\compare;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
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

    public function getSearchList()
    {
        $category = Cache::remember
        ('category',
            now()->addSeconds(3000000),
            function (){
                return  Category::all();
            });

        $brands = Cache::remember
        ('brands',
            now()->addSeconds(3000000),
            function (){
                return  Brand::all();
            });

        $sellers = Cache::remember
        ('sellers',
            now()->addSeconds(3000000),
            function (){
                return  Vendor::all();
            });


        return [$category,$brands,$sellers];
    }

    public function products()
    {

        $x = $this->getSearchList();
        $category = $x[0];
        $brands = $x[1];
        $sellers = $x[2];

        return view('user.products',compact('category','brands','sellers'));
    }

    public function search($type,$choice){

        $x = $this->getSearchList();
        $category = $x[0];
        $brands = $x[1];
        $sellers = $x[2];

        switch ($type){
            case 'category':
                $t = Category::find($choice);
                $products = Product::where('category_id','=',$t->id)->get();
                $choice = $t->name;
              return view('user.showProducts',compact('type','products','choice','category','brands','sellers'));

            case 'brand':
                $t = Brand::find($choice);
                $products = Product::where('brand_id','=',$t->id)->get();
                $choice = $t->name;
                return view('user.showProducts',compact('type','products','choice','category','brands','sellers'));

            case 'seller':
                $t = Vendor::find($choice);
                $products = Product::where('vendor_id','=',$t->id)->get();
                $choice = $t->name;
                return view('user.showProducts',compact('type','products','choice','category','brands','sellers'));

            case 'topRated':
                $t = Rating::select('product_id')->where('rate','>=',4)->get();
                $products = Product::whereIN('id',$t)->get();
                $choice = null;
                $type = "Top Rated";
                return view('user.showProducts',compact('type','products','choice','category','brands','sellers'));

            case 'onRate':
                $t = Rating::select('product_id')->where('rate','>=',$choice)->get();
                $products = Product::whereIN('id',$t)->get();
                $type ="".$choice." stars and up";
                return view('user.showProducts',compact('type','products','choice','category','brands','sellers'));
        }
        return redirect('product');
    }

    public function viewProduct(Product $product){

        return view('user.viewProduct',compact('product'));
    }

    public function cart()
    {
        $products = [];
        $totalQty = 0;
        $totalPrice = 0;
        $qty = [];

        if (Session::has('cart')) {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $products = $cart->items;
            $totalQty = $cart->totalQty;
            $totalPrice = $cart->totalPrice;
        }

        return view('user.cart', compact('products','totalPrice','totalQty'));
    }

    public function addToCart(Request $request,Product $product){

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product,$product->id);
        $request->session()->put('cart',$cart);

        return redirect()->route('cart');
    }

    public function deleteFromCart(Request $request,Product $product){

        if(Session::has('cart')){
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $cart->delete($product);
            $request->session()->put('cart',$cart);
        }

        return redirect()->route('cart');
    }

    public function order(){
        if(Session::has('cart')){
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $products = $cart->items;

            $order = new Order();
            $user = auth()->user()->id;
            $totDiscount = 0;

            $order->user_id = $user;
            $order->discount = 0;
            $order->total_price =$cart->totalPrice;
            $order->done = 0;
            $order->save();

            foreach ($products as $product){
                $order_item = new Order_item();
                $order_item->product_id = $product['item']->id;
                $order_item->quantity = $product['qty'];
                $p = Product::find($product['item']->id);
                $p->quantity -= $product['qty'];
                $p->save();
                $order_item->price = $product['price'];
                $order_item->done = 0;
                $discount = ($product['item']->discount * $product['item']->price)/100;
                $totDiscount += ($discount * $product['qty']);
                $order->order_items()->save($order_item);
            }
            Session::remove('cart');
            $order->discount = $totDiscount;
            $order->save();
        }
        return redirect()->route('home');
    }

}
