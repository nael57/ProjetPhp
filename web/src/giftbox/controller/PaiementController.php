<?php

//definition du namespace et des classes a utiliser
namespace giftbox\controller;
use giftbox\models\Categorie as Categorie;
use giftbox\models\Cagnotte as Cagnotte;
use giftbox\models\Prestation as Prestation;
use giftbox\models\Coffret as Coffret;
use giftbox\models\Contient as Contient;
use giftbox\vue\VueCoffret as VueCoffret;
use giftbox\vue\VuePaiement as VuePaiement;


class PaiementController {
    public function afficher_paiement(){
    	if(isset ($_COOKIE[ 'panier' ])){
        $liste = Contient::prestations($_COOKIE[ 'panier' ]);
        $coffret = Coffret::where('id','=',$_COOKIE[ 'panier' ])->first();
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

        $v = new VuePaiement($prest,$coffret);
        return $v->affich_general(1);
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
        if(count($listcat)>1 && $taille>1){
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
       return $v->affich_general(6);
    }

    public function validation_paiement(){
        $html='';
        if(isset($_POST['valider']) && $_POST['valider']=='Valider'){
            $coffret=Coffret::where('id', '=', $_COOKIE['panier'])->first();
            $coffret->nom=$_POST['nom'];
            $coffret->prenom=$_POST['prenom'];
            $coffret->mail=$_POST['mail'];
            $coffret->commentaire=$_POST['commentaire'];
            $coffret->modePaiement='classique';
            $coffret->etat='paye';
            $lien=$this->getGUID();
            $coffret->lien=$lien;
            if($_POST['mdp']!=null){
               $coffret->mdp= password_hash($_POST['mdp'], PASSWORD_DEFAULT);
            }
            $coffret->save();

            $c = new Coffret();
            setcookie('panier', '', time() - 3600, '/');
            $v = new VuePaiement(null,$coffret);
            $html=$v->affich_general(4);
        }
        return $html;
    }

    public function validerCagnotte($id){

        $html='';
        $coffret=Coffret::where('id', '=', $id)->first();
        if($coffret!=null) {
            $coffret->modePaiement='cagnotte';
            $coffret->etat='en cours';
            $coffret->save();

            $prest = array();

                $liste = Contient::prestations($id);
                if($liste!=null){
                    foreach ($liste as $p) {
                        $prest[] = Prestation::where('id', '=', $p->id_pre)->first();
                    }
                }

            $montant=0;

            if(Cagnotte::where('id_coffret','=',$coffret->id)->count()==0){
                $cagnotte = new Cagnotte();
                $cagnotte->id_coffret=$id;
                $cagnotte->contribution=$montant;

                $lienpar=$this->getGUID();
                $liengest=$this->getGUID();
                $cagnotte->Lienparticipation=$lienpar;
                $cagnotte->Liengestion=$liengest;
                $cagnotte->status='ouvert';
                $cagnotte->save();

            }else{

                $cagnotte=Cagnotte::where('id_coffret','=',$coffret->id)->first();

            }



            $v=new VuePaiement(null,$coffret,$cagnotte,'../');
            setcookie('panier', '', time() - 3600, '/');
            $html=$v->affich_general(10);
        }else{
            $html='Erreur coffret';
        }

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