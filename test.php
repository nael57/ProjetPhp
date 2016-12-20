<?php

use Illuminate\Database\Capsule\Manager as DB;
use giftbox\models\Prestation as Prest;
use giftbox\models\Categorie as Cat;

require_once 'vendor/autoload.php';


$db = new DB();
$tab = parse_ini_file('src/conf/conf.ini');
$db->addConnection($tab);
$db->setAsGlobal();
$db->bootEloquent();

$r = Cat::get(); 
$l = Prest::get();

print '<strong> Catégories : </strong> <br> <br>';

foreach($r as $cat){
    print $cat->id . '  ' . $cat->nom . '<br>';
}

print '<br> <strong> Prestations : </strong> <br> <br>';

foreach($l as $pre){
    print $pre->id . '  ' . $pre->nom . '  ' . $pre->descr . '  ' . $pre->cat_id . '  ' . $pre->img . '  ' . $pre->prix . '<br>';
}

if(isset( $_GET['id'])){
    $q = Prest::where('id', '=', $_GET['id'])->first();
    print $q->id . '  ' . $q->nom;
}

$pre = new Prest();
$pre->id = 28;
$pre->nom = 'Restorant';
$pre->save();

echo '<br> <br> ajout de la nouvelle prestation : <br> <br>';

$l = Prest::get();

print '<br> <strong> Nouvelles Prestations : </strong> <br> <br>';

foreach($l as $pre){
    print $pre->id . '  ' . $pre->nom . '  ' . $pre->descr . '  ' . $pre->cat_id . '  ' . $pre->img . '  ' . $pre->prix . '<br>';
}

$pre->delete();

echo '<br> <br> prestation effacée. <br> <br>';

$prest = Prest::where('id','=',1)->first();
$cat = $prest->categorie()->first();

echo 'La prestation 1 est dans la categorie : '. $cat->id . '  ' . $cat->nom . 
'<br> <br>';

$prest2 = $cat->prestations()->get();

echo 'la categorie Attention contient les prestation suivantes : <br> <br>';

foreach($prest2 as $p){
    print $p->id . '  ' . $p->nom . '<br>';
}