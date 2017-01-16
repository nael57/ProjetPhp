<?php

//on defini le namespace et on recupere la superclasse de cagnotte
namespace giftbox\models;
require_once 'vendor/illuminate/database/Eloquent/Model.php';
use Illuminate\Database\Eloquent\Model as Model;

//classe Cagnotte qui extends de Model 
class Cagnotte extends Model{
    
    //definition de la table associée, de sa clé primaire
    protected $table = 'cagnotte';
    protected $primaryKey = 'idcagnotte';
    //on precise qu'on de desire pas d'autres colonnes pour la date de modif
    public $timestamps = false;
    
        public function contient() {
        return $this->belongsTo('giftbox\models\Contient', 'id_coo, id_pre');
    }
        public function coffret() {
        return $this->belongsTo('giftbox\models\Coffret', 'id');
    }
        public function prestation() {
        return $this->belongsTo('giftbox\models\Prestation', 'id');
    }