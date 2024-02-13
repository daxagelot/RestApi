<?php

namespace App\Http\Controllers\Jpanel\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hasPermission = hasPermission('category',2);
        if($hasPermission){
            $categories = Category::all();
            return view('jpanel.catalog.category', compact('categories'));
        }
        else
            abort(403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hasPermission = hasPermission('category',1);
        if($hasPermission){
            $categories = Category::orderBy('name','asc')->get();
            return view('jpanel.catalog.createCategory', compact('categories'));
        }
        else
            abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cname' => 'required|unique:categories,name'
        ]);
        $category=new Category;
        $category->name=$request->cname;
        $category->parent_id=$request->parent_id;
        $category->created_by=Auth::id();
        $category->save();
        if ($category) {
            return redirect('jpanel/catalog/category/add')->with('success', 'Category has been created successfully!');
        } else {
            return redirect('jpanel/catalog/category/add')->with('error', 'Something went wrong. Try again.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Category $category)
    {
        //
        $hasPermission = hasPermission('category',3);
        if($hasPermission){
            $id = $request->id;
            $categories = Category::orderBy('name','asc')->get();
            $category = Category::find($id);
            return view('jpanel.catalog.editCategory', compact('categories','category'));
        }
        else
            abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'cname' => 'required|unique:categories,name,'.$request->id,
        ]);

        $category = Category::where('id', $request->id)->update(['name' => $request->cname, 'parent_id' => $request->parent_id,'updated_by'=>Auth::id()]);
        if ($category)
            return redirect('jpanel/catalog/category')->with('success', 'Category has been updated!');
        else
            return redirect('jpanel/catalog/category')->with('error', 'Something went wrong. Try again.');
    }

    //  Update Short and Long Description
    public function updateCategoryDescription(Request $request)
    {
        $request->validate([
            'shortDescription' => 'required',
            'longDescription' => 'required',
        ]);

        $category = Category::where('id', $request->id)->update(['shortDescription' => $request->shortDescription, 'longDescription' => $request->longDescription,'updated_by'=>Auth::id()]);
        if ($category)
            return redirect('jpanel/catalog/category/edit/'.$request->id)->with('success', 'Category has been updated!');
        else
            return redirect('jpanel/catalog/category/edit'.$request->id)->with('error', 'Something went wrong. Try again.');

    }

    //  Update Meta Data
    public function updateCategoryMeta(Request $request)
    {
        $request->validate([
            'metaTitle' => 'required',
        ]);

        $category = Category::where('id', $request->id)->update(['metaTitle' => $request->metaTitle, 'metaKeyword' => $request->metaKeyword,'metaDescription' => $request->metaDescription,'updated_by'=>Auth::id()]);
        if ($category)
            return redirect('jpanel/catalog/category/edit/'.$request->id)->with('success', 'Category has been updated!');
        else
            return redirect('jpanel/catalog/category/edit'.$request->id)->with('error', 'Something went wrong. Try again.');
    }

    //  Update Thumbnail  Image
    public function updateCategoryThumbnail(Request $request)
    {

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->file('avatar');
         $thumbnailPath = storage_path('app/public/images/category/th/');
         $mainImagePath = storage_path('app/public/images/category/');
         $imageName = time().'.'.$image->getClientOriginalExtension();
         $size_x = null;
         $size_y= 100;
         resizeImage($image,$thumbnailPath,$mainImagePath,$imageName,$size_x,$size_y);
        $user = Category::where('id', $request->id)->update(['thumbnailImage' => $imageName,'updated_by'=>Auth::id()]);
        if ($user) {
            return redirect('jpanel/catalog/category/edit/'.$request->id)->with('success', 'Thumbnail image has been changed!');
        } else {
            return redirect('jpanel/catalog/category/edit/'.$request->id)->with('error', 'Something went wrong. Try again.');
        }
    }

     //  Update Icon  Image
     public function updateCategoryIcon(Request $request)
     {
         $request->validate([
             'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);
         $image = $request->file('icon');
         $thumbnailPath = storage_path('app/public/images/category/icon/th/');
         $mainImagePath = storage_path('app/public/images/category/icon/');
         $imageName = time().'.'.$image->getClientOriginalExtension();
         $size_x = null;
         $size_y= 100;
         resizeImage($image,$thumbnailPath,$mainImagePath,$imageName,$size_x,$size_y);
         $user = Category::where('id', $request->id)->update(['iconImage' => $imageName,'updated_by'=>Auth::id()]);
         if ($user) {
             return redirect('jpanel/catalog/category/edit/'.$request->id)->with('success', 'Icon image has been changed!');
         } else {
             return redirect('jpanel/catalog/category/edit/'.$request->id)->with('error', 'Something went wrong. Try again.');
         }
     }

     //  Update Cover  Image
     public function updateCategoryCover(Request $request)
     {
         $request->validate([
             'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);
         $image = $request->file('cover');
         $thumbnailPath = storage_path('app/public/images/category/cover/th/');
         $mainImagePath = storage_path('app/public/images/category/cover');
         $imageName = time().'.'.$image->getClientOriginalExtension();
         $size_x = null;
         $size_y= 100;
         resizeImage($image,$thumbnailPath,$mainImagePath,$imageName,$size_x,$size_y);
         $user = Category::where('id', $request->id)->update(['coverImage' => $imageName,'updated_by'=>Auth::id()]);
         if ($user) {
             return redirect('jpanel/catalog/category/edit/'.$request->id)->with('success', 'Cover image has been changed!');
         } else {
             return redirect('jpanel/catalog/category/edit/'.$request->id)->with('error', 'Something went wrong. Try again.');
         }
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        $categories = Category::where('parent_id', $request->category_id)->get();
       $category = Category::where('id', $request->category_id)->delete();
        if ($category)
            return response()->json(['status'=>'success','message' => 'Category has been deleted successfully!','categories'=>$categories]);
        else
            return response()->json(['status'=>'error','message' => 'Something went wrong. Try again.']);
    }


    /**
     * Status update the specified resource in storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function statusUpdate(Request $request)
    {
        //
        $category = Category::find($request->category_id);
        $category->status = $request->status;
        $category->save();
        return response()->json(['status'=>'success','message' => 'Status has been changed successfully!']);
    }
    public function menuStatusUpdate(Request $request)
    {
        //
        $category = Category::find($request->category_id);
        $category->is_menu = $request->status;
        $category->save();
        $subCategory_id=Category::where('parent_id',$request->category_id)->get();
        if(!blank($subCategory_id)){
            $subCategory=Category::where('parent_id',$request->category_id)->update([
                'is_menu'=>$request->status
            ]);
            foreach($subCategory_id as $SubCategory_id) { 
                Category::where('parent_id',$SubCategory_id->id)->update([
                    'is_menu'=>$request->status
                ]);
            }
        }
        return response()->json(['status'=>'success','message' => 'Status has been changed successfully!']);
    }
}
