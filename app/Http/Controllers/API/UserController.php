<?php

namespace App\Http\Controllers\API;

use App\Admin;
use App\Brand;
use App\Category;
use App\Notification;
use App\Order;
use App\Order_item;
use App\Product;
use App\Property;
use App\Http\Controllers\Controller;
use App\Rating;
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
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
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
            'address' => 'required',
            'mobile' => 'required',
            'career' => 'required',
            'gender' => 'required',
            'social_status' => 'required',
            'scientific_level' => 'required',
            'three_most_hobbies' => 'required',
            'image' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $imagePath = $input['image']->store('images','public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1500,1500);
        $image->save();
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
            'dob' => $input['dob'],
            'address' => $input['address'],
            'mobile' => $input['mobile'],
            'career' => $input['career'],
            'gender' => $input['gender'],
            'social_status' => $input['social_status'],
            'scientific_level' => $input['scientific_level'],
            'three_most_hobbies' => $input['three_most_hobbies'],
            'image' => $imagePath,
        ]);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        return response()->json(['success' => $success], $this->successStatus);
    }

    public function logout(){
        $user = Auth::user()->token();
        $user->revoke();
        $success = 'true';
        return response()->json(['success' => $success], $this->successStatus);
    }

    public function categories()
    {
        $categories = Category::all();
        $success['categories'] = $categories;
        return response()->json(['success' => $success], $this->successStatus);
    }

    public function brands()
    {
        $brands = Brand::all();
        $success['brands'] = $brands;
        return response()->json(['success' => $success], $this->successStatus);
    }

    public function sellers()
    {
        $sellers = Vendor::all();
        $success['sellers'] = $sellers;
        return response()->json(['success' => $success], $this->successStatus);
    }

    public function products(Request $request, $type, $id)
    {
        switch ($type) {
            case 'category':
                $products = Product::where('category_id', '=', $id)->get();
                return response()->json(['products' => $products], $this->successStatus);

            case 'brand':
                $products = Product::where('brand_id', '=', $id)->get();
                return response()->json(['products' => $products], $this->successStatus);

            case 'seller':
                $products = Product::where('vendor_id', '=', $id)->get();
                return response()->json(['products' => $products], $this->successStatus);
        }
    }

    public function getProductCategory(Request $request, $id)
    {
        $p = Product::find($id);
        $category = Category::find($p->category_id);

        return response()->json(['category' => $category->name], $this->successStatus);
    }

    public function getProductBrand(Request $request, $id)
    {
        $p = Product::find($id);
        $brand = Brand::find($p->brand_id);

        return response()->json(['brand' => $brand->name], $this->successStatus);
    }

//    public function getProductProp(Request $request, $id)
//    {
//        $p = Product::find($id);
//        $category = Category::find($p->category_id);
//
//        return response()->json(['category' => $category->name], $this->successStatus);
//    }

    public function productProperties($id)
    {

        //$p = Product::find($id);
        $properties = Property::where('product_id', '=', $id)->get();

        return response()->json(['properties' => $properties], $this->successStatus);
    }

    public function otherProperties($id)
    {
        $product = Product::find($id);
        $prop = Property::where('product_id', '=', $id)->get();
        $otherProducts = Product::select('id')->where([
            ['item_num', '=', $product->item_num],
            ['vendor_id','=',$product->vendor_id],
            ['category_id','=',$product->category_id],
            ['brand_id','=',$product->brand_id]])->get();
        $other = [];
        foreach ($prop as $p) {
            $otherProp = Property::where([
                ['name', '=', $p->name],
                ['value', '<>', $p->value]
            ])->whereIn('product_id', $otherProducts)->get();

            array_push($other, $otherProp);
        }
        //dd($other);
        $other = Property::whereIn('product_id', $otherProducts)->get();
        return response()->json(['other' => $other], $this->successStatus);

    }

    public function getProduct($id)
    {
        $product = Product::find($id);
        return response()->json(['product' => $product], $this->successStatus);
    }

    public function order(Request $request)
    {

        $data = $request->input();

        $order = new Order();
        $user = auth()->user()->id;
        $totDiscount = 0;
        $totPrice = 0;
        $order->user_id = $user;
        $order->discount = 0;
        $order->total_price = 0;
        $order->done = 0;
        $order->save();

        foreach ($data as $id => $qty) {
            $order_item = new Order_item();
            $product = Product::find($id);
            $totPrice += $product->price * $qty;
            $order_item->product_id = $product->id;
            $order_item->quantity = $qty;
            $product->quantity -= $qty;
            $product->save();
            $order_item->price = $product['price'];
            $order_item->done = 0;
            $discount = ($product->discount * $product->price) / 100;
            $totDiscount += ($discount * $qty);
            $order->order_items()->save($order_item);

        }

        $order->discount = $totDiscount;
        $order->total_price = $totPrice - $totDiscount;
        $order->save();

        $noti = new Notification();
        $noti->user_id = auth()->guard()->user()->id;
        $noti->order_id = $order->id;
        $noti->title = 'New Order';
        $noti->body = 'you have new order from user: ' . auth()->guard()->user()->id;
        if ($noti->save()) {

            $url = route('admin.order.items', $order->id);
            $noti->toMultiDevice(Admin::all(), $noti->title, $noti->body, null, $url);
        }
        $success = "yes";
        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function profile(){
        $id = auth()->user()->id;
        $user = User::find($id);

        return response()->json(['user'=>$user], $this->successStatus);
    }

    public function search(Request $request){
        $data = $request->input();

        $products = Product::where('name','like',$data['query'].'%')->get();

        return response()->json(['products'=>$products], $this->successStatus);
    }

	public function myItems(){
		$id = auth()->user()->id;

		$orders = Order::where('user_id',$id)->get();
		$products = [];
		foreach($orders as $order){
			$items = $order->order_items()->get();
			foreach($items as $item){
				$product = Product::find($item->product_id);
				array_push($products,$product);
			}
		}

		return response()->json(['products'=>$products], $this->successStatus);
	}

	public function orderReview(){
        $orders = Order::where([
            ['user_id',auth()->user()->id],
            ['rated',null],
            ['done',1]
        ])->get();
        if($orders->count()) {
            $items = $orders[0]->order_items()->with('product')->where([
                ['rated', null]
            ])->get();

            return response()->json(['products'=>$items],$this->successStatus);

        }
        else{

            return response()->json(['products'=>$orders],$this->successStatus);
        }
    }

    public function review(Request $request){

        $request->validate([
            'rate' => 'required',
            'comment' => 'required',

        ]);

        $review = new Rating();
        $review->user_id = auth()->user()->id;
        $review->product_id = $request->id;
        $review->order_id = $request->order;
        $review->description = $request->comment;
        $review->rate = $request->rate;
        $review->save();

        $order = Order::find($request->order);
        $items = Order_item::where([
            ['order_id',$order->id],
            ['product_id',$request->id]
        ]);
        $items->update(['rated' => 1]);

        if($order->order_items->where('rated',null)->count()==0){
            $order->rated = 1;
            $order->save();
        }

        return response()->json([], 200);
    }



}
