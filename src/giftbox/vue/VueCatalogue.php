<?php

namespace giftbox\vue;


class VueCatalogue {
    
    private $tab;
    private $sel;
    private $id;
    private $lienPrest;
    private $lienCat;
    private $lienAccueil;
    
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
        
        $this->lienPrest = '../../Index.php/CatalogueController/affich_prest';
        $this->lienCat = '../../Index.php/CatalogueController/affich_cat';
        $this->lienAccueil = '../..';
        
        return $page;
    }
    
    private function affich_prest(){
        $page = '<h1> Description de la prestation n°' . $this->id . '</h1>';
        $page = $page . '<br> ' . 'Nom : ' . $this->tab->nom . ' Description : ' . $this->tab->descr . '  Prix : ' . $this->tab->prix . '€ ' . '<br><br>' . '<img src="../../../images/'.$this->tab->img.'">' . '</ul><br><br><a href=../../CoffretController/ajout_prest/' . $this->id . '> Ajouter cette prestation a ma commande </a>';
        
        $this->lienPrest = '../../CatalogueController/affich_prest';
        $this->lienCat = '../../CatalogueController/affich_cat';
        $this->lienAccueil = '../../..';
        
        return $page;
    }
   
    private function affich_liste_cat(){
        $page = '<h1> Liste des catégories </h1> <ul>';
        $i = 1;
        foreach($this->tab as $cat){
            $page = $page . '<li><a href=affich_cat/'. $i . '>' . $cat->id . '  ' . $cat->nom . '</a>';
            $i++;
        }
        
        $this->lienPrest = '../../Index.php/CatalogueController/affich_prest';
        $this->lienCat = '../../Index.php/CatalogueController/affich_cat';
        $this->lienAccueil = '../..';
        
        return $page;
        
    }
    
    private function affich_liste_prest_par_cat(){
        $page = '<h1> Prestations de la catégorie n°'.$this->id.'</h1> <ul>';
        $i = 1;
        foreach($this->tab as $pre){
            $page = $page . '<li><a href=../affich_prest/' . $pre->id . '>' . $pre->nom . ' ' . $pre->prix . '€ ' . $pre->cat_id . ' ' .'</a>'. '<img src="../../../images/'.$pre->img.'" width="80">'.'<br><br>';
            $i++;
        }
        
        $this->lienPrest = '../../CatalogueController/affich_prest';
        $this->lienCat = '../../CatalogueController/affich_cat';
        $this->lienAccueil = '../../..';
        
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
            <meta charset="utf-8">
        </head>
        <boby>
            <nav>
                <br><br>
                <a href="'.$this->lienPrest.'">Liste des prestations</a>
                <br><br>
                <br><br>
                <a href="'.$this->lienCat.'">Liste des categories</a>
                <br><br>
            </nav>
            <section>
                '.
                $content.'
            </section>
            <footer>
                <a href="'.$this->lienAccueil.'">Accueil</a>
            </footer>
        </body>
        </html>';
        
        return $html;
    }
}