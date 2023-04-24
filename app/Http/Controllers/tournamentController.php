<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Illuminate\Http\Request;

class tournamentController extends Controller
{
    //
    public function index(){
        $tournaments = Tournament::all();
        return view('admin.tournament', compact('tournaments'));
    }

    public function add(){

        return view('admin.addtournament');

    }

    public function store(Request $request){
       Tournament::create($request->all());
       return redirect()->back()->with('success', 'Added successfully');
    }

    public function edit($id){
        $tournament = Tournament::find($id);
        return view('admin.edittournament', compact('tournament'));
    }

    public function update(Request $request, $id){
        Tournament::find($id)->update($request->only('name','city','t_date','kick_off','route_name','start','end'));
        return redirect()->route('admin.tournament')->with('success','Successfully Updated');
    }

    public function delete($id){
        Tournament::find($id)->delete();
        return redirect()->back()->with('success','Successfully Updated');
    }


}
