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
        return view('vendor.home', [
            'products_count' => Product::all()->count(),
            'orders_count' => Order::all()->count(),
            'orders_item_count' => Order_item::all()->count()
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

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="done" id="' . $data->id . '" 
                    class="edit btn btn-primary btn-sm" onclick=done(' . $data->id . ')>done</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="' . $data->id . '" 
                    class="delete btn btn-danger btn-sm" onclick=show(' . $data->id . ')>view</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('vendor.orders');

    }

    public function soldItems(Request $request)
    {


        if ($request->ajax()) {
            $id = auth()->guard('vendor')->user()->id;
            $items = Product::select('id')->where('vendor_id', '=', $id)->get();
            $data = Order_item::whereIn('product_id', $items)->where('done', '=', 1);

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="show" id="' . $data->id . '" 
                    class="edit btn btn-primary btn-sm" onclick=show(' . $data->id . ')>view</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('vendor.soldItems');
    }

    /*********************** end orders *********************************/
    /***********************************************************************************/

}
