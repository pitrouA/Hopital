<?php

require_once('modele/modele.php');
require_once('modele/modeleHotesse.php');
require_once('modele/modeleDirecteur.php');
require_once('modele/modeleMedecin.php');

require_once('vue/vueHotesse.php');
require_once('vue/vueDirecteur.php');
require_once('vue/vue.php');
require_once('vue/vueMedecin.php');


/*La page d'accueil du site et celle affichée à chaque deconnexion*/
function ctrlAccueil(){
	identification();
}
/*function ctrlAjouterMessage($nom,$message){
	if(!empty($nom)&&!empty($message)){
		ajouterMessage($nom,$message);
		ctrlAccueil();
	}else{
		throw new Exception("nom ou message invalide");
	}
}
function ctrlSupprimerMessage($id){
	if(ctype_digit($id)){
		supprimerMessage($id);
		ctrlAccueil();
	}else{
		throw new Exception("id message invalide");
	}
}*/
function ctrlConnexion($login,$mdp){
	if(!empty($login)&&!empty($mdp)){
		$user=getUser($login,$mdp);
		if(!empty($user)){
			$nom=$user[0]->nom;
			$type=$user[0]->type;
			if ($type == "hotesse d'accueil"){
				pageHotesseBienvenue($nom);
			} else if ($type == "chef"){
				pageDirecteurBienvenue($nom);
			} else {
				$date=date("Y-m-d");
				CtlPageMedecins($nom,$date,$nom,"Bienvenue guimauve !");
			}
			//pageHotesseBienvenue($nom);
		}else{
			identificationErreur('L \'identification n\' a pu se faire');
		}
	}else{
		throw new Exception("nom ou message invalide");
	}
}
/*Appelle l'affichage de la creation de compte*/
function ctrlCreerCompteHotesse(){
	afficherBoutonsNouveauCompte();
}
/*Appelle l'affichage des boutons de synthese de l'hotesse*/
function ctrlSyntheseHotesse(){
	afficherBoutonsSynthese();
}
/*Appelle l'affichage des boutons de recherche de l'hotesse*/
function ctrlRechercheHotesse(){
	afficherBoutonsRecherche();
}
/*Appelle l'affichage des boutons d' encaissement de l'hotesse*/
function ctrlEncaisserHotesse(){
	afficherBoutonsEncaisser();
}
/*Appelle l'affichage des boutons de rendez-vous de l'hotesse*/
function ctrlRDVHotesse(){
	afficherBoutonsRDV();
}
/*affiche les rdv non-payes*/
function ctrlVoirRDVHotesse(){
	$rdv=recupererRDVNonPayes();
	afficherListeRDV($rdv);
}
/*Appelle le retour au menu de l'hotesse*/
function ctrlRetourHotesse(){
	pageHotesse();
}
/*Appelle une synthese du patient*/
function ctrlLancerSyntheseHotesse($nss){
	if(!empty($nss)){
		$patient=getSynthese($nss);//verifie si le patient existe et auquel cas, recupere sa synthese
		$somme=getSomme($nss);
		$listeConsultations=getListeConsultations($nss);
		if(!empty($patient)){
			$nom=$patient[0]->nomPatient;
			$ddn=$patient[0]->dateDeNaissance;
			$adresse=$patient[0]->adresse;
			$numTel=$patient[0]->numTel;
			$mail=$patient[0]->mail;
			$prof=$patient[0]->profession;
			$sitFam=$patient[0]->situationFamiliale;
			afficherResultatSyntheseHotesse($nom,$nss,$ddn,$adresse,$numTel,$mail,$prof,$sitFam,$somme,$listeConsultations);
		}else{
			afficherNouveauCompte($nssPatient);//creer un nouveau compte pour le patient
		}
	}else{
		throw new Exception("nss vide");
	}
}
/*Fait la MAJ du patient*/
function ctrlMAJHotesse($nom,$nss,$date,$adresse,$numTel,$mail,$prof,$sitFam){
	if(!empty($nom)&&!empty($nss)&&!empty($date)&&!empty($adresse)&&!empty($numTel)&&!empty($mail)&&!empty($prof)&&!empty($sitFam)){
		MAJ($nom,$nss,$date,$adresse,$numTel,$mail,$prof,$sitFam);
		ctrlLancerSyntheseHotesse($nss);
	}else{
		throw new Exception("Un des champs vide");
	}
}
/*Appelle une recherche du patient*/
function ctrlLancerRechercheHotesse($nom,$date){
	if(!empty($nom)&&!empty($date)){
		$nss=getNSS($nom,$date);
		if(!empty($nss)){
			afficherResultatRechercheHotesse($nom,$nss);
		}else{
			echo 'zut, rate. La recherche n\' a pu se faire<br>';
			ctrlRechercheHotesse();
		}
	}else{
		throw new Exception("nom ou nss vides");
	}
}
/*Appelle l'encaissement du compte du patient*/
function ctrlLancerEncaisserHotesse($nssPatient,$montant){
	if(!empty($nssPatient)&&!empty($montant)){
		$patient=getSynthese($nssPatient);//verifie si le patient existe
		if(!empty($patient)){
			setMontant($nssPatient,$montant);//execute l'encaissement
			afficherResultatEncaisserHotesse($nssPatient,$montant);//affiche le resultat de l'encaissement
		}else{
			afficherNouveauCompte($nssPatient);//creer un nouveau compte pour le patient
		}
	}else{
		throw new Exception("nssPatient ou montant vides");
	}
}
/*Appelle une prise de rdv pour le patient*/
function ctrlVerifierRDVHotesse($nssPatient,$nomMedecin,$specialite,$date){
	if(!empty($nssPatient)&&!empty($nomMedecin)&&!empty($specialite)){
		$patient=getSynthese($nssPatient);//verifie si le patient existe
		if(!empty($patient)){
			$medecin=getMedecin($nomMedecin,$specialite);//verifie que le medecin existe
			if(!empty($medecin)){
				CtlHoraireRDVHotesse($nssPatient,$nomMedecin,$date);
			}else{
				echo("Le médecin et la spécialité sélectionnés ne correspondent pas.");
				ctrlRDVHotesse();
			}
		}else{
			afficherNouveauCompte($nssPatient);//creer un nouveau compte pour le patient
		}
	}else{
		throw new Exception("nssPatient, nomMedecin ou specialite vides");
	}
}

