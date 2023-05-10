<?php

namespace App\Http\Controllers;

use App\Models\subscriptions;
use App\Http\Requests\StoresubscriptionsRequest;
use App\Http\Requests\UpdatesubscriptionsRequest;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = subscriptions::all();
        return view('product_subscriptions')->with(['subscriptions'=>$subscriptions]);
    }

    public function UploadTemplate()
    {
        $subscriptions = subscriptions::where('status','New')->get();
        return view('upload-template')->with(['subscriptions'=>$subscriptions]);
    }

    public function generateStoppage()
    {
        $subscriptions = subscriptions::where('status','Stoppage')->get();
        return view('stoppage-template')->with(['subscriptions'=>$subscriptions]);
    }


    public function uploadPayments(Request $request)
    {
            // Excel::import(new UsersImport, $request->file('filename'));

                if ($request->input('submit') != null ){

                  $file = $request->file('file');

                  // File Details
                  $filename = $file->getClientOriginalName();
                  $extension = $file->getClientOriginalExtension();
                  $tempPath = $file->getRealPath();
                  $fileSize = $file->getSize();
                  $mimeType = $file->getMimeType();

                  // Valid File Extensions
                  $valid_extension = array("csv");

                  // 500 in Bytes
                  $maxFileSize = 524288;

                  // Check file extension
                  if(in_array(strtolower($extension),$valid_extension)){

                    // Check file size
                    if($fileSize <= $maxFileSize){

                      // File upload location
                      $location = 'uploads';

                      // Upload file
                      $file->move($location,$filename);

                      // Import CSV to Database
                      $filepath = public_path($location."/".$filename);

                      // Reading file
                      $file = fopen($filepath,"r");

                      $importData_arr = array();
                      $i = 0;

                      while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                         $num = count($filedata );

                         // Skip first row (Remove below comment if you want to skip the first row)
                         if($i == 0){
                            $i++;
                            continue;
                         }
                         for ($c=0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata [$c];
                         }
                         $i++;
                      }
                      fclose($file);

                      // Insert to MySQL database
                      foreach($importData_arr as $importData){

                        $insertData = array(
                           "username"=>$importData[1],
                           "name"=>$importData[2],
                           "gender"=>$importData[3],
                           "email"=>$importData[4]);
                        Page::insertData($insertData);

                      }

                      Session::flash('message','Import Successful.');
                    }else{
                      Session::flash('message','File too large. File must be less than 2MB.');
                    }

                  }else{
                     Session::flash('message','Invalid File Extension.');
                  }

                }

                // Redirect to index
                return redirect()->action('PagesController@index');


            return redirect()->route('payments')->with('message', 'Imported Successfully');
    }

    public function clientSubs($cid)
    {
        $subscriptions = subscriptions::where('client_id',$cid)->get();
        return view('client_subscriptions')->with(['subscriptions'=>$subscriptions]);
    }

    public function topUp(Request $request)
    {
        $subscriptions = subscriptions::where('client_id',$cid)->get();
        return view('client_subscriptions')->with(['subscriptions'=>$subscriptions]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoresubscriptionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        subscriptions::updateOrCreate(['id'=>$request->id],[
            'product_id'=>$request->product_id,
            'client_id'=>$request->client_id,
            'subscription_plan'=>$request->subscription_plan,
            'date_subscribed'=>$request->date_subscribed,
            'penalties'=>$request->penalties,
            'status'=>$request->status,
            'business_id'=>Auth()->user()->business_id
        ]);
        $message = 'The Subscription was successful!';

        return redirect()->back()->with(['message'=>$message]);

    }

    public function paySubscription(Request $request){

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\subscriptions  $subscriptions
     * @return \Illuminate\Http\Response
     */
    public function show(subscriptions $subscriptions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subscriptions  $subscriptions
     * @return \Illuminate\Http\Response
     */
    public function edit(subscriptions $subscriptions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatesubscriptionsRequest  $request
     * @param  \App\Models\subscriptions  $subscriptions
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatesubscriptionsRequest $request, subscriptions $subscriptions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subscriptions  $subscriptions
     * @return \Illuminate\Http\Response
     */
    public function destroy($sid){
        subscriptions::find($sid)->delete();
        $message = "The subscription has been deleted";

        return redirect()->back()->with(['message'=>$message]);
      }
}
