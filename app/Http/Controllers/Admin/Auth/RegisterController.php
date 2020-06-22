<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Admin;
use App\Vendor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Mockery\Exception;

class RegisterController extends Controller
{
    public function index($message=""){

        return view('admin.auth.register',compact('message'));
    }

    public function register(Request $request)
    {

        request()->validate([
            'name' => 'required',
            'email' => 'unique:admin|required|email',
            'password' => 'required|min:8',
            'mobile' => 'required',
        ]);

        $data = $request->all();

            $admin = Admin::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'mobile' => $data['mobile'],
            ]);

            auth()->guard('admin')->login($admin);

            return redirect('admin/login');
         }


}
