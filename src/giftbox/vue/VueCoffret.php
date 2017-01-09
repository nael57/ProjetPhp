<?php

//definition du namespace et des alias
namespace giftbox\vue;
use giftbox\models\Prestation as Prestation;

//Classe vue pour le coffret (panier cadeau)
//Les tables ne sont jamais modifiees ici
class VueCoffret {

    //liens vers d'autres pages flexibles selon ou on se trouve
    private $lienPrest = '../../../Index.php/CatalogueController/affich_prest';
    private $lienCat = '../../../Index.php/CatalogueController/affich_cat';
    //prestations envoyees par le controller
    private $tab;
    //num de l'action a effectuer
    private $sel;
    //nul ou definissant la prestation a manipuler
    private $id;
    private $liens = false;
    private $lienhaut=null;
    private $lienbas=null;
    
    //contructeur prenant en parametre des prestations a ajouter, afficher,...
    public function __construct($tableau){
        $this->tab = $tableau;
    }
    
    //methode qui permet d'aiguiller vers differents affichages selon les parametres
    public function affich_general($selecteur, $id){
        $this->sel = $selecteur;
        $this->id = $id;
        $html = $this->render();
        return $html;
    }
    
    //methode pour permet d'ajouter une prestation au panier
    public function ajout_prest(){
        $this->lienhaut = '<a href="../../CatalogueController/affich_prest">Liste des prestations</a><br><br><a href="../../CatalogueController/affich_cat">Liste des categories</a>';
        $this->lienbas='<a href=../../CatalogueController/affich_prest>Continuer mes achats </a> <br> <br> <a href="../../CoffretController/affich_coffret"> Confirmer ma commande et passer au paiement </a>';
        $html = 'La prestation n°' . $this->id . ' a été ajoutée au panier !';
        return $html;
    }
    
    //methode qui permet d'afficher le panier de l'uilisateur
    public function affich_coffret(){
        $this->lienhaut = '<a href=../../CatalogueController/affich_prest>Continuer mes achats </a> <br> <br> <a href="../../CoffretController/affich_coffret"> Confirmer ma commande et passer au paiement </a>';
        $this->lienbas='<a href=../../CatalogueController/affich_prest>Continuer mes achats </a><br><br><a href="../../Index.php/CoffretController/confirmer_coffret"><strong>Confirmer ce coffret cadeau et passer au paiement de la commande</strong></a>';
        $html = '<h2> Votre coffret cadeau </h2> <br><br>';
        $montant = 0;
        foreach($this->tab as $pre){
            $html = $html . $pre . '<br>';
            $prix = $pre->prix;
            $montant = $montant + $prix;
        }
        
        $html = $html . '<br> Montant total de la commande : ' . $montant . '<br><br>';
        
        return $html;
    }
    
    //methode qui permet de confirmer le coffret une fois fini
    public function confirmer_coffret(){
        $content = '<h2> Confirmation de votre commande </h2><br><br>
        <form id="f1" method = "post" action = "">
                <label for="fNom"> nom : </label>
                <input type="text" id="fNom" name="nom" placeholder="<obligatoire>" required><br><br>
                <label for="fPrenom"> prenom : </label>
                <input type="text" id="fPrenom" name="prenom" placeholder="<obligatoire>" required><br><br>
                <label for="fMail"> mail : </label>
                <input type="text" id="fMail" name="mail" placeholder="<obligatoire>" required><br><br>
                <label for="fComm"> commentaire a envoyer au destinataire : </label>
                <input type="text" id="fComm" name="comm" placeholder="<obligatoire>" required><br><br>
                <label for="fMode"> Mode de paiement : </label>
                <label>classique</label><input type="radio" name="groupe_radio1" value=1>
                <label>cagnotte</label><input type="radio" mane="groupe_radio1" value=2><br><br>
                <button type="submit" name="valider" value="valid">valider</button>
        </form>';
        return $content;
    }
    
    //methode permettant l'affichage general de la page et y ajoutant le bon script
    public function render(){
        $content = '';
        switch ($this->sel){
            case 1 :
                $this->liens=true;
                $content = $this->ajout_prest();
            break;
            case 2 :
                $this->liens=true;
                $content = $this->affich_coffret();
            break;
            case 3 :
                $this->liens=false;
                $content = $this->confirmer_coffret();
            break;
        }
        
        $html = '
        <!DOCTYPE html>
        <html lang="fr">
        <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title> Ajouté au panier </title>
            <meta charset="utf-8">
        </head>
        <boby>
            <nav>
                <br><br>
                <a href="'.$this->lienPrest.'">Liste des prestations</a>
                <br><br>
                <a href="'.$this->lienCat.'">Liste des categories</a>
            </nav>
            <section>
                '.
                $content.'
            </section>
            <footer>'.
                $this->lienbas.    
            '</footer>
        </body>
        </html>';
        return $html;
    }
}