<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Notification;
use App\Product;
use App\Vendor;
use App\Http\Controllers\Controller;
use App\Order;
use App\Order_item;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

use App\Admin;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard', [
            'users_count' => User::all()->count(),
            'vendors_count' => vendor::where('approved','=',1)->count(),
            'orders_count' => Order::all()->count(),
            'vendorsReq_count' => vendor::where('approved','=',0)->count()
        ]);
    }

    public function show(Request $request)
    {

    }


/***********************************************************************************/
      /***************   control the vendors    ***************************/

    public function vendors(Request $request){

        if($request->ajax())
        {
            $data = Vendor::where('approved','=','1')->get();
            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" 
                    class="edit btn btn-primary btn-sm" onclick=update('.$data->id.')>Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'.$data->id.'" 
                    class="delete btn btn-danger btn-sm" onclick=del('.$data->id.')>Delete</button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.vendors');

    }

    public function editVendor(Request $request,$id)
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ]);
        $vendor = Vendor::find($id);
        $vendor->name = $request->input('name');
        $vendor->email = $request->input('email');
        $vendor->mobile = $request->input('mobile');
        $vendor->phone = $request->input('phone');
        $vendor->address = $request->input('address');
        $vendor->save(); //persist the data
        return redirect('admin/vendors');
    }

    public function updateVendor(Vendor $vendor){

        return view('admin.vendorEdit',compact('vendor'));
    }

    public function deleteVendor(Request $request){

        $data = Vendor::findOrFail($request->id);
        $data->delete();

        return;
    }

    public function pendingVendor(Request $request){

        if($request->ajax())
        {

            $data = Vendor::where('approved','=',"0")->get();
            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="approve" id="'.$data->id.'" 
                    class="edit btn btn-primary btn-sm" onclick=done('.$data->id.')>approve</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.pendingVendors');
    }

    public function approve(Request $request){

        $data = Vendor::findOrFail($request->id);
        $data->approved = 1;
        $data->save();
        return "yes";
    }

            /*********************** end vendors *********************************/
    /***********************************************************************************/

    /***********************************************************************************/
    /***************   control the users    ***************************/

    public function users(Request $request){
        if($request->ajax())
        {
            $data = User::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" 
                    class="edit btn btn-primary btn-sm" onclick=update('.$data->id.')>Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'.$data->id.'" 
                    class="delete btn btn-danger btn-sm" onclick=del('.$data->id.')>Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.users');

    }

    public function editUser(Request $request,$id)
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
           // 'address' => 'required',
        ]);
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');
        //$user->address = $request->input('address');
        $user->save(); //persist the data
        return redirect('admin/users');
    }

    public function updateUser(User $user){
        return view('admin.userEdit',compact('user'));
    }

    public function deleteUser(Request $request){
        $data = User::findOrFail($request->id);
        $data->delete();

        return;
    }
        /*********************** end users *********************************/
    /***********************************************************************************/

    /***********************************************************************************/
    /***************   control the orders    ***************************/

    public function orders(Request $request){

        if($request->ajax())
        {
            $data = Order::where('done','=',0)->get();
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

        return view('admin.orders');

    }

    public function done(Request $request){
        $data = Order::findOrFail($request->id);
        $data->done = 1;
        $data->save();
        return;
    }


    public function orderItems(Order $order){

        Notification::where('order_id','=',$order->id)->update(['read_at'=>date('Y-m-d H:i:s')]);


        if(request()->ajax())
        {
            $items = Order_item::where('order_id','=',$order->id)->get();
            return DataTables::of($items)
                ->addColumn('action', function($items){

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.orderShow',compact('order'));
    }

    public function oldOrders(Request $request){
        if($request->ajax())
        {
            $data = Order::where('done','=',1)->get();
            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="show" id="'.$data->id.'" 
                    class="edit btn btn-primary btn-sm" onclick=show('.$data->id.')>view</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.oldOrders');
    }

    public function readOrder(Request $request){

        if($request->ajax()){
            $notis = Notification::read();
            return view('readOrder',compact('notis'));
        }
        return response()->json(['data'=>234234],200);
    }

    /*********************** end orders *********************************/
    /***********************************************************************************/

    /***********************************************************************************/
    /***************   control the products    ***************************/

    public function products()
    {
        if(request()->ajax())
        {
            $items = Product::latest()->get();
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

        return view('admin.products');
    }

    public function editProduct(Product $product,Request $request)
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

        return redirect('admin/products');
    }

    public function updateProduct(Product $product){

        return view('admin.productEdit',compact('product'));
    }

    public function deleteProduct(Request $request){

        $data = Product::findOrFail($request->id);
        $data->delete();

        return;
    }

/*********************************************************************************/
/*************************** control categories **********************************/

    public function categories(){
        if(request()->ajax())
        {
            $items = Category::latest()->get();
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
        return view('admin.categories');
    }

    public function addCategory(){
        return view('admin.addCategory');
    }

    public function storeCategory(Request $request){
        $data = request()->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ]);
        if ($files = $request->file('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1500, 1500);
            $image->save();
        }
        $category = new Category();
        $category->name = $data['name'];
        $category->image = $imagePath;
        $category->save();

        return redirect()->route('admin.home');
    }

    public function editCategory(Category $category,Request $request)
    {

        $data = request()->validate([
            'name' => 'required',
        ]);
        $category->name = $request->input('name');

        $category->save(); //persist the data

        return redirect('admin/categories');
    }

    public function updateCategory(Category $category){

        return view('admin.categoryEdit',compact('category'));
    }

    public function deleteCategory(Request $request){

        $data = Category::findOrFail($request->id);
        $data->delete();

        return;
    }


    /*********************************************************************************/
    /*************************** control brands **********************************/

    public function brands(){
        if(request()->ajax())
        {
            $items = Brand::latest()->get();
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
        return view('admin.brands');
    }

    public function addBrand(){
        return view('admin.addBrand');
    }

    public function storeBrand(Request $request){
        $data = request()->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($files = $request->file('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1500, 1500);
            $image->save();
        }
        $brand = new Brand();
        $brand->name = $data['name'];
        $brand->image = $imagePath;
        $brand->save();

        return redirect()->route('admin.home');
    }

    public function editBrand(Brand $brand,Request $request)
    {

        $data = request()->validate([
            'name' => 'required',
        ]);
        $brand->name = $request->input('name');

        $brand->save(); //persist the data

        return redirect('admin/brands');
    }

    public function updateBrand(Brand $brand){

        return view('admin.brandEdit',compact('brand'));
    }

    public function deleteBrand(Request $request){

        $data = Brand::findOrFail($request->id);
        $data->delete();

        return;
    }
}
