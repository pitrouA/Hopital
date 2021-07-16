<?php

function pageDirecteur(){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p><input type="submit" value="Creer ou modifier logins" name="modifLog"/></p>
		<p><input type="submit" value="Modifier actes" name="modifActes"/></p>
		<p><input type="submit" value="Modifier pieces a fournir ou consignes" name="piecesConsignes"/></p>
		<p><input type="submit" value="Gerer medecins" name="gereMedecins"/></p>
		<p><input type="submit" value="Statistiques" name="stats"/></p>
		<p><input type="submit" value="Deconnexion" name="deconnexion"/></p>
	</form>';
	require_once('vue/gabarit.php');
}

function pageDirecteurBienvenue($nom){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p class="good">Bienvenue '.$nom.'</p>
		<p><input type="submit" value="Creer ou modifier logins" name="modifLog"/></p>
		<p><input type="submit" value="Modifier actes" name="modifActes"/></p>
		<p><input type="submit" value="Modier pieces a fournir ou consignes" name="piecesConsignes"/></p>
		<p><input type="submit" value="Gerer medecins" name="gereMedecins"/></p>
		<p><input type="submit" value="Statistiques" name="stats"/></p>
		<p><input type="submit" value="Deconnexion" name="deconnexionD"/></p>
	</form>';
	require_once('vue/gabarit.php');
}

//Modification logins
function afficherModifLogin(){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p><input type="submit" value="Creer ou modifier logins hotesse ou directeur" name="modifLogHotDir"/></p>
		<p><input type="submit" value="Creer ou modifier logins medecins" name="modifLogMedecin"/></p>
		<p><input type="submit" value="Retour" name="retourD"/></p>
		</form>';
		require_once('vue/gabarit.php');
}
//ctrlRetourDirecteur

function afficherModifLoginHotDir($listeHotDir){
	$contenu='<form id="monForm1" action="forum.php" method="post">
						<fieldset><legend>Liste du personnel auxilliaire</legend>';
		foreach ($listeHotDir as $ligne) {
			$contenu.='<p class="readOnly"><input name="hotDirRadio" type="radio" value="'.$ligne->nom.'"/><label>'.$ligne->nom.'</label><input class="hidden" type="text"></p>';//: <input type="text" value="'.$ligne->prix.'" readonly="readonly"/
		}
		$contenu.='</fieldset><p><label>Nouveau login : </label><input type="text" name="loginHotDir"/></p>
		<p><label>Nouveau mot de passe : </label><input type="text" name="mdpHotDir"/></p>
		<p><input type="submit" value="Modifier" name="modifLoginHotDir"/></p>
		<p><input type="submit" value="Retour" name="retourD"/></p>
		</form>';
		require_once('vue/gabarit.php');
		// <p><label>Nom :</label> <input type="text" name="nomHotDir"/></p>
}

function afficherModifLoginMedecin($listeMedecin){
	$contenu='<form id="monForm1" action="forum.php" method="post">
						<fieldset><legend>Liste du personnel auxilliaire</legend>';
		foreach ($listeMedecin as $ligne) {
			$contenu.='<p class="readOnly"><input name="medecinRadio" type="radio" value="'.$ligne->nom.'"/><label>'.$ligne->nom.'</label><input class="hidden" type="text"></p>';//: <input type="text" value="'.$ligne->prix.'" readonly="readonly"/
		}
		$contenu.='</fieldset><p><label>Nouveau login : </label><input type="text" name="loginMedecin"/></p>
		<p><label>Nouveau mot de passe : </label><input type="text" name="mdpMedecin"/></p>
		<p><input type="submit" value="Modifier" name="modifLoginMedecin"/></p>
		<p><input type="submit" value="Retour" name="retourD"/></p>
		</form>';
		require_once('vue/gabarit.php');
}


//Modifications actes
function afficherModifActe(){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p><input type="submit" value="Creer un acte" name="creerActe"/></p>
		<p><input type="submit" value="Supprimer un acte" name="suppActe"/></p>
		<p><input type="submit" value="Modifier le prix d\'un acte" name="modifPrixActe"/></p>
		<p><input type="submit" value="Retour" name="retourD"/></p>
		</form>';
		require_once('vue/gabarit.php');
}

