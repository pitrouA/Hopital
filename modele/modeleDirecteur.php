<?php



//cr�er/modif logins et mdp pour hotesses et directeur

function listeHotDir(){
	$connexion=getConnect();
	$requete="SELECT * FROM personnelsauxiliaires";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$listeHotDir=$resultat->fetchall();
	$resultat->closeCursor();
	return $listeHotDir;
}

function creeMofifLoginsPersonnelsAuxiliaires($nom, $login, $mdp){
	$connexion=getConnect();
	$requete="UPDATE personnelsauxiliaires SET login='$login', mdp='$mdp' where nom='$nom'";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
	if($requete==false)
		return false;
	else
		return true;
}

//cr�er/modif logins et mdp pour m�decins
function modifLoginsMedecin($nom, $login, $mdp){
	$connexion=getConnect();
	$requete="UPDATE medecins SET login='$login', mdp='$mdp' where nom='$nom'";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}


//cr�er/supp/modif les actes et leur prix
function creerActe($acte, $prix){
	$connexion=getConnect();
	$requete="INSERT into motif VALUES ('$acte','$prix','','',0)";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}
function creerPiece($piece){
	$connexion=getConnect();
	$requete="INSERT into piece VALUES ('$piece',0)";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}

function suppPiece($id){
	$connexion=getConnect();
	$requete="DELETE FROM piece where id='$id' ";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}

function suppActe($id){
	$connexion=getConnect();
	$requete="DELETE FROM motif where idMotif='$id' ";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}

function modifActe($acte, $prix){
	$connexion=getConnect();
	$requete="UPDATE motif SET prix='$prix' where idMotif='$acte'";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}

function modifPiece($piece,$acte){
	$connexion=getConnect();
	$requete="UPDATE motif SET pieces='$piece' where idMotif='$acte'";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}

function listeActes(){
	$connexion=getConnect();
	$requete="SELECT * FROM motif";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$listeActe=$resultat->fetchall();
	$resultat->closeCursor();
	return $listeActe;
}

function listePieces(){
	$connexion=getConnect();
	$requete="SELECT * FROM piece";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$listePiece=$resultat->fetchall();
	$resultat->closeCursor();
	return $listePiece;
}


//cr�er/sup m�decin : nom, prenom, specialit�
function ajouterMedecin($nom, $specialite){
	$connexion=getConnect();
	$requete="INSERT into medecins VALUES('$nom','','','medecin','$specialite',0)";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}

function suppMedecin($id){
	$connexion=getConnect();
	$requete="DELETE FROM medecins where idMedecin='$id'";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}


//cr�er/supp/modif liste des pieces � fournir et consignes
//pour consultation ou actes
function modifListePieceFournir($acte, $pieces){
	$connexion=getConnect();
	$requete="UPDATE motif SET pieces='$pieces' where motif='$acte'";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}

function modifConsignes($acte, $consignes){
	$connexion=getConnect();
	$requete="UPDATE motif SET reccomandations='$consignes' where motif='$acte'";
	$resultat=$connexion->query($requete);
	$resultat->closeCursor();
}

/*visualiser les statistiques de sa clinique : nombre de rdv entre
deux dates, nombre de patients
ayant un solde inf�rieur � une somme X, le nombre total de patients
, solde total de tous les
patients � une date pr�cise, l'annuaire de tous les m�decins
avec leur sp�cialit�
*/

function listePatient(){
	$connexion=getConnect();
	$requete="SELECT * FROM patient";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$nbPatient=$resultat->fetchall();
	$resultat->closeCursor();
	return $nbPatient;
}

function nombrePatientInfX($somme){
	$compt=0;
	$nbPatient=0;
	$tab=array();
	$connexion=getConnect();
	$requete= "SELECT NSS FROM patient";
/*	$requete="SELECT COUNT(*) FROM patient INNER JOIN compteinterne ON patient.NSS=compteinterne.NSS
	 								where compteinterne.argent<'$somme'";*/
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$listePatients=$resultat->fetchall();
	foreach ($listePatients as $ligne) {
		$tab[$compt]=getSomme($ligne->NSS);
		$compt++;
	}
	for($i=0;$i<$compt;$i++){
		if($tab[$i]<$somme)
			$nbPatient++;
	}
	//$nbPatient=$resultat->fetchall();
	$resultat->closeCursor();
	return $nbPatient;
}

function rdvEntre2Dates($date1,$date2){
		$connexion=getConnect();
		$requete="SELECT * FROM rdv WHERE date>='$date1' AND date<='$date2' ";
		$resultat=$connexion->query($requete);
		$resultat->setFetchMode(PDO::FETCH_OBJ);
		$rdv=$resultat->fetchall();
		$resultat->closeCursor();
		$compt=0;
		foreach ($rdv as $ligne) {
			$compt=$compt+1;
		}
		return $compt;
}

function soldeDateX($date){
	$tab=array();
	$compt=0;
	$connexion=getConnect();
	$requete= "SELECT NSS FROM patient";
	//$requete="SELECT argent FROM compteinterne WHERE date<='$date'";
	$resultat=$connexion->query($requete);
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	$listePatients=$resultat->fetchall();
	foreach ($listePatients as $ligne) {
		$nss=$ligne->NSS;
		$requete1="SELECT argent FROM compteinterne WHERE date<='$date' AND NSS='$nss'";
		$resultat1=$connexion->query($requete1);
		$resultat1->setFetchMode(PDO::FETCH_OBJ);
		$argent=$resultat1->fetchall();
		$total=0;
		foreach ($argent as $ligne1) {
			$total=$total+$ligne1->argent;
		}
		$tab[$compt]=$total;
		$compt++;
	}
	$resultat->closeCursor();
	$resultat1->closeCursor();
	return $tab;
}
