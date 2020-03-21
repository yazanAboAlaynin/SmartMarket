<?php

namespace App\Http\Controllers\Company;

use App\Company;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
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
        return view('home');
    }

    /***********************************************************************************/
            /***************    Products    ***************************/

    public function products()
    {
        $id = auth()->guard('company')->user()->id;

        if(request()->ajax())
        {
            $items = Product::where('company_id','=',$id)->get();
            return DataTables::of($items)
                ->addColumn('action', function($items){

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('company.products',compact('id'));
    }

    public function addProduct(){
        return view('company.addProduct');
    }


    public function storeProduct(Request $request){

        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'required',
            //'company_id' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'discount' => 'required',
        ]);

        $data = $request->all();

        $check = $this->create($data);
        return view('company.products');
    }

    public function create(array $data)
    {
        return Product::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'image' => $data['image'],
            'company_id' => 15,
            'category_id' => $data['category_id'],
            'brand_id' => $data['brand_id'],
            'discount' => $data['discount'],
        ]);
    }


    public function editCompany(Request $request,$id)
    {
        $data = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'required',
            'company_id' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'discount' => 'required',
        ]);
        $company = Company::find($id);
        $company->name = $request->input('name');
        $company->description = $request->input('description');
        $company->price = $request->input('price');
        $company->quantity = $request->input('quantity');
        $company->image = $request->input('image');
        $company->company_id = $request->input('company_id');
        $company->category_id = $request->input('category_id');
        $company->brand_id = $request->input('brand_id');
        $company->discount = $request->input('discount');
        $company->save(); //persist the data
        return view('company.company');
    }

    public function updateCompany(Company $company){

        return view('company.companyEdit',compact('company'));
    }

    public function deleteCompany(Request $request){

        $data = Company::findOrFail($request->id);
        $data->delete();

        return;
    }
}