function afficherCeerPiece(){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p><label>Piece : </label><input type="text" name="nouvPiece"/></p>
		<p><input type="submit" value="Creer" name="creerNouvPiece"/></p>
		<p><input type="submit" value="Retour" name="retourD"/></p>
		</form>';
		require_once('vue/gabarit.php');
}

function afficherSuppPiece($listePieces){
	$contenu='<form method="post" action="forum.php">
						<fieldset>
						<legend>Liste des pieces :</legend>';
	foreach ($listePieces as $ligne) {
		$contenu.='<p><input name="checkPiece[]" type="checkbox" value="'.$ligne->id.'"/><label>'.$ligne->nom.'</label><input class="hidden" type="text"/></p>';
	}
	$contenu.='	<p><input type="submit" value="Supprimer" name="supprimerPiece"/></p>
						<p><input type="submit" value="Retour" name="retourD"/></p>
						</form>';
		require_once('vue/gabarit.php');
}

function afficherCreerActe(){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p><label>Acte : </label><input type="text" name="nouvActe"/></p>
		<p><label>Prix : </label><input type="text" name="nouvPrix"/></p>
		<p><input type="submit" value="Creer" name="creerNouvActe"/></p>
		<p><input type="submit" value="Retour" name="retourD"/></p>
		</form>';
		require_once('vue/gabarit.php');
}

function afficherSuppActe($listeActe){
	$contenu='<form method="post" action="forum.php">
						<fieldset>
						<legend>Liste des actes :</legend>';
	foreach ($listeActe as $ligne) {
		$contenu.='<p><input name="checkActe[]" type="checkbox" value="'.$ligne->idMotif.'"/><label>'.$ligne->motif.' : </label><input type="text" value="'.$ligne->prix.'" readonly="readonly"/></p>';
	}
	$contenu.='	<p><input type="submit" value="Supprimer" name="supprimerActe"/></p>
						<p><input type="submit" value="Retour" name="retourD"/></p>
						</form>';
	/*$contenu='<form id="monForm1" action="forum.php" method="post">
		<p>Acte : <input type="text" name="acteASupp"/></p>
		<p><input type="submit" value="Supprimer" name="supprimerActe"/></p>
		<p><input type="submit" value="Retour" name="retourD"/></p>
		</form>';*/
		require_once('vue/gabarit.php');
}

function afficherModifPieceActe($listeActe,$listePiece){
	$contenu='<form method="post" action="forum.php">
						<fieldset>
						<legend>Veuileez choisir un ou plusieurs actes :</legend>';
	foreach ($listeActe as $ligne) {
		$contenu.='<p class="readOnly"><input name="radio" type="radio" value="'.$ligne->idMotif.'"/><label>'.$ligne->motif.'</label><input class="hidden" type="text"></p>';//: <input type="text" value="'.$ligne->prix.'" readonly="readonly"/
	}
	$contenu.='</fieldset>
						<fieldset>
						<legend>Veuillez choisir une piece :</legend>';
	foreach ($listePiece as $ligne) {
		$contenu.='<p><input name="checkActePiece[]" type="checkbox" value="'.$ligne->nom.'"/><label>'.$ligne->nom.'</label><input class="hidden" type="text"></p>';//: <input type="text" value="'.$ligne->prix.'" readonly="readonly"/
	}//checkActePiece1[]
	/*$contenu.='	<p> Acte : <SELECT name="acteAModifPiece" size="1">';
	foreach($listeActe as $ligne){
			$contenu.='<OPTION>'.$ligne->$motif;
	}*/
/*	$contenu.='</SELECT></p>';
	$contenu.='	<p> Piece : <SELECT name="pieceAModifPiece" size="1">';
	foreach($listePiece as $ligne){
			$contenu.='<OPTION>'.$ligne->$nom;
	}
	$contenu.='</SELECT></p>
						<p><input type="submit" value="Modifier" name="modifierPiece"/></p>
						<p><input type="submit" value="Retour" name="retourD"/></p>
						</form>';*/
	$contenu.='</fieldset>
						<p><input type="submit" value="Modifier" name="modifierPiece"/></p>
						<p><input type="submit" value="Retour" name="retourD"/></p>
						</form>';
	require_once('vue/gabarit.php');
}

