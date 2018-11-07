<!--
	#################################################################################
	#		REGOLE PER UNA BUONA PERMANENZA DI GRUPPO			#
	#	1 Se scrivi del nuovo codice, COMMENTA QUELLO CHE FAI			#
	#	2 Modifichi del codice? COMMENTA LA MODIFICA				#
	#	3 Modifichi del codice e non funziona? RIMETTI TUTTO A POSTO		#
	#	4 Hai dubbi su qualche parte del codice? NON METTERE MANI		#
	#	5 CERCA DI COMMENTARE CODICE CHE APPARE COMPLICATO AL RESTO DEL GRUPPO	#
	#										#
	#  Chi infrange le regole siamo obbligati a dare della puttana alla madre	#
	#  Buon lavoro :)								#
	#################################################################################
-->
<?php

include "php/dbconnection_session.php";

$nome = $_SESSION['admin_name'];

$ID = $_GET['chiave'];
if(!ctype_digit($ID)){
	$errore = True;
}

$query ="SELECT * FROM segnalazione where cdt = '$ID'";

$risultato = mysqli_query($connect, $query);

$riga = mysqli_num_rows($risultato);

if($riga == 0){
	$errorevuoto = True;
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
  <title>Civic Sense - Cerca segnalazione</title>
  <!-- Latest compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
   <? include "navbar.php";?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <h1>Cerca Segnalazione</h1>
      <hr>
      <div  class="row">
        <div class="col">
          <div class="card h-100">
            <div class="card-header">
              <h3 class="panel-title">Hai cercato il CDT:&nbsp<?php echo $ID; ?></h3>
            </div>
          <div class="card-body h-100">
<?php
	if($errore){ ?>
    <div class="col"></div>
		<div class="col"><p class="text-center"> Inserisci un CDT valido! </p></div>

<?php
	} else if ($errorevuoto) { ?>
		<div class="col"></div>
    <div class="col"><p class="text-center">La ricerca non ha prodotto nessun risultato!</p></div>
<?php
	} else { ?>
<!--TABELLA CHE MOSTRA I RISULTATI-->
 <div class="table-responsive">
            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nome Segnalazione</th>
                  <th>Stato</th>
                  <th>Data Creazione</th>
                </tr>
              </thead>
	      
      <!---- <tfoot>
                <tr>
                  <th>#</th>
                  <th>Nome Ticket</th>
                  <th>Stato</th>
                  <th>Data Creazione</th>
		  <th>Modifica</th>
                </tr>
              </tfoot>   --->
              <tbody>

<?php 
		
		$count = 1;  //VARIABILE PER CONTARE I TICKET NELLA TABELLA
		
		while($cicle=mysqli_fetch_array($risultato)){
			echo '<tr><td><b>'.$count++.'</b></td>';
			echo '<td><a href="detailTicket.php?id='.$cicle['cdt'].'">'.$cicle['nome_evento'].'</a></td>';
			echo "<td>".$cicle['stato']."</td>";
			$data_creazione = $cicle['data_creazione'];
			$data_creazione = date("d-m-Y", strtotime($data_creazione));
			echo "<td>".$data_creazione."</td>";
			echo "</tr>";		
			}
?>
 
              </tbody>
            </table>
          </div>
<?php } ?>
        </div>
        </div>
      </div>
   </div> <!-- /.container-fluid-->
  <div class="row"> 
   <? include 'footer.php';?>
  </div>  <!-- /.content-wrapper-->
  </div>
      <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
</body>

</html>
