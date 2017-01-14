<?php

//definition du namespace et des classes a utiliser
namespace giftbox\controller;
use giftbox\models\Categorie as Categorie;
use giftbox\models\Prestation as Prestation;
use giftbox\models\Coffret as Coffret;
use giftbox\models\Contient as Contient;
use giftbox\vue\VueCoffret as VueCoffret;

class PaiementController {
    public function afficher_paiement(){
        $liste = Contient::prestations($_COOKIE[ 'panier' ]);
        $prest = null;
        foreach($liste as $p){
            $prest[] = Prestation::where('id', '=', $p->id_pre)->first(); 
        }
        $v = new VuePaiement($prest);
    }
}