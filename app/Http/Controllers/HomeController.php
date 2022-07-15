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
            ->get(['entree','sortie']);
            // dd($pointage);
        if($pointage->isEmpty()){
            // raha tsy mbola misy pointage dia miditra anaty accueil avec boutton entrer
            $boutton = 'entrer';
            return view('pointage.pointage',compact('boutton'));
        }elseif($pointage->isNotEmpty()){
            // raha efa misy pointage fa mbola tsisy sortie
            if($pointage[0]->sortie==null) {
                $boutton = 'sortie';
                return view('pointage.pointage',compact('boutton'));
            }
            // raha efa misy sortie
            elseif($pointage[0]->sortie){
                $msg = 'Vous avez deja fait tous les pointages pour aujourd hui. À demain!';
                return view('pointage.pointage',compact('msg'));
            }
        }
    }
}
