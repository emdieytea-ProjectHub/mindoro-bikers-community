<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    //
    public function index(){
        $users = User::where('type', '1')->get(); // where('id', '<>', auth()->user()->id)
        return view('admin.users', compact('users'));
    }

    public function add(){
        
        return view('admin.adduser');
    }

     public function store(Request $request){
        $password = Hash::make($request->password);
        User::create([
            'avatar' => 'dist/images/resources/avatar.png',
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => $password,
            'type' => '1'
        ]);
        
        return redirect()->back()->with('success', "Successfully Added");
     }

      public function delete($id){
          if ($id == auth()->user()->id) {
            return redirect()->back()->with('error', 'Logged in user can\'t delete his/her own account.');
          }
          User::find($id)->delete();
          return redirect()->back()->with('success', 'Successfully Deleted');
      }

      public function edit($id){
        $user = User::find($id);
        return view('admin.edituser', compact('user'));
    }

    public function update(Request $request, $id){
        User::find($id)->update($request->only('fname','lnanme','email'));
        return redirect()->route('admin.users')->with('success', 'Successfully Updated');
    }
}
