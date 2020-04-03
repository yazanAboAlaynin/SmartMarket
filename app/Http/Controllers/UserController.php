<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

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
        return view('user.product');
    }

    public function chooseType($type,$choice){

        dd($type." ".$choice);
        switch ($type){
            case 'category':
                return redirect('products/category',$choice);
        }
        return redirect('product');
    }

    public function byCategory($choice){
        dd($choice);
    }



}
