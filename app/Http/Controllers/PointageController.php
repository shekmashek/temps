<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PointageController extends Controller
{
    //
    public function entrer(Request $request){
        $user_id = 1;
        $heure_actuel = date('H:i:s', time());
        DB::insert("insert into temps_pointage (employer_id, entree) values (".$user_id.",'".$heure_actuel."')");
        return redirect()->back();
    }

    public function sortie(Request $request){
        $user_id = 1;
        $pointage = DB::table('temps_pointage')
            ->where('employer_id', $user_id)
            ->whereDate('jour', now())
            ->get(['entree','sortie']);
        if($pointage);

        // raha efa misy sortie
        elseif($pointage[0]->sortie) return redirect()->back()->with('error','vous avez deja fait un pointage pour aujourd hui');

        $heure_actuel = date('H:i:s', time());
        DB::insert('insert into temps_pointage (employer_id, entree) values ('.$user_id.','.$heure_actuel.')');
        return redirect()->back();
    }
}
