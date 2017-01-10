<?php

//on defini le namespace et on recupere la superclasse de prestation
namespace giftbox\models;
require_once 'vendor/illuminate/database/Eloquent/Model.php';
use Illuminate\Database\Eloquent\Model as Model;

//classe Categorie
class Categorie extends Model {
    
    //definition de la table associée et de la clé principale
    protected $table = 'Categorie';
    protected $primaryKey = 'id';
    //on precise qu'on de desire pas d'autres colonnes pour la date de modif
    public $timestamps = false;
    
    /**
     * fonction qui permet de connaitre les prestations de cette categorie
     * @return les prestations dans cette categorie
     */
    public function prestations(){
        return $this->hasMany('\giftbox\models\Prestation', 'cat_id');
    }
    
    /*
    * Methode toString definissant l'affichage d'une categorie
    * @Return son affichage
    */
    public function __toString(){
        return $this->id . '  ' . $this->nom;
    }

}