<?php

namespace App\Http\Controllers\Jpanel;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index()
    {   
        $company=Company::first();
        $countries=Country::orderBy('name','asc')->get();
        $states=State::orderBy('name','asc')->get();
        $cities=City::orderBy('name','asc')->get();
        return view('jpanel.company',['company'=>$company,'countries'=>$countries,'states'=>$states,'cities'=>$cities]);
    }
    public function getStates($id){
        $states=State::where('country',$id)->orderBy('name','asc')->get();
        return response()->json(['data'=>$states]);
    }
    public function getCities($id){
        $cities=City::where('state',$id)->orderBy('name','asc')->get();
        return response()->json(['data'=>$cities]);
    }
    public function companyUpdate(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'company_type' => 'required',
            'gst_no' => 'required',
            'reg_date' => 'required',
            'reg_date' => 'required',
            'contact_no' => 'required',
            'alternate_no' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zipcode' => 'required|digits:6',
            'address' => 'required'
        ]);
        if($request->company_id == null){
            $company=new Company;
            $company->company_name=$request->company_name;
            $company->company_type=$request->company_type;
            $company->gst_no=$request->gst_no;
            $company->reg_date=$request->reg_date;
            $company->phone_no=$request->contact_no;
            $company->alternate_phone_no=$request->alternate_no;
            $company->email=$request->email;
            $company->country=$request->country;
            $company->state=$request->state;
            $company->city=$request->city;
            $company->zipcode=$request->zipcode;
            $company->address=$request->address;
            $company->created_by=Auth::id();
            $company->save();
        }else{
            $company = Company::where('id', $request->company_id)->update([
                'company_name'=>$request->company_name,
                'company_type'=>$request->company_type,
                'gst_no'=>$request->gst_no,
                'reg_date'=>$request->reg_date,
                'phone_no'=>$request->contact_no,
                'alternate_phone_no'=>$request->alternate_no,
                'email'=>$request->email,
                'country'=>$request->country,
                'state'=>$request->state,
                'city'=>$request->city,
                'zipcode'=>$request->zipcode,
                'address'=>$request->address,
                'updated_by'=>Auth::id()
            ]);
        }
        if ($company) {
            return redirect('jpanel/company')->with('success', 'Your compnay details has been changed!');
        } else {
            return redirect('jpanel/company')->with('error', 'Something went wrong. Try again.');
        }
    }
    public function companyImageUpdate(Request $request)
    {
        $company=Company::first();

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->file('avatar');
        $thumbnailPath = storage_path('app/public/images/companyProfile/th/');
        $mainImagePath = storage_path('app/public/images/companyProfile/');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $size_x = null;
        $size_y= 80;
        resizeImage($image,$thumbnailPath,$mainImagePath,$imageName,$size_x,$size_y);
         $company = Company::where('id', $company->id)->update(['company_logo' => $imageName]);
        if ($company) {
            return redirect('jpanel/company')->with('success', 'Your company logo has been changed!');
        } else {
            return redirect('jpanel/company')->with('error', 'Something went wrong. Try again.');
        }
    }
}
