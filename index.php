<!--
	#################################################################################
	#		REGOLE PER UNA BUONA PERMANENZA DI GRUPPO																		#
	#	1 Se scrivi del nuovo codice, COMMENTA QUELLO CHE FAI													#
	#	2 Modifichi del codice? COMMENTA LA MODIFICA																	#
	#	3 Modifichi del codice e non funziona? RIMETTI TUTTO A POSTO									#
	#	4 Hai dubbi su qualche parte del codice? NON METTERE MANI											#
	#	5 CERCA DI COMMENTARE CODICE CHE APPARE COMPLICATO AL RESTO DEL GRUPPO				#
	#																																								#
	#  Chi infrange le regole siamo obbligati a dare della puttana alla madre				#
	#  Buon lavoro :)																																#
	#################################################################################
-->
<?php
//AGGIUNGO LA CLASSE SEGNALAZIONE
include "php/Segnalazione.php";
include "php/dbconnection_session.php";
	
$nome = $_SESSION['admin_name'];

//VALORI DI DEFAULT PER ACCEDERE AL SITO COME OSPITE
	if ($nome == ""){
		$nome = "Ospite";
		$_SESSION['tipo'] = 0;
		$_SESSION['c_residenza'] = "Rome,Italy";
	}
?>

<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
   <title>Civic Sense - Dashboard</title>
  <!-- Latest compiled and minified Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
    <!-- Css per table -->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!--SCRIPT PER JQUERY-->
  <script src="vendor/jquery/jquery.min.js"></script>
        <!-- Bootstrap core JavaScript-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Css fix margin per tabelle -->
  <link href="css/table.css" rel="stylesheet">
  <!-- Custom styles for map-->
  <link href="css/map.css" rel="stylesheet">
  <!--SCRIPT E CSS PER LE ICONE DELLA GRAVITA'-->
  <script src="js/gravita.js"></script>
  <link href="css/gravita.css" rel="stylesheet">
  <? if($_SESSION['tipo']!=2){?>
  <!--  WORKAROUND PER LA X NELL'INFOWINDOWS DELLE MAPPE GOOGLE-->
  <style>
    .gm-ui-hover-effect {display: none!important;}
  </style>
 <? } ?>
</head>
<body class="fixed-nav sticky-footer bg-dark static-top" id="page-top">
  <?
  //FILE PER CARICARE LA NAVBAR DEL RELATIVO TIPO DI UTENTE COLLEGATO
  include "navbar.php";
?>
  <div class="content-wrapper">
<? 
// SWTICH PER CARICARE IL GIUSTO CONTENUTO IN BASE AL TIPO DI UTENTE
switch($_SESSION['tipo']){
	case 2:
	include "php/home/ente.php";
	break;
	case 3:
	include "php/home/squadra.php";
	break;
	default:
	include "php/home/cittadino.php";
}
 include "footer.php" ?>
</div>


    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script> 
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <!--<script src="js/sb-admin-charts.min.js"></script>-->
</body>

</html> 
