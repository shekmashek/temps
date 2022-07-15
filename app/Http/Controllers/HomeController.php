<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $user_id = 1;
        $pointage = DB::table('temps_pointage')
            ->where('employer_id', $user_id)
            ->whereDate('jour', now())
            ->get();
        if($pointage->isNotEmpty()){
            if($pointage[0]->sortie==null) {
                $boutton = 'sortie';
                return view('pointage.pointage',compact('boutton'));
            }
            elseif($pointage[0]->sortie) return redirect()->back()->with('error','vous avez deja fait un pointage pour aujourdhui');
        }elseif($pointage[0]->isEmpty()){
            $boutton = 'entrer';
            return view('pointage.pointage',compact('boutton'));
        }
    }
}