function CtlHoraireRDVHotesse($nssPatient,$nomMedecin,$date){
	$idPlanning = CtlGetIDMed($nomMedecin);
	$listeRDV=getRDV($idPlanning,$date);
	$blockedHours = getHoursBlocked($idPlanning,$date);
	$planningMedecin = afficherPlanning($nomMedecin,$date,$listeRDV,$blockedHours);
	afficherResultatRDVHotesse($nssPatient,$nomMedecin,$planningMedecin,$date);
}

/*Appelle la saisie du motif*/
function ctrlSaisirMotifHotesse($nssPatient,$nomMedecin,$date){
	if(!empty($nssPatient)&&!empty($nomMedecin)&&!empty($date)){
		$motifs=getMotifs();
		$dateDemi=explode(" ", $date);
		$calendrScind = explode("-", $dateDemi[0]);
		$horlogeScind = explode(":", $dateDemi[1]);

		$jour = $calendrScind[2];
		$mois = $calendrScind[1];
		$annee = $calendrScind[0];
		$heure = $horlogeScind[0];
		$min = $horlogeScind[1];
		if ($jour>0&&$jour<32&&$mois>0&&$mois<13&&$heure>-1&&$heure<24&&$min>-1&&$min<60){
			$date=$annee.'-'.$mois.'-'.$jour;
			$heure=$heure.':'.$min ;
			if(!empty($motifs)){
				afficherMotifsHotesse($nssPatient, $nomMedecin, $date, $heure, $motifs);
			}else{
				afficherResultatRDVHotesseErreur($nssPatient,$nomMedecin,'Il n\' y a pas de motifs a chercher',$planningMedecin,$date);
			}
		}else{
			echo $jour." "; echo $mois." aa";echo $heure." et";echo $min;

			$idPlanning = CtlGetIDMed($nomMedecin);
			$listeRDV=getRDV($idPlanning,$date);
			$blockedHours = getHoursBlocked($idPlanning,$date);
			$planningMedecin = afficherPlanning($nomMedecin,$date,$listeRDV,$blockedHours);
			afficherResultatRDVHotesseErreur($nssPatient,$nomMedecin,'Veuillez saisir correctement la date du RDV.',$planningMedecin,$date);
		}
	}else{
		throw new Exception("NSSpatient, nomMedecin ou date sont vides.");
	}
}
/*Appelle la validation du rdv*/
function ctrlValiderRDVHotesse($nssPatient,$nomMedecin,$date, $motif){
	if(!empty($nssPatient)&&!empty($nomMedecin)&&!empty($date)&&!empty($motif)){
		$idMedecin=getIDMedecin($nomMedecin);
		$infosMotif=getInfosMotif($motif);
		if(!empty($idMedecin)&&!empty($infosMotif)){
			validerRDV($idMedecin,$nssPatient,$date, $infosMotif);
			afficherReccomandations($infosMotif);
		}else{
			echo 'zut, rate. Impossible de prendre ce RDV<br>';
			ctrlSaisirMotifHotesse($nomPatient,$nomMedecin,$date);//a cause de la recuperation des motifs dans la BDD
		}
	}else{

		throw new Exception("nomPatient, nomMedecin ou date vides");
	}
}
/*Fait payer le RDV*/
function ctrlPayerRDV($chaineIDRDV){
	if(!empty($chaineIDRDV)){
		$tabID=explode(":",$chaineIDRDV);
		$tabID2=explode(")",$tabID[1]);
		$idRDV = $tabID2[0];
		$rdv=recupererUnRDVNonPaye($idRDV);
		if(!empty($rdv)){
			$nssPatient=$rdv->NSSpatient;
			$prix=$rdv->prix;
			$somme=getSomme($nssPatient);
			if($prix<=$somme){
				$idMedecin=$rdv->idMedecin;
				$date=$rdv->date;
				$idMotif=$rdv->idMotif;
				validerPayement($idRDV);
				setMontant($nssPatient,-$prix);//deduit l'argent de la consultation
				ctrlVoirRDVHotesse();
			}else{
				afficherBoutonsEncaisserErreur('Le patient n\' a pas assez d\' argent sur son compte.',$nssPatient);
			}
		}else{
			echo 'zut, rate. Impossible de payer ce RDV<br>';
			ctrlVoirRDVHotesse();
		}
	}else{
		throw new Exception("num est vide");
	}
}
/*Cree un nouveau compte pour le patient*/
function ctrlCreerComptePatient($nomPatient,$nss,$dateDeNaissance,$adresse,$numTel,$mail,$profession,$situationFamiliale){
	if(!empty($nomPatient)&&!empty($nss)&&!empty($dateDeNaissance)&&!empty($adresse)&&!empty($numTel)
		&&!empty($mail)&&!empty($profession)&&!empty($situationFamiliale)){
		if(empty(getSynthese($nss))){
			creerComptePatient($nomPatient,$nss,$dateDeNaissance,$adresse,$numTel,$mail,$profession,$situationFamiliale);
			pageHotesse();
		}else{
			pageHotesseErreur('Ce compte existe dejà.');
		}
	}else{
		throw new Exception("un ou plusieurs champs vides");
	}
}

