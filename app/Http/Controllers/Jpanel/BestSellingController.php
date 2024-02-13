<?php

namespace App\Http\Controllers\Jpanel;

use App\Http\Controllers\Controller;
use App\Models\Bestselling;
use App\Models\Product;
use Illuminate\Http\Request;

class BestSellingController extends Controller
{
    public function index(){
        $bestSelling=Bestselling::withTrashed()->get();
        $products=Product::all();
        $hasPermission = hasPermission('bestselling',2);
        if($hasPermission){
            return view('jpanel.Bestselling.viewBestselling',['bestSelling'=>$bestSelling,'products'=>$products]);
        }
        else
            abort(403);
    }
    public function BestsellingStatus(Request $request){
        $bestselling=Bestselling::where('id',$request->id)->update([
            'status'=>$request->status
        ]);
        if ($bestselling) {
            return response()->json(['status'=>'success','success'=>'Bestselling Status has been updated Successfully!']);
        } else {
            return response()->json(['error'=>'Something went wrong. Try again.']);
        }
    }
    public function BestsellingStore(Request $request){
        $request->validate([
            'product'=>'required|unique:Bestsellings,product_id',
        ]);
        $bestselling=new Bestselling;
        $bestselling->product_id=$request->product;
        $bestselling->save();
        if ($bestselling) {
            return redirect('jpanel/bestSelling/list')->with('success', 'Bestselling has been created Successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Try again.');
        }
    }
    public function BestsellingEdit($id){
        $bestSelling=Bestselling::find($id);
        $products=Product::all();
        return view('jpanel.Bestselling.editBestselling',['bestSelling'=>$bestSelling,'products'=>$products]);
    }
    public function BestsellingUpdate($id,Request $request){
        $request->validate([
            'product'=>'required|unique:Bestsellings,product_id,'.$id,
        ]);
        $bestselling=Bestselling::find($id);
        $bestselling->product_id=$request->product;
        $bestselling->save();
        if ($bestselling) {
            return redirect('jpanel/bestSelling/list')->with('success', 'Bestselling has been updated Successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Try again.');
        }
    }
    public function BestsellingDelete($id){
        $bestselling=Bestselling::find($id)->delete();
        if ($bestselling) {
            return response()->json(['status'=>'success','success'=>'Bestselling has been deleted Successfully!']);
        } else {
            return response()->json(['error'=>'Something went wrong. Try again.']);
        }
    }
    public function BestsellingRestore($id){
        $bestselling=Bestselling::withTrashed()->find($id)->restore();
        if ($bestselling) {
            return response()->json(['status'=>'success','success'=>'Bestselling has been restored Successfully!']);
        } else {
            return response()->json(['error'=>'Something went wrong. Try again.']);
        }
    }
}
