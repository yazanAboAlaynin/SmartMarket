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
use League\Csv\Writer;
use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Persisters\Filesystem;
use function Rubix\ML\array_transpose;

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

    public function recommendation()
    {
        $user = User::select('id', 'social_status', 'gender', 'scientific_level')
            ->selectRaw("TIMESTAMPDIFF(YEAR, DATE(dob), current_date) AS age")
            ->where('id',auth()->user()->id)
            ->get();
        if ($user[0]["gender"] == "Male") {
            $user[0]["gender"] = 1;
        } else {
            $user[0]["gender"] = 2;
        }
        switch ($user[0]["social_status"]) {
            case "Single":
                $user[0]["social_status"] = 1;
                break;
            case "Married":
                $user[0]["social_status"] = 2;
                break;
            case "Widowed":
                $user[0]["social_status"] = 3;
                break;
            case "separated":
                $user[0]["social_status"] = 4;
                break;
            case "Divorced":
                $user[0]["social_status"] = 5;
                break;
        }

        switch ($user[0]["scientific_level"]) {
            case "Not Educated":
                $user[0]["scientific_level"] = 1;
                break;
            case "High school diploma or equivalent":
                $user[0]["scientific_level"] = 2;
                break;
            case "Associate degree":
                $user[0]["scientific_level"] = 3;
                break;
            case "Bachelor's degree":
                $user[0]["scientific_level"] = 4;
                break;
            case "Master's degree":
                $user[0]["scientific_level"] = 5;
                break;
            case "Doctoral degree":
                $user[0]["scientific_level"] = 6;
                break;
        }

        switch ($user[0]["age"]) {
            case ($user[0]["age"] < 18):
                $user[0]["age"] = 1;
                break;
            case ($user[0]["age"] >= 18 && $user[0]["age"] < 25):
                $user[0]["age"] = 2;
                break;
            case ($user[0]["age"] >= 25 && $user[0]["age"] < 35):
                $user[0]["age"] = 3;
                break;
            case ($user[0]["age"] >= 35 && $user[0]["age"] < 50):
                $user[0]["age"] = 4;
                break;
            case ($user[0]["age"] >= 50):
                $user[0]["age"] = 5;
                break;
        }


        $string_data = \GuzzleHttp\json_encode($user->toArray());
        file_put_contents("yazzaan.txt", $string_data);
        $arr1 = json_decode($string_data, true);

        $arr = [];
        $label = [];

        foreach ($arr1 as $key => $val) {
            $a = [];
            foreach ($val as $k => $v) {
                if (is_numeric($v) && $k != "id")
                    array_push($a, $v);
                else if (!is_numeric($v)) {
                    $v = 2;
                    array_push($a, $v);
                }
            }
            array_push($label, $val["id"]);
            array_push($arr, $a);

        }
        $dataset = new Labeled($arr, $label);

        if ($user[0]->orders()->count() == 0) {

            $persister = new Filesystem('trained2.model');
            $estimator = $persister->load();

            $losses = $estimator->steps();

            $writer = Writer::createFromPath('progress.csv', 'w+');

            $writer->insertOne(['loss']);
            $writer->insertAll(array_transpose([$losses]));

            $predictions = $estimator->predictSample($dataset->sample(0));
            $string = file_get_contents("report2.json");
            $results = \GuzzleHttp\json_decode($string,true);

            $id = auth()->user()->id;

            $ids = [];
            foreach ($results[$predictions] as $key => $val) {
                if ($val == 1) {
                    array_push($ids, $key);
                    // echo "<br> $key";
                }
            }

            $orders = Order::select('id')->whereIn('user_id', $ids)->get();
            $ordersItems = Order_item::select('product_id')->whereIn('order_id', $orders)->get();
            $products = Product::whereIn('id', $ordersItems)->get();
            $type = '';
            $choice = 'Recommendation';
            return response()->json(['products'=>$products], 200);
        }
        else {
            //   $products = Product::all();
            $string = file_get_contents("products.json");
            $products = \GuzzleHttp\json_decode($string,true);

            $orders = Order::select('id')->where('user_id', $user[0]->id)->get();

            foreach($products as $product){

                $count = Order_item::select('quantity')->whereIn('order_id',$orders)->where('product_id',$product['id'])->get()->sum('quantity');
                $x = "p".$product['id'];
                $user[0][$x] = $count;

            }

            $string_data = \GuzzleHttp\json_encode($user->toArray());
            file_put_contents("yazzaan.txt", $string_data);
            $arr1 = json_decode($string_data, true);

            $arr = [];
            $label = [];

            foreach ($arr1 as $key => $val) {
                $a = [];
                foreach ($val as $k => $v) {
                    if (is_numeric($v) && $k != "id")
                        array_push($a, $v);
                    else if (!is_numeric($v)) {
                        $v = 2;
                        array_push($a, $v);
                    }
                }
                array_push($label, $val["id"]);
                array_push($arr, $a);

            }
            $dataset = new Labeled($arr, $label);

            $persister = new Filesystem('trained1.model');
            $estimator = $persister->load();

            $losses = $estimator->steps();

            $writer = Writer::createFromPath('progress.csv', 'w+');

            $writer->insertOne(['loss']);
            $writer->insertAll(array_transpose([$losses]));

            $predictions = $estimator->predictSample($dataset->sample(0));
            $string = file_get_contents("report1.json");
            $results = \GuzzleHttp\json_decode($string,true);
            if(is_null($predictions)){
                $predictions = 0;
            }
            $id = auth()->user()->id;

            $ids = [];
            foreach ($results[$predictions] as $key => $val) {
                if ($val == 1) {
                    array_push($ids, $key);
                    // echo "<br> $key";
                }
            }

            $orders = Order::select('id')->whereIn('user_id', $ids)->get();
            $ordersItems = Order_item::select('product_id')->whereIn('order_id', $orders)->get();
            $products = Product::whereIn('id', $ordersItems)->get();
            $type = '';
            $choice = 'Recommendation';
            return response()->json(['products'=>$products], 200);
        }
    }



}
