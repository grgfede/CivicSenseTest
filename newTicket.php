<!--
	#################################################################################
	#		REGOLE PER UNA BUONA PERMANENZA DI GRUPPO								#
	#	1 Se scrivi del nuovo codice, COMMENTA QUELLO CHE FAI						#
	#	2 Modifichi del codice? COMMENTA LA MODIFICA								#
	#	3 Modifichi del codice e non funziona? RIMETTI TUTTO A POSTO				#
	#	4 Hai dubbi su qualche parte del codice? NON METTERE MANI					#
	#	5 CERCA DI COMMENTARE CODICE CHE APPARE COMPLICATO AL RESTO DEL GRUPPO		#
	#																				#
	#  Chi infrange le regole siamo obbligati a dare della puttana alla madre		#
	#  Buon lavoro :)																#
	#################################################################################
-->
<?php
include "php/dbconnection_session.php";

$nome = $_SESSION['admin_name'];
if($nome == ""){
	$nome = "Ospite";
	$tipo = 0;
	$_SESSION['tipo'] = $tipo;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>

<style>
  textarea {
  height: 150px;
  width: 100%;
  padding: 5px 5px;
  border-radius: 4px;
  background-color: #f8f8f8;
  resize: none;
}

  #map {
  height: 220px;
  width: 100%;
  position: relative;
  float: center;
  margin: 10px auto;
	radiusX:

}
</style>

    <!--  WORKAROUND PER LA X NELL'INFOWINDOWS DELLE MAPPE GOOGLE-->
    <style>
      .gm-ui-hover-effect {
      	display: none!important;
      }
    </style>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Civic Sense - Crea Segnalazione</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <link href="css/radio2.css" rel="stylesheet">

    	<!-- JQUERY CORE SCRIPT -->
	<script src="vendor/jquery/jquery.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

<!--- SCRIPT JS PER IL COUNTDOWN DEI CARATTERI --->
    <script>
      function countChar(val) {
        var len = val.value.length;
        if (len >= 500) {
          val.value = val.value.substring(0, 500);
        } else {
          $('#charNum').text(500 - len + (" caratteri rimanenti"));
        }
      };
    </script>
<!--- FINE SCRIPT JS --->

<!--SOVRASCRIVO custom-file-text PER AVERE LA SCRITTA SFOGLIA
<style type="text/css">
	$custom-file-text: (
  en: "Browse",
  it: "Sfoglia"
);
</style>-->

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <? include "navbar.php";?>
  <div class="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Crea una Segnalazione</li>
      </ol>
      <h1>Crea una Segnalazione</h1>
      <hr>

<form action="php/inserisci_ticket.php" method="post" enctype="multipart/form-data">
<div class="row">
		<div class="geolocation col-xl-12 col-sm-12">
			<h3>Geolocalizzazione</h3>
			<div class="card" id="map"></div>
		 	<input type="hidden" name="latitude" id="latitude" style="margin:10px auto;">
      <input type="hidden" name="longitude" id="longitude" style="margin:10px auto; ">
	 </div>
</div>
<div class="row">
	 <div class="col-xl-12 col-sm-12">
	 	<div class="custom-control custom-checkbox">
	 		 	<input class="custom-control-input" type="checkbox" value="si" name="check_geo" id="check_geo">
	 		 	<label class="custom-control-label" for="check_geo">Clicca qui se la mappa riporta la corretta posizione.</label>
	 	</div>
	</div>
</div>

<div class="row">
	<div class="cittaindirizzo" id="cittaindirizzo">
		<div class="col-xl-12 col-sm-12">

			<div class="city" id="citta"><h5>Citt&agrave;<font color=red size=6> *</font></h5>
				<?php
					$errore = "Inserisci citt&agrave";
					if($_SESSION['errore_citta']){
						echo "<font color=red size=2>".$errore."</font>";
						$_SESSION['errore_citta'] = False;
					} else if ($_SESSION['errore_citta']){
						$errore = " ";
						echo $errore;
					}
				?>
				<div class="form-group">
							<input type="text" name="citta_tk" class="form-control" placeholder="Citt&agrave; da segnalare" style="width: 300px;">
		 		</div>
		</div>
		<div class="address"><h5>Indirizzo</h5>
		<?php
			$errore = "Inserisci Indirizzo";
			if($_SESSION['errore_indirizzo']){
				echo "<font color=red size=2>".$errore."</font>";
				$_SESSION['errore_indirizzo'] = False;
			} else if ($_SESSION['errore_indirizzo']){
				$errore = " ";
				echo $errore;
			}
		?>
				<div class="form-group">
							<input type="text" name="indirizzo_tk" class="form-control" placeholder="Indirizzo dov'&egrave; presente il problema" style="width: 300px;">
				</div>
		</div>
	</div>
 </div>
</div>

<div class="row">
	<div class="col">
		<h3>Oggetto<font color=red size=6> *</font></h3>
		<?php
			$errore = "Inserisci titolo";
			if ($_SESSION['errore_titolo']){
				echo "<font color=red size=2>".$errore."</font>";
				$_SESSION['errore_titolo'] = False;
			} else if ($_SESSION['errore_titolo']){
				$errore = " ";
				echo $errore;

			}
		?>
		  <input type="text" name="titolo_tk" class="form-control" style="width: 500px;">
	</div>
</div>

