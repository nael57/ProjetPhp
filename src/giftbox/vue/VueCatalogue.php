<?php

namespace giftbox\vue;


class VueCatalogue {
    
    private $tab;
    private $sel;
    private $id;
    
    public function __construct( $tableau ){
        $this->tab = $tableau;
    }
           
    public function affich_general( $selecteur, $id ){
        $this->sel = $selecteur;
        $this->id = $id;
        $html = $this->render();
        return $html;
    }
    
    private function affich_liste_prest(){
        $page = '<h1> Liste des prestations </h1> <ul> ';
        foreach($this->tab as $pre){
            $page = $page . '<li><a href=affich_prest/' . $pre->id . '>' . $pre->nom . ' ' . $pre->prix . '€ ' . $pre->cat_id . ' ' .'</a>'. '<img src="../../images/'.$pre->img.'" width="80">'.'<br><br>';
        }
        $page = $page . '</ul><br><br><a href=../../Index.php>Accueil</a>';
        return $page;
    }
    
    private function affich_prest(){
        $page = '<h1> Description de la prestation n°' . $this->id . '</h1>';
        $page = $page . '<br> ' . 'Nom : ' . $this->tab->nom . ' Description : ' . $this->tab->descr . '  Prix : ' . $this->tab->prix . '€ ' . '<br><br>' . '<img src="../../../images/'.$this->tab->img.'">' . '</ul><br><br><a href=../../../Index.php>Accueil</a>';
        return $page;
    }
   
    private function affich_liste_cat(){
        $page = '<h1> Liste des catégories </h1> <ul>';
        $i = 1;
        foreach($this->tab as $cat){
            $page = $page . '<li><a href=affich_cat/'. $i . '>' . $cat->id . '  ' . $cat->nom . '</a>';
            $i++;
        }
        $page = $page . '</ul><br><br><a href=../../Index.php>Accueil</a>';
        return $page;
        
    }
    
    private function affich_liste_prest_par_cat(){
        $page = '<h1> Prestations de la catégorie n°'.$this->id.'</h1> <ul>';
        $i = 1;
        foreach($this->tab as $pre){
            $page = $page.'<li>'.$pre;
            $i++;
        }
        $page = $page . '</ul><br><br><a href=../../../Index.php>Accueil</a>';
        return $page;
    }
    
    private function render(){
       $content=0;
        switch ($this->sel) {
            case 1 :
                $content = $this->affich_liste_prest();
            break;
            case 2 :
                $content = $this->affich_prest();
            break;
            case 3 :
                $content = $this->affich_liste_cat();
            break;
            case 4 :
                $content = $this->affich_liste_prest_par_cat();
            break;
        }
        
        $html = '
        <!DOCTYPE html>
        <html>
        <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title> Projet giftbox </title>
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
        </body>
        </html>';
        
        return $html;
    }
}