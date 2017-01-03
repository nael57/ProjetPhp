<?php

namespace giftbox\vue;
use giftbox\models\Prestation as Prestation;

class VueCoffret {
    
    private $tab;
    private $sel;
    private $id;

    public function __construct($tableau){
        $this->tab = $tableau;
    }
    
    public function affich_general($int, $id){
        $this->sel = $int;
        $this->id = $id;
        $html = $this->render();
        echo $html;
    }
    
    public function ajout_prest(){
        $html = 'La prestation n°' . $this->id . ' a été ajoutée au panier !';
        return $html;
    }
    
    public function affich_coffret(){
        $html = '<h2> Votre coffret cadeau </h2> <br><br>';
        
        foreach($this->tab as $pre){
            $html = $html . $pre;
        }
        return $html;
    }
    
    public function render(){
        $content = '';
        switch ($this->sel){
            case 1 :
                $content = $this->ajout_prest();
            break;
            case 2 :
                $content = $this->affich_coffret();
            break;
        }
        
        $html = '
        <!DOCTYPE html>
        <html lang="fr">
        <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title> Ajouté au panier </title>
            <meta charset="utf-8"><link rel="stylesheet" href="../../../../../DocRoot/Projet_php/projet.css"><style type="text/css"></style>
        </head>
        <boby>
            <nav>
                <br><br>
                <a href="../../../../../DocRoot/Projet_php/Index.php/CatalogueController/affich_prest">Liste des prestations</a>
                <br><br>
                <a href="../../../../../DocRoot/Projet_php/Index.php/CatalogueController/affich_prest/12">Description de la prestation 12 (exemple)</a>
                <br><br>
                <a href="../../../../../DocRoot/Projet_php/Index.php/CatalogueController/affich_cat">Liste des categories</a>
                <br><br>
                <a href="../../../../../DocRoot/Projet_php/Index.php/CatalogueController/affich_cat/1">Liste des prestations de la categorie 1 (exemple)</a>
            </nav>
            <section>
                '.
                $content.'
            </section>
            <footer>
                <a href=../../CatalogueController/affich_prest> Continuer mes achats </a> <br> <br> <a href="../../CoffretController/affich_coffret"> Confirmer ma commande et passer au paiement </a>
        </body>
        </html>';
        return $html;
    }
}