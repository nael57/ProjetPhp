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
    
    //methode qui ajoute la prestation en parametre au coffret
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
        }
        if($con == null){
            $v = new VueCoffret($con);
            $html= $v->affich_general(4,$id);

        }else{
            $v = new VueCoffret($con);
            $html = $v->affich_general(1, $id);
        }
        return $html;
    }
    
    //methode qui permettra d'afficher le coffret courant 
    public function affich_coffret(){
        $liste = Contient::prestations($_COOKIE[ 'panier' ]);
        $prest = null;
        foreach($liste as $p){
            $prest[] = Prestation::where('id', '=', $p->id_pre)->first(); 
        }
        $v = new VueCoffret($prest);
        $html = $v->affich_general(2, null);
        return $html;
    }
    
    //methode qui permet la confirmation du coffret ainsi que les formalités associées 
    public function confirmer_coffret(){
        $coffret=null;
        if(isset($_COOKIE['panier'])){
            $coffret = Coffret::where('id', '=', $_COOKIE['panier']);
        }
        $v = new VueCoffret($coffret);
        $html = $v->affich_general(3, null);
        return $html;
    }
}