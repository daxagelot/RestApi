<?php

namespace App\Http\Controllers\jpanel;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class LocationController extends Controller
{
    // ---------------------------------Country-----------------------------------------------
    public function country(){
        $country = Country::withTrashed()->get();
        return view('jpanel.location.countryList',['country' =>$country]);
    }
    public function countryStore(Request $request){
        $request->validate([
            'cname' => 'required|unique:countries,name',
        ]);
        $country=new Country;
        $country->name=$request->cname;
        $country->save();
        if ($country) {
            return redirect('jpanel/location/country')->with('success', 'Country has been created successfully!');
        } else {
            return redirect('jpanel/location/country')->with('error', 'Something went wrong. Try again.');
        }
    }
    public function countryEdit($id){
        $country = Country::find($id);
        return view('jpanel.location.countryEdit',['country'=>$country]);
    }
    
    public function countryUpdate (Request $request,$id){
        $request->validate([
            'cname' => 'required|unique:countries,name,'.$id,
        ]);
        $country = Country::where('id', $id)->update(['name' => $request->cname]);
        if ($country) {
            return redirect('jpanel/location/country')->with('success', 'Country has been updated!');
        } else {
            return redirect('jpanel/location/country/edit/'.$id)->with('error', 'Something went wrong. Try again.');
        }
    }

    public function countryDelete(Request $request)
    {
        Country::find($request->id)->delete();
        return response()->json(['status'=>'success','message' => 'Country has been Deleted successfully!']);
    }

    public function countryRestore(Request $request)
    {
        Country::withTrashed()->find($request->id)->restore();
        return response()->json(['status'=>'success','message' => 'Country has been Restored successfully!']);
    }
    // ---------------------------------State-----------------------------------------------
    public function state(){
        $states = DB::table('states')->select('countries.name as countryName','states.id','states.deleted_at','states.name as stateName')->join('countries','countries.id','=','states.country')->get();
        $country = Country::all();
        return view('jpanel.location.stateList',['states' =>$states,'country'=>$country]);
    }
    public function stateStore(Request $request){
        $request->validate([
            'sname' => 'required|unique:states,name',
            'country' => 'required|not_in:Select Country',
        ]);
        $state=new State;
        $state->country=$request->country;
        $state->name=$request->sname;
        $state->save();
        if ($state) {
            return redirect('jpanel/location/state')->with('success', 'State has been created successfully!');
        } else {
            return redirect('jpanel/location/state')->with('error', 'Something went wrong. Try again.');
        }
    }
    public function stateEdit($id){
        $state = State::find($id);
        $country = Country::all();
        return view('jpanel.location.stateEdit',['state'=>$state,'country'=>$country]);
    }
    
    public function stateUpdate (Request $request,$id){
        $request->validate([
            'sname' => 'required|unique:states,name,'.$id,
            'country' => 'required|not_in:Select Country',
        ]);
        $state = State::where('id', $id)->update(['name' => $request->sname,'country'=>$request->country]);
        if ($state) {
            return redirect('jpanel/location/state')->with('success', 'State has been updated!');
        } else {
            return redirect('jpanel/location/state/edit/'.$id)->with('error', 'Something went wrong. Try again.');
        }
    }

    public function stateDelete(Request $request)
    {
        State::find($request->id)->delete();
        return response()->json(['status'=>'success','message' => 'State has been Deleted successfully!']);
    }

    public function stateRestore(Request $request)
    {
        State::withTrashed()->find($request->id)->restore();
        return response()->json(['status'=>'success','message' => 'State has been Restored successfully!']);
    }

