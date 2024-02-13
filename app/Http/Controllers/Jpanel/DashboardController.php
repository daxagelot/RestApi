<?php

namespace App\Http\Controllers\Jpanel;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Module;
use App\Models\Language;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index(){
        // $categories=Category::all()->count();
        // $products=Product::all()->count();
        return view('jpanel.dashboard');
        // return view('jpanel.dashboard',['categories'=>$categories,'products'=>$products]);
    }
    public function adminSettings(){
        $totalModule = Module::all()->count();
        $totalRole = Role::all()->count();
        $totalUser = User::where('isAdminUser','1')->count();
        $totalLanguage = Language::all()->count();
        return view('jpanel.adminSettings',['totalModule'=>$totalModule,'totalLanguage'=>$totalLanguage,'totalRole'=>$totalRole,'totalUser'=>$totalUser]);
    }
    public function dashboard(){
       
    }
    
}
