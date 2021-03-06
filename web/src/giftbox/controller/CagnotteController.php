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
use giftbox\vue\VueMotDePasse as VueMotDePasse;

//classe CoffretController
class CagnotteController {


    //methode qui permettra d'afficher le coffret
    public function affich_form(){
        $v = new VueCagnotte();
        $html = $v->affich_general(1);
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

    public function afficher_gestion(){
        $i=1;
        if (isset($_POST['lien4']) && $_POST['lien4']!=null ){
            $post = $_POST['lien4'];
            $c = Coffret::where('lien', '=', $post)->count();
            $co = Coffret::where('lien', '=', $post)->first();
            if(isset($co)){
                if($co->mdp != null){
                    $v=new VueMotDePasse($co->id);
                }
                else{
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
                }
            }
            else{
                $i=3;
                $v=new VueCagnotte();
            }
        }
        else{
            $i=3;
            $v= new VueCagnotte();
        }
        $html=$v->affich_general($i);
        return $html;
    }
    //methode qui permettra d'afficher le coffret courant
    public function affich_coffret(){
        $i=0;
        $prest = null;
        if(isset($_POST['liencadeau']) && $_POST['liencadeau']!=null ){
            $post=$_POST['liencadeau'];
            $c = Cadeau::where('idca','=',$post)->count();
            $coo= Cadeau::where('idca','=',$post)->first();
            if (isset($coo)){
                $co = Coffret::where('id', '=', $coo->id_coffret)->first();
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
            }
        else{
            $i=3;
            $v=new VueCagnotte();
        }
    }else{
        $i=3;
        $v=new VueCagnotte();
    }
        $html = $v->affich_general($i);
        return $html;
    }

    public function affich_cagnotte(){
        $i=0;
        $prest = null;
        if(isset($_POST['lien2']) && $_POST['lien2']!=null ){
            $post = $_POST['lien2'];
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

    public function affich_gestion(){
        $i=0;
        $prest = null;
        if(isset($_POST['lien3']) && $_POST['lien3']!=null ){
            $post = $_POST['lien3'];
            $c = Cagnotte::where('Liengestion', '=', $post)->count();
            if ($c > 0) {
                $cagnotte = Cagnotte::where('Liengestion', '=', $post)->first();
                $coffret = Coffret::where('id', '=', $cagnotte->id_coffret)->first();
                $liste = Contient::prestations($coffret->id);
                foreach ($liste as $p) {
                    $prest[] = Prestation::where('id', '=', $p->id_pre)->first();
                }
                $i = 15;
                $v = new VueCagnotte($coffret, $prest,null, $cagnotte);
            } else {
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


    public function affich_coffretmdp($c)
    {
        $cadeau = Coffret::where('id', '=', $c)->first();
        if (crypt($_POST['mdp'], "kldjfskdjf43543jfdsljfls") == $cadeau->mdp) {
            $ca = Coffret::where('id', '=', $c)->count();
            if ($ca > 0) {
                $liste = Contient::prestations($cadeau->id);
                foreach ($liste as $p) {
                    $prest[] = Prestation::where('id', '=', $p->id_pre)->first();
                }
                $i = 2;
                $v = new VueCagnotte($cadeau, $prest,'../');
            } else {

                $i = 3;
                $v = new VueCagnotte();
            }


        }

    }

    public function confirmer_paiement($id){
        $cagnotte=Cagnotte::where('idcagnotte','=',$id)->first();
        if($_POST['montant']>0){
            $cagnotte->contribution+=$_POST['montant'];
            $cagnotte->save();
        }
        $coffret = Coffret::where('id', '=', $cagnotte->id_coffret)->first();
        $liste = Contient::prestations($coffret->id);
        $prest=null;
        foreach ($liste as $p) {
            $prest[] = Prestation::where('id', '=', $p->id_pre)->first();
        }
        $v= new VueCagnotte(null,$prest,'../',$cagnotte);
        return $v->affich_general(11);
    }

    public function cloturer_cagnotte($id){
        $cagnotte=Cagnotte::where('idcagnotte','=',$id)->first();
        $contribution=$cagnotte->contribution;

        $liste = Contient::prestations($cagnotte->id_coffret);

        foreach ($liste as $p) {
            $prest[] = Prestation::where('id', '=', $p->id_pre)->first();
        }

        $montant=0;
        foreach ($prest as $p){
            $montant+=$p->prix;
        }
        $i=15;
        $coffret=Coffret::where('id','=',$cagnotte->id_coffret)->first();

        if($contribution<$montant){

            $i=16;


        }else{

            $coffret->etat='paye';
            $coffret->save();
            $cagnotte->delete();
            $i=17;
        }

        $v=new VueCagnotte($coffret, $prest,'../', $cagnotte);

        $html=$v->affich_general($i);
        return $html;
    }


    public function participer_cagnotte($id){
        $v=new VueCagnotte(null,null,'../',Cagnotte::where('idcagnotte','=',$id)->first());
        $html=$v->affich_general(10);

        return $html;
    }
}