    // ---------------------------------City-----------------------------------------------
    public function city(Request $request){
        $cities = City::withTrashed()->get();
        if ($request->ajax()) {
            $data = DB::table('cities')
                ->join('states', 'cities.state', '=', 'states.id')
                ->select('cities.id', 'cities.name','cities.deleted_at', 'states.name as state')
                ->get();
            return FacadesDataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if($row->deleted_at == null){
                        $btn = "<a href=" . route('edit.city', $row->id) . " class='text-primary' data-toggle='tooltip' data-placement='top' title='Edit'><i class='fas fa-edit'></i></a> | 
                        <a href='javascript:void(0)' data-id='$row->id' class='text-danger deleteCity' id='delete$row->id' name='delete$row->id' data-toggle='tooltip' data-placement='top' title='Trash'><i class='fas fa-trash'></i></a>
                        ";
                    }else{
                        $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="text-danger restoreCity" id="restore'.$row->id.'" name="restore'.$row->id.'" data-toggle="tooltip" data-placement="top" title="Restore"><i class="fas fa-trash-restore-alt"></i></a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $cities = DB::table('cities')->select('states.name as stateName','cities.id','cities.deleted_at','cities.name as cityName')->join('states','states.id','=','cities.state')->get();
        $states = State::all();
        return view('jpanel.location.cityList',['cities' =>$cities,'states'=>$states]);
    }
    public function cityStore(Request $request){
        $request->validate([
            'cname' => 'required|unique:cities,name',
            'state' => 'required|not_in:Select State',
        ]);
        $city=new City;
        $city->state=$request->state;
        $city->name=$request->cname;
        $city->save();
        if ($city) {
            return redirect('jpanel/location/city')->with('success', 'City has been created successfully!');
        } else {
            return redirect('jpanel/location/city')->with('error', 'Something went wrong. Try again.');
        }
    }
    public function cityEdit($id){
        $city = City::find($id);
        $states = State::all();
        return view('jpanel.location.cityEdit',['city'=>$city,'states'=>$states]);
    }
    
    public function cityUpdate (Request $request,$id){
        $request->validate([
            'cname' => 'required|unique:cities,name,'.$id,
            'state' => 'required|not_in:Select State'
        ]);
        $city = City::where('id', $id)->update(['name' => $request->cname, 'state'=>$request->state]);
        if ($city) {
            return redirect('jpanel/location/city')->with('success', 'City has been updated!');
        } else {
            return redirect('jpanel/location/city/edit/'.$id)->with('error', 'Something went wrong. Try again.');
        }
    }

    public function cityDelete(Request $request)
    {
        City::find($request->id)->delete();
        return response()->json(['status'=>'success','message' =>'City has been Deleted successfully!']);
    }

    public function cityRestore(Request $request)
    {
        City::withTrashed()->find($request->id)->restore();
        return response()->json(['status'=>'success','message' =>'City has been Restored successfully!']);
    }

    // ---------------------------------Area-----------------------------------------------
    // public function area(){
    //     $cities = City::all();
    //     $areas = Area::withTrashed()->get();
    //     return view('jpanel.location.areaList',['cities' =>$cities,'areas'=>$areas]);
    // }
    // public function areaStore(Request $request){
    //     $request->validate([
    //         'aname' => 'required|unique:areas,name',
    //         'city' => 'required|not_in:Select City'
    //     ]);
    //     $area=new Area;
    //     $area->city=$request->city;
    //     $area->name=$request->aname;
    //     $area->save();
    //     if ($area) {
    //         return redirect('jpanel/location/area')->with('success', 'Area has been created successfully!');
    //     } else {
    //         return redirect('jpanel/location/area')->with('error', 'Something went wrong. Try again.');
    //     }
    // }
    // public function areaEdit($id){
    //     $area = Area::find($id);
    //     $cities = City::all();
    //     return view('jpanel.location.areaEdit',['area'=>$area,'cities'=>$cities]);
    // }
    
    // public function areaUpdate (Request $request,$id){
    //     $request->validate([
    //         'aname' => 'required|unique:areas,name,'.$id,
    //         'city' => 'required|not_in:Select City'
    //     ]);
    //     $area = Area::where('id', $id)->update(['name' => $request->aname, 'city'=>$request->city]);
    //     if ($area) {
    //         return redirect('jpanel/location/area')->with('success', 'Area has been updated!');
    //     } else {
    //         return redirect('jpanel/location/area/edit/'.$id)->with('error', 'Something went wrong. Try again.');
    //     }
    // }

    // public function areaDelete(Request $request)
    // {
    //     Area::find($request->id)->delete();
    //     return response()->json(['status'=>'success','message' =>'Area has been Deleted successfully!']);
    // }

    // public function areaRestore(Request $request)
    // {
    //     Area::withTrashed()->find($request->id)->restore();
    //     return response()->json(['status'=>'success','message' =>'Area has been Restored successfully!']);
    // }
}
