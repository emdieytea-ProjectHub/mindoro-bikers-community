<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function get_dashboard(){
        $products = Product::all();
        return view('admin.dashboard', compact('dashboard'));
    }

    public function verify($id){
        Product::find($id)->update(['verified'=>1]);
        
        return redirect()->back()->with('success', 'Successfully Verified');
    }
}
