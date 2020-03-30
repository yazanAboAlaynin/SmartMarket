<?php

namespace App\Http\Controllers\Company\auth;

use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class RegisterController extends Controller
{
    public function index($message=""){

        return view('company.auth.register',compact('message'));
    }

    public function register(Request $request)
    {

        request()->validate([
            'name' => 'required',
            'email' => 'unique:companies|required|email|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'required_with:password|same:password|min:8',
            'address' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
            'image' => 'required',
        ]);


        $data = $request->all();

            $company = Company::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'address' => $data['address'],
                'phone' => $data['phone'],
                'mobile' => $data['mobile'],
                'image' => $data['image'],
                'approved' => "0",
            ]);

            auth()->guard('company')->login($company);

            return redirect('company/login');
         }


}
