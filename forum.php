<?php

require_once('controleur/controleur.php');

try{
	//Iddentification
	$dateDuJour=date("Y-m-d");
	if(isset($_POST['envoyer'])){
		$login=$_POST['login'];
		$mdp=$_POST['mdp'];
		ctrlConnexion($login,$mdp);
	}//boutons d'interface de l'hotesse
	elseif(isset($_POST['creerCompte'])){
	ctrlCreerCompteHotesse();
	}
	elseif(isset($_POST['synthese'])){
		ctrlSyntheseHotesse();
	}elseif(isset($_POST['recherche'])){
		ctrlRechercheHotesse();
	}elseif(isset($_POST['encaisser'])){
		ctrlEncaisserHotesse();
	}elseif(isset($_POST['rdv'])){
		ctrlRDVHotesse();
	}elseif(isset($_POST['retour'])){
		ctrlRetourHotesse();
	}//boutons d'action de l'hotesse
	elseif(isset($_POST['lancerSynthese'])){
		$nss=$_POST['nss'];
		ctrlLancerSyntheseHotesse($nss);
	}elseif(isset($_POST['maj'])){
		$nom=$_POST['nom'];
		$nss=$_POST['nss'];
		$date=$_POST['date'];
		$adresse=$_POST['adresse'];
		$numTel=$_POST['numTel'];
		$mail=$_POST['mail'];
		$prof=$_POST['prof'];
		$sitFam=$_POST['sitFam'];
		ctrlMAJHotesse($nom,$nss,$date,$adresse,$numTel,$mail,$prof,$sitFam);
	}elseif(isset($_POST['lancerRecherche'])){
		$nom=$_POST['nom'];
		$date =$_POST['date'];
		ctrlLancerRechercheHotesse($nom,$date);
	}//encaisser
	elseif(isset($_POST['lancerEncaisser'])){
		$nss=$_POST['nss'];
		$montant=$_POST['montant'];
		ctrlLancerEncaisserHotesse($nss,$montant);
	}//rdv
	elseif(isset($_POST['voirRDV'])){
	ctrlVoirRDVHotesse();
	}
	elseif(isset($_POST['lancerRDV'])){
		$nomMedecin=$_POST['nomMedecin'];
		$nssPatient=$_POST['nssPatient'];
		$specialite=$_POST['specialite'];
		if(!empty($_POST['modifDatePlanning']))
			$date = $_POST['modifDatePlanning'];
		else $date = $dateDuJour;
		ctrlVerifierRDVHotesse($nssPatient,$nomMedecin,$specialite,$date);
	}elseif(isset($_POST['modifDatePlanningOK'])){
		$nomMedecin=$_POST['nomMedecin'];
		$nssPatient=$_POST['nssPatient'];
		if(!empty($_POST['modifDatePlanning']))
			$date = $_POST['modifDatePlanning'];
		else $date = $dateDuJour;
		CtlHoraireRDVHotesse($nssPatient,$nomMedecin,$date);
	}elseif(isset($_POST['validerHoraire'])){
		$nssPatient=$_POST['nssPatient'];
		$nomMedecin=$_POST['nomMedecin'];
		$date=$_POST['date'];
	if (CtlHeureLibre($nomMedecin,$date)){
			ctrlSaisirMotifHotesse($nssPatient,$nomMedecin,$date);
		}else{
			throw new Exception("Cette heure est déjà prise, vous êtes prié d'en choisir une autre");
		}
	}elseif(isset($_POST['validerMotif'])){
		$nssPatient=$_POST['nssPatient'];
		$nomMedecin=$_POST['nomMedecin'];
		$date=$_POST['date'];
		$motif=$_POST['motif'];
		ctrlValiderRDVHotesse($nssPatient,$nomMedecin,$date, $motif);
	}//creation d'un nouveau compte pour le patient
	elseif(isset($_POST['creerComptePatient'])){
		$nomPatient=$_POST['nomPatient'];
		$nss=$_POST['nss'];
		$dateDeNaissance=$_POST['dateDeNaissance'];
		$adresse=$_POST['adresse'];
		$numTel=$_POST['numTel'];
		$mail=$_POST['mail'];
		$profession=$_POST['profession'];
		$situationFamiliale=$_POST['situationFamiliale'];
		ctrlCreerComptePatient($nomPatient,$nss,$dateDeNaissance,$adresse,$numTel,$mail,$profession,$situationFamiliale);
	}//payer un rdv
	elseif(isset($_POST['payer'])){
		$idRDV=$_POST['payer'];
		ctrlPayerRDV($idRDV);
	}

//Partie Directeur -------------------------------------------------------------------------------------------------------------------
	elseif (isset($_POST['retourD'])) {
		ctrlRetourDirecteur();
	}

	//Modification des logs
	elseif (isset($_POST['modifLog'])) {
		ctrlAfficherLog();
	}
	elseif (isset($_POST['modifLogHotDir'])) {
		ctrlAfficherModifLogHotDir();
	}
	elseif (isset($_POST['modifLoginHotDir'])) {
		$nom=$_POST['hotDirRadio'];
		$login=$_POST['loginHotDir'];
		$mdp=$_POST['mdpHotDir'];
		ctrlAfficherModifLoginHotDir($nom,$login,$mdp);
	}

	elseif (isset($_POST['modifLogMedecin'])) {
		ctrlAfficherModifLogMedecin();
	}
	elseif (isset($_POST['modifLoginMedecin'])) {
		$nom=$_POST['medecinRadio'];
		$login=$_POST['loginMedecin'];
		$mdp=$_POST['mdpMedecin'];
		ctrlAfficherModifLoginMedecin($nom,$login,$mdp);
	}

	//Modification des actes
	elseif (isset($_POST['creerPiece'])) {
		ctrlafficherCeerPiece();
	}
	elseif (isset($_POST['creerNouvPiece'])) {
		$piece=$_POST['nouvPiece'];
		ctrlcreerPiece($piece);
	}
	elseif (isset($_POST['suppPiece'])) {
		ctrlafficherSuppPiece();
	}
	elseif (isset($_POST['supprimerPiece'])) {
		ctrlsuppPiece();
	}
	elseif (isset($_POST['modifActes'])) {
		ctrlAfficherModifActe();
	}
	elseif (isset($_POST['creerActe'])) {
		ctrlafficherCreerActe();
	}
	elseif (isset($_POST['creerNouvActe'])) {
		$acte=$_POST['nouvActe'];
		$prix=$_POST['nouvPrix'];
		ctrlCreerActe($acte,$prix);
	}
	elseif (isset($_POST['suppActe'])) {
		ctrlafficherSuppActe();
	}
	elseif (isset($_POST['supprimerActe'])) {
		//$acte=$_POST['acteASupp'];
	ctrlSuppActe(/*$acte*/);
	}
	elseif (isset($_POST['modifActePiece'])) {
		ctrlafficherModifPieceActe();
	}
	elseif (isset($_POST['modifierPiece'])) {
		//$acte=$_POST['acteAModifPiece'];
		//$piece=$_POST['pieceAModifPiece'];
	ctrlmodifPiece(/*$piece,$acte*/);
	}
	elseif (isset($_POST['modifPrixActe'])) {
		ctrlafficherModificationActe();
	}
	elseif (isset($_POST['modifActe'])) {
		$acte=$_POST['modifActeRadio'];
		$prix=$_POST['modifPrix'];
		ctrlModifPrixActe($acte,$prix);
	}
	elseif (isset($_POST['piecesConsignes'])) {
		ctrlafficherPieceConsigne();
	}
	elseif (isset($_POST['modifPiece'])) {
		ctrlafficherPieceAFournir();
	}
	elseif (isset($_POST['modifPieceAFournir'])) {
		$acte=$_POST['nomActe'];
		$pieces=$_POST['pieceAFournir'];
		ctrlmodifListePieceFournir($acte,$pieces);
	}
	elseif (isset($_POST['modifConsigne'])) {
		ctrlafficherConsigne();
	}
	elseif (isset($_POST['modificationConsigne'])) {
		$acte=$_POST['nomActe1'];
		$consignes=$_POST['consigne'];
		ctrlmodifConsignes($acte,$consignes);
	}

//Gérer medecins
	elseif (isset($_POST['gereMedecins'])) {
		ctrlAfficherModifMedecin();
	}
	elseif (isset($_POST['creerMedecin'])) {
		ctrlafficherAjouterMedecin();
	}
	elseif (isset($_POST['creerNouvMed'])){
		$nom=$_POST['nouvNomMed'];
		$specialite=$_POST['nouvSpeMed'];
		ctrlajouterMedecin($nom, $specialite);
	}
	elseif (isset($_POST['suppMedecin'])){
		ctrlafficherSuppMedecin();
	}
	elseif (isset($_POST['supprimerMed'])){
		ctrlsuppMedecin();
	}

	//Statistique
	elseif (isset($_POST['stats'])){
		ctrlafficherStatistique();
	}
	elseif (isset($_POST['afficherPatientSomme'])) {
		ctrlnombrePatientInfX();
	}
	elseif (isset($_POST['rdvEntre2Dates'])) {
		$date1=$_POST['date1'];
		$date2=$_POST['date2'];
		ctrlafficherRdvEntre2Dates($date1,$date2);
	}
	elseif (isset($_POST['afficherDateSolde'])) {
		$date=$_POST['dateSolde'];
		ctrlafficherPatientSoldeInfDate($date);
	}
//Partie Médecins -------------------------------------------------------------------------------------------------------------------
	elseif (isset($_POST['validerDatePlanning'])){ //Changer la date du planning
		$date = $_POST['datePlanning'];
		$nom = $_POST['NomDuMedecin'];
		$nomPlanning = $_POST['NomMedecinPlanning'];
		CtlPageMedecins($nom,$date,$nomPlanning,"Vous avez changé la date du planning à ".$date.".");
	}
	elseif(isset($_POST['J'])){ //Bloquer une heure
		if(!empty($_POST['bloquerHeure'])){
			$hoursblocked= $_POST['bloquerHeure'];
			$idMedecin=CtlGetIDMed($_POST['NomMedecinPlanning']);
			$msg="Vous venez de bloquer ";
			foreach($hoursblocked as $onehour){
				CtlBloquerHeure($onehour,$idMedecin);
				$tab = explode("/",$onehour);
				$msg.=$tab[0]."H ";
			}
		} else $msg = "Veuillez cocher une case, tout du moins avant de cliquer sur 'Bloquer les heures.'";
		CtlPageMedecins($_POST['NomDuMedecin'], $_POST['DateDuPlanning'], $_POST['NomMedecinPlanning'],$msg);
	}
	elseif(isset($_POST['debloquerHeure'])){ //Débloquer une heure
		$date=$_POST['datePlanning'];
		$heure=$_POST['debloquerHeure'][0];
		$nomedplan = $_POST['NomMedecinPlanning'];
		$idMedecin=CtlGetIDMed($nomedplan);
		CtlDebloquerHeure($date,$heure,$idMedecin);
		$tab = explode(" ",$heure);
		CtlPageMedecins($_POST['NomDuMedecin'],$date,$nomedplan,"Le créneau de ".$tab[1]."H a été débloqué.");
	}

	elseif(isset($_POST['MedecinPlanning'])){ // Afficher le planning d'un autre médecin
		$nom = $_POST['NomDuMedecin'];
		$date = $_POST['datePlanning'];
		$nomPlanning =  $_POST['MedecinPlanning'];
		CtlPageMedecins($nom,$date,$nomPlanning,"Vous regardez le planning de ".$nomPlanning.".");
	}
	elseif(isset($_POST['planningRDV'])){ //Affiche le RDV sélectionné
		$chaineRDV = $_POST['planningRDV'];
		$tab = explode("(", $chaineRDV);
		$tab2 = explode(")", $tab[1]);
		$idRDV = $tab2[0]; //Récupère l'idRDV entre parenthèses
		CtlAfficherRDV($idRDV);
	}
	elseif(isset($_POST['rdvTermine'])){ //Permet de remplir le compte-rendu, le suivi et la prescription d'un rendez-vous
		$idRDV = $_POST['idRDV'];
		CtlRemplirRDV($idRDV);
	}
	elseif(isset($_POST['finDuRDV'])){ //Permet de sauvegarder les informations du rendez-vous dans la base de données
		$compteRendu=$_POST['compteRenduRDV'];
		$suivi=$_POST['suiviRDV'];
		$prescription=$_POST['prescriptionRDV'];
		$idRDV=$_POST['idRDV'];
		CtlSauvegarderRDV($compteRendu, $suivi, $prescription, $idRDV);
		CtlAfficherRDV($idRDV);	
	}
	elseif(isset($_POST['retourPageMedFromRDV'])){
		$idMed=$_POST['idMed'];
		$date=$_POST['date'];
		$heure=explode(":",$_POST['heure']);
		$nom = CtlGetNomMed($idMed);
		CtlPageMedecins($nom,$date,$nom,"Vous venez de consulter le rendez-vous du ".$date." à ".$heure[0]."H.");
	}
	
	//choix par defaut : lancer l'identification
	else{
		ctrlAccueil();
	}
}catch(Exception $e){
		$msg=$e->getMessage();
		ctrlErreur($msg);
}
