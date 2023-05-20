<?php

namespace App\Http\Controllers;

use App\Models\product_files;
use App\Http\Requests\Storeproduct_filesRequest;
use App\Http\Requests\Updateproduct_filesRequest;
use Illuminate\Http\Request;

class ProductFilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-files');
    }

    public function addProductFile($pid)
    {
        return view('add-files')->with(['product_id'=>$pid]);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storeproduct_filesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validateData = $request->validate([
            'picture'=>'image|mimes:jpg,png,jpeg,gif,svg,webp'
        ]);

        if(!empty($request->file('file_name'))){
            // $picture = $request->file('picture')->getClientOriginalName();
            $file_name = time().'.'.$request->file_name->extension();
            // $path = $request->file('picture')->store('public/images');

            $request->file_name->move(\public_path('files/'.$request->product_id),$file_name);
        }else{
                $file_name = "";
        }

        product_files::create([
            'product_id'=>$request->product_id,

            'file_name'=>$file_name,
            'file_title'=>$request->file_title,
            'featured'=>$request->featured,
           'business_id'=>$request->business_id
        ]);
        $message = "Product File(s) uploaded successfully. <b><a href='/product-dashboard/".$request->product_id."'>Back to Product Dashboard</a></b>";
        return redirect()->back()->with(['message'=>$message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product_files  $product_files
     * @return \Illuminate\Http\Response
     */
    public function show(product_files $product_files)
    {
        //
    }

    public function file($fid)
    {
        $file = product_files::where('id',$fid)->first();
        return view('file')->with(['file'=>$file]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product_files  $product_files
     * @return \Illuminate\Http\Response
     */
    public function edit(product_files $product_files)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateproduct_filesRequest  $request
     * @param  \App\Models\product_files  $product_files
     * @return \Illuminate\Http\Response
     */
    public function update(Updateproduct_filesRequest $request, product_files $product_files)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product_files  $product_files
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        product_files::findOrFail($id)->delete();
        $message = 'The File been deleted!';
        return redirect()->back()->with(['message'=>$message]);
    }
}
