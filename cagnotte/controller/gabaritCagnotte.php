<?php
	session_start();
	$_SESSION['id'] = 1;
	$idCreateur = 2;
	$c = false;
	$montantTotal = 100;
	//$_SESSION['montantCourant'] = 50;

	if(isset($_POST) && isset($_POST['don']) && $_POST['don'] > 0)
	{
		if($_POST['don'] + $_SESSION['montantCourant'] <= $montantTotal)
		{
			$_SESSION['montantCourant'] += $_POST['don'];
		}
		else
		{
			$_SESSION['montantCourant'] = $montantTotal;
			echo '/!\ ATTENTION !!! Vous avez dépassé le montant total de la cagnotte avec votre dernier don, les sous-sous supplémentaires seront considéré comme un cadeau que vous faites au développeur.<br/> Merci';
		}
	}
	
	if($_SESSION['id'] == $idCreateur)
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
		<p>Montant : <?php echo $_SESSION['montantCourant'].' / '.$montantTotal;?>
		<?php
			if($c)
			{
				if($_SESSION['montantCourant'] >= $montantTotal)
				{
					echo 'Finir la cagnotte';
				}
				else
				{
					echo 'La cagnotte n\'est pas remplie';
				}
			}
			else
			{
				if($_SESSION['montantCourant'] >= $montantTotal)
				{
					echo 'La cagnotte est remplie';
				}
				else
				{
					echo 'faire un don:<form action="'.$_SERVER['PHP_SELF'].'" method="POST"><input type="number" placeholder="Votre don..." name="don"/><input type="submit" value="Valider"/></form>';
				}
			}
		?>
	</body>
</html>