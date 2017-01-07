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
$slim = new \Slim\Slim();

$slim->get('/', function(){
    $c = new CatalogueCon();
    $html = $c->affich_cat(2);
    echo $html;
});

$slim->run();

