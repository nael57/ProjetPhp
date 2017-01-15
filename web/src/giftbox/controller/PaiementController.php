<?php

//definition du namespace et des classes a utiliser
namespace giftbox\controller;
use giftbox\models\Categorie as Categorie;
use giftbox\models\Prestation as Prestation;
use giftbox\models\Coffret as Coffret;
use giftbox\models\Contient as Contient;
use giftbox\vue\VueCoffret as VueCoffret;
use giftbox\vue\VuePaiement as VuePaiement;

class PaiementController {
    public function afficher_paiement(){
    	if(isset ($_COOKIE[ 'panier' ])){
        $liste = Contient::prestations($_COOKIE[ 'panier' ]);
    }
    else{
    	$liste=null;
    }
        $prest = null;
        if(isset ($_COOKIE[ 'panier' ])){
        foreach($liste as $p){
            $prest[] = Prestation::where('id', '=', $p->id_pre)->first(); 
        }
    }
        $v = new VuePaiement($prest);
       return $v->affich_general(1);
    }

    public function afficher_carte(){
        if(isset ($_COOKIE[ 'panier' ])){
        $liste = Contient::prestations($_COOKIE[ 'panier' ]);
    }
    else{
        $liste=null;
    }
        $prest = null;
        if(isset ($_COOKIE[ 'panier' ])){
        foreach($liste as $p){
            $prest[] = Prestation::where('id', '=', $p->id_pre)->first(); 
        }
    }
        $v = new VuePaiement($prest);
       return $v->affich_general(2);
    }
}