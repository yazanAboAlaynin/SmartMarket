<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Http\Controllers\Controller;
use App\Order;
use App\Order_item;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
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
        return view('home');
    }

    public function show(Request $request)
    {

    }

/***********************************************************************************/
      /***************   control the companies    ***************************/

    public function companies(Request $request){

        if($request->ajax())
        {
            $data = Company::where('approved','=','1')->get();
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

        return view('admin.companies');

    }

    public function editCompany(Request $request,$id)
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ]);
        $company = Company::find($id);
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->mobile = $request->input('mobile');
        $company->phone = $request->input('phone');
        $company->address = $request->input('address');
        $company->save(); //persist the data
        return view('admin.companies');
    }

    public function updateCompany(Company $company){

        return view('admin.companyEdit',compact('company'));
    }

    public function deleteCompany(Request $request){

        $data = Company::findOrFail($request->id);
        $data->delete();

        return;
    }

    public function pendingCompanies(Request $request){

        if($request->ajax())
        {

            $data = Company::where('approved','=',"0")->get();
            return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="approve" id="'.$data->id.'" 
                    class="edit btn btn-primary btn-sm" onclick=done('.$data->id.')>approve</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.pendingCompanies');
    }

    public function approve(Request $request){

        $data = Company::findOrFail($request->id);
        $data->approved = 1;
        $data->save();
        return "yes";
    }

            /*********************** end companies *********************************/
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
        return view('admin.users');
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

    /*********************** end orders *********************************/
    /***********************************************************************************/

}
