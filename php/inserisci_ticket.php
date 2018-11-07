<?php

session_start();


//Variabili booleane per il controllo dei campi del form precedente. Se al pi� un campo � vuoto, restituisce errore.
$_SESSION['errore_titolo'] = False;
$_SESSION['errore_descrizione'] = False;
$_SESSION['errore_immagine'] = False;
$_SESSION['errore_citta'] = False;
$_SESSION['errore_indirizzo'] = False;
$_SESSION['errore_categoria'] = False;



/*Tutti queste belle condizioni verificano se effettivamente i campi obbligatori non siano vuoti
 se cos� fosse, restituisce errore e reinderizza alla pagina per la creazione del ticket */

if(empty($_POST['citta_tk']) && !isset($_POST[check_geo])){
		$_SESSION['errore_citta'] = True;
		header('Location: ../newTicket.php');
} else if (empty($_POST['titolo_tk'])) {
		$_SESSION['errore_titolo'] = True;
		header('Location: ../newTicket.php');
} else if (empty($_POST['descrizione_tk'])) {
		$_SESSION['errore_descrizione'] = True;
		header('Location: ../newTicket.php');
} else if ($_POST['categoria'] == "----------"){
		$_SESSION['errore_categoria'] = True;
		header('Location: ../newTicket.php');
	} else {
		$id_cittadino = $_SESSION['admin_name'];
		if ($id_cittadino == ""){
			$id_cittadino = "Ospite";
		}
		$titolo = utf8_decode(addslashes(ucfirst($_POST['titolo_tk'])));
		$gravita = $_POST['radio'];
		$descrizione = utf8_decode(addslashes(ucfirst($_POST['descrizione_tk'])));
		$data_creazione = date ("Y-m-d H:i:s");
		$tipo = utf8_decode(addslashes($_POST['categoria']));


		//RICAVA LAT E LONG DA GOOGLE MAPS DATO IN PASTO INDIRIZZO
		/*$url = "https://maps.googleapis.com/maps/api/geocode/json?address=$citta,$indirizzo&key=AIzaSyBNEuVJiKb4mSWwfqRYsCArxJWrv7il68w";
		$pickup_data = file_get_contents($url);
		$pickup_result = json_decode($pickup_data, true);

		$latitudine =  $pickup_result['results'][0]['geometry']['location']['lat'];
		$longitudine = $pickup_result['results'][0]['geometry']['location']['lng'];*/

		if (!empty($_POST['check_geo'])){
			$latitudine = $_POST['latitude'];
			$longitudine = $_POST['longitude'];

			$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$latitudine,$longitudine&key=AIzaSyBNEuVJiKb4mSWwfqRYsCArxJWrv7il68w";
			$pickup_data = file_get_contents($url);
			$pickup_result = json_decode($pickup_data, true);

			$citta = $pickup_result['results'][0]['address_components'][3]['long_name'];
			$indirizzo = $pickup_result['results'][0]['address_components'][1]['long_name'].", ".$pickup_result['results'][0]['address_components'][0]['long_name'];

		echo "Primo caso citta:" . $citta . "\n| Indirizzo: " . $indirizzo . "\n| Latitudine" . $latitudine . "\n|Longitudine:" . $longitudine;

		} else {
			$citta = addslashes(ucfirst($_POST['citta_tk']));
			$indirizzo = addslashes(ucfirst($_POST['indirizzo_tk']));
			$indirizzo = str_replace(' ', '', $indirizzo);
			$url = "https://maps.googleapis.com/maps/api/geocode/json?address=$citta,$indirizzo&key=AIzaSyBNEuVJiKb4mSWwfqRYsCArxJWrv7il68w";
			$pickup_data = file_get_contents($url);
			$pickup_result = json_decode($pickup_data, true);

			$latitudine =  $pickup_result['results'][0]['geometry']['location']['lat'];
			$longitudine = $pickup_result['results'][0]['geometry']['location']['lng'];

				//echo "Secondo caso citta:" . $citta . "\n| Indirizzo: " . $indirizzo . "\n| Latitudine" . $latitudine . "\n|Longitudine:" . $longitudine;
		}





		/*if(getimagesize($FILES["image"]["tmp_name"]) == FALSE){
			$_SESSION['errore_immagine'] = True;
			header('Location: ../new-ticket.php');
		}*/



		//PASSAGGI PER INSERIMENTO IMMAGINI NEL DATABASE CHE VERRANNO LETTE COL TAG IMG SRC
		//MATRICE CHE CONTIENE LA RISORSIA BINARIA (LA FOTO IN SE) E IL NOME DELLA FOTO
		//$data = file_get_contents($_FILES["image"]["tmp_name"]);
		//CODIFICA FOTO IN BASE64
		//$codImg = base64_encode($data);
		//echo $codImg;
	//	$imageType = $_FILES["image"]["type"];
	//	$imageSize = $_FILES["image"]["size"];

		//SE IL FILE NON E' UNA IMMAGINE MOSTRA ERRORE
		/*if(substr($imageType, 0, 5) !== "image") {
			if($imageSize == 0){
				//echo "SIZE 0";
			}
			if($imageSize !==0) {
				$_SESSION['errore_immagine'] = True;
				echo "ERRORE SUBSTR";
				header('Location: ../newTicket.php');
			}*/ //FINE IF IMAGESIZE
		//} //FINE IF SUBSTR


		//RECUPERA ID AUTOGENERATO
		$last_cdt = mysqli_insert_id($connect);
		$_SESSION['last_cdt'] = $last_cdt;

		$connect = mysqli_connect("localhost", "civicsense2018", "", "my_civicsense2018");



		//RECUPERO L'ULTIMO CDT NEL DATABASE
		$cdt_old = mysqli_insert_id($connect) + 1;
		$arrayImg = [];
		//echo count($_FILES["image"]['name']);



		//INSERISCO SEGNALAZIONE NEL DATABASE
		$sql = "insert into segnalazione (nome_evento, citta, indirizzo, categoria, gravita, descrizione, data_creazione, latitudine, longitudine) values ('$titolo', '$citta', '$indirizzo', '$tipo', '$gravita', '$descrizione', '$data_creazione', '$latitudine', '$longitudine')";
		$result1 = mysqli_query($connect,$sql) or die ('Non riesco ad aggiungere, errore inserimento in ticket'. mysqli_error($link));



		//RECUPERA ID AUTOGENERATO
		$last_cdt = mysqli_insert_id($connect);
		$_SESSION['last_cdt'] = $last_cdt;

		//INSERISCO SEGNALAZIONE IN CREASEGUE
		$sql2 = "insert into crea_segue (id_cittadino, cdt) values ('$id_cittadino', '$last_cdt')";
		$result2 = mysqli_query($connect,$sql2) or die ('Non riesco ad aggiungere, errore: inserimento in crea_segue'. mysqli_error($link));


		if ($_FILES["image"]['size'][0] > 0){
		//CONVERTO IN BASE 64 LE IMMAGINI CARICATE
		for($j=0; $j < count($_FILES["image"]['name']); $j++){
				$data = file_get_contents($_FILES["image"]['tmp_name'][$j]);
				//CODIFICA FOTO IN BASE64
				$codImg = base64_encode($data);
				$sqlImg = "insert into allegati (cdt, allegato) values ('$last_cdt', '$codImg')";
				$resultImg = mysqli_query($connect, $sqlImg) or die ('Immagini non caricate');
			}
}


		if((mysqli_error($connect, $result1)) || (mysqli_error($connect, $result2))){?>
				<script type="text/javascript">
					alert("Ops... Qualcosa &egrave andato storto! :-(");
				</script>
           		<?
       		 } else {

			header("Location: successful.php?status=ok");



  		  }


}


?>