function afficherModificationActe($listeActe){
	$contenu='<form id="monForm1" action="forum.php" method="post">
						<fieldset>
						<legend>Liste des actes : </legend>';
		foreach ($listeActe as $ligne) {
			$contenu.='<p class="readOnly"><input name="modifActeRadio" type="radio" value="'.$ligne->idMotif.'"/><label>'.$ligne->motif.'</label><input class="hidden" type="text"></p>';
		}
		$contenu.='</fieldset><p><label>Prix : </label><input type="text" name="modifPrix"/></p>
		<p><input type="submit" value="Modifier" name="modifActe"/></p>
		<p><input type="submit" value="Retour" name="retourD"/></p>
		</form>';
		require_once('vue/gabarit.php');
}


//Gerer medecin

function afficherModifMedecin(){
		$contenu='<form id="monForm1" action="forum.php" method="post">
			<p><input type="submit" value="Ajouter un medecin" name="creerMedecin"/></p>
			<p><input type="submit" value="Supprimer un medecin" name="suppMedecin"/></p>
			<p><input type="submit" value="Retour" name="retourD"/></p>
			</form>';
			require_once('vue/gabarit.php');
}

function afficherAjouterMedecin(){
		$contenu='<form id="monForm1" action="forum.php" method="post">
			<p><label>Nom : </label><input type="text" name="nouvNomMed"/></p>
			<p><label>Specialite : </label><input type="text" name="nouvSpeMed"/></p>
			<p><input type="submit" value="Creer" name="creerNouvMed"/></p>
			<p><input type="submit" value="Retour" name="retourD"/></p>
		</form>';
			require_once('vue/gabarit.php');
}

function afficherSuppMedecin($listeMedecin){
	$contenu='<form method="post" action="forum.php">
						<fieldset>
						<legend>Liste des medecins :</legend>';
	foreach ($listeMedecin as $ligne) {
		$contenu.='<p class="readOnly" ><input name="check[]" type="checkbox" value="'.$ligne->idMedecin.'"/><label>'.$ligne->nom.' : </label><input type="text" value="'.$ligne->specialite.'" readonly="readonly"/></p>';
	}
	$contenu.='	<p><input type="submit" value="Supprimer" name="supprimerMed"/></p>
						<p><input type="submit" value="Retour" name="retourD"/></p>
						</form>';
		require_once('vue/gabarit.php');
}


//Modifier liste pièces à fournir ou modifier consigne
function afficherPieceConsigne(){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p><input type="submit" value="Creer une piece a fournir" name="creerPiece"/></p>
		<p><input type="submit" value="Supprimer une piece a fournir" name="suppPiece"/></p>
		<p><input type="submit" value="Modifier une piece a fournir a un acte" name="modifActePiece"/></p>
		<p><input type="submit" value="Modifier consigne" name="modifConsigne"/></p>
		<p><input type="submit" value="Retour" name="retourD"/></p>
		</form>';
		require_once('vue/gabarit.php');
}

//Modifier liste pièces à fournir
function afficherPieceAFournir(){
		$contenu='<form id="monForm1" action="forum.php" method="post">
			<p><label>Acte : </label><input type="text" name="nomActe"/></p>
			<p><label>Pieces a fournir : <label><input type="text" name="pieceAFournir"/></p>
			<p><input type="submit" value="Modifier" name="modifPieceAFournir"/></p>
			<p><input type="submit" value="Retour" name="retourD"/></p>
		</form>';
			require_once('vue/gabarit.php');
}

