<?php

namespace App\Http\Controllers\Jpanel;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //
    public function index(){
        $review=Review::withTrashed()->get();
        $hasPermission = hasPermission('review',2);
        if($hasPermission){
            return view('jpanel.Review.viewReview',['review'=>$review]);
        }
        else
            abort(403);
    }
    public function reviewStatus(Request $request){
        $review=Review::where('id',$request->id)->update([
            'status'=>$request->status
        ]);
        if ($review) {
            return response()->json(['status'=>'success','success'=>'Review Status has been updated Successfully!']);
        } else {
            return response()->json(['error'=>'Something went wrong. Try again.']);
        }
    }
    public function reviewCreate(){
        $hasPermission = hasPermission('review',1);
        if($hasPermission){
            return view('jpanel.Review.addReview');
        }
        else
            abort(403);
    }
    public function reviewStore(Request $request){
        $request->validate([
            'profile'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name'=>'required',
            'designation'=>'required',
            'review'=>'required',
            'rating'=>'required|numeric',
        ]);
        $image = $request->file('profile');
        $thumbnailPath = storage_path('app/public/images/review/th/');
        $mainImagePath = storage_path('app/public/images/review/');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $size_x = null;
        $size_y= 80;
        resizeImage($image,$thumbnailPath,$mainImagePath,$imageName,$size_x,$size_y);
        $review=new Review;
        $review->profile=$imageName;
        $review->name=$request->name;
        $review->designation=$request->designation;
        $review->review=$request->review;
        $review->rating=$request->rating;
        $review->created_by=Auth::id();
        $review->save();
        if ($review) {
            return redirect('jpanel/review/list')->with('success', 'Review has been created Successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Try again.');
        }
    }
    public function reviewEdit($id){
        $review=Review::find($id);
        return view('jpanel.Review.editReview',['review'=>$review]);
    }
    public function reviewUpdate($id,Request $request){
        $request->validate([
            'profile'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name'=>'required',
            'designation'=>'required',
            'review'=>'required',
            'rating'=>'required|numeric',
        ]);
        if($request->file('profile')){
            $itemDelete = Review::where('id',$id)->first();
            $thumbnailPath = storage_path('app/public/images/review/th/' . $itemDelete->profile);
            $mainImagePath = storage_path('app/public/images/review/' . $itemDelete->profile);
            if (file_exists($thumbnailPath)) {
                @unlink($thumbnailPath);
            }
            if (file_exists($mainImagePath)) {
                @unlink($mainImagePath);
            }
            $image = $request->file('profile');
            $thumbnailPath = storage_path('app/public/images/review/th/');
            $mainImagePath = storage_path('app/public/images/review/');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $size_x = null;
            $size_y= 80;
            resizeImage($image,$thumbnailPath,$mainImagePath,$imageName,$size_x,$size_y);
        }
        $review=Review::find($id);
        if($request->file('profile')){
            $review->profile=$imageName;
        }
        $review->name=$request->name;
        $review->designation=$request->designation;
        $review->review=$request->review;
        $review->rating=$request->rating;
        $review->updated_by=Auth::id();
        $review->save();
        if ($review) {
            return redirect('jpanel/review/list')->with('success', 'Review has been created Successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Try again.');
        }
    }
    public function reviewDelete($id){
        Review::where($id)->update(['deleted_by'=>Auth::id()]);
        $review=Review::find($id)->delete();
        if ($review) {
            return response()->json(['status'=>'success','success'=>'Review has been deleted Successfully!']);
        } else {
            return response()->json(['error'=>'Something went wrong. Try again.']);
        }
    }
    public function reviewRestore($id){
        Review::withTrashed()->where($id)->update(['deleted_by'=>NULL]);
        $review=Review::withTrashed()->find($id)->restore();
        if ($review) {
            return response()->json(['status'=>'success','success'=>'Review has been restored Successfully!']);
        } else {
            return response()->json(['error'=>'Something went wrong. Try again.']);
        }
    }
}
