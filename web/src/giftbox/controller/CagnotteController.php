<?php

//definition du namespace et des classes a utiliser
namespace giftbox\controller;
use giftbox\models\Categorie as Categorie;
use giftbox\models\Prestation as Prestation;
use giftbox\models\Coffret as Coffret;
use giftbox\models\Cadeau as Cadeau;
use giftbox\models\Cagnotte as Cagnotte;
use giftbox\models\Contient as Contient;
use giftbox\vue\VueCagnotte as VueCagnotte;
use giftbox\vue\VueCadeau as VueCadeau;

//classe CoffretController
class CagnotteController {


    //methode qui permettra d'afficher le coffret
    public function affich_form(){
        $v = new VueCagnotte();
        $html = $v->affich_general(50);
        return $html;
    }

    public function supp_prest($co,$id){


        Contient::where('id_coo', '=', $co)->where('id_pre', '=', $id)->delete();
        $prest=array();
        $liste = Contient::prestations($co);
        foreach($liste as $p){
            $prest[] = Prestation::where('id', '=', $p->id_pre)->first();
        }

        $coffret = Coffret::where('id','=',$co)->first();

        $v = new VueCagnotte($coffret,$prest,'../../');

        $html = $v->affich_general(2);
        return $html;
    }


    //methode qui permettra d'afficher le coffret courant
    public function affich_coffret(){
        $i=0;
        $prest = null;

        if(isset($_POST['liencadeau']) && $_POST['liencadeau']!=null ){
                $post=$_POST['liencadeau'];
                $c = Cadeau::where('idca','=',$post)->count();
                if($c>0) {
                    $cof=Cadeau::where('idca','=',$post)->first();
                    $coffret = Coffret::where('id', '=', $cof->id_coffret)->first();
                    if($coffret->dateouverture==null || $coffret->etatcadeau != 'Ouvert'){
                        $coffret->etatcadeau = 'Ouvert';
                        $coffret->dateouverture = date('l jS \of F Y h:i:s A');
                        $coffret->save();
                    }

                    $liste = Contient::prestations($coffret->id);
                    foreach ($liste as $p) {
                        $prest[] = Prestation::where('id', '=', $p->id_pre)->first();
                    }
                    $i = 2;

                    $v = new VueCadeau($coffret);
                } else {
                    $i = 3;
                    $v = new VueCagnotte();
                }

        }elseif (isset($_POST['lien4']) && $_POST['lien4']!=null ) {
                $post = $_POST['lien4'];
                $c = Coffret::where('lien', '=', $post)->count();
                if ($c > 0) {
                    $coffret = Coffret::where('lien', '=', $post)->first();
                    $liste = Contient::prestations($coffret->id);
                    foreach ($liste as $p) {
                        $prest[] = Prestation::where('id', '=', $p->id_pre)->first();
                    }
                    $i = 2;
                    $v = new VueCagnotte($coffret, $prest);
                } else {

                    $i = 3;
                    $v = new VueCagnotte();
                }

        }elseif (isset($_POST['liencagnotte']) && $_POST['liencagnotte']!=null ) {
            $post = $_POST['liencagnotte'];
            $c = Cagnotte::where('Lienparticipation', '=', $post)->count();
            if ($c > 0) {
                $cagnotte = Cagnotte::where('Lienparticipation', '=', $post)->first();
                $coffret = Coffret::where('id', '=', $cagnotte->id_coffret)->first();
                $liste = Contient::prestations($coffret->id);
                foreach ($liste as $p) {
                    $prest[] = Prestation::where('id', '=', $p->id_pre)->first();
                }
                $i = 4;
                $v = new VueCagnotte($coffret, $prest,null, $cagnotte);
            } else {
                echo $c;
                $i = 3;
                $v = new VueCagnotte();
            }
        }else {
            $i = 3;
            $v = new VueCagnotte();
             }


        $html = $v->affich_general($i);
        return $html;
    }

    public function participer_cagnotte($id){
        $v=new VueCagnotte(null,null,'../',Cagnotte::where('idcagnotte','=',$id)->first());
        $html=$v->affich_general(10);
        return $html;
    }

    public function confirmer_paiement($id){
        $cagnotte=Cagnotte::where('idcagnotte','=',$id)->first();
        if($_POST['montant']>0){
            $cagnotte->contribution+=$_POST['montant'];
            $cagnotte->save();
        }
        $coffret = Coffret::where('id', '=', $cagnotte->id_coffret)->first();
        $liste = Contient::prestations($coffret->id);
        foreach ($liste as $p) {
            $prest[] = Prestation::where('id', '=', $p->id_pre)->first();
        }
        $v= new VueCagnotte(null,$prest,'../',$cagnotte);
        return $v->affich_general(11);
    }


}
