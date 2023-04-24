<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{

	public function index()
	{
		return view('admin.login');
	}
	//
	public function login(Request $request)
	{
		$login = Auth::attempt($request->only('email', 'password'));

		if ($login) {
			if (Auth::user()->type == 1) {
				return redirect()->route('dashboard');
			} else {
				return redirect()->route('home');
			}
		} else {
			return redirect()->back()->with('error', "Invalid credentials");
		}
	}

	public function logout()
	{
		Auth::logout();
		return redirect()->route('admin.login');
	}
}
