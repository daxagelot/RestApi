<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Contactus;
use App\Models\Gallery;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Team;

class HomeController extends Controller
{
    // public function index(){
    //     $company=Company::first();
    //     $review=Review::where('status',"1")->get();
    //     $galleries=Gallery::where('status',"1")->get();
    //     return view('frontend.index',['review'=>$review,'company'=>$company,'galleries'=>$galleries]);
    // }
    public function index(){
        // $galleries=Gallery::where('status',"1")->get();
        $teams = Team::all();

        return view('frontend.index',compact('teams'));
    }
    public function blog(){
        
        return view('frontend.blog');
    }
    public function blog_detail(){
        
        return view('frontend.blog_detail');
    }
    //---------------------------------------------------------store contact use------------------------------------------------------------
    public function storeContactUs(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|numeric|digits:10',
            'message'=>'required'
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()]);
        }
        $contact=new Contactus();
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->phone=$request->phone;
        $contact->message=$request->message;
        $contact->save();
        if($contact){
            return response()->json(['status'=>'success','message'=>'ContactUs has been saved successfully!']);
        }else{
            return response()->json(['status'=>'warning','message'=>'Please try again,Something went wrong!']);
        }
    }
    
   

}
