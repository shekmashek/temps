<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class HeureSupplementaire extends Model
{

    protected $table = "listeHeureSup";
    protected $fillable = [
        'id','debut','fin','duree','jour','semaine','mois','annee'
    ];

    public function HeureSupHuit(){
        $liste = DB::table('HeureSupHuit')
            ->where('totalSemaine','>',40)
            ->where('totalHeureSupSemaine','<',8)
            ->get();
        return $liste;
    }

    public function liste_heure_supplementaire()
    {
        $heure_supplementaire_avant_huit = DB::select('select * from heure_supplementaire_avant_huit ');
        $heure_supplementaire_apres_huit = DB::select('select * from heure_supplementaire_apres_huit ');
        $heure_supplementaire_jour = DB::select('select * from heure_supplementaire_jour ');
        $heure_supplementaire_nuit = DB::select('select * from heure_supplementaire_nuit ');
        return response()->json([
            'heure_supplementaire_avant_huit'=> $heure_supplementaire_avant_huit,
            'heure_supplementaire_apres_huit'=> $heure_supplementaire_apres_huit,
            'heure_supplementaire_jour'=>$heure_supplementaire_jour,
            'heure_supplementaire_nuit'=> $heure_supplementaire_nuit
        ]);
    }

}
