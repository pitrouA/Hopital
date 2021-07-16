<?php


function MaPageMedecin($nom,$listemed,$date,$nomPlanning,$listeRDV,$blockedHours,$msg){
	$contenu='<form class="formed" action="forum.php" method="post"><fieldset class="listemed"><legend>Planning des Médecins </legend>
	<p>Le <input type="date" value="'.$date.'" name="datePlanning" size="10"><input class="champMed" type="submit" name="validerDatePlanning" value="OK"><br />';
	$grp='';
	foreach($listemed as $ligne){
		if($ligne->specialite != $grp){
			$contenu.='<br />';
			$grp = $ligne->specialite ;
			$contenu.= $grp.'<br />' ;
		}
		$contenu.='<input type="submit" value="'.$ligne->nom.'" name="MedecinPlanning"/>';

	}
	$contenu.='<p> Vous êtes génial, '.$nom.'</p><p>'.$msg.'</fieldset>

	<input type="hidden" name="NomDuMedecin" value="'.$nom.'">
	<input type="hidden" name="NomMedecinPlanning" value="'.$nomPlanning.'">
	<input type="hidden" name="DateDuPlanning" value="'.$date.'">';

		$planning="";
		$planning.= '<div class="planningmed">
			<table>
				<caption>Planning de '.$nomPlanning.'<span id="datePlanning"> le '.$date.'</span></caption>
					<tr><th>Heures</th><th>Rendez-vous</th><th>Bloquer les heures</th>';
					$cptRDV = 0;
					$cptBLOC=0;
					for($i =0;$i<=23;$i++){
						$oneHour = "";
						if(!empty($blockedHours[$cptBLOC]->heure)&&(($blockedHours[$cptBLOC]->heure == '0'.$i.':00:00')||($blockedHours[$cptBLOC]->heure == $i.':00:00'))){
							$planning.='<tr class="bloctab"><td>'.(int)$blockedHours[$cptBLOC]->heure.' H</td><td>Heure Bloquée</td><td><input class="boutonMed"  type="submit" name ="debloquerHeure[]" value="Débloquer '.$i.' H"><input type="hidden" name="heureADebloquer[]" value="'.$i.'"</td></tr>'; // Make unclickable
							$cptBLOC++;
						}

						else if (!empty($listeRDV[$cptRDV]->heure)&&(($listeRDV[$cptRDV]->heure == '0'.$i.':00:00')||($listeRDV[$cptRDV]->heure == $i.':00:00'))){
							$heureDuRDV = explode(":",$listeRDV[$cptRDV]->heure);
							$planning.='<tr class="rdvtab"><td>'.(int)$heureDuRDV[0].' H</td><td><input class="boutonMed"  type = "submit" value="'.$listeRDV[$cptRDV]->intitule.'('.$listeRDV[$cptRDV]->idRDV.')" name="planningRDV"></td><td>Impossible</td></tr>'; // Make unclickable
							$cptRDV++;
						}
						else{
							$planning.='<tr class="emptab"><td>'.$i.' H</td><td></td><td><input type="checkbox" name ="bloquerHeure[]" value="'.$i.'/'.$date.'"></td></tr>';
						}
					}
		$planning.='</table><p><input type="submit" value="Bloquer les heures" name="J"/></p><p></p></div>';
		$contenu.= $planning.'<br />
			<p><input type="submit" value="Retour à la page principale" name="retourPageMed"/></p>
			<p><input type="submit" value="Déconnexion" name="deconnexion"/></p>
		</form>';
		require_once('vue/gabarit.php');
	}






function pageMedecin($nom,$listemed,$date,$nomPlanning,$listeRDV,$blockedHours,$msg){
	$contenu='<form class="formed"  action="forum.php" method="post"><fieldset class="listemed"><legend>Planning des Médecins </legend>
	<p>Le <input class="boutMed" type="date" value="'.$date.'" name="datePlanning" size="10"><input type="submit" name="validerDatePlanning" value="OK"><br />';
	$grp='';
	foreach($listemed as $ligne){
		if($ligne->specialite != $grp){
			$contenu.='<br />';
			$grp = $ligne->specialite ;
			$contenu.= $grp.'<br />' ;
		}
		$contenu.='<input type="submit" value="'.$ligne->nom.'" name="MedecinPlanning"/>';

	}
	$contenu.='<p> Vous êtes génial, '.$nom.'</p><p>'.$msg.'</fieldset>

	<input type="hidden" name="NomDuMedecin" value="'.$nom.'">
	<input type="hidden" name="NomMedecinPlanning" value="'.$nomPlanning.'">
	<input type="hidden" name="DateDuPlanning" value="'.$date.'">';


	$contenu.= afficherPlanning($nomPlanning, $date, $listeRDV, $blockedHours).'<br />
		<p><input type="submit" value="Retour à la page principale" name="retourPageMed"/></p>
		<p><input type="submit" value="Déconnexion" name="deconnexion"/></p>
	</form>';
	require_once('vue/gabarit.php');
}

