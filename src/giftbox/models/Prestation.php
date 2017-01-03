<?php

//on defini le namespace et on recupere la superclasse de prestation
namespace giftbox\models;
require_once 'vendor/illuminate/database/Eloquent/Model.php';
use Illuminate\Database\Eloquent\Model as Model;

//classe Prestation qui extends de Model 
class Prestation extends Model{
    
    //definition de la table associée, de sa clé primaire
    protected $table = 'prestation';
    protected $primaryKey = 'id';
    //on precise qu'on de desire pas d'autres colonnes pour la date de modif
    public $timestamps = false;
    
    /**
     * fonction qui permet de connaitre sa categorie
     * @return les prestations dans cette categorie
     */
    public function categorie() {
        return $this->belongsTo('giftbox\models\Categorie', 'cat_id');
    }
    
    public function __toString(){
        return $this->id . '  ' . $this->nom . '  ' . $this->descr . '  ' . $this->cat_id . '  ' . $this->img . '  ' . $this->prix .'€';
    }
}