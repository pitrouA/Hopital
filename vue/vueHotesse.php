<?php

/*
La page principale de l'Hotesse. Contiens 5 boutons permettant de:
-Lancer une synthese d'un patient a partir de son NSS
-Trouver le NSS d'un patient a partir de son nom et de sa date de naissance.
-Encaisser l'argent necessaire pour les consultations a partir du NSS d'un patient
-Prendre un rdv pour un patient a partir de son NSS, du nom du medecin et de la specialite du medecin.
-Se deconnecter.
*/
function pageHotesse(){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p><input type="submit" value="CreerCompte" name="creerCompte"/></p>
		<p><input type="submit" value="Synthèse" name="synthese"/></p>
		<p><input type="submit" value="Chercher NSS" name="recherche"/></p>
		<p><input type="submit" value="Encaisser" name="encaisser"/></p>
		<p><input type="submit" value="Rendez-vous" name="rdv"/></p>
		<p><input type="submit" value="RDVNonPayes" name="voirRDV"/></p>
		<p><input type="submit" value="Deconnexion" name="deconnexion"/></p>
	</form>';
	require_once('vue/gabarit.php');
}
function pageHotesseBienvenue($nom){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p class="good">Bienvenue '.$nom.'</p>
		<p><input type="submit" value="CreerCompte" name="creerCompte"/></p>
		<p><input type="submit" value="Synthèse" name="synthese"/></p>
		<p><input type="submit" value="Chercher NSS" name="recherche"/></p>
		<p><input type="submit" value="Encaisser" name="encaisser"/></p>
		<p><input type="submit" value="Rendez-vous" name="rdv"/></p>
		<p><input type="submit" value="RDVNonPayes" name="voirRDV"/></p>
		<p><input type="submit" value="Deconnexion" name="deconnexion"/></p>
	</form>';
	require_once('vue/gabarit.php');
}
function pageHotesseErreur($msg){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p class="error">Attention ! '.$msg.'</p>
		<p><input type="submit" value="CreerCompte" name="creerCompte"/></p>
		<p><input type="submit" value="Synthèse" name="synthese"/></p>
		<p><input type="submit" value="Chercher NSS" name="recherche"/></p>
		<p><input type="submit" value="Encaisser" name="encaisser"/></p>
		<p><input type="submit" value="Rendez-vous" name="rdv"/></p>
		<p><input type="submit" value="RDVNonPayes" name="voirRDV"/></p>
		<p><input type="submit" value="Deconnexion" name="deconnexion"/></p>
	</form>';
	require_once('vue/gabarit.php');
}
function afficherBoutonsNouveauCompte(){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p><label> Nom : </label><input type="text" name="nomPatient"/></p>
		<p><label> NSS : </label><input type="number" name="nss"/></p>
		<p><label> Date de Naissance : </label><input type="date" name="dateDeNaissance" placeholder="AAAA/MM/JJ"/></p>
		<p><label> Adresse : </label><input type="text" name="adresse"/></p>
		<p><label> Numero de telephone : </label><input type="number" name="numTel"/></p>
		<p><label> Mail : </label><input type="text" name="mail"/></p>
		<p><label> Profession : </label><input type="text" name="profession"/></p>
		<p><label> Situation Familiale : </label><input type="text" name="situationFamiliale"/></p>
		<p><input type="submit" value="Creer un compte" name="creerComptePatient"/></p>
		<p><input type="submit" value="Retour" name="retour"/></p>
	</form>';
	require_once('vue/gabarit.php');
}
function afficherBoutonsSynthese(){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p><label> N° de securité sociale du patient :</label><input type="number" name="nss"/></p>
		<p><input type="submit" value="Synthèse" name="lancerSynthese"/></p>
		<p><input type="submit" value="Retour" name="retour"/></p>
	</form>';
	require_once('vue/gabarit.php');
}
function afficherBoutonsRecherche(){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p><label> Nom du patient : </label><input type="text" name="nom"/></p>
		<p><label> Date de naissance : </label><input type="text" name="date"/></p>
		<p><input type="submit" value="Recherche" name="lancerRecherche"/></p>
		<p><input type="submit" value="Retour" name="retour"/></p>
	</form>';
	require_once('vue/gabarit.php');
}
function afficherBoutonsEncaisser(){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p><label> N° de securite sociale : </label><input type="text" name="nss"/></p>
		<p><label> Montant : </label><input type="number" name="montant"/></p>
		<p><input type="submit" value="Encaisser" name="lancerEncaisser"/></p>
		<p><input type="submit" value="Retour" name="retour"/></p>
	</form>';
	require_once('vue/gabarit.php');
}
function afficherBoutonsEncaisserErreur($msg,$nss){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p class="error"> Attention ! '.$msg.'</p>
		<p class=readOnly><label> N° de securite sociale : </label><input type="text" value="'.$nss.'" name="nss" readOnly="readOnly"/></p>
		<p><label> Montant :</label><input type="number" name="montant"/></p>
		<p><input type="submit" value="Encaisser" name="lancerEncaisser"/></p>
		<p><input type="submit" value="Retour" name="retour"/></p>
	</form>';
	require_once('vue/gabarit.php');
}
function afficherBoutonsRDV(){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p><label> NSS du Patient : </label><input type="text" name="nssPatient"/></p>
		<p><label> Nom medecin : </label><input type="text" name="nomMedecin"/></p>
		<p><label> Specialite du medecin : </label><input type="text" name="specialite"/></p>
		<p><input type="submit" value="RDV" name="lancerRDV"/></p>
		<p><input type="submit" value="Retour" name="retour"/></p>
	</form>';
	require_once('vue/gabarit.php');
}
function afficherResultatSyntheseHotesse($nom,$nss,$ddn,$adresse,$numTel,$mail,$prof,$sitFam,$somme,$listeConsultations){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p class="readOnly"><label>Nom : </label><input type="text" value="'.$nom.'" name="nom" readonly="readonly"/><br></p>
		<p class="readOnly"><label>NSS : </label><input type="text" value="'.$nss.'" name="nss" readonly="readonly"/><br></p>
		<p class="readOnly"><label>Date de naissance : </label><input type="text" value="'.$ddn.'" name="date" readonly="readonly"/><br></p>
		<p><label>Adresse : </label><input type="text" value="'.$adresse.'" name="adresse"/><br></p>
		<p><label>N° de Tel : </label><input type="text" value="'.$numTel.'" name="numTel"/><br></p>
		<p><label>Mail : </label><input type="text" value="'.$mail.'" name="mail"/><br></p>
		<p><label>Profession : </label><input type="text" value="'.$prof.'" name="prof"/><br></p>
		<p><label>SituationFamiliale : </label><input type="text" value="'.$sitFam.'" name="sitFam"/><br></p>
		<p><input type="submit" value="Mettre a jour" name="maj"/></p><br/><br/>
		<hr><br/>
		<p class="readOnly"><label>Quantité d\'argent restant : </label><input type="text" value="'.$somme.'" readonly="readonly"/> €</p><br/>
		<hr><br/>';
	foreach($listeConsultations as $ligne){
		$contenu=$contenu.'<p class="consultation">Consultation ID'.$ligne->idRDV.' : '.$ligne->intitule.' <br></p>
			<p class="readOnly"><label>Nom du medecin :</label><input type="text" value="'.$ligne->nom.'" readonly="readonly"/><br></p>
			<p class="readOnly"><label>Date et Heure de l\'intervention : </label><input type="text" value="'.$ligne->date.'" readonly="readonly"/> à <input type="text" value="'.$ligne->heure.'" readonly="readonly"/><br></p>
			<p class="readOnly"><label>Compte-rendu : </label><input type="text" value="'.$ligne->compteRendu.'" readonly="readonly"/><br></p>
			<p class="readOnly"><label>Suivi : </label><input type="text" value="'.$ligne->suivi.'" readonly="readonly"/><br></p>
			<p class="readOnly"><label>Prescription : </label><input type="text" value="'.$ligne->prescription.'" readonly="readonly"/><br></p>
			<p class="readOnly"><label>Prix de l\'intervention : </label><input type="text" value="'.$ligne->prix.'" readonly="readonly"/>€<br></p>
			<p class="readOnly"><label>Statut : </label><input type="text"value="'.$ligne->statut.'" readonly="readonly"/><br></p><br/>';
	}
	$contenu=$contenu.'<p><input type="submit" value="Retour" name="retour"/></p></form>';
	require_once('vue/gabarit.php');
}
function afficherResultatRechercheHotesse($nom,$nss){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p class="readOnly">Nom patient : <input type="text" value="'.$nom.'" name="nom" readOnly="readOnly"/></p>
		<p class="readOnly">NSS : <input type="number" value="'.$nss.'" name="nss" readOnly="readOnly"/></p>
		<p><input type="submit" value="Retour" name="retour"/></p>
	</form>';
	require_once('vue/gabarit.php');
}
function afficherResultatEncaisserHotesse($nss,$montant){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p>NSS : '.$nss.' a ete credite de : '.$montant.'</p>
		<p><input type="submit" value="Retour" name="retour"/></p>
	</form>';

	require_once('vue/gabarit.php');
}
function afficherResultatRDVHotesse($nssPatient,$nomMedecin,$planningMedecin,$date){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p class="readOnly"><label>Rendez-vous avec Mr/Mme </label><input type="text" value="'.$nomMedecin.'" name="nomMedecin" readonly="readonly"/></p>
		<p class="readOnly"><label>Pour le patient de NSS : </label><input type="text" value="'.$nssPatient.'" name="nssPatient" readonly="readonly"/></p>
		<div class="hotessePlanning">
		<p > Entrer la Date du rendez-vous : <br /><input class="rdv" type="date" value="'.$date.' 00:00" name="date"/></p>
		<p><input type="submit" value="Valider" name="validerHoraire"/></p><br />
		<p> Voir le planning du : <br />
		<input class="rdv" type="text" name="modifDatePlanning" value="'.$date.'"/></p><p><input type="submit" name="modifDatePlanningOK" value="OK"/></p><br />
		<p><input type="submit" value="Retour" name="retour"/></p>
	</div>'.$planningMedecin.'</form>';
	require_once('vue/gabarit.php');
}
function afficherResultatRDVHotesseErreur($nssPatient,$nomMedecin,$msg,$planningMedecin,$date){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p class="error">Attention ! '.$msg.'<br></p>
		<p class="readOnly">Rendez-vous avec mr <input type="text" value="'.$nomMedecin.'" name="nomMedecin" readonly="readonly"/></p>
		<p class="readOnly">Pour le patient de NSS : <input type="text" value="'.$nssPatient.'" name="nssPatient" readonly="readonly"/> le : </p>
		<p><label> Entrer la Date du rendez-vous : </label><br /><input type="date" value="'.$date.'" name="date"/></p>
		<p><input type="submit" value="Valider Horaire" name="validerHoraire"/></p><br />
		<p> Voir le planning le : <br />
		<input type="text" name="modifDatePlanning" value="'.$date.'"><input type="submit" name="modifDatePlanningOK" value="OK"></p><br />
		<p><input type="submit" value="Retour" name="retour"/></p>
	</div>'.$planningMedecin.'</form>';
	require_once('vue/gabarit.php');
}
function afficherMotifsHotesse($nssPatient, $nomMedecin, $date, $heure, $motifs){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p class="readOnly"><label>Rendez-vous avec Mr/Mme : </label><input type="text" value="'.$nomMedecin.'" name="nomMedecin" readonly="readonly"/></p>
		<p class="readOnly"><label>Pour Mr/Mme : </label><input type="text" value="'.$nssPatient.'" name="nssPatient" readonly="readonly"/></p>
		<p class="readOnly"><label> Date : </label><input type="date" value="'.$date.' '.$heure.'" name="date" readonly="readonly"/></p>
		<p> <label>Choisir un motif pour la consultation : </label><SELECT name="motif" size="1">';
	foreach($motifs as $ligne){
			$contenu=$contenu.'<OPTION>'.$ligne->motif;
	}
	$contenu=$contenu.'</SELECT></p><p><input type="submit" value="Valider Horaire" name="validerMotif"/></p>
		<p><input type="submit" value="Retour" name="retour"/></p>
		</form>';
	require_once('vue/gabarit.php');
}
function afficherReccomandations($infosMotif){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p>Le RDV a bien été pris.</p>
		<p>Veillez toutefois à bien prendre notes des reccomandations suivantes : '.$infosMotif->reccomandations.'</p>
		<p>Veillez aussi à apporter les pieces suivantes : '.$infosMotif->pieces.'</p>
		<p><input type="submit" value="Retour" name="retour"/></p>
	</form>';
	require_once('vue/gabarit.php');
}
function afficherNouveauCompte($nssPatient){
	$contenu='<form id="monForm1" action="forum.php" method="post">
		<p class="error">Attention ! Ce patient n\'est pas connu de nos services. Merci de prendre ses informations avant toute chose.</p>
		<p> Nom : <input type="text" name="nomPatient"/></p>
		<p class="readOnly"> NSS : <input type="number" value="'.$nssPatient.'" name="nss" readonly="readonly"/></p>
		<p> Date de Naissance : <input type="date" name="dateDeNaissance" placeholder="AAAA/MM/JJ"/></p>
		<p> Adresse : <input type="text" name="adresse"/></p>
		<p> Numero de telephone : <input type="number" name="numTel"/></p>
		<p> Mail : <input type="text" name="mail"/></p>
		<p> Profession : <input type="text" name="profession"/></p>
		<p> Situation Familiale : <input type="text" name="situationFamiliale"/></p>
		<p><input type="submit" value="Creer un compte" name="creerComptePatient"/></p>
		<p><input type="submit" value="Reesayer" name="lancerRDV"/></p>
		<p><input type="submit" value="Retour" name="retour"/></p>
	</form>';
	require_once('vue/gabarit.php');
}
function afficherListeRDV($rdv){
	$contenu='<form action="forum.php" method="post"><fieldset><legend> Liste des RDV non-Payes</legend>';
	$var=0;
	foreach($rdv as $ligne){
		$var=$var+1;
		$contenu=$contenu.'<fieldset><legend>Rendez-vous n°'.$var.'</legend>
												<label class="plusGrand">De Mr/Mme '.$ligne->nomPatient.'
					avec le docteur '.$ligne->nom.' <br/>coût : '.$ligne->prix.' </label>
					<input type="submit" value="Payer ce RDV(ID:'.$ligne->idRDV.')" name="payer"/ ></p></fieldset>
					<input type="hidden" value="'.$ligne->idRDV.'" name="num">';
	}
	$contenu=$contenu.'<p><input type="submit" value="Retour" name="retour"/></p>
										</fieldset>
										</form>';
	require_once('vue/gabarit.php');
}
