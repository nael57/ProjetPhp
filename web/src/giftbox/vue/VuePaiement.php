<?php

//definition du namespace
namespace giftbox\vue;
use giftbox\models\Prestation as Prestation;
use giftbox\models\Categorie as Categorie;
use giftbox\models\Contient as Contient;


//Classe vue pour le catalogue
class VuePaiement {

    //prestation envoyee par le controller
    private $prestation,$sel,$id,$lien;
    
    public function __construct( $presta=null,$lien=null ){
        $this->prestation = $presta;
        $this->lien=$lien;
    }
    public function affich_general($i){
        $html = $this->render($i);
        return $html;
    }

    private function affich_liste_cat(){
        $cat = Categorie::get();
        $this->tab=$cat;
        $page = '';
        $i = 1;
        foreach($this->tab as $pre){
            $page = $page. '<li><a href="../../index.php/CatalogueController/affich_cat/'.$i.'">'.$pre->nom.'</a></li>';
            $i++;
        }
        
        $this->lienPrest = '../../../index.php/CatalogueController/affich_prest';
        $this->lienCat = '../../../index.php/CatalogueController/affich_cat';
        $this->lienAccueil = '../../..';
        
        return $page;
        
    }

    public function affich_coffretpaiement(){
        $html='';
        if(!empty($this->prestation)) {
            $montant=0;
            foreach($this->prestation as $pre){
                $html = $html . $pre->nom.' '.$pre->descr.' '.$pre->prix.'€'. '<br>';
                $prix = $pre->prix;
                $montant = $montant + $prix;
            }
            $html = $html.'Montant total : '.$montant.'€<br><br>'.'
    <div class="row"></div>
    <a class="btn btn-primary btn-lg btn-learn" href="../../index.php/PaiementController/afficher_carte">Payer via carte bancaire</a>
    <a class="btn btn-primary btn-lg btn-learn" href="../../../index.php/CoffretController/ajout_prest/' . $this->id . '">Payer via cagnotte</a>';
        }else{
            $html='votre panier est vide';
        }
        return $html;
    }

    public function affich_coffret_validation(){
        $html='<h1><font color="red"> Attention !</font></h1><p>Votre coffret doit contenir au moins 2 prestations de 2 catégories différentes</p><br>';
        if(!empty($this->prestation)) {
            $montant=0;
            foreach($this->prestation as $pre){
                $html = $html . $pre->nom.' '.$pre->descr.' '.$pre->prix.'€'. '<br>';
                $prix = $pre->prix;
                $montant = $montant + $prix;
            }
            $html = $html.'Montant total : '.$montant.'€<br><br>';
        }else{
            $html='votre panier est vide';
        }
        return $html;
    }

    public function affich_coffret_validation_ok(){
        $html='';
        if(!empty($this->prestation)) {
            $montant=0;
            foreach($this->prestation as $pre){
                $html = $html . $pre->nom.' '.$pre->descr.' '.$pre->prix.'€  ';
                $html = $html . '<a class="btn btn-primary btn-lg btn-learn" href="../CoffretController/supp_prest/' . $pre->id . '">Supprimer</a><br>';
                $prix = $pre->prix;
                $montant = $montant + $prix;
            }
            $html = $html.'Montant total : '.$montant.'€<br><br>'.'
    <div class="row"></div>
    <a class="btn btn-primary btn-lg btn-learn" href="../../index.php/PaiementController/afficher_paiement">Valider mon coffret</a>';
        }else{
            $html='votre panier est vide';
        }
        return $html;
    }

    public function affich_paiementcarte(){
        $html='';
        $montant=0;
            foreach($this->prestation as $pre){
                $html = $html . $pre->nom.' '.$pre->descr.' : '.$pre->prix.'€'. '<br>';
                $prix = $pre->prix;
                $montant = $montant + $prix;
            }
        $html=$html.'<br>
    <div class="row"></div>
    Veuillez remplir le formulaire de paiement<br>
    <form action="../../index.php/PaiementController/validerpaiement" method="post">
     <table>              
                  <tr>
                    <td>Nom : </td>
                    <td> <input type="text" name="nom" required/><br></td>
                  </tr>
                  <tr>
                    <td>Prénom : </td>
                    <td><input type="text" name="prenom" required/></td>
                  </tr>   
                  <tr>
                    <td>Mail : </td>
                    <td><input type="email" name="mail" required/></td>
                  </tr>
                  <tr>
                    <td>Mot de passe :(optionnel)</td>
                    <td><input type="password" name="mdp"></td>
                  </tr>
                   <tr>
                     <td>Numéro de carte bancaire : </td>
                    <td><input type="text" name="numcarte" required/></td>
                  </tr>                     
                  <tr>
                    <td>Commentaire :(optionnel)</td>
                    <td><textarea name="commentaire" rows="7" cols="30"></textarea></td>
                  </tr>
    </table>
    Montant total de la transaction : '.$montant.'€<br>
    <input type="submit" name="valider" value="Valider">
    
    </form>';
    return $html;

    }


