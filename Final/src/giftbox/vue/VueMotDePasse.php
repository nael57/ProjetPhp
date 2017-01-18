<?php

//definition du namespace
namespace giftbox\vue;
use giftbox\models\Categorie as Categorie;
use giftbox\models\Prestation as Prestation;
use giftbox\models\Contient as Contient;
//Classe vue pour le catalogue
class VueMotDePasse {
    private $atr;
    private $tab;
    private $lien="";
  public function __construct( $tableau,$l="" ){
        $this->atr = $tableau;
        $this->lien=$l;
    }

    public function affich_general($i){
        $html = $this->render();
        return $html;
    }

    private function affich_liste_cat(){
        $cat = Categorie::get();
        $this->tab=$cat;
        $page = '';
        $i = 1;
        foreach($this->tab as $pre){
            $page = $page. '<li><a href="'.$this->lien.'../../index.php/CatalogueController/affich_cat/'.$i.'">'.$pre->nom.'</a></li>';
            $i++;
        }
        
        return $page;
        
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
        if($liste!=null && $prest != null){
        foreach($prest as $pre){
            $html="<li>".$pre->nom." d'une valeur de ".$pre->prix. " €</li>";
            $montant = $montant + $pre->prix;
        }
    }
        
        $html = $html . '<li>Montant total : ' . $montant . '</li><li><a href="'.$this->lien.'../../index.php/PaiementController/afficher_paiement"><strong>Passer au paiement de la commande</strong></a></li>';
        
        return $html;
    }

    private function render()
    {
        $content = $this->affich_liste_cat();
        $html = '
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
    <link rel="stylesheet" href="'.$this->lien.'../../css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="'.$this->lien.'../../css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="'.$this->lien.'../../css/bootstrap.css">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="'.$this->lien.'../../css/magnific-popup.css">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="'.$this->lien.'../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="'.$this->lien.'../../css/owl.theme.default.min.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="'.$this->lien.'../../css/style.css">

    <!-- Modernizr JS -->
    <script src="'.$this->lien.'../../js/modernizr-2.6.2.min.js"></script>
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
                                <li ><a href="'.$this->lien.'../../">Accueil</a></li>
                                <li class="has-dropdown" >
                                    <a href="'.$this->lien.'../../index.php/CatalogueController/affich_prest" >Catalogue</a>
                                    <ul class="dropdown">
                                        '.$content.'
                                    </ul>
                                </li>
                                <li><a href="'.$this->lien.'../../index.php/CagnotteController/form">Accéder à un coffret ou à une cagnotte</a></li>
                                <li class="btn-cta"><a href="'.$this->lien.'../../index.php/ConnexionController/affich"><span>Connexion</span></a></li>
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
                                <h1>Cet élément est protégé par un mot de passe, veuillez le saisir</h1>
                                <form action="'.$this->lien.'../../index.php/CagnotteController/affich_cofmdp/'.$this->atr.'" method="post"><p>
                                <table><tr>
                                   <tr><td> Mot de passe </td> <td><input type="password" name="mdp" /></td></tr>
                                  <td> <br><br><br><input type="submit" value="Accéder"></td>
                                    </table>
                                </form><br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
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
                        <h4>Nos partenaires</h4>
                        <ul class="fh5co-footer-links">
                        <li><a href="http://iut-charlemagne.univ-lorraine.fr/" target="_blank">IUT Charlemagne</a></li>
                        <li><a href="#">Cours en PHP de Monsieur B.</a></li>
                        <li><a href="https://openclassrooms.com/" target="_blank">OpenClassroom</a></li>
                        <li><a href="https://www.youtube.com/?gl=FR&hl=fr" target="_blank">Youtube</a></li>
                        </ul>
                    </div>

                    <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1">
                        <h4>Connexion</h4>
                        <ul class="fh5co-footer-links">
                            <li><a href="'.$this->lien.'../../index.php/ConnexionController/affich">Se connecter</a></li>
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
    <script src="'.$this->lien.'../../js/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="'.$this->lien.'../../js/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="'.$this->lien.'../../js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="'.$this->lien.'../../js/jquery.waypoints.min.js"></script>
    <!-- Stellar Parallax -->
    <script src="'.$this->lien.'../../js/jquery.stellar.min.js"></script>
    <!-- Carousel -->
    <script src="'.$this->lien.'../../js/owl.carousel.min.js"></script>
    <!-- countTo -->
    <script src="'.$this->lien.'../../js/jquery.countTo.js"></script>
    <!-- Magnific Popup -->
    <script src="'.$this->lien.'../../js/jquery.magnific-popup.min.js"></script>
    <script src="'.$this->lien.'../../js/magnific-popup-options.js"></script>
    <!-- Main -->
    <script src="'.$this->lien.'../../js/main.js"></script>

</body>
</html>';
        return $html;
    }
}