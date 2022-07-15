<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PointageController extends Controller
{
    public function __construct()
    {
        $this->user_id  = 1;
        $this->heure_actuel  = date('H:i:s', time());
    }

    public function valeur_pointage(){
        $pointage = DB::table('temps_pointage')
            ->where('employer_id', $this->user_id)
            ->whereDate('jour', now())
            ->get(['entree','sortie','id']);
        return $pointage;
    }

    public function entrer(Request $request){
        $valeur_pointage = $this->valeur_pointage();
        if($valeur_pointage->isEmpty()) DB::insert("insert into temps_pointage (employer_id, entree) values (".$this->user_id.",'".$this->heure_actuel."')");
        elseif($valeur_pointage->isNotEmpty())
            if($valeur_pointage[0]->entree)
                return redirect()->back()->with('error',"Vous avez déjà fait un pointage d'entrée à ".$valeur_pointage[0]->entree);
        return redirect()->back();
    }

    public function sortie(Request $request){
        $valeur_pointage = $this->valeur_pointage();
        if($valeur_pointage->isNotEmpty()){
            if($valeur_pointage[0]->sortie == null){
                DB::table('temps_pointage')
                    ->where('id', $valeur_pointage->id)
                    ->update(['sortie' => $this->heure_actuel]);
            }
            elseif($valeur_pointage[0]->sortie) return redirect()->back()->with('error',"Vous avez déjà fait un pointage d'entrée à ".$valeur_pointage[0]->sortie);
        }elseif($valeur_pointage->isEmpty()){
            $boutton = 'oublie_entree';
            $msg = 'Vous devez devez pointer votre entrée';
            return view('pointage.pointage',compact('boutton'));
        }
        return redirect()->back();
    }
}