//Pour le directeur

function ctrlRetourDirecteur(){
	pageDirecteur();
}
//Modification des logs :
function ctrlAfficherLog(){
	afficherModifLogin();
}

function ctrlAfficherModifLogHotDir(){
	$listeHotDir=listeHotDir();
	afficherModifLoginHotDir($listeHotDir);
}

function ctrlAfficherModifLoginHotDir($nom,$login,$mdp){
	if(!empty($nom) && !empty($login) && !empty($mdp)){
		creeMofifLoginsPersonnelsAuxiliaires($nom, $login, $mdp);
		pageDirecteur();
	}
	else{
		throw new Exception("un ou plusieurs champs vides");
	}
}

function ctrlAfficherModifLogMedecin(){
	$listeMedecin=getListeMedecin();
	afficherModifLoginMedecin($listeMedecin);
}

function ctrlAfficherModifLoginMedecin($nom,$login,$mdp){
	if(!empty($nom) && !empty($login) && !empty($mdp)){
		modifLoginsMedecin($nom, $login, $mdp);
		pageDirecteur();
		}
		else{
			throw new Exception("un ou plusieurs champs vides");
		}
}


//Gérer les actes

function ctrlAfficherModifActe(){
	afficherModifActe();
}

function ctrlafficherCeerPiece(){
	afficherCeerPiece();
}

