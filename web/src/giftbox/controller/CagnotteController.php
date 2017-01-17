<?php

//definition du namespace et des classes a utiliser
namespace giftbox\controller;
use giftbox\models\Categorie as Categorie;
use giftbox\models\Prestation as Prestation;
use giftbox\models\Coffret as Coffret;
use giftbox\models\Contient as Contient;
use giftbox\vue\VueCoffret as VueCoffret;

//classe CoffretController
class CagnotteController {


    //methode qui permettra d'afficher le coffret
    public function affich_form(){
        $v = new VueCagnotte();
        $html = $v->affich_general(1);
        return $html;
    }

    //methode qui permettra d'afficher le coffret courant
    public function affich_coffret(){
        $coffret = Coffret::where('lien','=',$_POST[ 'lien' ])->count();

        $liste = Contient::prestations($coffret->id);
        $prest = null;
        foreach($liste as $p){
            $prest[] = Prestation::where('id', '=', $p->id_pre)->first();
        }



        $v = new VueCagnotte($prest);
        $html = $v->affich_general(2, null);
        return $html;
    }


}
