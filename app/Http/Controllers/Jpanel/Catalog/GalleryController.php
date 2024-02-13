<?php

namespace App\Http\Controllers\Jpanel\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Image;


class GalleryController extends Controller
{
    public function index()
    {
        // $hasPermission = hasPermission('gallery',2);
        // if($hasPermission){
            $galleries = Gallery::all();
            return view('jpanel.catalog.gallery', compact('galleries'));
        // }
        // else
        //     abort(403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $hasPermission = hasPermission('category',1);
        // if($hasPermission){
            $categories = Category::orderBy('name','asc')->get();
            return view('jpanel.catalog.createGallery', compact('categories'));
    //     }
    //     else
    //         abort(403);
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
        'name' => 'required|unique:galleries,name',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'category_id' => 'required',
    ]);

    $gallery = new Gallery;
    $gallery->name = $request->name;
    $gallery->category_id = $request->category_id;
    $gallery->created_by = Auth::id();

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Store the image in the storage/app/public/gallery_images folder
        $imagePath = $image->storeAs('public/gallery_images', $imageName);

        // Save the full path to the image in the database
        $gallery->image = $imagePath;
    }

    $gallery->save();

    if ($gallery) {
        return redirect('jpanel/catalog/gallery/add')->with('success', 'Gallery has been created successfully!');
    } else {
        return redirect('jpanel/catalog/gallery/add')->with('error', 'Something went wrong. Try again.');
    }
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $category
     * @return \Illuminate\Http\Response
     */
   
     public function edit($id)
     {
         $categories = Gallery::get()->all();
         $gallery = Gallery::find($id);
         return view('jpanel.catalog.editGallery', compact('gallery', 'categories'));
     }
 
     public function update(Request $request, Gallery $gallery)
     {
         // Validate the request data
        //  $request->validate([
        //      'name' => 'required|unique:galleries,name,' . $gallery->id,
        //      'category_id' => 'required',
        //      'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        //  ]);
     
         // Update other fields
         $gallery->name = $request->name;
         $gallery->category_id = $request->category_id;
         $gallery->updated_by = Auth::id();
     
         // Handle image update
         if ($request->hasFile('image')) {
             // Delete the existing image if it exists
             if ($gallery->image) {
                 Storage::delete($gallery->image);
             }
     
             $image = $request->file('image');
             $imageName = time() . '.' . $image->getClientOriginalExtension();
             $imagePath = 'gallery_images/' . $imageName;
     
             // Store the new image in the storage folder
             Storage::put($imagePath, file_get_contents($image));
     
             $gallery->image = $imagePath;
         }
     
         // Save the changes
         $gallery->update();
     
         return redirect('jpanel/catalog/gallery')->with('success', 'Gallery has been updated!');
     }
     
     //  Update Thumbnail  Image
    public function updateGalleryThumbnail(Request $request)
    {

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->file('avatar');
         $thumbnailPath = storage_path('app/public/images/gallery/th/');
         $mainImagePath = storage_path('app/public/images/gallery/');
         $imageName = time().'.'.$image->getClientOriginalExtension();
         $size_x = null;
         $size_y= 100;
         resizeImage($image,$thumbnailPath,$mainImagePath,$imageName,$size_x,$size_y);
        $user = Gallery::where('id', $request->id)->update(['thumbnailImage' => $imageName,'updated_by'=>Auth::id()]);
        if ($user) {
            return redirect('jpanel/catalog/gallery/edit/'.$request->id)->with('success', 'Thumbnail image has been changed!');
        } else {
            return redirect('jpanel/catalog/gallery/edit/'.$request->id)->with('error', 'Something went wrong. Try again.');
        }
    }

     //  Update Icon  Image
     public function updateGalleryIcon(Request $request)
     {
         $request->validate([
             'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);
         $image = $request->file('icon');
         $thumbnailPath = storage_path('app/public/images/gallery/icon/th/');
         $mainImagePath = storage_path('app/public/images/gallery/icon/');
         $imageName = time().'.'.$image->getClientOriginalExtension();
         $size_x = null;
         $size_y= 100;
         resizeImage($image,$thumbnailPath,$mainImagePath,$imageName,$size_x,$size_y);
         $user = Gallery::where('id', $request->id)->update(['iconImage' => $imageName,'updated_by'=>Auth::id()]);
         if ($user) {
             return redirect('jpanel/catalog/gallery/edit/'.$request->id)->with('success', 'Icon image has been changed!');
         } else {
             return redirect('jpanel/catalog/gallery/edit/'.$request->id)->with('error', 'Something went wrong. Try again.');
         }
     }

     //  Update Cover  Image
     public function updateGalleryCover(Request $request)
     {
         $request->validate([
             'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);
         $image = $request->file('cover');
         $thumbnailPath = storage_path('app/public/images/gallery/cover/th/');
         $mainImagePath = storage_path('app/public/images/gallery/cover');
         $imageName = time().'.'.$image->getClientOriginalExtension();
         $size_x = null;
         $size_y= 100;
         resizeImage($image,$thumbnailPath,$mainImagePath,$imageName,$size_x,$size_y);
         $user = Gallery::where('id', $request->id)->update(['coverImage' => $imageName,'updated_by'=>Auth::id()]);
         if ($user) {
             return redirect('jpanel/catalog/gallery/edit/'.$request->id)->with('success', 'Cover image has been changed!');
         } else {
             return redirect('jpanel/catalog/gallery/edit/'.$request->id)->with('error', 'Something went wrong. Try again.');
         }
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
{
    $id = $request->input('id');

    // Assuming you have a Gallery model
    $gallery = Gallery::find($id);

    if (!$gallery) {
        return response()->json(['status' => 'error', 'message' => 'Gallery not found']);
    }

    // Your deletion logic
    $gallery->delete();

    return response()->json(['status' => 'success', 'message' => 'Gallery deleted successfully']);
}


    /**
     * Status update the specified resource in storage.
     *
     * @param  \App\Models\Gallery  $category
     * @return \Illuminate\Http\Response
     */
    public function statusUpdate(Request $request)
    {
        //
        $gallery = Gallery::find($request->category_id);
        $gallery->status = $request->status;
        $gallery->save();
        return response()->json(['status'=>'success','message' => 'Status has been changed successfully!']);
    }
  
}
