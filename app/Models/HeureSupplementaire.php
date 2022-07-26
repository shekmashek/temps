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

    public function HeureJours(){
        $results = array();
        foreach($this::all() as $jour){

        }
    }

// heure de travail > heure normale
// maka 8 premières heures
// heure de jour ou heure de nuit
// type de jour: ouvrable, dimanche, férié

}
