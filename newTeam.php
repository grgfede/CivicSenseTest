<!--
	#################################################################################
	#		REGOLE PER UNA BUONA PERMANENZA DI GRUPPO																		#
	#	1 Se scrivi del nuovo codice, COMMENTA QUELLO CHE FAI													#
	#	2 Modifichi del codice? COMMENTA LA MODIFICA																	#
	#	3 Modifichi del codice e non funziona? RIMETTI TUTTO A POSTO									#
	#	4 Hai dubbi su qualche parte del codice? NON METTERE MANI											#
	#	5 CERCA DI COMMENTARE CODICE CHE APPARE COMPLICATO AL RESTO DEL GRUPPO				#
	#																			
	#################################################################################
-->
<?php

include "php/dbconnection_session.php";
	$nome = $_SESSION['admin_name'];

  if ($_SESSION['tipo'] != 2){ ?>
    <script>
      window.location.replace("index.php");
    </script>
    <?
  }
  //AGGIUNGO LA CLASSE SEGNALAZIONE
	include "php/Segnalazione.php";
?>

<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
<title>Civic Sense - Nuova squadra</title>

  <!-- Latest compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <!-- Custom styles for map-->
  <link href="css/map.css" rel="stylesheet">

</head>
<body class="fixed-nav sticky-footer bg-dark static-top" id="page-top">
  <div class="content-wrapper">
  <? //FILE PER CARICARE LA NAVBAR DEL RELATIVO TIPO DI UTENTE COLLEGATO
    include "navbar.php"; ?>
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Crea una nuova squadra</li>
     </ol>

        <form name="registerSquad" action="php/register_connectivitySquad.php" method="post" enctype="multipart/form-data">
					<div class="card">
						<h5 class="card-header">Crea una nuova squadra</h5>
						<div class="card-body">
							<div class = "row">
		              <div class="col">
		                <h4>Identificativo Squadra<span class = "text-danger"> *</span></h4>
										<?php
											$errore = "Inserisci un identificativo per la squadra";
											if($_SESSION['erroreId']){?>
												<font color=red size=2><?echo $errore?></font>
												<?$_SESSION['erroreUsername'] = False;
											}?>
										?>
		                <input type="text" name="id_squadra" class="form-control" placeholder="Nome squadra risoluzione">
		              </div>
								</div>

								<div class="row">
		              <div class="col">
										<h4>Email<span class = "text-danger"> *</span></h4>
										<?php
											$errore = "Inserisci email del capo squadra";
											if($_SESSION['erroreMail']){?>
												<font color=red size=2><?echo $errore?></font>
												<?$_SESSION['erroreMail'] = False;
											}
										?>
										<input type="text" name="email_squadra" class="form-control">
		              </div>
								</div>

								<div class="row">
		              <div class="col">
		                <h4>Password<span class = "text-danger"> *</span></h4>
										<?php
											$errore = "Inserisci username del capo squadra";
											if($_SESSION['errorePassword']){?>
												 <font color=red size=2><?echo $errore?></font>
												<?$_SESSION['errorePassword'] = False;
											}
										?>
		                <input type="password" name="pass_squadra" class="form-control">
		              </div>
								</div>
							</div><!--FINE CARD BODY-->
							<div class="card-footer">
								<div class = "row">
								 	<div class="col">
										 	<button class="btn btn-primary float-right" name="login">Crea nuova squadra</button>
									</div>
								</div>
							</div><!--FINE FOOTER-->
						</div><!--FINE CARD-->
				</form>


						<?
							if ($_SESSION['IdEsistente']){?>
								<script>
									alert("Identificativo già esistente");
									location.reload();
								</script>
							<?
							$_SESSION['IdEsistente'] = False;
						}?>
<div class="row">
  <?include "footer.php"; ?>
</div>
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
