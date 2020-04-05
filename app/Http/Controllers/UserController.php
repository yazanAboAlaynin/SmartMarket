<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Providers\Cart;
use App\Rating;
use Illuminate\Http\Request;
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
    public function products()
    {
        $category = Category::all();

        return view('user.products',compact('category'));
    }

    public function chooseType($type,$choice){

        switch ($type){
            case 'category':
                $t = Category::find($choice);
                $products = Product::where('category_id','=',$t->id)->get();
                $choice = $t->name;

              return view('user.showProducts',compact('type','products','choice'));
        }
        return redirect('product');
    }

    public function viewProduct(Product $product){

        return view('user.viewProduct',compact('product'));
    }

    public function cart(){
        $products = [];

        if(request()->ajax())
        {
           if(Session::has('cart')){
               $oldCart = Session::get('cart');
               $cart = new Cart($oldCart);
               $items = $cart->items;
               foreach ($items as $item){
                   array_push($products,$item['item']);
               }
               return DataTables::of($products)
                   ->addColumn('action', function($products){
                       $button = '<button type="button" name="edit" id="'.$products->id.'" 
                    class="edit btn btn-primary btn-sm" onclick=update('.$products->id.')>Edit</button>';
                       $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'.$products->id.'" 
                    class="delete btn btn-danger btn-sm" onclick=del('.$products->id.')>Delete</button>';

                       return $button;
                   })
                   ->rawColumns(['action'])
                   ->make(true);
           }
        }

        return view('user.cart',compact('products'));
    }

    public function addToCart(Request $request,Product $product){

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product,$product->id);
        $request->session()->put('cart',$cart);

        return redirect()->route('products');
    }

}
