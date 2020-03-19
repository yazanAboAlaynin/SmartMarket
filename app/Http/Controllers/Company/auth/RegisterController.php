<?php

namespace App\Http\Controllers\Company\auth;

use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){

        return view('company.auth.register');
    }

    public function register(Request $request){

        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'address' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
            'image' => 'required',
        ]);

        $data = $request->all();
        $check = $this->create($data);
        auth()->guard('company')->login($check);
        return redirect('company/login');
    }

    public function create(array $data)
    {

        return Company::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'phone' => $data['phone'],
            'mobile' => $data['mobile'],
            'image' => $data['image'],
            'approved' => "0",
        ]);
    }
}
