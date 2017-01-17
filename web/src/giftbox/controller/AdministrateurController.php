<?php
namespace giftbox\controller;

use giftbox\models\Categorie as Categorie;
use giftbox\models\Prestation as Prestation;
use giftbox\models\Membre as Membre;
use giftbox\models\Contient as Contient;
use giftbox\vue\VueAdministrateur as VueAdministrateur;
use giftbox\vue\VueConnexion as VueConnexion;
use giftbox\models\Vote as Vote;

class AdministrateurController{

	public function afficher_admin(){
		if(!empty($_POST['nomutil']) && !empty($_POST['mdp'])){
			//$con = new Membre(); Pour linsertion à garder
           // $con->nom_utilisateur = $_POST['nomutil'];
			$pass = crypt($_POST['mdp'],"kldjfskdjf43543jfdsljfls");
			//$con->mot_de_passe = $pass;
            //$con->save();
			$user = Membre::where('mot_de_passe','=',$pass)->where('nom_utilisateur','=',$_POST['nomutil']);
			$res = $user->count();
		}
		else{
			$v = new VueConnexion();
			echo "<h2>Tous les champs n'ont pas été remplis ! </h2>";
			return $v->affich_general();
		}
		if($res==1){
			$v = new VueAdministrateur();
			return $v->affich_general();
		}
		else{
			$v = new VueConnexion();
			echo "<h2>Mauvais identifiant ou mot de passe </h2>";
			return $v->affich_general();
		}
	}

	public function ajouter_presta(){
		if(!empty($_POST['nom']) && !empty($_POST['tarif']) && !empty($_POST['description'])){
			if(isset($_FILES['nom_du_fichier'])){
				$errors= array();
				$file_name = $_FILES['nom_du_fichier']['name'];
				$file_size =$_FILES['nom_du_fichier']['size'];
				$file_tmp =$_FILES['nom_du_fichier']['tmp_name'];
				$file_type=$_FILES['nom_du_fichier']['type'];
				$file_ext=strtolower(end(explode('.',$_FILES['nom_du_fichier']['name'])));
				$expensions= array("jpeg","jpg","png","gif");
				if(in_array($file_ext,$expensions)=== false){
					$errors[]="Extension non autorisé";
				}
				if($file_size > 2097152){
					$errors[]='La taille du fichier doit être inférieure à 2 MB !';
				}

				if(empty($errors)==true){
					move_uploaded_file($file_tmp,"images/".$file_name);
					$con = new Prestation();
					$con->nom = $_POST['nom'];
					$con->descr = $_POST['description'];
					$con->prix = $_POST['tarif'];
					$con->img= $_FILES['nom_du_fichier']['name'];
					$cat =Categorie::where('nom','=',$_POST['ajout'])->first();
					$con->cat_id= $cat['id'];
					$con->etat="actif";
					$con->save();
					$id=Prestation::where('nom','=',$_POST['nom'])->first();
					$id=$id['id'];
					$vo = new Vote();
					$vo->save();
					echo"Upload réussi !";
				}
				else{
					echo"Upload échoué !";
				}
			}
		
		}
		$v = new VueAdministrateur();
		return $v->affich_general();

	}

	public function desactiver_presta(){
		$presta =Prestation::get();
		foreach ($presta as $value) {
			if($value['nom']==$_POST['desac']){
				$value['etat']="desactif";
				$value->save();
			}
		}
		echo "<h2> Desactivation OK ! </h2>";
		$v = new VueAdministrateur();
		return $v->affich_general();
	}

	public function activer_presta(){
		$presta =Prestation::get();
		foreach ($presta as $value) {
			if($value['nom']==$_POST['acti']){
				$value['etat']="actif";
				$value->save();
			}
		}
		echo "<h2> Activation OK ! </h2>";
		$v = new VueAdministrateur();
		return $v->affich_general();
	}

	public function supprimer_presta(){
		$presta =Prestation::where('nom','=',$_POST['sup']);
		$id = $presta['id'];
		$presta->delete();
		$vote = Vote::where('id','=',$id)->delete();
		echo "<h2> Suppression OK ! </h2>";
		$v = new VueAdministrateur();
		return $v->affich_general();
	}


}

