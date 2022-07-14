<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PointageController extends Controller
{
    //
    public function entre(Request $request){
        DB::insert('insert into temps_pointage values employer_id(1)');
        return redirect()->back();
    }
}
