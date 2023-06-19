<?php

namespace App\Http\Controllers;

use App\Models\transactions;
use Illuminate\Http\Request;

use App\Models\accountheads;
use App\Models\trips;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = transactions::paginate(50);
        $accountheads = accountheads::select('title','category')->get();
        $trips = trips::select('id','to','driver_id','departure_timedate')->get();

        return view('transactions', compact('transactions','accountheads','trips'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        transactions::updateOrCreate(['id'=>$request->id],[
            'title' => $request->title,
            'amount' => $request->amount,
            'account_head' => $request->account_head,
            'date'=>$request->date,
            'reference_no' => $request->reference_no,
            'upload'=>'',
            'detail'=>$request->detail,
            'from'=>$request->from,
            'to'=>$request->to,
            'subscription_id'=>$request->subscription_id,
            'approved_by'=>$request->approved_by,
            'recorded_by'=>$request->recorded_by,
            'business_id'=>Auth()->user()->business_id,

        ]);
        $transactions = transactions::paginate(50);
        $accountheads = accountheads::select('title','category')->get();
        $users = User::select('id','name')->get();

        $message='An transaction was created/modified';
        return view('transactions', compact('transactions','accountheads','users','message'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function show(transactions $transactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function edit(transactions $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transactions $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function delTrans($id)
    {
        transactions::findOrFail($id)->delete();
        $message = 'The transaction\'s Record has been deleted!';
        return redirect()->route('transactions')->with(['message'=>$message]);
    }
}
