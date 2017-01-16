<?php
namespace giftbox\controller;
include '../connect_base.php';

use giftbox\models\Coffret as Categorie;
use giftbox\models\Prestation as Prestation;
use giftbox\models\Contient as Contient;
use giftbox\vue\VueCagnotte as VueCagnotte;

$req = 'Select * from cagnotte';
$res = mysql_query($req) or die(mysql_error());
$row = mysql_fetch_array($res);
print_r($row);


$char= array('a','b','c','d','e','f','g','h',   'i','j','k','l','m','n','o','p','q','r','s','t','u','v','x','y','z','0','1','2','3','4','5','6','7','8','9');
$nom = '';
for($i =0; $i<10; $i++){
    $nom.=$char[rand(0,count($char)-1)];
}

$file = fopen('cagnottes/'.$nom.'.php','w+');
fseek($file,0);
fputs($file,'<?php
	session_start();
	$_SESSION[\'id\'] = 1;
	$idCreateur = 2;
	$c = false;
	$montantTotal = 100;
	//$_SESSION[\'montantCourant\'] = 50;

	if(isset($_POST) && isset($_POST[\'don\']) && $_POST[\'don\'] > 0)
	{
		if($_POST[\'don\'] + $_SESSION[\'montantCourant\'] <= $montantTotal)
		{
			$_SESSION[\'montantCourant\'] += $_POST[\'don\'];
		}
		else
		{
			$_SESSION[\'montantCourant\'] = $montantTotal;
			echo \'/!\ ATTENTION !!! Vous avez dépassé le montant total de la cagnotte avec votre dernier don, les sous-sous supplémentaires seront considéré comme un cadeau que vous faites au développeur.<br/> Merci\';
		}
	}
	
	if($_SESSION[\'id\'] == $idCreateur)
	{
		$c = true;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charet="utf-8"/>
		<title>Cagnotte de <nom></title>
	</head>
	<body>
		<h1>Cagnotte de José</h1>
		<p> Bla bla bla</p>
		<p>Montant : <?php echo $_SESSION[\'montantCourant\'].\' / \'.$montantTotal;?>
		<?php
			if($c)
			{
				if($_SESSION[\'montantCourant\'] >= $montantTotal)
				{
					echo \'Finir la cagnotte\';
				}
				else
				{
					echo "La cagnotte n\'est pas remplie";
				}
			}
			else
			{
				if($_SESSION[\'montantCourant\'] >= $montantTotal)
				{
					echo \'La cagnotte est remplie\';
				}
				else
				{
					echo \'faire un don:<form action="\'.$_SERVER[\'PHP_SELF\'].\'" method="POST"><input type="number" placeholder="Votre don..." name="don"/><input type="submit" value="Valider"/></form>\';
				}
			}
		?>
	</body>
</html>');


fclose($file);
header('Location: '.'cagnottes/'.$nom.'.php');


