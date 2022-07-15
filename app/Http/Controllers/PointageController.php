<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PointageController extends Controller
{
    public function __construct()
    {
        $this->user_id  = 1;
        $this->heure_actuel  = date('H:i:s', time());
    }

    public function valeur_pointage_maintenant(){
        $pointage = DB::table('temps_pointage')
            ->where('employer_id', $this->user_id)
            ->whereDate('jour', now())
            ->get(['entree','sortie','id']);
        return $pointage;
    }

    public function valeur_pointage_hier(){
        $pointage = DB::table('temps_pointage')
            ->where('employer_id', $this->user_id)
            ->whereDate('jour', Carbon::yesterday())
            ->get(['entree','sortie','id']);
        return $pointage;
    }

    public function entrer(Request $request){
        $valeur_pointage = $this->valeur_pointage_maintenant();
        $valeur_pointage_hier = $this->valeur_pointage_hier();
        // rehefa vao tonga izy dia mijery hoe nisy pointage sortie adino ve omaly
        if($valeur_pointage_hier->isNotEmpty()){
            if(($valeur_pointage_hier[0]->entree and $valeur_pointage_hier[0]->sortie == null)){
                $boutton = 'oublie_sortie';
                $pointage_id = $valeur_pointage_hier[0]->id;
                return view('pointage.pointage',compact('boutton','pointage_id'));
            }
        }
        // rehefa tsisy adino omaly dia mijery hoe mbola tsisy pointage androany dia mampiditra
        elseif($valeur_pointage->isEmpty()) {
            DB::insert("insert into temps_pointage (employer_id, entree) values (".$this->user_id.",'".$this->heure_actuel."')");
            return redirect()->back();
        }
        // raha efa nisy pointage androany
        elseif($valeur_pointage->isNotEmpty())
            if($valeur_pointage[0]->entree)
                return redirect()->back()->with('error',"Vous avez déjà fait un pointage d'entrée à ".$valeur_pointage[0]->entree);
    }

    public function sortie(Request $request){
        $valeur_pointage = $this->valeur_pointage_maintenant();

        // raha efa nanao pointage entréeizy androany
        if($valeur_pointage->isNotEmpty()){
            // nefa mbola tsy nanao pointage entrée
            if($valeur_pointage[0]->entree == null){
                $pointage_id = $valeur_pointage[0]->id;
                $boutton = 'oublie_entree';
                return view('pointage.pointage',compact('boutton','pointage_id'));
            }
            // raha mbola tsy nanao pointage sortie
            if($valeur_pointage[0]->sortie == null){
                DB::table('temps_pointage')
                    ->where('id', $valeur_pointage[0]->id)
                    ->update(['sortie' => $this->heure_actuel]);
                return redirect()->back();
            }
            // raha efa nanao pointage sortie
            elseif($valeur_pointage[0]->sortie) return redirect()->back()->with('error',"Vous avez déjà fait un pointage d'entrée à ".$valeur_pointage[0]->sortie);

        // raha nanadino ny entrée androany izy
        }elseif($valeur_pointage->isEmpty()){
            $pointage_id = $valeur_pointage[0]->id;
            $boutton = 'oublie_entree';
            return view('pointage.pointage',compact('boutton','pointage_id'));
        }
    }

    public function update_entrer(Request $request){
        $valeur_pointage = $this->valeur_pointage_maintenant();
        if($valeur_pointage->isEmpty()) {
            DB::insert("insert into temps_pointage (employer_id, entree) values (".$this->user_id.",'".$this->heure_actuel."')");
            return redirect()->back();
        }
        elseif($valeur_pointage->isNotEmpty())
            if($valeur_pointage[0]->entree)
                return redirect()->back()->with('error',"Vous avez déjà fait un pointage d'entrée à ".$valeur_pointage[0]->entree);
        elseif($valeur_pointage->isEmpty()){
            $boutton = 'oublie_sortie';
            return view('pointage.pointage',compact('boutton'));
        }
    }

    public function update_sortie(Request $request){
        $valeur_pointage = $this->valeur_pointage_maintenant();
        if($valeur_pointage->isNotEmpty()){
            if($valeur_pointage[0]->sortie == null){
                DB::table('temps_pointage')
                    ->where('id', $valeur_pointage[0]->id)
                    ->update(['sortie' => $this->heure_actuel]);
                return redirect()->back();
            }
            elseif($valeur_pointage[0]->sortie) return redirect()->back()->with('error',"Vous avez déjà fait un pointage d'entrée à ".$valeur_pointage[0]->sortie);
        }elseif($valeur_pointage->isEmpty()){
            $boutton = 'oublie_entree';
            return view('pointage.pointage',compact('boutton'));
        }
    }
}
