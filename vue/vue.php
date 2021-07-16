<?php

function identification(){
	$contenu='<form id="monForm1" action="forum.php" method="post">
			<p><label> Login :</label><input type="text" name="login"/></label></p>
			<p><label> Mdp :</label><input type="text" name="mdp"/></label></p>
			<p><input type="submit" value="Identification" name="envoyer"/></p>
		</form>';
	require_once('vue/gabarit.php');
}
/*Lance apres erreur seulement. Affiche l'erreur et les champs permettant l'iddentification de l'utilisateur*/
function identificationErreur($msg){
	$contenu='<form id="monForm1" action="forum.php" method="post">
			<p class="error"> Attention ! '.$msg.'</p>
			<p> Login : <input type="text" name="login"/></p>
			<p> Mdp : <input type="text" name="mdp"/></p>
			<p><input type="submit" value="Identification" name="envoyer"/></p>
		</form>';
	require_once('vue/gabarit.php');
}

function afficherErreur($erreur){
	$contenu='<p class="error">'.$erreur.'</p><p><a href="forum.php"/>Revenir au forum</a></p>';
	require_once('vue/gabarit.php');
}
function afficherMessage($msg){
	$contenu='<p class="msg">'.$msg.'</p>';
	return $contenu;
}
