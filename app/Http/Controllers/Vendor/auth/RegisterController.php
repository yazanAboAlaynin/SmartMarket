<?php

namespace App\Http\Controllers\vendor\auth;

use App\Vendor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Mockery\Exception;

class RegisterController extends Controller
{
    public function index($message=""){

        return view('vendor.auth.register',compact('message'));
    }

    public function register(Request $request)
    {

        request()->validate([
            'name' => 'required',
            'email' => 'unique:vendors|required|email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required_with:password|same:password|min:8',
            'address' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($files = $request->file('image')) {

            // for save original image
            $imagePath = request('image')->store('images','public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1500,1500);
            $image->save();
        }


        $data = $request->all();

            $company = Vendor::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'address' => $data['address'],
                'phone' => $data['phone'],
                'mobile' => $data['mobile'],
                'image' => $imagePath,
                'approved' => "0",
            ]);

            //auth()->guard('vendor')->login($company);

            return redirect('vendor/login');
         }


}
