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
