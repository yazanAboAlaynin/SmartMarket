<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Rating;
use Illuminate\Http\Request;
use function Sodium\compare;

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

}
