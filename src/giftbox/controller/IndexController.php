<?php

//definition du namespace et des alias
namespace giftbox\controller;
use giftbox\vue\VueIndex as VueIndex;

//Classe controller pour l'index
class IndexController {

    //Unique methode du controller qui controle l'affichage de l'index
    public function affichage(){
        $v = new VueIndex();
        $html = $v->affichage();
        return $html;
    }
}