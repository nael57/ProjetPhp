<?php

/**
* Programme principal de l'application web Giftbox
*/


//on lance l'autoload
require_once 'vendor/autoload.php';

use giftbox\vue\VueCatalogue as VueCatalogue;
use Illuminate\Database\Capsule\Manager as DB;
use giftbox\controller\CatalogueController as CatalogueCon;
use giftbox\controller\IndexController as Index;

//creation de la connexion
$db = new DB();
$tab = parse_ini_file('../conf/conf.ini');
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

//on demande ici de lister les prestations
$slim->get('/CatalogueController/affich_prest', function(){
    $c = new CatalogueCon();
    $html = $c->affich_prest(null);
    echo $html;
});

//on demande ici de decrire une prestation selon l'id passé
$slim->get('/CatalogueController/affich_prest/:id', function($id){
    $c = new CatalogueCon();
    $html = $c->affich_prest($id);
    echo $html;
});

//on demande ici de lister les categories
$slim->get('/CatalogueController/affich_cat', function(){
    $c = new CatalogueCon();
    $html = $c->affich_cat(null);
    echo $html;
});

//on demande ici de lister les prestations d'une categorie
$slim->get('/CatalogueController/affich_cat/:id', function($id){
    $c = new CatalogueCon();
    $html = $c->affich_cat($id);
    echo $html;
});

//on traite ici la requète courante
$slim->run();