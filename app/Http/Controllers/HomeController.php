<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\projects;
use App\Models\categories;
use App\Models\subscriptions;

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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $subscriptions = subscriptions::all();
        return view('home')->with(['subscriptions'=>$subscriptions]);
    }

    public function clients()
    {
        $allclients = User::where('role','Client')->get();
        return view('clients')->with(['allclients'=>$allclients]);
    }

    public function Staff()
    {
        $allclients = User::where('category','Staff')->get();
        return view('staff')->with(['allclients'=>$allclients]);
    }



    public function newClient()
    {
        $categories = categories::where('group_name','Clients')->get();
        return view('new-client')->with(['categories'=>$categories,'object'=>'Client']);
    }

    public function newStaff()
    {
        $categories = categories::where('group_name','Clients')->get();
        return view('new-client')->with(['categories'=>$categories,'object'=>'Staff']);
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    public function saveClient(Request $request)
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
            'about'=>$request->about,
            'phone_number'=>$request->phone_number,
            'company_name'=>$request->company_name,

            'service_no'=>$request->service_no,
            'ippis_no'=>$request->ippis_no,
            'grade_level'=>$request->grade_level,
            'step'=>$request->step,
            'rank'=>$request->rank,
            'service_length'=>$request->service_length,
            'retirement_date'=>$request->retirement_date,
            'salary_account'=>$request->salary_account,
            'bank'=>$request->bank,
            'lga'=>$request->lga,
            'kin_name'=>$request->kin_name,
            'kin_address'=>$request->kin_address,
            'dob'=>$request->dob,

            'category'=>$request->category,
            'address'=>$request->address,
            'role'=>$request->role,
            'status'=>$request->status,
            'business_id'=>Auth()->user()->business_id,



        ]);

        $message = 'The '.$request->object.' has been '.$outcome.' successfully';

        return redirect()->route('clients')->with(['message'=>$message]);
    }

    public function editClient($cid)
    {
        $client = User::where('id',$cid)->first();
        $categories = categories::where('group_name','Clients')->get();
        return view('new-client')->with(['client'=>$client,'categories'=>$categories]);
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
            'ministry_name' => $request->ministry_name,
            'motto' => $request->motto,
            'logo' => $logo,
            'address' => $request->address,
            'background' => $background,
            'mode'=>$request->mode,
            'color'=>$request->color,
            'ministrygroup_id'=>$request->ministrygroup_id,
            'user_id'=>$request->user_id
        ]);


        $message = "The settings has been updated!";
        return redirect()->back()->with(['message'=>$message]);
      }

      public function destroy($cid){
        User::find($cid)->delete();
        $message = "The User has been deleted";

        return redirect()->back()->with(['message'=>$message]);
      }
}
