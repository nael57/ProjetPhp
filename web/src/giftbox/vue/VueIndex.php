<?php

//definition du namespace
namespace giftbox\vue;
use giftbox\models\Categorie as Categorie;

//Classe qui premet l'affichage de 'lindex
class VueIndex {
    
    //contructeur vide
    public function __contruct(){}


     public function affich_general( $selecteur, $id ){
        $this->sel = $selecteur;
        $this->id = $id;
        $html = $this->render();
        return $html;
    }
    private function affich_liste_cat(){
        $cat = Categorie::get();
        $this->tab=$cat;
        $page = '';
        $i = 1;
        foreach($this->tab as $pre){
            $page = $page. '<li><a href="../../index.php/CatalogueController/affich_cat/'.$i.'.">'.$pre->nom.'</a></li>';
            $i++;
        }
        
        $this->lienPrest = '../../Index.php/CatalogueController/affich_prest';
        $this->lienCat = '../../Index.php/CatalogueController/affich_cat';
        $this->lienAccueil = '../..';
        
        return $page;
        
    }
    
    

    //methode qui permet un affichage de l'index
    public function affichage(){
        $html = '
        <!DOCTYPE HTML>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GiftBox, offrez du rêve</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
    <meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
    <meta name="author" content="freehtml5.co" />

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
                        <div id="fh5co-logo"><a href="index.html">Gift<span>Box</span></a></div>
                    </div>
                    <div class="col-xs-11 text-right menu-1">
                        <ul>
                            <li class="active"><a href="index.html">Accueil</a></li>
                            <li><a href="courses.html">Concept</a></li>
                            <li class="has-dropdown">
                                <a href="catalogue.php">Catalogue</a>
                                <ul class="dropdown">
                                    '.$this->affich_liste_cat().'
                                </ul>
                            </li>
                            <li><a href="contact.html">Qui sommes nous ?</a></li>
                            <li class="btn-cta"><a href="#"><span>Connexion</span></a></li>
                            <li class="has-dropdown">
                                <a href="#"><span>Panier</span></a>
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

    <header id="fh5co-header" class="fh5co-cover" role="banner" style="background-image:url(images/img_bg_1.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="display-t">
                        <div class="display-tc animate-box" data-animate-effect="fadeIn">
                            <h1>GiftBox, offrez un moment de bonheur !</h1>
                            <h2>Offrez un coffret de <a href="#">rêve</a> à vos proches</h2>
                            <p><a class="btn btn-primary btn-lg btn-learn" href="LIEN POUR PRESENTER CONCEPT">Quel est le concept ?</a> <a class="btn btn-primary btn-lg popup-vimeo btn-video"METTRE LE LIEN CATALOGUE"><i class="icon-play"></i>Voir notre catalogue</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div id="fh5co-counter" class="fh5co-counters">
        <div class="container">
            <div class="row">
                <div class="col-md-3 text-center animate-box">
                    <span class="fh5co-counter js-counter" data-from="0" data-to="1348" data-speed="4000" data-refresh-interval="50"></span>
                    <span class="fh5co-counter-label">Clients satisfaits</span>
                </div>
                <div class="col-md-3 text-center animate-box">
                    <span class="fh5co-counter js-counter" data-from="0" data-to="123" data-speed="4000" data-refresh-interval="50"></span>
                    <span class="fh5co-counter-label">Partenaires de confiance</span>
                </div>
                <div class="col-md-3 text-center animate-box">
                    <span class="fh5co-counter js-counter" data-from="0" data-to="27" data-speed="4000" data-refresh-interval="50"></span>
                    <span class="fh5co-counter-label">Prestations proposées</span>
                </div>
                <div class="col-md-3 text-center animate-box"><!-- Mettre dans le data-to le nombre courant darticle dans lpanier -->
                    <span class="fh5co-counter js-counter" data-from="0" data-to="0" data-speed="4000" data-refresh-interval="50"></span>
                    <span class="fh5co-counter-label">Prestations dans votre panier</span>
                </div>
            </div>
            
        </div>
    </div>

    <div id="fh5co-explore" class="fh5co-bg-section">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
                    <h2>Le concept Gift<a href="#">Box</a></h2>
                    <p>Offrir en un clic des dizaines de produits tous aussi originaux les uns que les autres. Ne perdez plus de temps à chercher en magasin: les meilleures idées cadeaux sont sur GiftBox !</p>
                </div>
            </div>
        </div>      
        <div id="fh5co-steps">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2><strong>Créer un coffret personnalisé na jamais été aussi simple !</strong></h2>
                </div>
            </div>

            <div class="row bs-wizard animate-box" style="border-bottom:0;">
                
                <div class="col-xs-3 bs-wizard-step complete">
                    <div class="text-center bs-wizard-stepnum"><h4>Étape 1</h4></div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="#" class="bs-wizard-dot"></a>
                    <div class="bs-wizard-info text-center"><p>Choisissez les prestations</p></div>
                </div>

                <div class="col-xs-3 bs-wizard-step active"><!-- complete -->
                    <div class="text-center bs-wizard-stepnum"><h4>Étape 2</h4></div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="#" class="bs-wizard-dot"></a>
                    <div class="bs-wizard-info text-center"><p>Validez votre coffret</p></div>
                </div>

                <div class="col-xs-3 bs-wizard-step disabled"><!-- complete -->
                    <div class="text-center bs-wizard-stepnum"><h4>Étape 3</h4></div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="#" class="bs-wizard-dot"></a>
                    <div class="bs-wizard-info text-center"><p>Payez le coffret directement ou via une cagnotte</p></div>
                </div>

                <div class="col-xs-3 bs-wizard-step disabled"><!-- active -->
                    <div class="text-center bs-wizard-stepnum"><h4>Étape 4</h4></div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="#" class="bs-wizard-dot"></a>
                    <div class="bs-wizard-info text-center"><p>Envoyez le coffret à votre proche</p></div>
                </div>
            </div>

        </div>
    </div>
        <div class="fh5co-explore fh5co-explore1">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-push-5 animate-box">
                        <img class="img-responsive" src="images/partenaire.jpg" alt="work">
                    </div>
                    <div class="col-md-4 col-md-pull-8 animate-box">
                        <div class="mt">
                            <h3>Un panel de partenaires impressionnant</h3>
                            <p>Aves des années de travail, GiftBox a su sentourer des meilleurs partenaires nationaux afin de proposer des prestations de qualité à des prix défiants toute concurrence.</p>
                            <ul class="list-nav">
                                <li><i class="icon-check2"></i>Des prestations de qualité</li>
                                <li><i class="icon-check2"></i>Satisfaction garantie</li>
                                <li><i class="icon-check2"></i>Entièrement sécurisé</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fh5co-explore">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-pull-1 animate-box">
                        <img class="img-responsive" src="images/dev.jpg" alt="work">
                    </div>
                    <div class="col-md-4 animate-box">
                        <div class="mt">
                            <div>
                                <h4><i class="icon-user"></i>Des clients satisfaits </h4>
                                <p>Notre service client est disponible 24/24 et 7/7 pour vous conseiller et vous aider.</p>
                            </div>
                            <div>
                                <h4><i class="icon-video2"></i>Une équipe engagée</h4>
                                <p>Une équipe de 5 programmateurs/commerciaux dévoués vous assure la stabilité du service ainsi quun large panel de prestations de qualité.</p>
                            </div>
                            <div>
                                <h4><i class="icon-shield"></i>Un développement inégalé</h4>
                                <p>GiftBox se développe de plus en plus à léchelle nationale, de ce fait, nous obtenons les meilleurs clients ainsi que les meilleurs tarifs.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <div id="fh5co-project">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2><strong>Catalogue</strong></h2>
                    <p>Voici les prestations les plus populaires du moment</p>
                </div>
            </div>
        </div>
        <div class="container-fluid proj-bottom">
            <!--  METTRE DE MANIÈRE DYNAMIQUE LES 6 MEILLEURS ACHATS DU MOMENT AVEC LES IMAGES ASSOCIÉES -->
            <div class="row">
                <div class="col-md-4 col-sm-6 fh5co-project animate-box" data-animate-effect="fadeIn">
                    <a href="#"><img src="images/animateur.jpg" class="img-responsive">
                        <h3>Un cours dAqua-Gym</h3>
                        <span>Plus dinfos</span>
                    </a>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center animate-box">
                    <p><a class="btn btn-primary btn-lg btn-learn" href="#">Acceder au catalogue complet</a></p>
                </div>
            </div>
        </div>
    </div>

    

    <div id="fh5co-testimonial" class="fh5co-bg-section">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
                    <h2>Qui sommes nous ?</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="row animate-box">
                        <div class="owl-carousel owl-carousel-fullwidth">
                            <div class="item">
                                <div class="testimony-slide active text-center">
                                    <figure>
                                        <img src="images/nael.jpg" alt="user">
                                    </figure>
                                    <span>Nael Bouzaza</span>
                                    <blockquote>
                                        <p>&ldquo;Je moccupe de toute la partie design ainsi que la recherche de prestations et lamélioration du code interne permettant ainsi au site dêtre le plus optimisé possible pour nos clients&rdquo;</p>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimony-slide active text-center">
                                    <figure>
                                        <img src="images/leo.jpg" alt="user">
                                    </figure>
                                    <span>Léo Claudel</span>
                                    <blockquote>
                                        <p>&ldquo;Je moccupe de toute la partie design ainsi que la recherche de prestations et lamélioration du code interne permettant ainsi au site dêtre le plus optimisé possible pour nos clients&rdquo;</p>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimony-slide active text-center">
                                    <figure>
                                        <img src="images/tolga.jpg" alt="user">
                                    </figure>
                                    <span>Tolga Gurel</span>
                                    <blockquote>
                                        <p>&ldquo;Je moccupe de toute la partie design ainsi que la recherche de prestations et lamélioration du code interne permettant ainsi au site dêtre le plus optimisé possible pour nos clients&rdquo;</p>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimony-slide active text-center">
                                    <figure>
                                        <img src="images/pierre.jpg" alt="user">
                                    </figure>
                                    <span>Pierre Biermann</span>
                                    <blockquote>
                                        <p>&ldquo;Je moccupe de toute la partie design ainsi que la recherche de prestations et lamélioration du code interne permettant ainsi au site dêtre le plus optimisé possible pour nos clients&rdquo;</p>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimony-slide active text-center">
                                    <figure>
                                        <img src="images/flo.jpg" alt="user">
                                    </figure>
                                    <span>Florian Savouroux</span>
                                    <blockquote>
                                        <p>&ldquo;Je moccupe de toute la partie design ainsi que la recherche de prestations et lamélioration du code interne permettant ainsi au site dêtre le plus optimisé possible pour nos clients&rdquo;</p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
</html>


        ';
        return $html;
    }
}