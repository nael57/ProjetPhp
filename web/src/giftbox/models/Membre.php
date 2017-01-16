<?php

//on defini le namespace et on recupere la superclasse de prestation
namespace giftbox\models;
require_once 'vendor/illuminate/database/Eloquent/Model.php';
use Illuminate\Database\Eloquent\Model as Model;

//classe Prestation qui extends de Model 
class Membre extends Model{
    
    //definition de la table associée, de sa clé primaire
    protected $table = 'membre';
    protected $primaryKey = 'id';
    //on precise qu'on de desire pas d'autres colonnes pour la date de modif
    public $timestamps = false;
    
    /**
     * fonction qui permet de connaitre sa categorie
     * @return les prestations dans cette categorie
     */
    public function coffret() {
        return $this->belongsTo('giftbox\models\Coffret', 'id_membre');
    }
}