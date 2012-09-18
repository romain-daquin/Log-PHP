<?php
	/*
	* Fichier php qui permet de creer facilement un fichier log
	* Prochainement une classe utilisable pour tous
	*/

	/*$path = "";

	// on ouvre le fichier en écriture seul, il se cré si il n'existe pas
	$file = fopen($path.'log.txt', 'a');

	// par défaut on met DATE_RSS
	$format_en = "g:i a, F j, Y";
	$format_fr = "G:i:s le j/n/Y";

	$date = date($format_en);

	fputs($file,$date." - ma première ligne \n");
	fputs($file,$date." - ma seconde ligne\n");

	// on ferme le fichier
	fclose($file);*/


	/*
	* Il faut gérer les retour à la ligne, créer une variable par exemple
	* la mm chose pour les tabulations \t \n
	* gérer le format de date que l'on veut
	* gérer si on veut faire: date - titre - description ou date - description
	* !!! chmod 777 sur le fichier : droit à l'écriture dessus
	* ! attention, ne pas ouvrir le fichier ac le bloc note sous windows sinon pas de mise en page
	*
	* Dans la doc : Faire attention a ce que le dossier existe en ecriture ext ... les prob possible
	*/

	require("Log.class.php");
	
	$log = new Log("log","dos/","hy");
	$log->writeShortFile("Bonjour");
	$log->writeShortFile("Je suis Romain");
	$log->writeLongFile("Title","Je suis Romain");
?>