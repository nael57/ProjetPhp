<?php

//specification du namespace, de la super classe de Coffret et des classe utilisées
namespace giftbox\models;
require_once 'vendor/illuminate/database/Eloquent/Model.php';
use Illuminate\database\Eloquent\Model as Model;
use giftbox\Models\Prestation as Prestation;
use giftbox\Models\Categorie as Categorie;
use giftbox\Models\Contient as Contient;


//classe coffret representant le panier du client
class Coffret extends Model {
    
    //on renseigne  la table et la clé primaire
    protected $table = 'Coffret';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    /**
     * Methode prestations devant retourner les prestations contenues dans le coffret
     *
     * @return la liste des prestations
     */
    public function prestations(){
        $query = Contient::where('id_coo', '=', $this->id)->get();
        $prest = null;
        foreach($query as $pre){
            $prest[] = Prestation::where('id', '=', $pre->id_pre)->get();
        }
        return $prest;
    }
    
    /**
     * Methode toString définissant l'affichage d'un coffret
     *
     * @return la description du coffret
     */
    public function __toString(){
        return ' id : ' . $this->id;
    }
}