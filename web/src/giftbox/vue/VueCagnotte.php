<?php

//definition du namespace
namespace giftbox\vue;
use giftbox\models\Prestation as Prestation;
use giftbox\models\Categorie as Categorie;
use giftbox\models\Contient as Contient;
//Classe vue pour le catalogue
class VueCagnotte {
    private $problemelien;
    //prestation envoyee par le controller
    private $presta;
    private $coffret;
    private $titre;

    public function __construct($coff=null,$po=null,$probleme=null,$cagnott=null){
        $this->presta = $po;
        $this->coffret=$coff;
        $this->cagnotte=$cagnott;
        $this->problemelien=$probleme;
        $this->titre="<h1>Entrez votre lien dans la case correspondante</h1>";
    }

    public function affich_general($i){
        $html=$this->render($i);
        return $html;

    }
    public function affich_form(){
        $html='<h1> Accéder à un cadeau</h1>';
        $html=$html.'<br>
    <div class="row"></div><h3>
    Veuillez saisir votre identifiant cadeau</h3><br><br>
    <form action="../../index.php/CagnotteController/affich_coffret" method="post">
     <table>              
                  <tr>
                    <td>Identifiant : </td>
                    <td> <input type="text" name="liencadeau" required/><br></td>
                  </tr>
    </table><br>
    <input type="submit" name="valider" value="Valider">
    
    </form>';

    $html=$html.'<br><br><br><h1> Accéder à une cagnotte</h1> <br>
    <div class="row"></div><h3>
    Veuillez saisir votre identifiant cagnotte</h3><br><br>
    <form action="../../index.php/CagnotteController/affich_cagnotte" method="post">
     <table>              
                  <tr>
                    <td>Identifiant : </td>
                    <td> <input type="text" name="lien2" required/><br></td>
                  </tr>
    </table><br>
    <input type="submit" name="valider" value="Valider">
    
    </form>';

    $html=$html.'<br><br><br><h1> Accéder à la gestion d'."'une cagnotte</h1>".' <br>
    <div class="row"></div><h3>
    Veuillez saisir votre identifiant cagnotte</h3><br><br>
    <form action="../../index.php/CagnotteController/afficher_gestion_cagnotte" method="post">
     <table>              
                  <tr>
                    <td>Identifiant : </td>
                    <td> <input type="text" name="lien3" required/><br></td>
                  </tr>
    </table><br>
    <input type="submit" name="valider" value="Valider">
    
    </form>';

        $html=$html.'<br><br><br><h1> Accéder à la gestion d'."'un coffret</h1>".' <br>
    <div class="row"></div><h3>
    Veuillez saisir votre identifiant coffret</h3><br><br>
    <form action="../../index.php/CagnotteController/affich_gestion" method="post">
     <table>              
                  <tr>
                    <td>Identifiant : </td>
                    <td> <input type="text" name="lien4" required/><br></td>
                  </tr>
    </table><br>
    <input type="submit" name="valider" value="Valider">
    
    </form>';
        return $html;
    }

    public function affich_form_erreur(){

        $html='<br>
    <div class="row"></div><h1> Accéder à un cadeau</h1>';
        $html=$html.'<br>
    <div class="row"></div><h3>
    <font color="red">Veuillez saisir un lien valide</font><br><br>
    Veuillez saisir votre identifiant cadeau</h3><br><br>
    <form action="../../index.php/CagnotteController/affich_coffret" method="post">
     <table>              
                  <tr>
                    <td>Identifiant : </td>
                    <td> <input type="text" name="liencadeau" required/><br></td>
                  </tr>
    </table><br>
    <input type="submit" name="valider" value="Valider">
    
    </form>';

        $html=$html.'<br><br><br><h1> Accéder à une cagnotte</h1> <br>
    <div class="row"></div><h3>
    Veuillez saisir votre identifiant cagnotte</h3><br><br>
    <form action="../../index.php/CagnotteController/affich_cagnotte" method="post">
     <table>              
                  <tr>
                    <td>Identifiant : </td>
                    <td> <input type="text" name="lien2" required/><br></td>
                  </tr>
    </table><br>
    <input type="submit" name="valider" value="Valider">
    
    </form>';

        $html=$html.'<br><br><br><h1> Accéder à la gestion d'."'une cagnotte</h1>".' <br>
    <div class="row"></div><h3>
    Veuillez saisir votre identifiant cagnotte</h3><br><br>
    <form action="../../index.php/CagnotteController/afficher_gestion_cagnotte" method="post">
     <table>              
                  <tr>
                    <td>Identifiant : </td>
                    <td> <input type="text" name="lien3" required/><br></td>
                  </tr>
    </table><br>
    <input type="submit" name="valider" value="Valider">
    
    </form>';

        $html=$html.'<br><br><br><h1> Accéder à la gestion d'."'un coffret</h1>".' <br>
    <div class="row"></div><h3>
    Veuillez saisir votre identifiant coffret</h3><br><br>
      <form action="../../index.php/CagnotteController/affich_gestion" method="post">
         <table>              
                      <tr>
                        <td>Identifiant : </td>
                        <td> <input type="text" name="lien4" required/><br></td>
                      </tr>
        </table>
        <input type="submit" name="valider" value="Valider">
        
     </form>';
        return $html;
    }

