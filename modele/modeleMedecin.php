<?php

function getListeMedecin(){
	$connexion=getConnect();
	$requete="SELECT nom, specialite, idMedecin FROM medecins ORDER BY specialite";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$listemed=$resultat->fetchall();
	$resultat->closeCursor();
	return $listemed;

}

function getRDV($idMed,$date){
	$connexion=getConnect();
	$requete="SELECT intitule, idMotif, idRDV, heure FROM rdv WHERE idMedecin='$idMed' AND date='$date' ORDER BY heure " ;
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$listeRDV=$resultat->fetchall();
	$resultat->closeCursor();
	return $listeRDV;
}

function getHoursBlocked($idMed,$date){
	$connexion=getConnect();
	$requete="SELECT heure FROM planning WHERE idMedecin='$idMed' AND date='$date' AND blocked='1' ORDER BY heure " ;
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$blockedhours=$resultat->fetchall();
	$resultat->closeCursor();
	return $blockedhours;
}

function getIDMed($nom){
	$connexion=getConnect();
	$requete="SELECT idMedecin FROM medecins WHERE nom='$nom'";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$idMed=$resultat->fetch();
	$resultat->closeCursor();
	return $idMed->idMedecin;
}

function getNomMed($idMed){
	$connexion=getConnect();
	$requete="SELECT nom FROM medecins WHERE idMedecin='$idMed'";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$nom=$resultat->fetch();
	$resultat->closeCursor();
	return $nom->nom;
}

function bloquerHeure($heure, $date,$idMed){
	$connexion=getConnect();
	$requeteTest="SELECT blocked FROM planning WHERE heure='$heure' AND date='$date' AND idMedecin='$idMed'";
	$resultatTest=$connexion->query($requeteTest);
	if(!$resultatTest->fetch()){
		$requete="INSERT into planning VALUES ('$idMed', '$date', '$heure','0','1')";
		$resultat=$connexion->query($requete);
		$resultat->closeCursor();
	}
	$resultatTest->closeCursor();
}

function debloquerHeure($date,$heure,$idMed){
	$connexion=getConnect();
	$requete="DELETE FROM planning WHERE heure='$heure' AND date='$date' AND idMedecin='$idMed' ";
	$resultat = $connexion->query($requete);
	$resultat->closeCursor();
}

function isThisHourEmpty($date,$heure,$idMed){
	$connexion=getConnect();
	$requete="SELECT idRDV FROM rdv WHERE date='$date' AND heure='$heure' AND idMedecin='$idMed'";
	$resultat=$connexion->query($requete);
	$resultat-> setFetchMode(PDO::FETCH_OBJ);
	if (!($resultat->fetch())){
		$requete2="SELECT idMedecin FROM planning WHERE date='$date' AND heure='$heure' AND idMedecin='$idMed'";
		$resultat2=$connexion->query($requete2);
		$resultat2-> setFetchMode(PDO::FETCH_OBJ);
		$heure  = $resultat2->fetch();
		if (empty($heure)){
			$resultat->closeCursor();
			$resultat2->closeCursor();
			return true;
		} else $resultat2->closeCursor();
	}
	$resultat->closeCursor();
	return false ;
}

function getNSSDuRDV($idRDV){
	$connexion=getConnect();
	$requete="SELECT NSSpatient FROM rdv WHERE idRDV='$idRDV' ";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$nss = $resultat->fetch();
	$resultat->closeCursor();
	return $nss->NSSpatient;
}

function getRDVFini($idRDV){
	$connexion=getConnect();
	$requete="SELECT rdvFini FROM rdv WHERE idRDV='$idRDV' ";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$fini = $resultat->fetch();
	$resultat->closeCursor();
	return $fini->rdvFini;
}

function getInfoDuRDV($idRDV){
	$connexion=getConnect();
	$requete="SELECT compteRendu, suivi, prescription, idMedecin, date, heure, pieces, reccomandations, motif, prix FROM rdv NATURAL JOIN motif WHERE idRDV='$idRDV' ";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$infoRDV = $resultat->fetch();
	$resultat->closeCursor();
	return $infoRDV;
}

function getMotifPrixDuRDV($idRDV){
	$connexion=getConnect();
	$requete="SELECT idMotif FROM rdv WHERE idRDV='$idRDV'";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$idMotif = $resultat->fetch();
	$resultat->closeCursor();
	if (!empty($idMotif)){
		$requete2="SELECT motif, prix FROM motif WHERE idMotif=".$idMotif->idMotif;
		$resultat2=$connexion->query($requete2);
		$resultat2->setFetchMode(PDO::FETCH_OBJ);
		$motifPrix = $resultat2->fetch();
		$resultat2->closeCursor();
		return $motifPrix;
	} else throw new Exception("Le motif n'a pas ??t?? trouv??.'");
}

function sauvegarderRDV($compteRendu, $suivi, $prescription, $idRDV){
	$connexion=getConnect();
	$requete="UPDATE rdv SET compteRendu='$compteRendu', suivi='$suivi', prescription='$prescription',rdvFini=1 WHERE idRDV='$idRDV'";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}
