<?php

//definition du namespace et des alias
namespace giftbox\controller;
use giftbox\vue\VueMembre as VueMembre;
//Classe controller pour le catalogue
class MembreController {
    
    //methode qui affiche la liste des prestations si le parametre est 
    //nul ou la prestation en parametre sinon
    public function affich_coffret($id){
            $m = Membre::where('id', '=', $id)->first();
            $v = new VueMembre($m);
            $html = $v->affich_general(1, $id);
        return $html;
    }


}
    