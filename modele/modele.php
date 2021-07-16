<?php

require('modele/connect.php');

function getConnect(){
	$connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD);
	$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$connexion->query('SET NAMES UTF8');
	return $connexion;
}
function getUser($login,$mdp){
	$connexion=getConnect();
	$requete="SELECT * FROM personnelsauxiliaires WHERE login='$login' AND mdp='$mdp'";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$user=$resultat->fetchall();
	if (empty($user)){
		$requete2="SELECT * FROM medecins WHERE login='$login' AND mdp='$mdp'";
		$resultat=$connexion->query($requete2);
		$resultat->setFetchMode(PDO::FETCH_OBJ);
		$user=$resultat->fetchall();
	}
	$resultat->closeCursor();
	return $user;
}
