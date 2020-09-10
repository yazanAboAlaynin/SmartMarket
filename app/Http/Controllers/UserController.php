<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Brand;
use App\Category;
use App\Order;
use App\Order_item;
use App\Product;
use App\Cart;
use App\property;
use App\Rating;
use App\User;
use App\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use League\Csv\Writer;
use Rubix\ML\Persisters\Filesystem;
use function Rubix\ML\array_transpose;
use Rubix\ML\CrossValidation\Reports\ContingencyTable;
use Rubix\ML\CrossValidation\Metrics\Homogeneity;
use Rubix\ML\Clusterers\FuzzyCMeans;
use Rubix\ML\Kernels\Distance\Euclidean;
use Rubix\ML\Clusterers\Seeders\Random;
use Rubix\ML\Datasets\Labeled;

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
        return view('user.products');
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
            return view('user.showProducts', compact('type', 'products', 'choice'));
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
            return view('user.showProducts', compact('type', 'products', 'choice'));
        }
    }

    public function profile()
    {
        $user = auth()->user();
        $orders = Order::select('id')->where('user_id', auth()->user()->id)->get();
        $ordersItems = Order_item::select('product_id')->whereIn('order_id', $orders)->get();

        return view('user.profile', compact('user', 'ordersItems'));
    }

    public function edit()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        return view('user.profileEdit', compact('user'));
    }

    public function update(Request $request)
    {

        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'career' => 'required',
            'gender' => 'required',
            'social_status' => 'required',
            'scientific_level' => 'required',

        ]);

        $id = auth()->user()->id;
        $user = User::find($id);

        $user->name = $request['name'];
        $user->email = $request['dob'];
        $user->dob = $request['dob'];
        $user->address = $request['dob'];
        $user->mobile = $request['mobile'];
        $user->career = $request['career'];
        $user->gender = $request['dob'];
        $user->social_status = $request['social_status'];
        $user->scientific_level = $request['scientific_level'];

        $user->save();

        return redirect('profile');

    }

    public function addOrderReview(Order $order)
    {
        $items = $order->order_items()->where([
            ['rated', null]
        ])->get();


        return view('user.reviewOrder', compact('items', 'order'));
    }


    public function review(Request $request)
    {

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
            ['order_id', $order->id],
            ['product_id', $request->id]
        ]);
        $items->update(['rated' => 1]);

        if ($order->order_items->where('rated', null)->count() == 0) {
            $order->rated = 1;
            $order->save();
        }

        return response()->json([], 200);
    }


    public function products()
    {
        $orders = Order::where([
            ['user_id', auth()->user()->id],
            ['rated', null],
            ['done', 1]
        ])->get();
        if ($orders->count()) {
            $order = $orders[0];
            return redirect()->route('add.orderReview', $order);
        }
        return view('user.products');
    }

    public function searchBtn(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'choice' => 'required'
        ]);
        //dd('here');
        $t = Category::find($request->category);
        $products = Product::where([
            ['category_id', '=', $t->id],
            ['name', 'like', $request->choice . '%']
        ])->get();
        $type = $request->choice;
        $choice = $t->name;
        return view('user.showProducts', compact('type', 'products', 'choice'));
    }

    public function search($type, $choice)
    {

        switch ($type) {
            case 'category':
                $t = Category::find($choice);
                $products = Product::where('category_id', '=', $t->id)->get();
                $choice = $t->name;
                return view('user.showProducts', compact('type', 'products', 'choice'));

            case 'brand':
                $t = Brand::find($choice);
                $products = Product::where('brand_id', '=', $t->id)->get();
                $choice = $t->name;
                return view('user.showProducts', compact('type', 'products', 'choice'));

            case 'seller':
                $t = Vendor::find($choice);
                $products = Product::where('vendor_id', '=', $t->id)->get();
                $choice = $t->name;
                return view('user.showProducts', compact('type', 'products', 'choice'));

            case 'topRated':
                $t = Rating::select('product_id', DB::raw('ROUND(avg(rate)) as total'))->having('total', '>=', 4)->groupBy('product_id')->get();
                $products = Product::whereIN('id', $t)->get();
                $choice = null;
                $type = "Top Rated";
                return view('user.showProducts', compact('type', 'products', 'choice'));

            case 'onRate':
                $t = Rating::select('product_id', DB::raw('ROUND(avg(rate)) as total'))->having('total', '<=', $choice)->groupBy('product_id')->get();
                $t = $t->pluck('product_id');
                $products = Product::whereIN('id', $t)->get();
                $type = "" . $choice . " stars";
                return view('user.showProducts', compact('type', 'products', 'choice'));
        }
        return redirect('product');
    }

    public function viewProduct(Product $product)
    {
        $images = $product->images()->get();
        $properties = Property::where('product_id', '=', $product->id)->get();
        $otherProp = $this->otherProperties($product, $properties);
        $ratings = Rating::with('user')->where('product_id', $product->id)->get();
        $avg = Rating::where('product_id', $product->id)->avg('rate');
        $avg = round($avg);
        return view('user.viewProduct', compact('product', 'images', 'properties', 'otherProp', 'ratings', 'avg'));
    }

    public function otherProperties(Product $product, $prop)
    {

        $otherProducts = Product::select('id')->where([
            ['item_num', '=', $product->item_num],
            ['id', '<>', $product->id],
            ['vendor_id', '=', $product->vendor_id],
            ['category_id', '=', $product->category_id],
            ['brand_id', '=', $product->brand_id]])->get();
        $other = [];
        foreach ($prop as $p) {
            $otherProp = Property::where([
                ['name', '=', $p->name],
                ['value', '<>', $p->value]
            ])->whereIn('product_id', $otherProducts)->get();
            $other[$p->name] = [];
            array_push($other[$p->name], $otherProp);
        }
        //dd($other);
        return $other;

    }

    public function cart()
    {
        $products = [];
        $totalQty = 0;
        $totalPrice = 0;
        $qty = [];

        if (Session::has('cart')) {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $products = $cart->items;
            $totalQty = $cart->totalQty;
            $totalPrice = $cart->totalPrice;
        }

        return view('user.cart', compact('products', 'totalPrice', 'totalQty'));
    }

    public function addToCart(Request $request, Product $product)
    {

        request()->validate([
            'quantity' => 'required',
        ]);

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id, $request->quantity);
        $request->session()->put('cart', $cart);

        return redirect()->route('cart');
    }

    public function deleteFromCart(Request $request, Product $product)
    {

        if (Session::has('cart')) {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $cart->delete($product);
            $request->session()->put('cart', $cart);
        }

        return redirect()->route('cart');
    }

    public function order()
    {

        if (Session::has('cart')) {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $products = $cart->items;
            if(sizeof($products)==0){
                return redirect()->route('cart');
            }

            $order = new Order();
            $user = auth()->user()->id;
            $totDiscount = 0;

            $order->user_id = $user;
            $order->discount = 0;
            $order->total_price = $cart->totalPrice;
            $order->done = 0;


            foreach ($products as $product) {
                $order_item = new Order_item();
                $order_item->product_id = $product['item']->id;
                $order_item->quantity = $product['qty'];
                $p = Product::find($product['item']->id);
                if($p->quantity<$product['qty']){
                    return redirect()->route('cart');
                }
                $p->quantity -= $product['qty'];
                $p->save();
                $order_item->price = $product['price'];
                $order_item->done = 0;
                $discount = ($product['item']->discount * $product['item']->price) / 100;
                $totDiscount += ($discount * $product['qty']);
                $order->save();
                $order->order_items()->save($order_item);
            }

            Session::remove('cart');
            $order->discount = $totDiscount;
            $order->save();

        }
        return redirect()->route('products');
    }

}
