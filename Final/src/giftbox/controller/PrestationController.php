<?php

//definition du namespace et des alias
namespace giftbox\controller;
use giftbox\models\Categorie as Categorie;
use giftbox\models\Prestation as Prestation;
use giftbox\vue\VueCatalogue as VueCatalogue;
use giftbox\vue\VuePrestation as VuePrestation;
//Classe controller pour le catalogue
class PrestationController {
    
    //methode qui affiche la liste des prestations si le parametre est 
    //nul ou la prestation en parametre sinon
    public function affich_prest($id){
            $liste = Prestation::where('id', '=', $id)->first();
            $v = new VuePrestation($liste);
            $html = $v->affich_general(1, $id);
        return $html;
    }

    public function vote($id,$num){
        $liste = Prestation::where('id', '=', $id)->first();
    	if($num >5){
    		$num=5;
    	}
    	if($num<1){
    		$num=1;
    	}
    	$votes=null;
        $vote= Prestation::find($id);
        $vote['sommevotes']=$vote['sommevotes']+$num;
        $vote['nbvotes']=$vote['nbvotes']+1;
        $vote['moyenne']=$vote['sommevotes']/$vote['nbvotes'];
        $vote->save();
    	$v= new VuePrestation($liste);
    	$html = $v->affich_general(2,$id);
        return $html;

    }


}
    