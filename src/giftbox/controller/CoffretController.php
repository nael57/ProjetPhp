<?php

//definition du namespace et des classes a utiliser
namespace giftbox\controller;
use giftbox\models\Categorie as Categorie;
use giftbox\models\Prestation as Prestation;
use giftbox\models\Coffret as Coffret;
use giftbox\models\Contient as Contient;
use giftbox\vue\VueCoffret as VueCoffret;

//classe CoffretController
class CoffretController {
    
    public function ajout_prest($id){
        
        $c = new Coffret();
        
        if(isset( $_COOKIE[ 'panier' ])){
            $c = Coffret::where('id', '=', $_COOKIE[ 'panier' ])->first();
        }
        else {
            $c->save();
            setcookie('panier', $c->id, time() + 60*60, '/'); 
        }
        if((Contient::where('id_pre', '=', $id)->where('id_coo', '=', $c->id)->first()) == null){
            $con = new Contient();
            $con->id_pre = $id;
            $con->id_coo = $c->id;
            $con->save();
        }
        else{
            $con = null;
            echo 'la prestation a deja ete ajoutee';
        }
        $v = new VueCoffret($con);
        $html = $v->affich_general(1, $id);
        return $html;
    }
    
    public function affich_coffret(){
        echo $_COOKIE[ 'panier' ];
       $liste = Contient::prestations($_COOKIE[ 'panier' ]);
        $v = new VueCoffret($liste);
        $html = $v->affich_general(2, null);
        return $html;
    }
}