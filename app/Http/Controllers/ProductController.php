<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function get_products(){
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    public function verify($id){
        Product::find($id)->update(['verified'=>1]);

        return redirect()->back()->with('success', 'Successfully Verified');
    }
}
