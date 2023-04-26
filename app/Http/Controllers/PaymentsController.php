<?php

namespace App\Http\Controllers;

use App\Models\payments;
use App\Models\cpayments;
use App\Models\products;

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

    public function itemPayments($pid)
    {
        if (Auth()->user()->role == 'Super' || Auth()->user()->role == 'Admin'){

            $payments = payments::where('product_id',$pid)->get();
        }else{
            $payments = payments::where('product_id',$pid)->where('client_id',Auth()->user()->id)->get();
        }

        $item = products::where('id',$pid)->first()->title;
        return view('item-payments')->with(['payments'=>$payments,'item'=>$item]);

    }

    public function cTransactions()
    {
        $contributions  = cpayments::all();
        return view('ctransactions')->with(['contributions'=>$contributions ]);

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

    public function paySub(Request $request)
    {
        $payment = cpayments::Create([
            'client_id'=>$request->client_id,
            'amount'=>$request->amount,
            'saving_plan'=>$request->saving_plan,
            'account_head'=>$request->account_head,
            'credit_officer'=>$request->credit_officer,
            'status'=>$request->status,
            'payment_date'=>$request->date_paid,
            'business_id'=>Auth()->user()->business_id
        ]);


        $message = 'The '.$request->account_head.' payment was successful! ';

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

     public function deleteCsub($pid){
        cpayments::find($pid)->delete();
        $message = "The record has been deleted";

        return redirect()->back()->with(['message'=>$message]);
      }

    public function destroy($pid){
        payments::find($pid)->delete();
        $message = "The Payment has been deleted";

        return redirect()->back()->with(['message'=>$message]);
      }
}
