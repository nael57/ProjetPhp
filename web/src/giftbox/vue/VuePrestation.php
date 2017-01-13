<?php

//definition du namespace
namespace giftbox\vue;

//Classe vue pour le catalogue
class VuePrestation {

    //prestation envoyee par le controller
    private $prestation;
    
    public function __construct( $presta ){
        $this->prestation = $presta;
    }
    
    private function affich_liste_cat(){
        $cat = Categorie::get();
        $this->tab=$cat;
        $page = '';
        $i = 1;
        foreach($this->tab as $pre){
            $page = $page. '<li><a href="index.php/CatalogueController/affich_cat/'.$i.'">'.$pre->nom.'</a></li>';
            $i++;
        }
        
        $this->lienPrest = '../../../index.php/CatalogueController/affich_prest';
        $this->lienCat = '../../../index.php/CatalogueController/affich_cat';
        $this->lienAccueil = '../../..';
        
        return $page;
        
    }
    $html='

    <!DOCTYPE HTML>
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
    <link rel="stylesheet" href="css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="css/magnific-popup.css">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Modernizr JS -->
    <script src="js/modernizr-2.6.2.min.js"></script>
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
    <div id="fh5co-logo"><a href="index.php">Gift<span>Box</span></a></div>
    </div>
    <div class="col-xs-11 text-right menu-1">
    <ul>
    <li ><a href="index.php">Accueil</a></li>
    <li><a href="courses.html">Concept</a></li>
    <li class="has-dropdown" >
    <a href="catalogue.php" >Catalogue</a>
    <ul class="dropdown">
    <!--'.$this->affich_liste_cat().'-->
    </ul>
    </li>
    <li><a href="contact.html">Qui sommes nous ?</a></li>
    <li class="btn-cta"><a href="#"><span>Connexion</span></a></li>
    <li class="has-dropdown">
    <a href="#"><span>Coffret</span></a>
    <ul class="dropdown">
    <li><a href="#">Votre coffret est actuellement vide !</a></li>
    <!-- METTRE LES ARTICLES DYNAMIQUEMENT LÀ -->
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
    <h1>'.$prestation->nom.'</h1>
    <h2>METTRE LA PHOTO ICI</h2>
    </div>
    </div>
    </div>
    </div>
    </div>
    </header>
    <div id="fh5co-blog">
    <div class="container">
    <div class="row">'.$prestation->description.'</div>
    <div class="row">'.$prestation->prix.'</div>
    <div class="row">METTRE LAJOUT AU PANIER</div>
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
                        '.$this->affich_liste_cat().'
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
    <script src="js/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="js/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="js/jquery.waypoints.min.js"></script>
    <!-- Stellar Parallax -->
    <script src="js/jquery.stellar.min.js"></script>
    <!-- Carousel -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- countTo -->
    <script src="js/jquery.countTo.js"></script>
    <!-- Magnific Popup -->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/magnific-popup-options.js"></script>
    <!-- Main -->
    <script src="js/main.js"></script>

    </body>
    </html>';
    return $html;
}