//Modifier consigne
function afficherConsigne(){
		$contenu='<form id="monForm1" action="forum.php" method="post">
			<p><label>Acte : </label><input type="text" name="nomActe1"/></p>
			<p><label>Consignes : </label><input type="text" name="consigne"/></p>
			<p><input type="submit" value="Modifier" name="modificationConsigne"/></p>
			<p><input type="submit" value="Retour" name="retourD"/></p>
		</form>';
		require_once('vue/gabarit.php');
}


//statistiques
function afficherStatistique($listeMedecin,$nbPatient){
	$compt=0;
	foreach ($nbPatient as $ligne) {
		$compt=$compt+1;
	}
	$contenu='<form id="monForm1" action="forum.php" method="post">
						<fieldset>
						<legend>Liste des medecins</legend>';
	foreach ($listeMedecin as $ligne) {
		$contenu.='<p class="readOnly"><label>Nom : </label class="stat"><input type="text" value="'.$ligne->nom.'" readonly="readonly"/></p>
		  				<p class="readOnly"><label class="stat">Specialite : </label><input type="text" value="'.$ligne->specialite.'" readonly="readonly"/></p><br/>';
	}

	$contenu.='	</fieldset>
							<fieldset>
							<legend>Rendez-Vous</legend>
							<h5>Rendez-vous entre deux dates : </h5>
							<p><label>Entre : </label><input type="date" name="date1" placeholder="AAAA-MM-JJ"/></p>
							<p><label>Et : </label><input type="date" name="date2" placeholder="AAAA-MM-JJ"/></p>
							<p><input type="submit" value="Chercher" name="rdvEntre2Dates"/></p>
							</fieldset>';

	$contenu.=' <fieldset>
							<legend>Informations sur les patients</legend>
							<p class="readOnly"><label>Nombre de patient : </label><input type="text" value="'.$compt.'" readonly="readonly"/></p>
							<p><label>Nombre de patient ayant un solde en dessous de : </label><input type="text" name="patientSomme"/> €</p>
							<p><input type="submit" value="Valider" name="afficherPatientSomme"/></p><br/>
							<p><label>Solde des patients a une date donnee : </label><input type="date" name="dateSolde" placeholder="AAAA-MM-JJ"/></p>
							<p><input type="submit" value="Valider" name="afficherDateSolde"/></p>
							</fieldset>
							<p><input type="submit" value="Retour" name="retourD"/></p>
							</form>	';
		require_once('vue/gabarit.php');
}

function afficherNbPatientEnDessousX($somme, $nbPatient){
	$contenu='<form id="monForm1" action="forum.php" method="post">
						<p class="readOnly"><label>Nombre de patient en dessous de '.$somme.' : </label><input type="text" value="'.$nbPatient.'" readonly="readonly"></p>
						<p><input type="submit" value="Retour" name="retourD"/></p>
						</form>';
	require_once('vue/gabarit.php');
}

function afficherRdvEntre2Dates($nbRdv,$date1,$date2){
	$contenu='<form id="monForm1" action="forum.php" method="post">
						<p class="readOnly"><label class="plusGrand">Nombre de rendez-vous entre '.$date1.' et '.$date2.' : </label><input type="text" value="'.$nbRdv.'" readonly="readonly"></p>
						<p><input type="submit" value="Retour" name="retourD"/></p>
						</form>';
	require_once('vue/gabarit.php');
}

function afficherPatientSoldeInfDate($tab,$listePatient,$date){
	$contenu='<form id="monForm1" action="forum.php" method="post">';
	$compt=0;
	foreach ($listePatient as $ligne) {
		$contenu.='	<p class="readOnly"><label>Nom : </label><input type="text" value="'.$ligne->nomPatient.'" readonly="readonly"/><p>
		  					<p class="readOnly"><label> Solde a la date '.$date.' : </label><input type="text" value="'.$tab[$compt].'" readonly="readonly"/></p><br/>';
			$compt++;
	}
	$contenu.='<p><input type="submit" value="Retour" name="retourD"/></p>
						</form>';
	require_once('vue/gabarit.php');
}
