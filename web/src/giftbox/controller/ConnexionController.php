<?php

//definition du namespace et des alias
namespace giftbox\controller;
use giftbox\models\Categorie as Categorie;
use giftbox\models\Prestation as Prestation;
use giftbox\vue\VueCatalogue as VueCatalogue;
use giftbox\vue\VueConnexion as VueConnexion;
//Classe controller pour le catalogue
class ConnexionController {
    
    //methode qui affiche la liste des prestations si le parametre est 
    //nul ou la prestation en parametre sinon
    public function affich(){
            $v = new VueConnexion();
            $html=$v->affich_general();
        return $html;
    }


}
    