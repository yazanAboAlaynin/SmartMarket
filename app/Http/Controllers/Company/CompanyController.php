<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

  

    public function products(Company $company){

        if(request()->ajax())
        {
            $items = Product::where('company_id','=',$company->id)->get();
            return DataTables::of($items)
                ->addColumn('action', function($items){

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('company.products',compact('company'));
    }


    public function addproduct(Request $request){

        request()->validate([
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

        $data = $request->all();
        $check = $this->create($data);
        return redirect('company/addproduct');
    }

    public function create(array $data)
    {
        return Company::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'image' => $data['image'],
            'company_id' => $data['company_id'],
            'category_id' => $data['category_id'],
            'brand_id' => $data['brand_id'],
            'discount' => $data['discount'],
        ]);
    }

    public function company(Request $request){

        if($request->ajax())
        {
            $data = Company::latest()->get();
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

        return view('company.company');

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
