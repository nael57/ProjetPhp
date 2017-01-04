<?php

//definition du namespace
namespace giftbox\vue;

//Classe qui premet l'affichage de 'lindex
class VueIndex {
    
    //contructeur vide
    public function __contruct(){}

    //methode qui permet un affichage de l'index
    public function affichage(){
        $html = '
        <!DOCTYPE html>
        <html lang="fr">
            <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <title> Accueil </title>
                <meta charset="utf-8">
            </head>
            <boby>
                <h1> Bienvenue sur l\'accueil </h1>
                <br> <br> 
                <h2> Que voulez vous faire ? </h2>
                <br> <br> <a href="Index.php/CatalogueController/affich_prest">Liste des prestations</a>
                <br> <br>
                <a href="Index.php/CatalogueController/affich_cat">Liste des categories</a>
            </body>
        </html>
        ';
        return $html;
    }
}