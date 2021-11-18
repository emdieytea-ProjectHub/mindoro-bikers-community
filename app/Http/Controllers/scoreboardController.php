<?php

namespace App\Http\Controllers;

use App\Models\Scoreboard;
use App\Models\Tournament;
use Illuminate\Http\Request;

class scoreboardController extends Controller
{
    //

    public function index(){
        $scores = Scoreboard::all();
        return view('admin.scoreboard', compact('scores'));
    }

    public function add(){
       $tournaments = Tournament::all();
        return view('admin.addscoreboard', compact('tournaments'));

    }

    public function store(Request $request){
       Scoreboard::create($request->all());
       return redirect()->back()->with('success', 'Added successfully');
    }

    public function edit($id){
        $scoreboard = Scoreboard::find($id);
        $tournaments = Tournament::all();
        return view('admin.editscoreboard', compact('scoreboard','tournaments'));
    }

    public function update(Request $request, $id){
        Scoreboard::find($id)->update($request->only('tournament_id','plate','team','time','time_interval','actual_time','rank','score'));
        return redirect()->route('admin.scoreboard')->with('success','Successfully Updated');
    }

    public function delete($id){
        Scoreboard::find($id)->delete();
        return redirect()->back()->with('success','Successfully Updated');
    }

}
