<?php

//on defini le namespace et on recupere la superclasse de contient
namespace giftbox\models;
require_once 'vendor/illuminate/database/Eloquent/Model.php';
use Illuminate\Database\Eloquent\Model as Model;

//classe Contient qui extends de Model 
class Contient extends Model{
    
    //definition de la table associée, de sa clé primaire
    protected $table = 'Contient';
    protected $primaryKey = 'id_coo, id_pre';
    //on precise qu'on de desire pas d'autres colonnes pour la date de modif
    public $timestamps = false;
    
    /**
     * Methode prestations retournant les prestations associées au Contient
     * 
     * @return la liste des prestations
     */
    public function prestations($id){
        $liste = Contient::where('id_coo', '=', $id)->get();
        return $liste;
    }
    
    /**
     * fonction toString controllant l'affichage d'une instance de Contient
     * 
     * @return la description d'une instance de Contient
     */
    public function __toString(){
        return 'Le coffret n°' . $this->id_coo . ' contient la prestation n°' . $this->id_pre;
    }
}