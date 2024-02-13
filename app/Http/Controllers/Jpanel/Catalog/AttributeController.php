<?php

namespace App\Http\Controllers\Jpanel\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttributeController extends Controller
{
    //
    public function index()
    {
        $hasPermission = hasPermission('attribute',2);
        if($hasPermission){
            $attributes = Attribute::all();
            return view('jpanel.catalog.attribute', compact('attributes'));
        }
        else
            abort(403);
    }

    public function create()
    {
        $hasPermission = hasPermission('attribute',1);
        if($hasPermission){
            return view('jpanel.catalog.createAttribute');
        }
        else
            abort(403);
    }

    public function store(Request $request)
    {
        $request->validate([
            'attribute_name' => 'required|unique:attributes,name',
            'slug' => 'required|unique:attributes,slug'
        ]);
        $attribute=new Attribute();
        $attribute->name=$request->attribute_name;
        $attribute->slug=$request->slug;
        $attribute->created_by=Auth::id();
        $attribute->save();
        if ($attribute) {
            return redirect('jpanel/catalog/attribute')->with('success', 'Attribute has been created successfully!');
        } else {
            return redirect('jpanel/catalog/attribute')->with('error', 'Something went wrong. Try again.');
        }
    }

    public function edit(Request $request, Attribute $attribute)
    {
        //
        $hasPermission = hasPermission('attribute',3);
        if($hasPermission){
            $id = $request->id;
            $attribute = Attribute::find($id);
            return view('jpanel.catalog.editAttribute', compact('attribute'));
        }
        else
            abort(403);
    }

    public function update(Request $request)
    {
        $request->validate([
            'attribute_name' => 'required|unique:attributes,name,'.$request->id,
            'slug' => 'required|unique:attributes,slug,'.$request->id,
        ]);
        $attribute = Attribute::where('id', $request->id)->update(['name' => $request->attribute_name, 'slug' => $request->slug,'updated_by'=>Auth::id()]);
        if ($attribute)
            return redirect('jpanel/catalog/attribute')->with('success', 'Attribute has been updated!');
        else
            return redirect('jpanel/catalog/attribute')->with('error', 'Something went wrong. Try again.');
    }

    public function destroy(Request $request, Attribute $attribute)
    {
        Attribute::where('id',$request->attribute_id)->update(['deleted_by'=>Auth::id()]);
        Attribute::find($request->attribute_id)->delete();
        return response()->json(['status'=>'success','message' => 'Attribute has been Deleted successfully!']);
    }

    public function statusUpdate(Request $request)
    {
        //
        $attribute = Attribute::find($request->attribute_id);
        $attribute->status = $request->status;
        $attribute->save();
        return response()->json(['status'=>'success','message' => 'Status has been changed successfully!']);
    }

    public function value(Request $request, Attribute $attribute)
    {
        //
        $hasPermission = hasPermission('attribute',3);
        if($hasPermission){
            $id = $request->id;
            $attribute = Attribute::find($id);
            $attributeValues = AttributeValue::where('attribute_id', $id)->get();
            return view('jpanel.catalog.valueAttribute', compact('attribute','attributeValues'));
        }
        else
            abort(403);
    }
    public function valueAdd(Request $request)
    {
        //
        $request->validate([
            'attribute_value' => 'required'
        ]);
        $attribute=new AttributeValue();
        $attribute->attribute_id=$request->id;
        $attribute->value=$request->attribute_value;
        $attribute->created_by=Auth::id();
        $attribute->save();
        if ($attribute) {
            return redirect('jpanel/catalog/attribute/value/'.$request->id)->with('success', 'Attribute Value has been Added successfully!');
        } else {
            return redirect('jpanel/catalog/attribute/add/'.$request->id)->with('error', 'Something went wrong. Try again.');
        }
    }
    public function valueDelete(Request $request, AttributeValue $attribute)
    {
        AttributeValue::where('id',$request->id)->update(['deleted_by'=>Auth::id()]);
        AttributeValue::find($request->id)->delete();
        return response()->json(['status'=>'success','message' => 'Attribute Value has been Deleted successfully!']);
    }
}