    public function affich_contenu_coffret(){
        $this->titre='<h1>Voici le contenu du coffret</h1>';
        $html='';
        $montant=0;
        foreach($this->presta as $pre){
            $html = $html .'<img src="../../'.$this->problemelien.'images/'.$pre->img.'" class="img-responsive">'. $pre->nom.' '.$pre->descr.' '.$pre->prix.'€';
            $html= $html.'      <a class="btn btn-primary btn-lg btn-learn" href="../../'.$this->problemelien.'index.php/CagnotteController/supp_prest/' . $this->coffret->id . '/'.$pre->id.'">Supprimer</a><br>';
            $prix = $pre->prix;
            $montant = $montant + $prix;
        }

        $html=$html.'<br> Montant total :'.$montant;
        if($this->coffret->etatcadeau!=null){

            $html=$html.'<br><br>Voici '."l'état de votre Cadeau : ".$this->coffret->etatcadeau;
            if($this->coffret->dateouverture!=null){
                $html=$html.'<br>Date : '.$this->coffret->dateouverture;
            }
        }
        $html=$html.'<br><br><a href="../../'.$this->problemelien.'"><strong>Retour à l'."'accueil</strong></a>";

        return $html;
    }

    public function affich_gestion_cagnotte(){
        $this->titre='<h1>Voici le contenu de votre cagnotte</h1>';
        $html='';
        $montant=0;
        foreach($this->presta as $pre){
            $html = $html .'<img src="../../'.$this->problemelien.'images/'.$pre->img.'" class="img-responsive">'. $pre->nom.' '.$pre->descr.' '.$pre->prix.'€';
            $html= $html.'      <a class="btn btn-primary btn-lg btn-learn" href="../../'.$this->problemelien.'index.php/CagnotteController/supp_prest/' . $this->coffret->id . '/'.$pre->id.'">Supprimer</a><br>';
            $prix = $pre->prix;
            $montant = $montant + $prix;
        }

        $html=$html.'<br> Montant total :'.$montant;

        $html=$html.'<br> Contribution total :'.$this->cagnotte->contribution;

        $html=$html.'<br><br><a href="../../'.$this->problemelien.'/CagnotteController/cloturer_cangotte"><strong>Clôturer cagnotte</strong></a>';

        $html=$html.'<br><br><a href="../../'.$this->problemelien.'"><strong>Retour à l'."'accueil</strong></a>";

        return $html;
    }

    public function affich_cagnotte(){
        $html='Voici le contenu de ce cagnotte :<br>';
        $montant=0;
        if($this->presta!=null){
            foreach($this->presta as $pre){
                $html = $html .'<br><br><img src="../../'.$this->problemelien.'images/'.$pre->img.'" class="img-responsive">'. $pre->nom.' '.$pre->descr;

                $prix = $pre->prix;
                $montant = $montant + $prix;
            }



            $html=$html.'<br><br> Montant total : '.$montant.'€';
            $html=$html.'<br><br> Contribution total : '.$this->cagnotte->contribution;

            $html=$html.'<br><br><a class="btn btn-primary btn-lg btn-learn" href="../../'.$this->problemelien.'index.php/CagnotteController/participer_cagn/'.$this->cagnotte->idcagnotte.'">Participer à la cagnotte</a>';
            $html=$html.'<br><br><a class="btn btn-primary btn-lg btn-learn" href="../../'.$this->problemelien.'">Retour à l'."'accueil".'</a>';
        }
        return $html;
    }

    public function confirmer_paiement(){
        $html='<h1>Merci pour votre contribution</h1><br>';
        $html=$html.$this->affich_cagnotte();
        return $html;
    }

    public function affich_participation(){
        $html='<h1> Participer à une cagnotte</h1><br>
        <div class="row"></div><h3>
        Veuillez saisir le montant de votre participation</h3><br><br>
        <form action="../../../index.php/CagnotteController/confirmer_paiement/'.$this->cagnotte->idcagnotte.'" method="post">
         <table>              
                      <tr>
                        <td>Montant : </td>
                        <td> <input type="number" name="montant" required/><br></td>
                      </tr>
        </table><br>
        <input type="submit" name="valider" value="Valider">
        
        </form>';

        return $html;
    }

    public function affich_coffret()
    {
        if (isset($_COOKIE['panier'])) {
            $liste = Contient::prestations($_COOKIE['panier']);
        } else {
            $liste = null;
        }
        $prest = null;
        if ($liste != null) {
            foreach ($liste as $p) {
                $prest[] = Prestation::where('id', '=', $p->id_pre)->first();
            }
        }
        $html = '';
        $montant = 0;
        if ($liste != null && $prest != null) {
            foreach ($prest as $pre) {
                $html = "<li>" . $pre->nom . " dune valeur de " . $pre->prix . " €</li>";
                $montant = $montant + $pre->prix;
            }
        }

        $html = $html . '<li>Montant total : ' . $montant . '</li><li><a href="../../'.$this->problemelien.'index.php/PaiementController/afficher_coffret_validation"><strong>Passer au paiement de la commande</strong></a></li>';

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

    private function render($i)
    {
        if($i==2){
            $contenu=$this->affich_contenu_coffret();
        }elseif($i==3){
            $contenu=$this->affich_form_erreur();
        }elseif ($i==4){
            $contenu=$this->affich_cagnotte();
        }elseif($i==10){
            $contenu=$this->affich_participation();
        }elseif ($i==11){
            $contenu=$this->confirmer_paiement();
        }elseif ($i==15){
            $contenu=$this->affich_gestion_cagnotte();
        }else{
            $contenu=$this->affich_form();
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
    <a href="../../index.php/CatalogueController/affich_prest" >Catalogue</a>
    <ul class="dropdown">
    '.$content.'
    </ul>
    </li>
    <li><a href="../../index.php/CagnotteController/form">Accéder à un coffret ou à une cagnotte</a></li>
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
    '.$this->titre.'
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