function afficherPlanning($nom, $date, $listeRDV,$blockedHours){
	$planning="";
	$planning.= '<div class="planningmed">
		<table>
			<caption>Planning de '.$nom.'<span id="datePlanning"> le '.$date.'</span></caption>
				<tr><th>Heures</th><th>Rendez-vous</th>';
				$cptRDV = 0;
				$cptBLOC=0;
				for($i =0;$i<=23;$i++){
					$oneHour = "";
					if(!empty($blockedHours[$cptBLOC]->heure)&&(($blockedHours[$cptBLOC]->heure == '0'.$i.':00:00')||($blockedHours[$cptBLOC]->heure == $i.':00:00'))){
						$planning.='<tr class="bloctab"><td>'.(int)$blockedHours[$cptBLOC]->heure.' H</td><td>Heure Bloquée</td></tr>';
						$cptBLOC++;
					}

					else if (!empty($listeRDV[$cptRDV]->heure)&&(($listeRDV[$cptRDV]->heure == '0'.$i.':00:00')||($listeRDV[$cptRDV]->heure == $i.':00:00'))){
						$heureDuRDV = explode(":",$listeRDV[$cptRDV]->heure);
						$planning.='<tr class="rdvtab"><td>'.(int)$heureDuRDV[0].' H</td><td>'.$listeRDV[$cptRDV]->intitule.'</td></tr>';
						$cptRDV++;
					}
					else{
						$planning.='<tr class="emptab"><td>'.$i.' H</td><td></td></tr>';
					}
				}
	$planning.='</table></div>';
	return $planning;
}

function afficherRDV($nss,$patient,$rdvFini,$infoRDV,$idRDV){
	$contenu='<form action="forum.php" method="post">
		<h1><span class="motifRDV">Rendez-vous pour motif : '.$infoRDV->motif.' </span><span class="prixRDV"> à : '.$infoRDV->prix.'€</span></h1>


		<fieldset class="syntheseRDVMedecin"><legend>Synthèse du Patient</legend>
			<p class="readOnly"><label>Nom : </label><input type="text" value="'.$patient->nomPatient.'" name="nom" readonly="readonly"/><br></p>
			<p class="readOnly"><label>NSS : </label><input type="text" value="'.$nss.'" name="nss" readonly="readonly"/><br></p>
			<p class="readOnly"><label>Date de naissance : </label><input type="text" value="'.$patient->dateDeNaissance.'" name="date" readonly="readonly"/><br></p>
			<p class="readOnly"><label>Adresse : </label><input type="text" value="'.$patient->adresse.'" name="adresse" readonly="readonly"/><br></p>
			<p class="readOnly"><label>N° de Tel : </label><input type="text" value="'.$patient->numTel.'" name="numTel" readonly="readonly"/><br></p>
			<p class="readOnly"><label>Mail : </label><input type="text" value="'.$patient->mail.'" name="mail" readonly="readonly"/><br></p>
			<p class="readOnly"><label>Profession : </label><input type="text" value="'.$patient->profession.'" name="prof" readonly="readonly"/><br></p>
			<p class="readOnly"><label>Situation Familiale : </label><input type="text" value="'.$patient->situationFamiliale.'" name="sitFam" readonly="readonly"/><br></p>
		</fieldset>
		<fieldset><legend>Pièces et consignes</legend>
			<p class="readOnly"><label>Pièces : </label><input type="text" value="'.$infoRDV->pieces.'" name="pieces" readonly="readonly"/><br></p>
			<p class="readOnly"><label>Consignes : </label><input type="text" value="'.$infoRDV->reccomandations.'" name="reccomandations" readonly="readonly"/><br></p>
		</fieldset>';
		if($rdvFini){
			$contenu.='<fieldset><legend>Information sur le rendez-vous</legend>
			<p class="readOnly"><label>Compte-Rendu </label><input type="text" name="compteRenduRDV" value="'.$infoRDV->compteRendu.'" readonly="readonly"></p>
			<p class="readOnly"><label>Suivi </label><input type="text" name="suiviRDV" value="'.$infoRDV->suivi.'" readonly="readonly"></p>
			<p class="readOnly"><label>Prescription </label><input type="text" name="prescriptionRDV" value="'.$infoRDV->prescription.'" readonly="readonly"></p>
			</fieldset>';
		} else {
			$contenu.='<input type="submit" value="Rendez-vous terminé" name="rdvTermine" />';
		}

		$contenu.='<input type="hidden" value="'.$idRDV.'" name="idRDV">
		<input type="hidden" value="'.$infoRDV->idMedecin.'" name="idMed">
		<input type="hidden" value="'.$infoRDV->date.'" name="date">
		<input type="hidden" value="'.$infoRDV->heure.'" name="heure">
		<input type="submit" value="Retour à la page principale" name="retourPageMedFromRDV" />
		</form>';
	require_once('vue/gabarit.php');
}
function afficherRemplirRDV($idRDV){
		$contenu='<form action="forum.php" method="post">
			<p><label>Compte-Rendu </label><input type="text" name="compteRenduRDV"></p>
			<p><label>Suivi </label><input type="text" name="suiviRDV"></p>
			<p><label>Prescription </label><input type="text" name="prescriptionRDV"></p>
			<input type="hidden" value="'.$idRDV.'" name="idRDV">
			<input type="submit" value="Enregistrer les informations" name="finDuRDV"><input type="reset" value="Tout effacer">
			</form>';
		require_once('vue/gabarit.php');
}
