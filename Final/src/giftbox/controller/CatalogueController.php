<?php

//definition du namespace et des alias
namespace giftbox\controller;
use giftbox\models\Categorie as Categorie;
use giftbox\models\Prestation as Prestation;
use giftbox\vue\VueCatalogue as VueCatalogue;

//Classe controller pour le catalogue
class CatalogueController {
    
    //methode qui affiche la liste des prestations si le parametre est 
    //nul ou la prestation en parametre sinon
    public function affich_prest($id=null, $order=null){

        if($id==null){
            if($order=='desc'){
                $liste = Prestation::where('etat','=','actif')->Orderby('prix', 'desc')->get();
                $v = new VueCatalogue($liste);
                $html = $v->affich_general(2, null);
            }elseif ($order=='asc'){
                $liste = Prestation::where('etat','=','actif')->Orderby('prix', 'asc')->get();
                $v = new VueCatalogue($liste);
                $html = $v->affich_general(2, null);
            }else {
                $liste = Prestation::where('etat','=','actif')->get();
                $v = new VueCatalogue($liste);
                $html = $v->affich_general(1, null);
            }
        }
        else {
            $liste = Prestation::where('id', '=', $id)->first();
            $v = new VueCatalogue($liste);
            $html = $v->affich_general(2, $id);
        }
        return $html;
    }
    
    /*
    * Methode qui affiche la liste des categorie si le parametre est nul 
    * ou les presations d'une categorie sinon
    */
    public function affich_cat($id_cat,$order=null){
        if($id_cat==null){
            $liste = Prestation::get();
            $v = new VueCatalogue($liste);
            $html = $v->affich_general(4, null);
        }
        else {
            if($order=='asc'){
                $prest=Prestation::where('etat','=','actif')->where('cat_id','=',$id_cat)->Orderby('prix','asc')->get();
                $v = new VueCatalogue($prest);
                $html = $v->affich_general(4, $id_cat);
            }elseif($order=='desc'){
                $prest=Prestation::where('etat','=','actif')->where('cat_id','=',$id_cat)->Orderby('prix','desc')->get();
                $v = new VueCatalogue($prest);
                $html = $v->affich_general(4, $id_cat);
            }else {
                $prest=Prestation::where('etat','=','actif')->where('cat_id','=',$id_cat)->get();
                $v = new VueCatalogue($prest);
                $html = $v->affich_general(3, $id_cat);
            }
        }
        return $html;
    }
}