<?php

//definition du namespace
namespace giftbox\vue;
use giftbox\models\Categorie as Categorie;
use giftbox\models\Contient as Contient;
use giftbox\models\Prestation as Prestation;

//Classe vue pour le catalogue
class VueCatalogue {
    
    //prestations ou categories envoyees par le controller
    private $tab;
    //num de l'action a effectuer
    private $sel;
    //nul ou definissant la categorie ou la prestation a afficher sinon
    private $id;
    //liens vers d'autres pages flexibles selon ou on se trouve
    private $lien = '../../';
    public $methode='affich_prest_tri';
    
    //contructeur prenant en parametre des prestations ou des categories
    public function __construct( $tableau ){
        $this->tab = $tableau;
    }
    
    //methode qui permet d'aiguiller vers differents affichages selon les parametres
    public function affich_general( $selecteur, $id ){
        $this->sel = $selecteur;
        $this->id = $id;
        $html = $this->render();
        return $html;
    }
    
    //methode permettant d'afficher la liste des prestations
    private function affich_liste_prest($selec){
        if($selec == 'prestdepuiscat'){
                $this->lien = $this->lien.'../';
            }
        $page = '<h1> Liste des prestations </h1> <ul> ';
        foreach($this->tab as $pre){
            $cat = Categorie::where('id', '=', $pre->cat_id)->first();
            $page=$page.'<div class="col-lg-4 col-md-4">
            <div class="fh5co-blog animate-box">
            <a href="#"><img class="img-responsive" src="'.$this->lien.'images/'.$pre->img.'"alt=""></a>
            <div class="blog-text">
            <h3><a href="#">'.$pre->nom.'</a></h3>
            <span class="posted_on">'.$pre->prix.' €</span>
            <a href="'.$this->lien.'index.php/PrestationController/affich_prest/'.$pre->id.'" class="btn btn-primary">Lire plus</a>
            <br> Categorie: '.$cat->nom.'
            </div> 
            </div>
            </div>';
        }
        $this->methode='affich_prest_tri';
        return $page;

    }
    //methode premettant d'afficher la liste des categories
    private function affich_liste_cat_depuiscata(){
        $cat = Categorie::get();
        $this->tab=$cat;
        $page = '';
        $i = 1;
        foreach($this->tab as $pre){
            $page = $page. '<li><a href="'.$this->lien.'index.php/CatalogueController/affich_cat/'.$i.'">'.$pre->nom.'</a></li>';
            $i++;
        }
        return $page;
        
    }

    private function affich_liste_cat_depuiscat(){
        $cat = Categorie::get();
        $this->tab=$cat;
        $page = '';
        $i = 1;
        $this->lien = $this->lien.'../';
        foreach($this->tab as $pre){
            $page = $page. '<li><a href="'.$this->lien.'index.php/CatalogueController/affich_cat/'.$i.'">'.$pre->nom.'</a></li>';
            $i++;
        }
        return $page;
        
    }

    private function affich_liste_cat_depuiscatcat(){
        $cat = Categorie::get();
        $this->tab=$cat;
        $page = '';
        $i = 1;
        $this->lien = $this->lien.'../../';
        foreach($this->tab as $pre){
            $page = $page. '<li><a href="'.$this->lien.'index.php/CatalogueController/affich_cat/'.$i.'">'.$pre->nom.'</a></li>';
            $i++;
        }
        
        return $page;
        
    }
    
    //methode permettant d'afficher les prestations d'une cateogie en particulier
    private function affich_liste_prest_par_cat(){
        $cat = Categorie::where('id', '=', $this->id)->first();
        $nom = $cat->nom;
        $this->lien = $this->lien.'../';
        $page = '<h1> Prestations de la catégorie: '.$nom.'</h1> <ul>';
        $i = 1;
        foreach($this->tab as $pre){
            $cat = Categorie::where('id', '=', $pre->cat_id)->first();
            $page=$page.'<div class="col-lg-4 col-md-4">
            <div class="fh5co-blog animate-box">
            <a href="#"><img class="img-responsive" src="../../../images/'.$pre->img.'"alt=""></a>
            <div class="blog-text">
            <h3><a href="#">'.$pre->nom.'</a></h3>
            <span class="posted_on">'.$pre->prix.' €</span>
            <a href="'.$this->lien.'index.php/PrestationController/affich_prest/'.$pre->id.'" class="btn btn-primary">Lire plus</a>
             <br> Categorie: '.$cat->nom.'
            </div> 
            </div>
            </div>';
            $i++;
        }
        
         $this->methode='affich_cat_tri/'.$this->id;
        
        return $page;
    }