function ctrlcreerPiece($piece){
	if(!empty($piece)){
		creerPiece($piece);
		pageDirecteur();
	}
	else{
		throw new Exception("le champ est vide");
	}
}

function ctrlafficherSuppPiece(){
	$listePieces=listePieces();
	afficherSuppPiece($listePieces);
}

function ctrlsuppPiece(){
	foreach ($_POST['checkPiece'] as $val) {
			suppPiece($val);
	}
	pageDirecteur();
}

function ctrlafficherCreerActe(){
	afficherCreerActe();
}

function ctrlCreerActe($acte,$prix){
	if(!empty($acte) && !empty($prix)){
		creerActe($acte, $prix);
	}
	else{
		throw new Exception("un ou plusieurs champs vides");
	}
	pageDirecteur();
}

function ctrlafficherSuppActe(){
	$listeActe=listeActes();
	afficherSuppActe($listeActe);
}

function ctrlSuppActe(){
	foreach ($_POST['checkActe'] as $val) {
			suppActe($val);
	}
	pageDirecteur();
	/*if(!empty($acte)){
		suppActe($acte);
	}
	pageDirecteur();*/
}

function ctrlafficherModifPieceActe(){
	$listeActes=listeActes();
	$listePieces=listePieces();
	afficherModifPieceActe($listeActes,$listePieces);
}

function ctrlmodifPiece(/*$piece,$acte*/){
	//if(!empty($piece) && !empty($acte)){
	$listePieces='';
	if(isset($_POST['checkActePiece']) && isset($_POST['radio'])){
		$acte=$_POST['radio'];
		foreach ($_POST['checkActePiece'] as $piece)
			$listePieces.=$piece.', ';
		modifPiece($listePieces, $acte);
	}
	else{
		throw new Exception("un ou plusieurs champs vides");
	}

	//}
	//else{
	//	throw new Exception("un ou plusieurs champs vides");
	//}
	pageDirecteur();
}


function ctrlafficherModificationActe(){
	$listeActe=listeActes();
	afficherModificationActe($listeActe);
}

function ctrlModifPrixActe($acte,$prix){
	if(!empty($acte) && !empty($prix)){
		modifActe($acte, $prix);
	}
	else{
		throw new Exception("un ou plusieurs champs vides");
	}
	pageDirecteur();
}

function ctrlafficherPieceConsigne(){
	afficherPieceConsigne();
}

function ctrlafficherPieceAFournir(){
	afficherPieceAFournir();
}

function ctrlmodifListePieceFournir($acte,$pieces){
	if(!empty($acte) && !empty($pieces)){
		modifListePieceFournir($acte, $pieces);
	}
	else{
		throw new Exception("un ou plusieurs champs vides");
	}
	pageDirecteur();
}

function ctrlafficherConsigne(){
	afficherConsigne();
}

function ctrlmodifConsignes($acte,$consignes){
	if(!empty($acte) && !empty($consignes)){
		modifConsignes($acte, $consignes);
	}
	else{
		throw new Exception("un ou plusieurs champs vides");
	}
	pageDirecteur();
}

function ctrlAfficherModifMedecin(){
	afficherModifMedecin();
}

function ctrlafficherAjouterMedecin(){
	afficherAjouterMedecin();
}

function ctrlajouterMedecin($nom, $specialite){
	if(!empty($nom) && !empty($specialite)){
		ajouterMedecin($nom, $specialite);
	}
	else{
		throw new Exception("un ou plusieurs champs vides");
	}
	pageDirecteur();
}

function ctrlafficherSuppMedecin(){
	$listeMedecin=getListeMedecin();
	afficherSuppMedecin($listeMedecin);
}

function ctrlsuppMedecin(){
	foreach ($_POST['check'] as $val) {
			suppMedecin($val);
	}
	pageDirecteur();
}


//Statistiques
function ctrlafficherStatistique(){
	$listeMedecin=getListeMedecin();
	$nbPatient=listePatient();
	afficherStatistique($listeMedecin,$nbPatient);
}

function ctrlnombrePatientInfX(){
	if(!empty($_POST['patientSomme'])){
		$somme=$_POST['patientSomme'];
		$nbPatient=nombrePatientInfX($somme);
		afficherNbPatientEnDessousX($somme, $nbPatient);
	}
	else{
		throw new Exception("Le champ est vide");
	}
}

