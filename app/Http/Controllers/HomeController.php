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

        // raha tsy mbola misy pointage dia miditra anaty accueil avec boutton entrer
        if($pointage->isEmpty())$boutton = 'entrée';

        // raha efa misy pointage
        elseif($pointage->isNotEmpty()){
            // fa mbola tsisy sortie
            if($pointage[0]->sortie==null)$boutton = 'sortie';

            // raha efa misy sortie
            elseif($pointage[0]->sortie)$boutton = 'terminé';
        }
        return view('pointage.pointage',compact('boutton'));
    }
}
