<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\requests;
use App\Models\facilities;
use App\Models\department;
use App\Models\unit;

// To be used for registration
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth()->user()->role=="Super" || Auth()->user()->role=="Admin"){
            $requests = requests::all();
            return view('home')->with(['requests'=>$requests]);
        }elseif(Auth()->user()->role=="Staff"){
            return redirect()->route('new-request');
        }elseif(Auth()->user()->role=="Supervisor"){
            return redirect()->route('requests');
        }elseif(Auth()->user()->role=="Driver"){
            return redirect()->route('driver-trips');
        }

    }

    public function staffs()
    {
        $allstaffs = User::where('role','Staff')->get();
        return view('staffs')->with(['allstaffs'=>$allstaffs]);
    }


    public function newStaff()
    {
        $facilities = facilities::select('id','facility_name')->get();
        $departments = department::select('id','department_name')->get();
        $units = unit::select('id','unit_name')->get();
        return view('new-staff')->with(['facilities'=>$facilities,'departments'=>$departments,'units'=>$units,'object'=>'Staff']);
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function saveStaff(Request $request)
    {
        if($request->password!=""){
            $password = Hash::make($request->password);

        }else{
            $password =$request->oldpassword;
        }

        if($request->cid>0){
            $outcome = "modified";
        }else{
            $outcome = "created";
        }

        User::updateOrCreate(['id'=>$request->cid],[
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'staff_id'=>$request->staff_id,
            'designation'=>$request->designation,
            'phone_number'=>$request->phone_number,
            'facility_id'=>$request->facility_id,
            'department_id'=>$request->department_id,
            'unit_id'=>$request->unit_id,
            'supervisor'=>$request->supervisor,
            'role'=>$request->role,
            'status'=>$request->status
        ]);

        $message = 'The '.$request->object.' has been '.$outcome.' successfully';

        return redirect()->back()->with(['message'=>$message]);
    }

    public function editStaff($cid)
    {
        if (Auth()->user()->role == 'Admin' || Auth()->user()->role == 'Super' ) {
            $staff = User::where('id',$cid)->first();
        }else{
            $staff = User::where('id',Auth()->user()->id)->first();
        }
        $object = $staff->role;

        $facilities = facilities::select('id','facility_name')->get();
        $departments = department::select('id','department_name')->get();
        $units = unit::select('id','unit_name')->get();

        return view('new-client')->with(['facilities'=>$facilities,'departments'=>$departments,'units'=>$units,'object'=>'Staff']);
    }

    public function settings(request $request){
        $validateData = $request->validate([
            'logo'=>'image|mimes:jpg,png,jpeg,gif,svg',
            'background'=>'image|mimes:jpg,png,jpeg,gif,svg'
        ]);

        if(!empty($request->file('logo'))){

            $logo = time().'.'.$request->logo->extension();

            $request->logo->move(\public_path('images'),$logo);
        }else{
            $logo = $request->oldlogo;
        }

        if(!empty($request->file('background'))){

            $background = time().'.'.$request->background->extension();

            $request->background->move(\public_path('images'),$background);
        }else{
            $background = $request->oldbackground;
        }


        settings::updateOrCreate(['id'=>$request->id],[
            'org_name' => $request->org_name,
            'motto' => $request->motto,
            'logo' => $logo,
            'address' => $request->address,
            'background' => $background,
            'mode'=>$request->mode,
            'color'=>$request->color,
        ]);


        $message = "The settings has been updated!";
        return redirect()->back()->with(['message'=>$message]);
      }

      public function destroy($cid){
        User::find($cid)->delete();
        $message = "The User has been deleted";

        return redirect()->back()->with(['message'=>$message]);
      }

      public function Artisan1($command) {
        $artisan = \Artisan::call($command);
        $output = \Artisan::output();
        return dd($output);
    }

    public function Artisan2($command, $param) {
        $output = \Artisan::call($command.":".$param);
        return dd($output);
    }
    }
