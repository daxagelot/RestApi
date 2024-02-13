<?php

namespace App\Http\Controllers\Jpanel;

use App\Http\Controllers\Controller;
use App\Models\Contactus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index(){
        $contact=Contactus::withTrashed()->orderBy('id','desc')->get();
        return view('jpanel.Contact.viewContact',['contact'=>$contact]);
    }
    public function deleteContact($id){
        Contactus::where('id',$id)->update(['deleted_by'=>Auth::id()]);
        $contact=Contactus::find($id)->delete();
        if ($contact) {
            return response()->json(['status'=>'success','success'=>'Contact has been deleted Successfully!']);
        } else {
            return response()->json(['error'=>'Something went wrong. Try again.']);
        }
    }
    public function restoreContact($id){
        Contactus::withTrashed()->where('id',$id)->update(['deleted_by'=>NULL]);
        $contact=Contactus::withTrashed()->find($id)->restore();
        if ($contact) {
            return response()->json(['status'=>'success','success'=>'Contact has been restored Successfully!']);
        } else {
            return response()->json(['error'=>'Something went wrong. Try again.']);
        }
    }
}