<div class="row">
	<div class="col">
		<h3>Gravit&agrave;</h3>

		<label class="control control-radio">
			<a data-toggle="tooltip" title="Il problema non viene considerato di grande rilievo. Si concentra un'attenzione minore."><font color=green><b>Bassa</b></font></a>
			<input type="radio" name="radio" value = 1 checked="checked"/>
			<div class="control_indicator"></div>
		</label>

		<label class="control control-radio">
			<a data-toggle="tooltip" title="Il problema potrebbe recare disturbo se non risolto."><b><font color="#fbc531">Media</font></b></a>
			<input type="radio" name="radio" value = 2 />
			<div class="control_indicator"></div>
		</label>

		<label class="control control-radio">
			<a data-toggle="tooltip" title="Il problema &egrave; assolutamente da risolvere."><font color=red><b>Alta</b></font></a>
			<input type="radio" name="radio" value = 3 />
			<div class="control_indicator"></div>
		</label>
	</div>
</div>

<div class="row">
	<div class="col">
		<h3>Categoria<font color=red size=6> *</font></h3>
		<?php
			$errore = "Categoria non valida";
			if ($_SESSION['errore_categoria']){
				echo "<font color=red size=2>".$errore."</font>";
				$_SESSION['errore_titolo'] = False;
			} else if ($_SESSION['errore_titolo']){
				$errore = " ";
				echo $errore;

			}
			//QUERY PER PRENDERE LE CATEGORIE
			$sql = "SELECT * FROM categoria";
			$sql_esegui = mysqli_query ($connect, $sql);
		?>
		 <select style="width:250px" class="form-control" id="sel1" name="categoria">
			<option>----------</option>
			<? while($cicle=mysqli_fetch_array($sql_esegui)){
				echo "<option>" . utf8_encode($cicle['nome']) . "</option>";
			}
			?>
		</select>
	</div>
</div>

<div class="row">
	<div class="col">
		<h3>Descrizione<font color=red size=6> *</font></h3>
		<p><font size="2">Per una buona descrizione si consiglia di comunicare il problema principale in modo chiaro e diretto con i dettagli principali ben leggibili.</font></p>

	<?php
			$errore = "Inserisci descrizione";
			if ($_SESSION['errore_descrizione']){

				echo "<font color=red size=2>".$errore."</font>";
				$_SESSION['errore_descrizione'] = False;
			} else if ($_SESSION['errore_descrizione']){
				$errore = " ";
				echo $errore;
			}
		?>
		<textarea name="descrizione_tk" class="form-control mb-3" onkeyup="countChar(this)"></textarea>
		<div id="charNum"></div>
	</div>
</div>

<div class="row">
	<div class="col">
		<?php
				$errore = "Il file inserito non &egrave; una immagine. Per favore, scegliere una immagine.";
				if ($_SESSION['errore_immagine']){
					echo "<font color=red size=2>".$errore."</font>";
					$_SESSION['errore_immagine'] = False;
					echo "<br>";
				}
			?>
			<!--<input type="file" name="image" /> --->
		<div class="custom-file mb-15">
			<input type="file" lang="it" class="custom-file-input" id="image" name="image[]" multiple>
		  <label class="custom-file-label" for="image">Aggiungi allegati</label>
		</div>
	</div>
</div>
<br>
<div class="row">
		<div class="col">
				<button class="btn btn-primary float-right" name="create_report">Crea segnalazione</button>
	 </div>
</div>

</form>


</div><!-- /.container-fluid-->
<div class="row">
	<? include "footer.php"; ?>
</div>
</div>

<!-- SCRIPT PER LA CREAZIONE DELLA MAPPA-->
<script>

	 var map, infoWindow;
	 function initMap() {
		 map = new google.maps.Map(document.getElementById('map'), {
			 center: {lat: -34.397, lng: 150.644},
			 zoom: 15,
      disableDefaultUI:true,
      zoomControl:true
		 });
		 infoWindow = new google.maps.InfoWindow;

		 // Try HTML5 geolocation.
		 if (navigator.geolocation) {
			 navigator.geolocation.getCurrentPosition(function(position) {
				 var pos = {
					 lat: position.coords.latitude,
					 lng: position.coords.longitude
				 };
				 document.getElementById('latitude').value = position.coords.latitude;
  				 document.getElementById('longitude').value = position.coords.longitude;
				 infoWindow.setPosition(pos);
				 infoWindow.setContent('<h2 class="text-center panel-title"><b>Posizione rilevata</b></h2>');
				 infoWindow.open(map);
				 map.setCenter(pos);
			 }, function() {
				 handleLocationError(true, infoWindow, map.getCenter());
			 },{maximumAge:60000, timeout:5000, enableHighAccuracy:true});
		 } else {
			 // Browser doesn't support Geolocation
			 handleLocationError(false, infoWindow, map.getCenter());
		 }
	 }

	 function handleLocationError(browserHasGeolocation, infoWindow, pos) {
		 infoWindow.setPosition(pos);
		 infoWindow.setContent(browserHasGeolocation ?
		 											'<h3 class="text-center panel-title">Errore: Non riesco a determinare la tua posizione.</h3>' :
		 											'<h3 class="text-center panel-title">Errore: Il tuo Browser non supporta la geolocalizzazione.</h3>');
		 infoWindow.open(map);
	 }
 </script>

<!--- FINE SCRIPT JS --->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNEuVJiKb4mSWwfqRYsCArxJWrv7il68w&callback=initMap"
    async defer></script>
<!--- FINE SCRIPT JS --->

  	<!-- POPPER CORE SCRIPT -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  	<!-- BOOTSTRAP CORE SCRIPT -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<!-- SCRIPT PER NASCONDERE CITTA E INDIRIZZO SE SI USA LA GEOLOCALIZZAZIONE-->
  <script>
    $("#check_geo").click(function () {
    	if(document.getElementById("check_geo").checked){
  			$("#cittaindirizzo").hide(600);
  		}else{
  			$("#cittaindirizzo").show(600);
  		}
    });
    </script>
</body>

</html>
