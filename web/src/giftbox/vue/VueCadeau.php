<?php

//definition du namespace
namespace giftbox\vue;
use giftbox\models\Prestation as Prestation;
use giftbox\models\Categorie as Categorie;
use giftbox\models\Contient as Contient;


//Classe vue pour le catalogue
class VueCadeau {

    //prestation envoyee par le controller
    private $prestation,$sel,$id,$urlca,$coffret,$problemelien;
    
    public function __construct( $cof=null,$lien=null,$problem=null){
        $this->coffret = $cof;
        $this->urlca=$lien;
        $this->problemelien=$problem;
    }
    public function affich_general($i){
        $html = $this->render($i);
        return $html;
    }

    public function confirmer_envoie(){
        $html='<h1>Envoi de cadeau</h1><br>';
        $html=$html."Le cadeau à bien été envoyé à l'adresse : ".$this->coffret->mail;
        $html=$html.'<br>(Le lien cadeau est : '.$this->urlca.')';
        return $html;
    }

    private function affich_liste_cat(){
        $cat = Categorie::get();
        $this->tab=$cat;
        $page = '';
        $i = 1;
        foreach($this->tab as $pre){
            $page = $page. '<li><a href="../../'.$this->problemelien.'index.php/CatalogueController/affich_cat/'.$i.'">'.$pre->nom.'</a></li>';
            $i++;
        }
        
        $this->lienPrest = '../../../index.php/CatalogueController/affich_prest';
        $this->lienCat = '../../../index.php/CatalogueController/affich_cat';
        $this->lienAccueil = '../../..';
        
        return $page;
        
    }

    public function affich_contenu_coffret(){
        $html='<h2>Voici le contenu de ce cadeau :</h2><br><div id="fh5co-testimonial" class="fh5co-bg-section">
        <div class="container"><div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="row animate-box">
                        <div class="owl-carousel owl-carousel-fullwidth">
';
        $montant=0;
        $liste = Contient::prestations($this->coffret->id);
        $prest=array();

        foreach($liste as $p){
            $prest[] = Prestation::where('id', '=', $p->id_pre)->first();
        }
        foreach($prest as $pre){
            $html = $html .'<div class="item">
                                <div class="testimony-slide active text-center">
                                    <figure>
                                        <img src="../../images/'.$pre->img.'" alt="user" class="img-responsive">
                                    </figure><span>'. $pre->nom.'</span><blockquote> '.$pre->descr.'</blockquote></div>
                            </div>';

        }

        $html= $html . '<br></div></div></div></div></div></div><br>Voici le commentaire de '.$this->coffret->prenom.': '.$this->coffret->commentaire;
        $html=$html.'<br><br><a href="../../'.$this->problemelien.'"><strong>Retour à l'."'accueil</strong></a>";

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
        if($liste!=null && $prest != null){
        foreach($liste as $p){
            $prest[] = Prestation::where('id', '=', $p->id_pre)->first();
        }
        }
        $html = '';
        $montant = 0;
        if($liste!=null && $prest != null){
            foreach($prest as $pre){
                $html="<li>".$pre->nom." dune valeur de ".$pre->prix. " €</li>";
                $montant = $montant + $pre->prix;
            }
        }

        $html = $html . '<li>Montant total : ' . $montant . '</li><li><a href="../../'.$this->problemelien.'index.php/PaiementController/afficher_coffret_validation"><strong>Passer au paiement de la commande</strong></a></li>';

        return $html;
    }


    private function render($i)
    {
        if($i==1){
            $contenu=$this->confirmer_envoie();
        }elseif($i==2){
        $contenu=$this->affich_contenu_coffret();
        }else{

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
    <link rel="stylesheet" href="../../'.$this->problemelien.'css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="../../'.$this->problemelien.'css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="../../'.$this->problemelien.'css/bootstrap.css">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="../../'.$this->problemelien.'css/magnific-popup.css">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="../../'.$this->problemelien.'css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../'.$this->problemelien.'css/owl.theme.default.min.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="../../'.$this->problemelien.'css/style.css">

    <!-- Modernizr JS -->
    <script src="../../'.$this->problemelien.'js/modernizr-2.6.2.min.js"></script>
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
    <li ><a href="../../'.$this->problemelien.'">Accueil</a></li>
    <li class="has-dropdown" >
    <a href="../../../index.php/CatalogueController/affich_prest" >Catalogue</a>
    <ul class="dropdown">
    '.$content.'
    </ul>
    </li>
    <li><a href="../../'.$this->problemelien.'index.php/CagnotteController/form">Accéder à un coffret ou à une cagnotte</a></li>
    <li class="btn-cta"><a href="../../'.$this->problemelien.'index.php/ConnexionController/affich"><span>Connexion</span></a></li>
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
    <h1>Voici, ci dessous le contenu de votre coffret cadeau offert par '.$this->coffret->prenom.'</h1>
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
    <script src="../../'.$this->problemelien.'js/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="../../'.$this->problemelien.'js/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="../../'.$this->problemelien.'js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="../../'.$this->problemelien.'js/jquery.waypoints.min.js"></script>
    <!-- Stellar Parallax -->
    <script src="../../'.$this->problemelien.'js/jquery.stellar.min.js"></script>
    <!-- Carousel -->
    <script src="../../'.$this->problemelien.'js/owl.carousel.min.js"></script>
    <!-- countTo -->
    <script src="../../'.$this->problemelien.'js/jquery.countTo.js"></script>
    <!-- Magnific Popup -->
    <script src="../../'.$this->problemelien.'js/jquery.magnific-popup.min.js"></script>
    <script src="../../'.$this->problemelien.'js/magnific-popup-options.js"></script>
    <!-- Main -->
    <script src="../../'.$this->problemelien.'js/main.js"></script>

    </body>
    </html>';
        return $html;
    }
}