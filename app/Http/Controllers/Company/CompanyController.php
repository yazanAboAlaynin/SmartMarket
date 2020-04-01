<?php

namespace App\Http\Controllers\Company;

use App\Brand;
use App\Category;
use App\Company;
use App\Http\Controllers\Controller;
use App\Order;
use App\Order_item;
use App\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;


class CompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:company');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('company.home');
    }

    public function profile()
    {
        $id = auth()->guard('company')->user()->id;
        $company = Company::find($id);

        return view('company.profile',compact('company'));
    }

    /***********************************************************************************/
            /***************    Products    ***************************/

    public function products()
    {
        $id = auth()->guard('company')->user()->id;

        if(request()->ajax())
        {
            $items = auth()->guard('company')->user()->products();
            return DataTables::of($items)
                ->addColumn('action', function($items){
                    $button = '<button type="button" name="edit" id="'.$items->id.'" 
                    class="edit btn btn-primary btn-sm" onclick=update('.$items->id.')>Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'.$items->id.'" 
                    class="delete btn btn-danger btn-sm" onclick=del('.$items->id.')>Delete</button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('company.products',compact('id'));
    }

    public function addProduct(){
        $categories = Category::all();
        $brands = Brand::all();
        return view('company.addProduct',compact('categories','brands'));
    }


    public function storeProduct(Request $request){

        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //'company_id' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'discount' => 'required',
        ]);
        if ($files = $request->file('image')) {

            // for save original image
            $imagePath = request('image')->store('images','public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1500,1500);
            $image->save();
        }
        $p = new Product();

        $p->name = request()->name;
        $p->price = request()->price;
        $p->description = request()->description;
        $p->image = $imagePath;
        $p->quantity = request()->quantity;
        $p->company_id = auth()->guard('company')->user()->id;
        $p->category_id = request()->category_id;
        $p->brand_id = request()->brand_id;
        $p->discount = request()->discount;
        $p->save();

        return redirect('company/products');
    }

    public function editProduct(Product $product,Request $request)
    {

        $data = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'discount' => 'required',
        ]);

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->image = $request->input('image');
        $product->category_id = $request->input('category_id');
        $product->brand_id = $request->input('brand_id');
        $product->discount = $request->input('discount');
        $product->save(); //persist the data

        return redirect('company/products');
    }

    public function updateProduct(Product $product){

        return view('company.productEdit',compact('product'));
    }

    public function deleteProduct(Request $request){

        $data = Product::findOrFail($request->id);
        $data->delete();

        return;
    }

    /*********************** end products *********************************/
    /***********************************************************************************/


        /***********************************************************************************/
    /***************   orders    ***************************/

    public function orders(Request $request){

        if($request->ajax())
        {
            $id = auth()->guard('company')->user()->id;
            $items = Product::select('id')->where('company_id','=',$id)->get();
            $data = Order_item::whereIn('product_id',$items)->where('done','=',0);

            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="done" id="'.$data->id.'" 
                    class="edit btn btn-primary btn-sm" onclick=done('.$data->id.')>done</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'.$data->id.'" 
                    class="delete btn btn-danger btn-sm" onclick=show('.$data->id.')>view</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('company.orders');

    }

    public function soldItems(Request $request){


        if($request->ajax())
        {
            $id = auth()->guard('company')->user()->id;
            $items = Product::select('id')->where('company_id','=',$id)->get();
            $data = Order_item::whereIn('product_id',$items)->where('done','=',1);

            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="show" id="'.$data->id.'" 
                    class="edit btn btn-primary btn-sm" onclick=show('.$data->id.')>view</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('company.soldItems');
    }

    /*********************** end orders *********************************/
    /***********************************************************************************/

}
