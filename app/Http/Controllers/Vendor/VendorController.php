<?php

namespace App\Http\Controllers\vendor;

use App\Brand;
use App\Image as img;
use App\Category;
use App\property;
use App\Vendor;
use App\Http\Controllers\Controller;
use App\Order;
use App\Order_item;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use function Sodium\compare;
use Yajra\DataTables\Facades\DataTables;


class VendorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $data = Order_item::select(DB::raw('product_id, sum(quantity) as quantity'))->groupBy('product_id')->orderBy('quantity',"desc")->get()->toArray();
       $data2 = Category::all();

       //dd($all);
        $all = [];
        for ($i=0;$i<sizeof($data);$i++){
            $x = [];
            array_push($x,$data[$i]['product_id']);
            array_push($x,$data[$i]['quantity']);
            array_push($all,$x);
        }
       // dd($all);
        $all = json_encode($all);

        $all2 = [];
        $cat = [];
        for ($i=0;$i<sizeof($data2);$i++){
            $x = [];
            array_push($x,$data2[$i]['name']);
            array_push($x,$data2[$i]->products()->count());
            array_push($all2,$x);
        }
        // dd($all);
        sort($all2);
        for ($i=0;$i<min(5,sizeof($all2));$i++)
            array_push($cat,$all2[$i]);

        $cat = json_encode($cat);

        return view('vendor.home', [
            'products_count' => Product::all()->count(),
            'orders_count' => Order::all()->count(),
            'orders_item_count' => Order_item::all()->count(),
            'all' => $all,
            'cat' => $cat
        ]);
    }

    public function profile()
    {
        $id = auth()->guard('vendor')->user()->id;
        $vendor = Vendor::find($id);

        return view('vendor.profile', compact('vendor'));
    }

    public function edit()
    {
        $id = auth()->guard('vendor')->user()->id;
        $vendor = Vendor::find($id);
        return view('vendor.profileEdit', compact('vendor'));
    }

    public function update(Request $request)
    {

        request()->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
        ]);

        $id = auth()->guard('vendor')->user()->id;
        $vendor = Vendor::find($id);

        $vendor->name = $request['name'];

        $vendor->address = $request['address'];
        $vendor->phone = $request['phone'];
        $vendor->mobile = $request['mobile'];
        $vendor->save();

        return redirect('vendor/profile');

    }

    /***********************************************************************************/
    /***************    Products    ***************************/

    public function products()
    {
        $id = auth()->guard('vendor')->user()->id;

        if (request()->ajax()) {
            $items = auth()->guard('vendor')->user()->products();
            return DataTables::of($items)
                ->addColumn('action', function ($items) {

                    $button = '<button type="button" name="edit" id="' . $items->id . '"
                    class="edit btn btn-primary btn-sm" onclick=update(' . $items->id . ')>Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="' . $items->id . '"
                    class="delete btn btn-danger btn-sm" onclick=del(' . $items->id . ')>Delete</button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('vendor.products', compact('id'));
    }

    public function addProduct()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('vendor.addProduct', compact('categories', 'brands'));
    }


    public function storeProduct(Request $request)
    {

        request()->validate([
            'name' => 'required',
            'item_num' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            'category_id' => 'required',
            'brand_id' => 'required',
            'discount' => 'required',
        ]);

        if ($files = $request->file('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(2000, 2000);
            $image->save();
        }

        $p = new Product();

        $p->name = request()->name;
        $p->item_num = request()->item_num;
        $p->price = request()->price;
        $p->description = request()->description;
        $p->image = $imagePath;
        $p->quantity = request()->quantity;
        $p->vendor_id = auth()->guard('vendor')->user()->id;
        $p->category_id = request()->category_id;
        $p->brand_id = request()->brand_id;
        $p->discount = request()->discount;
        $p->save();
        if ($files = $request->file('filename')) {

            foreach ($request->file('filename') as $image) {

                // for save original image
                $imagePath = $image->store('images', 'public');
                $image = Image::make(public_path("storage/{$imagePath}"))->fit(1500, 1500);
                $image->save();
                $img = new img();
                $img->src = $imagePath;
                $img->product_id = $p->id;
                $img->save();
            }
        }


        return redirect('vendor/product/'.$p->id.'/add/Properties');
    }

    public function editProduct(Product $product, Request $request)
    {

        $data = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'discount' => 'required',
        ]);

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');

        $product->category_id = $request->input('category_id');
        $product->brand_id = $request->input('brand_id');
        $product->discount = $request->input('discount');
        $product->save(); //persist the data

        return redirect('vendor/products');
    }

    public function updateProduct(Product $product)
    {

        return view('vendor.productEdit', compact('product'));
    }

    public function product(Request $request)
    {
        $product = Product::find($request->id);
        return view('vendor.productEdit', compact('product'));
    }

    public function deleteProduct(Request $request)
    {

        $data = Product::findOrFail($request->id);
        $data->delete();

        return;
    }

    public function addProperties(Product $product)
    {
        return view('vendor.addProperty',compact('product'));
    }

    public function storeProperties(Request $request,Product $product)
    {

        if(is_null($request['names'])){
            $request['names'] = [];
        }
        if(is_null($request['values'])){
            $request['names'] = [];
        }


        foreach ($request['names'] as $index => $names){
            $property = new Property();
            $property->product_id = $product->id;
            $property->name = $names;
            $property->value = $request['values'][$index];
            $property->save();
        }

        return redirect()->route('vendor.home');
    }



    public function discounts()
    {
        $id = auth()->guard('vendor')->user()->discount != '0';

        if (request()->ajax()) {
            $items = Product::where('discount','!=','0')->get();
            return DataTables::of($items)
                ->addColumn('action', function ($items) {
                    $button = '<button type="button" name="edit" id="' . $items->id . '"
                    class="edit btn btn-primary btn-sm" onclick=update(' . $items->id . ')>Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="' . $items->id . '"
                    class="delete btn btn-danger btn-sm" onclick=del(' . $items->id . ')>Delete</button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('vendor.discounts', compact('id'));

    }

    public function editDiscount(Product $discount, Request $request)
    {

        $data = request()->validate([
            'discount' => 'required',
        ]);


        $discount->discount = $request->input('discount');
        $discount->save(); //persist the data

        return redirect('vendor/discounts');
    }

    public function updateDiscount(Product $discount)
    {

        return view('vendor.discountEdit', compact('discount'));
    }

    public function deleteDiscount(Request $request)
    {

        $data = Product::findOrFail($request->id);
        $data->discount = 0;
        $data->save();
        return;
    }


    /*********************** end products *********************************/
    /***********************************************************************************/


    /***********************************************************************************/
    /***************   orders    ***************************/

    public function orders(Request $request)
    {

        if ($request->ajax()) {
            $id = auth()->guard('vendor')->user()->id;
            $items = Product::select('id')->where('vendor_id', '=', $id)->get();
            $data = Order_item::whereIn('product_id', $items)->where('done', '=', 0);

            return DataTables::of($data)->make(true);
        }

        return view('vendor.orders');

    }

    public function soldItems(Request $request)
    {



        if ($request->ajax()) {
            $id = auth()->guard('vendor')->user()->id;
            $items = Product::select('id')->where('vendor_id', '=', $id)->get();
            $data = Order_item::whereIn('product_id', $items)->where('done', '=', 1)->get();

            return DataTables::of($data)->make(true);
        }

        return view('vendor.soldItems');
    }

    /*********************** end orders *********************************/
    /***********************************************************************************/

}
