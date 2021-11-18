<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
	public function registerPage()
	{
		return view('users.register');
	}

	public function register(Request $request)
	{
		$mobilePattern = "/^(09|\+639)\d{9}$/";

		$numOk = preg_match($mobilePattern, $request->phone);

		if (!$numOk) {
			return redirect()->back()->with('error', 'Invalid mobile number');
		} else if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
			return redirect()->back()->with('error', 'Invalid email address');
		} else {
			$user = User::create([
				'avatar' => "dist/images/resources/avatar.png",
				'fname' => $request->fname,
				'lname' => $request->lname,
				'email' => $request->email,
				'phone' => $request->phone,
				'gender' => $request->gender,
				'type' => '2',
				'password' => Hash::make($request->password)
			]);

			return redirect()->back()->with('success', 'Registered Successfully. You can now Login');
		}
	}

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
			return redirect()->back()->with('error', "Invalid Email or Password");
		}
	}

	public function loginPage()
	{
		return view('users.login');
	}

	public function profile()
	{
		return view('users.profile');
	}

	public function updateprofile(Request $request)
	{
		User::find(Auth::id())->update($request->only('fname', 'lname', 'email', 'phone'));
		return redirect()->back()->with('success', 'Updated Success');
	}

	public function logout()
	{
		Auth::logout();
		return redirect()->route('login')->with('success', 'Logged out successfully');
	}

	public function updateavatar(Request $request)
	{
		try {
			$user = User::find(Auth::id());
			$user->avatar = 'files/' . time() . '.' . $request->AvatarFile->extension();
			$request->AvatarFile->move(public_path('files'), $user->avatar);
			$user->save();

			return redirect()->back()->with('ca-success', 'Avatar updated success');
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}
}
