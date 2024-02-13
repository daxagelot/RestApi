<?php

namespace App\Http\Controllers\JPanel\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Featuredproduct;
use App\Models\Product;
use App\Models\Productattribute;
use App\Models\Productimage;
use App\Models\Topranking;
use App\Models\Vendorcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class ProductController extends Controller
{
    //list of product
    public function index(Request $request){
        $hasPermission = hasPermission('product',2);
        if($hasPermission){
            if ($request->ajax()) {
                $data = Product::where('user_id',Auth::id())->get();
                return FacadesDataTables::of($data)->addIndexColumn()
                    ->addColumn('category', function ($row) {
                        return $row->ProductCategory->name;
                    })
                    ->addColumn('status', function ($row) {
                        $btn = '<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success"><input data-id="'.$row->id.'" type="checkbox" class="custom-control-input productStatus" id="status'.$row->id.'" name="status'.$row->id.'" '.($row->status ? "checked" : "").'><label class="custom-control-label" for="status'.$row->id.'"></label></div>';
                        return $btn;
                    })
                    ->addColumn('action', function ($row) {
                        $btn='<a href="'.route('uploads.product',$row->id).'" class="text-primary" data-toggle="tooltip" data-placement="top" title="Upload"><i class="fas fa-upload"></i></a> | <a href="'.route('edit.product',$row->id).'" class="text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a> | <a href="'.route('attribute.product',$row->id).'" class="text-primary" data-toggle="tooltip" data-placement="top" title="Attributes"><i class="fas fa-cubes"></i></a> | <a href="javascript:void(0)" data-id="'.$row->id.'" class="text-danger deleteProduct" id="delete'.$row->id.'" name="delete'.$row->id.'" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fas fa-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['category','status','action'])
                    ->make(true);
            }
            return view('jpanel.Product.viewProduct');
        }
        else
            abort(403);
    }
    // details of Product
    public function productDetails($id){
        $product = Product::find($id);
        $productImage = Productimage::where('product_id',$id)->get();
        return view('jpanel.Product.detailsProduct',['product'=>$product,'productImage'=>$productImage]);
    }
    // add product
    public function productAdd(){
        $hasPermission = hasPermission('product',1);
        if($hasPermission){
            $categories=Category::all();
            return view('jpanel.Product.addProduct',['categories'=>$categories]);
        }
        else
            abort(403);
    }
    public function productStore(Request $request){
        //json for specification
        $title=$request->title;
        $value=$request->value;
        $specificationJson='';
        $specificationArray=[];
        if(!blank($title)){
            for($j = 0; $j< count($title);$j++){
                $specificationArray[]='{"no":"'.($j+1).'","title":"'.$title[$j].'","value":"'.$value[$j].'"}';
            }//making array to json
            $specificationJson='{"specs":['.implode(',',$specificationArray).']}'; // making format 
        }
        $product=new Product;
        $product->user_id=Auth::id();
        $product->name=$request->name;
        $product->price=$request->price;
        $product->categories_id =$request->category;
        $product->specification=$specificationJson;
        $product->short_desc=$request->short_desc;
        $product->long_desc=$request->long_desc;
        $product->m_title=$request->mTitle;
        $product->m_keyword=$request->mKeyword;
        $product->m_desc=$request->mDesc;
        $product->created_by=Auth::id();
        $product->save();
        if($product){
            $image= $request->file('image');
            if(!blank($image)){
                for ($i = 0; $i < count($image); $i++) {
                    $thumbnailPath = storage_path('app/public/images/product/th/');
                    $mainImagePath = storage_path('app/public/images/product/');
                    $imageName = time().($i+1).'.'.$image[$i]->getClientOriginalExtension();
                    $size_x = null;
                    $size_y= 80;
                    resizeImage($image[$i],$thumbnailPath,$mainImagePath,$imageName,$size_x,$size_y);
                    $productImage=new Productimage;
                    $productImage->user_id=Auth::id();
                    $productImage->product_id=$product->id;
                    $productImage->image=$imageName;
                    $productImage->imageorder=$i+1;
                    $productImage->created_by=Auth::id();
                    $productImage->save();
                }
                if ($productImage) {
                    return redirect()->route('list.product')->with('success', 'Product has been Added successfully!');
                } else {
                    return redirect()->back()->with('error', 'Something went wrong. Try again.');
                }
            }else {
                return redirect()->back()->with('error', 'Something went wrong. Try again.');
            }
        }
        else {
            return redirect()->back()->with('error', 'Something went wrong. Try again.');
        }
    }
    // status of product
    public function productStatus(Request $request){
        $product=Product::where('id',$request->id)->update([
            'status'=>$request->status
        ]);
        return response()->json(['status'=>'success']);
    }
    // update product
    public function productEdit($id){
        $product=Product::find($id);
        $categories=Category::all();
        return view('jpanel.Product.editProduct',['product'=>$product,'categories'=>$categories]);
    }
    public function productUpdate($id,Request $request){
        //json for specification
        $title=$request->title;
        $value=$request->value;
        $specificationJson='';
        $specificationArray=[];
        if(!blank($title)){
            for($j = 0; $j< count($title);$j++){
                $specificationArray[]='{"no":"'.($j+1).'","title":"'.$title[$j].'","value":"'.$value[$j].'"}';
            }//making array to json
            $specificationJson='{"specs":['.implode(',',$specificationArray).']}'; // making format 
        }
        $product=Product::find($id);
        $product->name=$request->name;
        $product->price=$request->price;
        $product->categories_id =$request->category;
        $product->specification=$specificationJson;
        $product->short_desc=$request->short_desc;
        $product->long_desc=$request->long_desc;
        $product->m_title=$request->mTitle;
        $product->m_keyword=$request->mKeyword;
        $product->m_desc=$request->mDesc;
        $product->updated_by=Auth::id();
        $product->save();
        if($product){
            return redirect('jpanel/product/list')->with('success', 'Product has been Updated successfully!');
        }
        else {
            return redirect('jpanel/product/add')->with('error', 'Something went wrong. Try again.');
        }
    }
    //delete product
    public function productDelete($id){
        Product::where('id',$id)->update(['deleted_by'=>Auth::id()]);
        $product = Product::find($id);
        $product->delete();
        $image = Productimage::where('product_id',$id)->delete();
        return response()->json(['status'=>'success','message'=>"Product has been Deleted Successfully!"]);
    }
    //product attribute
    public function productAttribute($id){
        $product=Product::find($id);
        $attributes=Attribute::all();
        $product_attributes=Productattribute::where('product_id',$id)->get();
        return view('jpanel.Product.attributeProduct',['attributes'=>$attributes,'product_attributes'=>$product_attributes,'product'=>$product]);
    }
    public function productAttributeValue(Request $request){
        $AttrValue=AttributeValue::where('attribute_id',$request->id)->get();
        return response()->json(['AttrValue'=>$AttrValue]);
    }
    public function productAttributeStore(Request $request){
        $request->validate([
            'attribute_id'=>'required',
            'attribute_value_id'=>'required|not_in:Select Attribute Value|unique:productattributes,attribute_value_id'
        ]);
        $product_attributes=new Productattribute;
        $product_attributes->user_id=Auth::id();
        $product_attributes->product_id=$request->product_id;
        $product_attributes->attribute_id=$request->attribute_id;
        $product_attributes->attribute_value_id=$request->attribute_value_id;
        $product_attributes->created_by=Auth::id();
        $product_attributes->save();
        if ($product_attributes) {
            return redirect('jpanel/product/attribute/'.$request->product_id)->with('success', 'Product Attribute has been saved successfully!');
        } else {
            return redirect('jpanel/product/attribute/'.$request->product_id)->with('error', 'Something went wrong. Try again.');
        }
    }
    //delete attribute product
    public function productAttributeDelete($id){
        $product = Productattribute::find($id);
        $product->delete();
        return response()->json(['status'=>'success','message'=>"Product Attribute has been Deleted Successfully!"]);
    }
    //UPLOAD PRODUCT
    public function uploads($id)
    {
        $hasPermission = hasPermission('product', 2);
        if ($hasPermission) {
            $images = Productimage::where('product_id', $id)->get();
            return view('jpanel.Product.imagesProduct', compact('images', 'id'));
        } else {
            abort(403);
        }
    }
    public function storeImage(Request $request){
        $request->validate([
            'productImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->file('productImage');
        $thumbnailPath = storage_path('app/public/images/product/th/');
        $mainImagePath = storage_path('app/public/images/product/');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $size_x = null;
        $size_y = 80;
        resizeImage($image, $thumbnailPath, $mainImagePath, $imageName, $size_x, $size_y);
        $orderImage = new Productimage();
        $orderImage->user_id = Auth::id();
        $orderImage->product_id = $request->productId;
        $orderImage->image = $imageName;
        $orderImage->created_by=Auth::id();
        $orderImage->save();
        return redirect()->back()->with('success','Product has been uploaded Successfully!');
    }
    //IMAGE ORDER
    public function imageOrder(Request $request)
    {
        $product = Productimage::find($request->id);
        $order_check = Productimage::where('product_id', $request->product_id)
            ->where('imageorder', $request->orderNo)
            ->get()
            ->first();
        if ($order_check){
            return response()->json(['error' =>'This order is already allocated to another image !']);
        } else {
            $product->imageorder = $request->orderNo;
            $product->save();
            return response()->json(['success' =>'Order image has been Updated successfully!']);
        }
    }
    //DELETE IMAGE
    public function imageDelete($id)
    {
        $itemDelete = Productimage::where('id', '=', $id)
            ->get()
            ->first();
        $thumbnailPath = storage_path('app/public/images/product/th/' . $itemDelete->image_name);
        $mainImagePath = storage_path('app/public/images/product/' . $itemDelete->image_name);
        if (file_exists($thumbnailPath)) {
            @unlink($thumbnailPath);
        }
        if (file_exists($mainImagePath)) {
            @unlink($mainImagePath);
        }
        $product_image_delete = Productimage::where('id', '=', $id);
        if (!is_null($product_image_delete)) {
            $product_image_delete->delete();
        }
        return redirect()->back()->with('success','Product image has been deleted Successfully!');
    }
}
