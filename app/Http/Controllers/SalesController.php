<?php

namespace App\Http\Controllers;

use App\Models\Soldproduct;
use Illuminate\Http\Request;

class SalesController extends Controller
{
	public function sales()
	{
		$soldproducts = Soldproduct::all();

		return view('admin.sales', compact('soldproducts'));
	}
}
