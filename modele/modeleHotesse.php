<?php



function getSynthese($nss){
	$connexion=getConnect();
	$requete="SELECT * FROM patient WHERE nss='$nss'";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$patient=$resultat->fetchall();
	$resultat->closeCursor();
	return $patient;
}
function MAJ($nom,$nss,$date,$adresse,$numTel,$mail,$prof,$sitFam){
	$connexion=getConnect();
	//UPDATE nom_table_cible SET colonne = valeur
	//nomPatient='$nom',nss='$nss',dateDeNaissance='$date'
	$requete="UPDATE patient SET nomPatient='$nom',nss='$nss',dateDeNaissance='$date',adresse='$adresse',numTel='$numTel',mail='$mail',profession='$prof',situationFamiliale='$sitFam' where nss='$nss'";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}
function getListeConsultations($nss){
	$connexion=getConnect();
	//INNER
	$requete="SELECT * FROM rdv INNER JOIN medecins ON rdv.idMedecin = medecins.idMedecin
								INNER JOIN motif ON rdv.idMotif = motif.idMotif
								WHERE NSSpatient='$nss' ORDER BY date DESC, heure DESC";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$liste=$resultat->fetchall();
	$resultat->closeCursor();
	return $liste;
}
function getNSS($nom,$date){
	$connexion=getConnect();
	$requete="SELECT nss FROM patient WHERE nomPatient='$nom' AND dateDeNaissance='$date'";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$patient=$resultat->fetchall();
	$resultat->closeCursor();
	return $patient[0]->nss;
}
function setMontant($nss,$montant){
	$connexion=getConnect();
	$date=date("Y-m-d h:i:s");
	$requete="INSERT INTO compteinterne(NSS,argent,date) VALUES('$nss','$montant','$date')";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}
function getMedecin($nomMedecin,$specialite){
	$connexion=getConnect();
	$requete="SELECT * FROM medecins WHERE nom='$nomMedecin' AND specialite='$specialite'";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$medecin=$resultat->fetch();
	$resultat->closeCursor();
	return $medecin;
}
function getMotifs(){
	$connexion=getConnect();
	$requete="SELECT * FROM motif";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$patient=$resultat->fetchall();
	$resultat->closeCursor();
	return $patient;
}
function getIDMedecin($nomMedecin){
	$connexion=getConnect();
	$requete="SELECT idMedecin FROM medecins WHERE nom='$nomMedecin'";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$medecins=$resultat->fetchall();
	$resultat->closeCursor();
	return $medecins[0]->idMedecin;
}
function getInfosMotif($motif){
	$connexion=getConnect();
	$requete="SELECT * FROM motif WHERE motif='$motif'";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$infosMotif=$resultat->fetchall();
	$resultat->closeCursor();
	return $infosMotif[0];
}
function validerRDV($idMedecin,$nssPatient,$date,$infosMotif){
	$connexion=getConnect();
	$motif=$infosMotif->motif;
	$idMotif=$infosMotif->idMotif;
	$dateheure=explode(" ", $date);
	$requete="INSERT INTO rdv(intitule,idMedecin,NSSPatient, date, heure,rdvFini, statut,compteRendu,suivi,prescription, idMotif)
			  VALUES('$motif','$idMedecin','$nssPatient','$dateheure[0]','$dateheure[1]',0,'Attente de Paiement',' ',' ',' ', '$idMotif')";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}
function getSomme($nss){
	$connexion=getConnect();
	$requete="SELECT argent FROM compteinterne WHERE NSS='$nss'";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$argent=$resultat->fetchall();
	$total=0;
	foreach($argent as $ligne){
		$argent=$ligne->argent;
		$total=$total+$argent;
	}
	$resultat->closeCursor();
	return $total;
}
function creerComptePatient($nomPatient,$nss,$dateDeNaissance,$adresse,$numTel,$mail,$profession,$situationFamiliale){
	$connexion=getConnect();
	$requete="INSERT INTO patient(nomPatient,nss,dateDeNaissance,adresse,numTel,mail,profession,situationFamiliale)
			  VALUES('$nomPatient','$nss','$dateDeNaissance','$adresse','$numTel','$mail','$profession','$situationFamiliale')";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}
function recupererRDVNonPayes(){
	$connexion=getConnect();
	$requete="SELECT * FROM rdv INNER JOIN patient ON rdv.NSSPatient = patient.NSS
								INNER JOIN medecins ON rdv.idMedecin = medecins.idMedecin
								INNER JOIN motif ON rdv.idMotif = motif.idMotif
								WHERE statut='Attente de Paiement'";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$rdv=$resultat->fetchall();
	$resultat->closeCursor();
	return $rdv;
}
function recupererUnRDVNonPaye($idRDV){
	$connexion=getConnect();
	$requete="SELECT * FROM rdv INNER JOIN patient ON rdv.NSSPatient = patient.NSS
								INNER JOIN medecins ON rdv.idMedecin = medecins.idMedecin
								INNER JOIN motif ON rdv.idMotif = motif.idMotif
								WHERE idRDV='$idRDV'";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$rdv=$resultat->fetch();
	$resultat->closeCursor();
	return $rdv/*[$num-1]*/;
}
function validerPayement($idRDV){
	$connexion=getConnect();
	/*$requete="UPDATE rdv SET statut='Paye' WHERE idMedecin='$idMedecin' AND NSSpatient='$nssPatient' AND date='$date' AND idMotif='$idMotif'";*/
	$requete="UPDATE rdv SET statut='Paye' WHERE idRDV='$idRDV'";
	echo "done";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}
