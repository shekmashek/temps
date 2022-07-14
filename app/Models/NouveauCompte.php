<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NouveauCompte extends Model
{

    public function insert_ETP($doner,$url)
    {

        $data = [
            $doner["nom_etp"], $doner["email_etp"],
            $doner["nif"], $doner["logo_etp"],$url,$doner["secteur_id"]
        ];

        DB::insert('insert into entreprises(nom_etp,email_etp,nif,logo,created_at,url_logo,secteur_id) values (?,?,?,?, NOW(),?,?)', $data);
        DB::commit();
    }
    public function insert_resp_ETP($doner, $entreprise_id, $user_id)
    {
        $data = [
            $doner["matricule_emp"], $doner["nom_emp"], $doner["prenom_emp"], $doner["cin_emp"], $doner["email_emp"],
            $entreprise_id, $user_id
        ];
        DB::insert('insert into employers(matricule_emp,nom_emp,prenom_emp,cin_emp,email_emp
        ,entreprise_id,user_id,activiter,created_at,prioriter) values(?,?,?,?,?,?,?,1,NOW(),true)', $data);
        DB::commit();
    }

    public function verify_NIF_etp($nif)
    {
        $dta = DB::select('select * from entreprises WHERE UPPER(nif)=UPPER(?)', [$nif]);
        return $dta;
    }
    public function verify_etp($nom, $mail)
    {
        $dta = DB::select('select * from entreprises WHERE UPPER(nom_etp)=UPPER(?) OR email_etp=?', [$nom, $mail]);
        return $dta;
    }

    public function verify_resp($email, $tel)
    {
        $data = DB::select('select * from responsables where email_resp=? OR telephone_resp=?', [$email, $tel]);
        return $data;
    }

    public function search_etp($nom_etp)
    {
        $data = DB::select('select * from entreprises WHERE UPPER(nom_etp) LIKE UPPER("%' . $nom_etp . '%")');
        return $data;
    }

    public function verify_cin_user($valiny)
    {
        $data = DB::select('select * from users WHERE cin =?', [$valiny]);
        return $data;
    }

    public function verify_tel_user($valiny)
    {
        $data = DB::select('select * from users WHERE telephone =?', [$valiny]);
        return $data;
    }

    public function verify_mail_user($valiny)
    {
        $data = DB::select('select * from users WHERE email =?', [$valiny]);
        return $data;
    }

    public function validation_form_etp($imput)
    {
        $rules = [
            'matricule_resp_etp.required' => 'votre matricule ne doit pas être nul',
            'name_etp.required' => 'la raison sociale de votre entreprise ne doit pas être nulle',
            'nif_etp.required' => 'le NIF de votre entreprise ne doit pas être nul',
            'logo_etp.required' => 'le logo de votre entreprise ne doit pas être nul',
            'logo_etp.file' => 'le logo de votre entreprise doit être de type "file"',
            'logo_etp.max' => 'la taille de votre image ne doit pas dépassé 1.7 MB',
            'logo_etp.mimes' => 'votre logo doit être soit "*.png, *.jpg, *.jpeg"',
            'nom_resp_etp.required' => 'le Nom de votre responsable ne doit pas être nul',
            'cin_resp_etp.required' => 'le CIN de votre responsable ne doit pas être nul',
            'email_resp_etp.required' => 'votre e-mail ne doit pas être null',
            'email_resp_etp.email' => 'votre e-mail doit être contenir "@" !'
        ];
        $critereForm = [
            'matricule_resp_etp' => 'required',
            'name_etp' => 'required',
            'nif_etp' => 'required',
            'logo_etp' => 'required|file|max:1700|mimes:jpeg,png,jpg',
            'nom_resp_etp' => 'required',
            'cin_resp_etp' => 'required|min:6',
            'email_resp_etp' => 'required|email'
        ];
        $imput->validate($critereForm, $rules);
    }

}