function ctrlafficherRdvEntre2Dates($date1,$date2){
	if(!empty($date1) && !empty($date2)){
		if($date1<$date2){
			$nbRdv=rdvEntre2Dates($date1,$date2);
			afficherRdvEntre2Dates($nbRdv,$date1,$date2);
		}
		else{
			throw new Exception("La premiere date doit etre inferieure a la deuxieme");
		}
	}
	else{
		throw new Exception("un ou plusieurs champs vides");
	}
}

function ctrlafficherPatientSoldeInfDate($date){
	if(!empty($date))
	{
		$listePatient=listePatient();
		$tab=soldeDateX($date);
		afficherPatientSoldeInfDate($tab,$listePatient,$date);
	}
}

//Partie Médecins -------------------------------------------------------------------------------------------------------------------

function CtlPageMedecins($nom,$date,$nomPlanning,$msg){ //Affiche la page d'un Médecin
	$listemed = getListeMedecin();
	$idPlanning = CtlGetIDMed($nomPlanning);
	$listeRDV=getRDV($idPlanning,$date);
	$blockedHours = getHoursBlocked($idPlanning,$date);
	if ($nom == $nomPlanning)
		MaPageMedecin($nom,$listemed,$date,$nomPlanning,$listeRDV,$blockedHours,$msg);
	else
	//	echo "tata";
		pageMedecin($nom,$listemed,$date,$nomPlanning,$listeRDV,$blockedHours,$msg);

}

function CtlGetIDMed($nom){ //Renvoie l'ID du médecin selon son nom
	$IDMed = getIDMed($nom);
	return $IDMed;
}
function CtlGetNomMed($idMed){
	$nomMed = getNomMed($idMed);
	return $nomMed;
}

function CtlBloquerHeure($chaine,$idMed){ //Bloque les heures d'un médecin
	if (!empty($chaine)){
	echo $chaine;
	$tab = explode("/", $chaine); //Heure:Date
	$heure = $tab[0];
	if ($heure<10) $heure='0'.$heure.':00:00';
	else $heure.=':00:00';
	bloquerHeure($heure,$tab[1],$idMed);
	}else echo "ah";
}

function CtlDebloquerHeure($date,$heure,$idMedecin){ //Débloque l'heure d'un médecin
	$tab = explode(" ",$heure); // Débloquer X Heure
	$heure = $tab[1];
	if ($heure<10) $heure='0'.$heure.':00:00';
	else $heure.=':00:00';
	echo $heure;
	debloquerHeure($date,$heure,$idMedecin);
}

function CtlHeureLibre($nomMedecin,$dateheure){
	$tab=explode(" ",$dateheure);
	$date=$tab[0];
	$heure=$tab[1];
	$idMed = CtlGetIDMed($nomMedecin);
	echo $date.' '.$heure.' '.$idMed.' controleur';
	return isThisHourEmpty($date,$heure,$idMed);
}

function CtlAfficherRDV($idRDV){
	$nss = getNSSDuRDV($idRDV) ;
	if(!empty($nss)){
		$tabPatient=getSynthese($nss); //modeleHotesse, récupère la synthèse du patient si ce dernier existe
		if(!empty($tabPatient)){
			$patient=$tabPatient[0]; //Contient toutes les infos de la synthèse du patient
			$rdvFini=getRDVFini($idRDV);
			$infoRDV = getInfoDuRDV($idRDV);
			echo $infoRDV->idMedecin;
			afficherRDV($nss,$patient,$rdvFini,$infoRDV,$idRDV); //affiche les détails du rendez-vous
		} else throw new Exception("Le patient et sa synthèse n'ont pas été trouvés dans notre base de donnée.");
	} else throw new Exception("Le patient n'est pas dans la base de donnée (NSS non reconnu).");
}

function CtlRemplirRDV($idRDV){
	afficherRemplirRDV($idRDV);
}

function CtlSauvegarderRDV($compteRendu, $suivi, $prescription, $idRDV){
	if(!empty($compteRendu)){
		if(empty($suivi)) $suivi = "Aucun suivi ";
		if(empty($prescription)) $prescription = "Aucune prescription ";
		sauvegarderRDV($compteRendu, $suivi, $prescription, $idRDV);
	} else throw new Exception("Vous devez impérativement rentrer un compte-rendu du rendez-vous.");
}

function ctrlErreur($erreur){
	afficherErreur($erreur);
}
