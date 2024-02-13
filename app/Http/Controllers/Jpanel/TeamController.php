<?php

namespace App\Http\Controllers\Jpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


use Image;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $teams = Team::all();

        return view('jpanel.team.index',compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jpanel.team.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required|unique:teams,name',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
            'title' => 'required',

        ]);
    
        $gallery = new Team;
        $gallery->name = $request->name;
        $gallery->title = $request->title;
        $gallery->description = $request->description;
        // $gallery->created_by = Auth::id();
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
    
            // Store the image in the storage/app/public/gallery_images folder
            $imagePath = $image->storeAs('public/team_images', $imageName);
    
            // Save the full path to the image in the database
            $gallery->image = $imagePath;
        }
    
        $gallery->save();
    
        if ($gallery) {
            return redirect()->route('team.index')->with('success', 'Team has been created successfully!');
        } else {
            return redirect()->route('team.index')->with('error', 'Something went wrong. Try again.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = Team::find($id);
        return view('jpanel.team.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        // Validate the request data
   
    
        // Update other fields
        $team->name = $request->name;
        $team->title = $request->title;
        $team->description = $request->description;

        $team->updated_by = Auth::id();
    
        // Handle image update
        if ($request->hasFile('image')) {
            // Delete the existing image if it exists
            if ($team->image) {
                Storage::delete($team->image);
            }
    
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'team_images/' . $imageName;
    
            // Store the new image in the storage folder
            Storage::put($imagePath, file_get_contents($image));
    
            $team->image = $imagePath;
        }
    
        // Save the changes
        $team->update();

        return redirect()->route('team.index')->with('success', 'Teamhas been updated!');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
