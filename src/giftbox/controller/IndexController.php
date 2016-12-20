<?php

namespace giftbox\controller;
use giftbox\vue\VueIndex as VueIndex;

class IndexController {

    public function affichage(){
        $v = new VueIndex();
        $html = $v->affichage();
        return $html;
    }
}