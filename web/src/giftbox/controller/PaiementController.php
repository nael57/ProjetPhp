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
        $prest = array();
        if($liste!=null){

            foreach($liste as $p){
                $prest[] = Prestation::where('id', '=', $p->id_pre)->first();
            }
        }

        $v = new VuePaiement($prest);
        return $v->affich_general(6);
    }


    public function afficher_coffret_validation(){
        if(isset ($_COOKIE[ 'panier' ])){
            $liste = Contient::prestations($_COOKIE[ 'panier' ]);
        }
        else{
            $liste=null;
        }
        $prest = array();
        if($liste!=null){

            foreach($liste as $p){
                $prest[] = Prestation::where('id', '=', $p->id_pre)->first();
            }
        }
        $listcat=array();
        foreach($prest as $value){
            $cat=$value->cat_id;
            if(!in_array($cat,$listcat)){
                $listcat[]=$cat;
            }
        }
        $i=2;
        $taille=count($prest);
        if(count($listcat)>1 && $taille>=4){
            $i=3;
        }

        $v = new VuePaiement($prest);
        return $v->affich_general($i);
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
       return $v->affich_general(3);
    }
}