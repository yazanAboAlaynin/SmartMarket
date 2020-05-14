<?php

namespace App\Http\Controllers\API;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Vendor;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            return response()->json(['success' => $success], $this-> successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'dob' => 'required',
            'mobile' => 'required',
            'image' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
//        $imagePath = $input['image']->store('images','public');
//        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1500,1500);
//        $image->save();
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
            'dob' => $input['dob'],
            'mobile' => $input['mobile'],
            'image' =>  $input['image'],
        ]);
        $success['token'] =  $user->createToken('MyApp')-> accessToken;
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success], $this-> successStatus);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        $categories = Category::all();
        $success['categories'] = $categories;
        return response()->json(['success' => $success], $this-> successStatus);
    }

    public function brands()
    {
        $brands = Brand::all();
        $success['brands'] = $brands;
        return response()->json(['success' => $success], $this-> successStatus);
    }

    public function sellers()
    {
        $sellers = Vendor::all();
        $success['sellers'] = $sellers;
        return response()->json(['success' => $success], $this-> successStatus);
    }
}