    public function affich_coffret(){
        if (isset($_COOKIE[ 'panier' ])){
            $liste = Contient::prestations($_COOKIE[ 'panier' ]);
        }
        else{
            $liste=null;
        }
        $prest = null;
        if($liste!=null){
        foreach($liste as $p){
            $prest[] = Prestation::where('id', '=', $p->id_pre)->first(); 
        }
        }
        $html = '';
        $montant = 0;
        if($liste!=null){
            foreach($prest as $pre){
                $html="<li>".$pre->nom." dune valeur de ".$pre->prix. " €</li>";
                $montant = $montant + $pre->prix;
            }
        }
        
        $html = $html . '<li>Montant total : ' . $montant . '</li><li><a href="../../index.php/PaiementController/afficher_coffret_validation"><strong>Passer au paiement de la commande</strong></a></li>';
        
        return $html;
    }
    public function paiement_ok($lien){

        $html='Votre paiement a été validé';
        $html=$html.'<br>Voici url de gestion de votre coffret (NE PAS PERDE CE LIEN !!!): '.$lien;
        $html=$html.'<br><a href="../../"><strong>Retour à l'."'accueil</strong></a>";
        return $html;

    }


    private function render($i)
    {
        if($i==1){
            $contenu=$this->affich_coffretpaiement();
        }
        elseif($i==2) {
            $contenu=$this->affich_coffret_validation();
        }elseif($i==3) {
            $contenu=$this->affich_coffret_validation_ok();
        }elseif($i==4){
            $contenu=$this->paiement_ok($this->lien);
            unset($_COOKIE['panier']);
        }else{
            $contenu=$this->affich_paiementcarte();
        }

        $content = $this->affich_liste_cat();
        $html = ' <!DOCTYPE HTML>
    <html>
    <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GiftBox, offrez du rêve</title>

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,700,800" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="../../css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="../../css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="../../css/bootstrap.css">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="../../css/magnific-popup.css">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../css/owl.theme.default.min.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="../../css/style.css">

    <!-- Modernizr JS -->
    <script src="../../'.$this->lien.'js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    </head>
    <body>

    <div class="fh5co-loader"></div>
    
    <div id="page">
    <nav class="fh5co-nav" role="navigation">
    <div class="top-menu">
    <div class="container">
    <div class="row">
    <div class="col-xs-1">
    <div id="fh5co-logo"><a href="#">Gift<span>Box</span></a></div>
    </div>
    <div class="col-xs-11 text-right menu-1">
    <ul>
    <li ><a href="../../">Accueil</a></li>
    <li class="has-dropdown" >
    <a href="../../index.php/CatalogueController/affich_prest" >Catalogue</a>
    <ul class="dropdown">
    '.$content.'
    </ul>
    </li>
    <li><a href="#">Accéder à un coffret ou à une cagnotte</a></li>
    <li class="btn-cta"><a href="../../index.php/ConnexionController/affich"><span>Connexion</span></a></li>
    <li class="has-dropdown">
    <a href="#"><span>Coffret</span></a>
    <ul class="dropdown">
    <li><a href="#">Voici le contenu actuel du coffret :</a></li>
                                         '.$this->affich_coffret().'
    </ul>
    </li>
    </ul>
    </div>
    </div>

    </div>
    </div>
    </nav>

    <header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/img_bg_2.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
    <div class="row">
    <div class="col-md-8 col-md-offset-2 text-center">
    <div class="display-t">
    <div class="display-tc animate-box" data-animate-effect="fadeIn">
    <h1>Voici, ci dessous le contenu de votre coffret</h1>
    </div>
    </div>
    </div>
    </div>
    </div>
    </header>
    <div id="fh5co-blog">
    <div class="container">
    '.$contenu.'
    
    </div>
    </div>


 <footer id="fh5co-footer" role="contentinfo">
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-3 fh5co-widget">
                    <h4>À propos</h4>
                    <p>GiftBox est une entreprise purement fictive réalisée dans le cadre du projet de notre 3ème semestre de DUT Informatique, toute ressemblance avec une entreprise existante nest pas voulue.</p>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1">
                    <h4>Catalogue</h4>
                    <ul class="fh5co-footer-links">
                        ' . $this->affich_liste_cat() . '
                    </ul>
                </div>

                <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1">
                    <h4>Laventure GiftBox</h4>
                    <ul class="fh5co-footer-links">
                        <li><a href="#">Le concept</a></li>
                        <li><a href="#">Qui sommes nous</a></li>
                    </ul>
                </div>

                <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1">
                    <h4>Nos partenaires</h4>
                    <ul class="fh5co-footer-links">
                        <li><a href="#">IUT Charlemagne</a></li>
                        <li><a href="#">Cours en PHP de Monsieur B.</a></li>
                        <li><a href="#">OpenClassroom</a></li>
                        <li><a href="#">Youtube</a></li>
                    </ul>
                </div>

                <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1">
                    <h4>Connexion</h4>
                    <ul class="fh5co-footer-links">
                        <li><a href="#">Se connecter</a></li>
                        <li><a href="#">Se déconnecter</a></li>
                    </ul>
                </div>
            </div>

            <div class="row copyright">
                <div class="col-md-12 text-center">
                    <p>
                        <small class="block">&copy; 2016 Nael Léo Tolga Pierre Florian <strong>Groupe S3B</strong></small> 
                    </p>

                </div>
            </div>

        </div>
    </footer>
    </div>

    <div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
    </div>
    
    <!-- jQuery -->
    <script src="../../js/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="../../js/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="../../js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="../../js/jquery.waypoints.min.js"></script>
    <!-- Stellar Parallax -->
    <script src="../../js/jquery.stellar.min.js"></script>
    <!-- Carousel -->
    <script src="../../js/owl.carousel.min.js"></script>
    <!-- countTo -->
    <script src="../../js/jquery.countTo.js"></script>
    <!-- Magnific Popup -->
    <script src="../../js/jquery.magnific-popup.min.js"></script>
    <script src="../../js/magnific-popup-options.js"></script>
    <!-- Main -->
    <script src="../../js/main.js"></script>

    </body>
    </html>';
        return $html;
    }
}