     private function affich_liste_prest_par_catdepuiscat(){
        $cat = Categorie::where('id', '=', $this->id)->first();
        $nom = $cat->nom;
        $this->lien = $this->lien.'../../';
        $page = '<h1> Prestations de la catégorie: '.$nom.'</h1> <ul>';
        $i = 1;
        foreach($this->tab as $pre){
            $cat = Categorie::where('id', '=', $pre->cat_id)->first();
            $page=$page.'<div class="col-lg-4 col-md-4">
            <div class="fh5co-blog animate-box">
            <a href="#"><img class="img-responsive" src="../../../../images/'.$pre->img.'"alt=""></a>
            <div class="blog-text">
            <h3><a href="#">'.$pre->nom.'</a></h3>
            <span class="posted_on">'.$pre->prix.' €</span>
            <a href="'.$this->lien.'index.php/PrestationController/affich_prest/'.$pre->id.'" class="btn btn-primary">Lire plus</a>
             <br> Categorie: '.$cat->nom.'
            </div> 
            </div>
            </div>';
            $i++;
        }
        $this->methode='affich_cat_tri/'.$this->id;
        
        return $page;
    }

    public function affich_coffret1(){
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
        if($liste!=null && $prest != null){
            foreach($prest as $pre){
                $html=$html."<li>".$pre->nom." d'une valeur de ".$pre->prix. " €</li>";
                $montant = $montant + $pre->prix;
            }
        }

        $html = $html . '<li>Montant total : ' . $montant . '</li><li><a href="'.$this->lien.'index.php/PaiementController/afficher_coffret_validation "><strong>Passer au paiement de la commande</strong></a></li>';

        return $html;
    }
    
    //methode qui permet un affichage general des pages en y ajoutant le bon script selon l'action demandee par l'utilisateur
    private function render(){
       $content=0;
        switch ($this->sel) {
            case 1 :
                $content = $this->affich_liste_prest(null);
            break;
            case 2 :
                $content = $this->affich_liste_prest('prestdepuiscat');
            break;
            case 3 :
                $content = $this->affich_liste_prest_par_cat();
            break;
            case 4 :
                $content = $this->affich_liste_prest_par_catdepuiscat();
            break;
        }
        
         $html = '
    <!DOCTYPE HTML>
    <html>
    <head>
    <meta charset="utf-8">
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
    <link rel="stylesheet" href="'.$this->lien.'css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="'.$this->lien.'css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="'.$this->lien.'css/bootstrap.css">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="'.$this->lien.'css/magnific-popup.css">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="'.$this->lien.'css/owl.carousel.min.css">
    <link rel="stylesheet" href="'.$this->lien.'css/owl.theme.default.min.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="'.$this->lien.'css/style.css">

    <!-- Modernizr JS -->
    <script src="'.$this->lien.'js/modernizr-2.6.2.min.js"></script>
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
    <li ><a href="'.$this->lien.'">Accueil</a></li>
    <li class="has-dropdown" >
    <a href="'.$this->lien.'index.php/CatalogueController/affich_prest" >Catalogue</a>
    <ul class="dropdown">
    '.$this->affich_liste_cat_depuiscata().'
    </ul>
    </li>
    <li><a href="../../index.php/CagnotteController/form">Accéder à un coffret ou à une cagnotte</a></li>
    <li class="btn-cta"><a href="'.$this->lien.'index.php/ConnexionController/affich"><span>Connexion</span></a></li>
    <li class="has-dropdown">
    <a href="#"><span>Coffret</span></a>
    <ul class="dropdown">
    <li><a href="#">Voici le contenu actuel du coffret :</a></li>
                                         '.$this->affich_coffret1().'
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
    <h1>Catalogue</h1>
    <h2>Sur ce catalogue, vous pourrez trouver tous les produits proposés par Gift<a href="#">Box</a></h2>
    <a href="'.$this->lien.'index.php/CatalogueController/'.$this->methode.'/desc" class="btn btn-lg">Trier par prix décroissant</a>
    <a href="'.$this->lien.'index.php/CatalogueController/'.$this->methode.'/asc" class="btn btn-lg">Trier par prix croissant</a>
    </div>
    </div>
    </div>
    </div>
    </div>
    </header>
    <div id="fh5co-blog">
    <div class="container">
    <div class="row">'.$content.'</div>
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
                        '.$this->affich_liste_cat_depuiscata().'
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
    <script src="'.$this->lien.'js/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="'.$this->lien.'js/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="'.$this->lien.'js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="'.$this->lien.'js/jquery.waypoints.min.js"></script>
    <!-- Stellar Parallax -->
    <script src="'.$this->lien.'js/jquery.stellar.min.js"></script>
    <!-- Carousel -->
    <script src="'.$this->lien.'js/owl.carousel.min.js"></script>
    <!-- countTo -->
    <script src="'.$this->lien.'js/jquery.countTo.js"></script>
    <!-- Magnific Popup -->
    <script src="'.$this->lien.'js/jquery.magnific-popup.min.js"></script>
    <script src="'.$this->lien.'js/magnific-popup-options.js"></script>
    <!-- Main -->
    <script src="'.$this->lien.'js/main.js"></script>

    </body>
    </html>
    ';
        return $html;
    }
}