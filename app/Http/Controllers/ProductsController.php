<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\suppliers;

use App\Models\categories;
use Illuminate\Http\Request;
use App\Models\subscription_plans;

use App\Models\User;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = products::all();
        return view('products')->with(['products'=>$products]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        //
    }

    public function newProduct(){
        $suppliers = suppliers::select('supplier_name','id','company_name')->get();
        $pcategories = categories::where('group_name','Products')->get();

        return view('new-product')->with(['suppliers'=>$suppliers,'pcategories'=>$pcategories]);
    }

    public function editProduct($pid)
    {
        $product = products::where('id',$pid)->first();
        $suppliers = suppliers::select('supplier_name','id','company_name')->get();
        $pcategories = categories::where('group_name','Products')->get();

        return view('new-product')->with(['product'=>$product,'suppliers'=>$suppliers, 'pcategories'=>$pcategories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreproductsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->product_id!=''){
            $outcome = "modified";
        }else{
            $outcome = "created";
        }

        foreach($request->model as $key=>$model){


            $product_id = products::updateOrCreate(['id'=>$request->product_id],[
                'title' => $request->title.' - '.$model,
                'price' => $request->price[$key],
                'model' => $request->model[$key],
                //'supplier_id'=>1,
                'start_date'=>$request->start_date,
                'end_date'=>$request->end_date,
                'detail'=>$request->detail,
                'terms'=>$request->terms,
                'category'=>$request->category,
                'status'=>$request->status,
                'business_id'=>Auth()->user()->business_id
            ])->id;

            $monthsplan = [3, 6, 9, 12, 15, 18, 21, 24];

            foreach ($monthsplan as $month)  {
                $current_month = 'm'.$month;
                if ($request->$current_month[$key]!="") {
                    $newprice = (($request->price[$key]/100)*$request->$current_month[$key])+$request->price[$key];
                    $monthly_contribution = $newprice/$month;
                    subscription_plans::updateOrCreate(['product_id'=>$product_id,'duration'=>$month],[
                        'product_id' => $product_id,
                        'title' => $request->title.' - '.$model.' - N'.$newprice.' ('.$month.')',
                        'price' => $newprice,
                        'percentage_increase'=>$request->$current_month[$key],
                        'duration'=>$month,
                        'monthly_contribution'=>$monthly_contribution,
                        'business_id'=>Auth()->user()->business_id
                    ]);
                }
            }
        }

        $message = 'The product has been '.$outcome.' successfully';

        return redirect()->route('products')->with(['message'=>$message]);
    }

    public function productDashboard($pid)
    {
        $product = products::where('id',$pid)->first();

        if (Auth()->user()->role=="Client") {
            return view('guest-product-dashboard')->with(['product'=>$product]);
        }else{
            return view('product-dashboard')->with(['product'=>$product]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateproductsRequest  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateproductsRequest $request, products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(products $products)
    {
        //
    }
}
