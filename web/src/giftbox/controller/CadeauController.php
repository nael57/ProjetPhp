<?php

//definition du namespace et des classes a utiliser
namespace giftbox\controller;
use giftbox\models\Categorie as Categorie;
use giftbox\models\Prestation as Prestation;
use giftbox\models\Coffret as Coffret;
use giftbox\models\Cadeau as Cadeau;
use giftbox\models\Contient as Contient;
use giftbox\vue\VueCagnotte as VueCagnotte;
use giftbox\vue\VueCadeau as VueCadeau;

//classe CoffretController
class CadeauController {


    //methode qui permettra d'afficher le coffret
    public function confirmcad($id){
        $v = new VueCadeau();
        $coffret=Coffret::where('id','=',$id)->first();
        if(Cadeau::where('id_coffret','=',$id)->count()!=0){
            $cadeau=Cadeau::where('id_coffret','=',$id)->first();

        }else{
            $lien=$this->getGUID();
            $cadeau= new Cadeau();
            $cadeau->idca=$lien;
            $cadeau->id_coffret=$id;
            $cadeau->save();
        }


        /*// Le message
        $message =$coffret->commentaire;
        // Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
        $messageOK = wordwrap($message, 70, "\r\n");
        // Envoi du mail
        echo $coffret->mail;
        mail($coffret->mail,'GIFTBOX', $messageOK);
        */
        $v= new VueCadeau($coffret,$cadeau->idca);
        $html = $v->affich_general(1);
        return $html;
    }


    //methode qui permettra d'afficher le coffret courant
    public function affich_coffret(){
        $i=0;
        $prest = null;

        $c = Coffret::where('lien','=',$_POST[ 'lien' ])->count();
        $cofrret=null;
        if($c>0){
            $coffret = Coffret::where('lien','=',$_POST[ 'lien' ])->first();
            $liste = Contient::prestations($coffret->id);
            foreach($liste as $p){
                $prest[] = Prestation::where('id', '=', $p->id_pre)->first();
            }
            $i=2;
            $v = new VueCagnotte($coffret,$prest);
        }else{
            $i=3;
            $v = new VueCagnotte();
        }

        $html = $v->affich_general($i);
        return $html;
    }

    private function getGUID(){
        if (function_exists('com_create_guid')){
            return com_create_guid();
        }
        else {
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $uuid=substr($charid, 0, 8).substr($charid, 8, 4)
                .substr($charid,12, 4);

            return $uuid;
        }

    }

}
