<?php

namespace App\Http\Controllers;

use App\Models\payments;
use App\Models\subscriptions;

use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = payments::all();
        return view('payments')->with(['payments'=>$payments]);

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
     * @param  \App\Http\Requests\StorepaymentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payment = payments::Create([
            'client_id'=>$request->client_id,
            'product_id'=>$request->product_id,
            'amount_paid'=>$request->amount,
            'payment_date'=>$request->date_paid,
            'subscription_id'=>$request->subscription_id,
            'business_id'=>Auth()->user()->business_id
        ]);

        $thissubpayments = payments::where('subscription_id',$request->subscription_id)->count();
        $TEXT =  $thissubpayments. " of ".$payment->subscription->subplan->duration;

        if(number_format($thissubpayments) >= $payment->subscription->subplan->duration){
            subscriptions::where('id',$request->subscription_id)->update(['status'=>'Completed']);
        }else{
            subscriptions::where('id',$request->subscription_id)->update(['status'=>'Open']);
        }


        $message = 'The Subscription payment was successful! '.$TEXT;

        return redirect()->back()->with(['message'=>$message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function show(payments $payments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function edit(payments $payments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepaymentsRequest  $request
     * @param  \App\Models\payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepaymentsRequest $request, payments $payments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function destroy($pid){
        payments::find($pid)->delete();
        $message = "The Payment has been deleted";

        return redirect()->back()->with(['message'=>$message]);
      }
}
