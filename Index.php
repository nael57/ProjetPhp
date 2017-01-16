<?php

/**
* Programme principal de l'application web Giftbox
*/


//on lance l'autoload
require_once 'vendor/autoload.php';

use giftbox\vue\VueCatalogue as VueCatalogue;
use Illuminate\Database\Capsule\Manager as DB;
use giftbox\controller\CatalogueController as CatalogueCon;
use giftbox\controller\CoffretController as CoffretCon;
use giftbox\controller\IndexController as Index;

//creation de la connexion
$db = new DB();
$tab = parse_ini_file('src/conf/conf.ini');
$db->addConnection($tab);
$db->setAsGlobal();
$db->bootEloquent();

//on instancie un slim
$slim = new \Slim\Slim();

$slim->get('/', function(){
    $c = new Index();
    $html = $c->affichage();
    echo $html;
});

//on demande de lister les prestations
$slim->get('/CatalogueController/affich_prest', function(){
    $c = new CatalogueCon();
    $html = $c->affich_prest(null);
    echo $html;
});

//on demande de decrire une prestation selon l'id passé
$slim->get('/CatalogueController/affich_prest/:id', function($id){
    $c = new CatalogueCon();
    $html = $c->affich_prest($id);
    echo $html;
});

//on demande de lister les categories
$slim->get('/CatalogueController/affich_cat', function(){
    $c = new CatalogueCon();
    $html = $c->affich_cat(null);
    echo $html;
});

//on demande de lister les prestations d'une categorie
$slim->get('/CatalogueController/affich_cat/:id', function($id){
    $c = new CatalogueCon();
    $html = $c->affich_cat($id);
    echo $html;
});

//on demande l'ajout d'une prestation au coffret
$slim->get('/CoffretController/ajout_prest/:id', function($id){
    $c = new CoffretCon();
    $html = $c->ajout_prest($id);
    echo $html;
});

//on demande l'affichage du coffret
$slim->get('/CoffretController/affich_coffret', function(){
   $c = new CoffretCon();
    $html = $c->affich_coffret();
    echo $html;
});

//on demande a valider le coffret
$slim->get('/CoffretController/confirmer_coffret', function(){
    $c = new CoffretCon();
    $html = $c->confirmer_coffret();
    echo $html;
});

//on demande le recapitulatif final du coffret
$slim->get('/CoffretController/finaliser_coffret', function(){
    $c = new CoffretCon();
    $html = $c->finaliser_coffret();
    echo $html;
});

$slim->run();