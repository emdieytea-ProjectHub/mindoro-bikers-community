<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function report(){
        $groups = Group::all();
        return view('admin.report', compact('groups'));
    }
}
