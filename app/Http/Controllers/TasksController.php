<?php

namespace App\Http\Controllers;

use App\Models\tasks;
use Illuminate\Http\Request;
use App\Models\categories;
use Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth()->user()->role == 'Super' || Auth()->user()->role == 'Admin'){
            return view('tasks');
        }else{
            return view('member-message');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    // General Task
    public function newTask()
    {
        if (Auth()->user()->role == 'Super' || Auth()->user()->role == 'Admin'){
            $categories = categories::all();
            return view('new-task')->with(['categories'=>$categories]);
        }else{
            return view('new-message');
        }

    }

    // Save General Task
    public function saveTask(Request $request)
    {
        tasks::updateOrCreate(['id'=>$request->tid],[

            'subject'=>$request->subject,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'details'=>$request->details,
            'assigned_to'=>$request->assigned_to,
            'category'=>$request->category,
            'status'=>$request->status,
            'sender_id'=>Auth()->user()->id
        ]);

        $message = "Message/Task created successfully!";

        return redirect()->back()->with(['message'=>$message]);

    }

    public function viewTask($tid)
    {
        $task = tasks::where('id',$tid)->first();
        return view('task')->with(['task'=>$task]);

    }

    public function change_task_status(Request $request)
    {
        $task = tasks::where('id',$request->task_id)->first();
        $task->status=$request->change_status;
        $task->save();

        $message = "Task Status Changed to ".$request->change_status;

        return redirect()->back()->with(['message'=>$message]);

    }

    public function completetask($id)
    {
        $task = tasks::where('id',$id)->first();
        $task->status = 'Completed';
        $task->save();

        $message = 'The task has been updated!';
        // audit::create([
        //     'action'=>"Task update",
        //     'description'=>'Update',
        //     'doneby'=>Auth()->user()->id,
        //     'settings_id'=>Auth()->user()->settings_id,
        // ]);
        return redirect()->route('tasks')->with(['message'=>$message]);
    }

    public function inprogresstask($id)
    {
        $task = tasks::where('id',$id)->first();
        $task->status = 'In Progress';
        $task->save();

        $message = 'The task has been updated!';

        return redirect()->route('tasks')->with(['message'=>$message]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoretasksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretasksRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetasksRequest  $request
     * @param  \App\Models\tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetasksRequest $request, tasks $tasks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy($task_id)
    {
        tasks::find($task_id)->delete();
        $message = "The selected task has been deleted";

        return redirect()->back()->with(['message'=>$message]);
    }
}
