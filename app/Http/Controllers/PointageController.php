<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PointageController extends Controller
{
    //
    public function entrer(Request $request){
        DB::insert('insert into temps_pointage (employer_id) values (1)');
        return redirect()->back();
    }
}
