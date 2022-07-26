<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\HeureSupplementaire;

class HeureSupplementaireController extends Controller
{


    public function __construct()
    {
        $this->user_id  = 1;
    }

    public function liste(){
        $liste = HeureSupplementaire::all();
        $hs = new HeureSupplementaire();
        // $liste = $hs->HeureSupHuit();
        dd($liste);
    }

}
