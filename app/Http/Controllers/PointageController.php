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

    public function valeur_pointage_cette_semaine($lundi, $dimanche){
        $pointage = DB::table('temps_pointage')
            ->where('employer_id', $this->user_id)
            ->whereBetween('jour', [$lundi, $dimanche])
            ->get('id');
        return $pointage;
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
            ->get(['entree','sortie','id','heure_pause']);
        return $pointage;
    }

    public function entrer(Request $request){
        $valeur_pointage = $this->valeur_pointage_maintenant();
        $valeur_pointage_hier = $this->valeur_pointage_hier();
        // rehefa vao tonga izy dia mijery hoe nisy pointage sortie adino ve omaly
        if($valeur_pointage_hier->isNotEmpty()){
            if(($valeur_pointage_hier[0]->entree and $valeur_pointage_hier[0]->sortie == null)){
                // sady mampiditra entrée no manao redirect modification sortie omaly
                if($valeur_pointage->isEmpty()) {
                    DB::insert("insert into temps_pointage (employer_id, entree) values (".$this->user_id.",'".$this->heure_actuel."')");
                }
                $boutton = 'oublie_sortie';
                $pointage_id = $valeur_pointage_hier[0]->id;
                $pause_hier = $valeur_pointage_hier[0]->heure_pause;
                return view('pointage.pointage',compact('boutton','pointage_id','pause_hier'));
            }
            elseif(($valeur_pointage_hier[0]->entree and $valeur_pointage_hier[0]->sortie)){
                // rehefa tsisy adino omaly dia mijery hoe mbola tsisy pointage androany dia mampiditra
                if($valeur_pointage->isEmpty()) {
                    DB::insert("insert into temps_pointage (employer_id, entree) values (".$this->user_id.",'".$this->heure_actuel."')");
                    return redirect()->back();
                }
                // raha efa nisy pointage androany
                elseif($valeur_pointage->isNotEmpty())
                    if($valeur_pointage[0]->entree){
                        return redirect()->back()->with('error',"Vous avez déjà fait un pointage d'entrée à ".$valeur_pointage[0]->entree);
                    }
            }
        }
        elseif($valeur_pointage_hier->isEmpty()){
            // rehefa tsisy adino omaly dia mijery hoe mbola tsisy pointage androany dia mampiditra
            if($valeur_pointage->isEmpty()) {
                DB::insert("insert into temps_pointage (employer_id, entree) values (".$this->user_id.",'".$this->heure_actuel."')");
                return redirect()->back();
            }
            // raha efa nisy pointage androany
            elseif($valeur_pointage->isNotEmpty())
                if($valeur_pointage[0]->entree){
                    return redirect()->back()->with('error',"Vous avez déjà fait un pointage d'entrée à ".$valeur_pointage[0]->entree);
                }
        }
    }

    public function sortie(Request $request){
        $valeur_pointage = $this->valeur_pointage_maintenant();
        if($request->heure_pause==null)return redirect()->back()->with('error',"Vous devez ajouter votre heure de pause.");
        if($request->heure_pause<0)return redirect()->back()->with('error',"Votre heure de pause doit etre superieur à 0.");
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
                    ->update(['sortie' => $this->heure_actuel, 'heure_pause' => $request->heure_pause]);
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
        DB::table('temps_pointage')
            ->where('id', $request->pointage_id)
            ->update(['entree' => $request->modif_entree]);
        return redirect('/home');
    }

    public function update_sortie(Request $request){
        if($request->heure_pause==null)return redirect()->back()->with('error',"Vous devez ajouter votre heure de pause.");
        if($request->heure_pause<0)return redirect()->back()->with('error',"Votre heure de pause doit etre superieur à 0.");
        DB::table('temps_pointage')
            ->where('id', $request->pointage_id)
            ->update(['sortie' => $request->modif_sortie, 'heure_pause' => $request->modif_pause]);
        return redirect('/home');
    }

    public function valider_feuille_de_temps(Request $request){
        // verification si user a fait un choix de semaine
        if(in_array(null, $request->date, true))return redirect()->back()->with('error',"Vous devez choisir la semaine pour le pointage.");

        // verification si il y a deja eu de pointage durant la semaine choisie
        $valeur_pointage_cette_semaine = $this->valeur_pointage_cette_semaine($request->date[0],$request->date[count($request->object)-1]);
        if($valeur_pointage_cette_semaine->isEmpty()){
            $response = array();
            for ($i = 0; $i < count($request->object); $i += 1) {
                $response[] = array(
                    "employer_id"=>$this->user_id,
                    "jour" => $request->date[$i],
                    "entree" => $request->entree[$i],
                    "heure_pause" => $request->pause[$i],
                    "sortie" => $request->sortie[$i],
                );
            }
            DB::table('temps_pointage')->insert($response);
            return redirect()->back()->with('msg',"Insertion des pointages reussi. Merci, À la prochaine ! ");
        }
        elseif($valeur_pointage_cette_semaine->isNotEmpty())return redirect()->back()->with('error',"Vous avez déjà terminé les pointages de la semaine.");

    }

}
