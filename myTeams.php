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

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['admin_name'])) {
header('Location: index.html');
}

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
   <title>Civic Sense - Gestisci squadre</title>

  <!-- Latest compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
    <!-- Css per table -->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="css/table.css" rel="stylesheet">

  <!-- Custom styles for map-->
  <link href="css/map.css" rel="stylesheet">

		<!--FUNZIONE PER ELIMINARE SQUADRA-->
		<script>
			var	selected_team = "";
			function memory_team(team) {
				selected_team = team;
			}
			function modify_team(nomeEnte, nomeSquadra, nuovaSquadra, nuovaPass, nuovaEmail){
					var form = document.createElement("form");
					document.body.appendChild(form);
					form.method = "POST";
					form.action = "php/modify_team.php";
					var f_ente = document.createElement("input");
				  f_ente.type="hidden";
				  f_ente.name = "ente";
				  f_ente.value = nomeEnte;
				  form.appendChild(f_ente);
					var f_nomeSquadra = document.createElement("input");
				 	f_nomeSquadra.type="hidden";
				 	f_nomeSquadra.name = "nomeSquadra";
				 	f_nomeSquadra.value = nomeSquadra;
				 	form.appendChild(f_nomeSquadra);
					var f_nuovaSquadra = document.createElement("input");
					f_nuovaSquadra.type="hidden";
					f_nuovaSquadra.name = "nuovaSquadra";
					f_nuovaSquadra.value = nuovaSquadra;
					form.appendChild(f_nuovaSquadra);
					var f_nuovaPass = document.createElement("input");
					f_nuovaPass.type="hidden";
					f_nuovaPass.name = "nuovaPass";
					f_nuovaPass.value = nuovaPass;
					form.appendChild(f_nuovaPass);
					var f_emailSquadra = document.createElement("input");
					f_emailSquadra.type="hidden";
					f_emailSquadra.name = "nuovaEmail";
				 	f_emailSquadra.value = nuovaEmail;
				 	form.appendChild(f_emailSquadra);

					form.submit();
			}

			function deleteTeam(nome_squadra, ente) {
				var form = document.createElement("form");
		    document.body.appendChild(form);
		    form.method = "POST";
		    form.action = "php/rimuovi_squadra.php";
		    var f_ente = document.createElement("input");
		    f_ente.type="hidden";
		    f_ente.name = "ente";
		    f_ente.value = ente;
		    form.appendChild(f_ente);
		    var f_nome_squadra = document.createElement("input");
		    f_nome_squadra.type="hidden";
		    f_nome_squadra.name = "nome_squadra";
		    f_nome_squadra.value = nome_squadra;
		    form.appendChild(f_nome_squadra);
		    form.submit();
			}
		</script>

</head>
<body class="fixed-nav sticky-footer bg-dark static-top" id="page-top">
  <?
  //FILE PER CARICARE LA NAVBAR DEL RELATIVO TIPO DI UTENTE COLLEGATO
  include "navbar.php";?>
  <div class="content-wrapper">
    <div class="container-fluid">
     <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Gestisci squadre</li>
      </ol>
      <div class="row">
      	<div class="col-12 col-sm-8">
      <h1>Gestisci Squadre</h1>
  		</div>
  		<div class="col-12 col-sm-4 d-flex align-items-center">
      	<a class="btn bg-success ml-auto" href="newTeam.php">
         <i class="fa fa-fw fa-plus text-white"></i><span class="text-white">Crea squadra</span>
        </a>
    	</div>
       </div>
		<hr>
      <div class="row">
        <div class="col-xl-12 col-sm-12 mb-3">
          <div class="card">
          <div class="card-header">
                <i class="fa fa-gears"></i>&nbsp; Le mie squadre
          </div>

          <!--Creazione tabella dei CDT in lavorazione-->
          <div class="table-responsive">
                  <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nome Squadra</th>
												<th>Email Capo Squadra</th>
                        <th>Azioni</th>
                      </tr>
                    </thead>
                    <tbody>
<?
  $count = 1;
  $querySquadre = "Select * from squadra_risoluzione where ente = '$nome'";
  $esegui = mysqli_query($connect, $querySquadre);
  $riga = mysqli_num_rows($esegui);
  while($cicle=mysqli_fetch_array($esegui)){ ?>
    <tr><td><b><? echo $count++; ?></b></td>
    <td> <? echo $cicle['id_squadra']; ?></td>
		<td> <? echo $cicle['email_capo']; ?></td>
    <td><button onclick="deleteTeam('<? echo $cicle['id_squadra'];?>', '<? echo $nome;?>')" style="background: none; border:none"><i class="fa fa-fw fa-trash"></i></button>
    <button onclick="memory_team('<? echo $cicle['id_squadra']; ?>')"data-toggle="modal" data-target="#ModalResolutionTeam" style="background:none; border:none"><i class="fa fa-edit"></i></button></td></tr>
  <?}
  ?>
                    </tbody>
                  </table>
                </div>
              </div>
    </div>
	</div>
	</div>
	<div class="row">
		<? include "footer.php" ?>
	</div>
	<!-- POPUP PER L'ASSEGNAMENTO DELLE SEGNALAZIONE ALLA SQUADRA DI RISOLUZIONE-->
	<div class="modal fade" id="ModalResolutionTeam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
					<h5 class="modal-title" id="teamModalLabel" style="position: relative">Modifica Squadra</h5>
	      </div>

	      <div class="col-xl-12 col-sm-12 mb-3">
	        <!--QUI ANDRA' IL PHP PER LA RICERCA DELLE SQUADRE DISPONIBILI-->
					<label for="exampleInputName">Nome Identificativo</label>
					<input class="form-control" id="idTeam" name="idTeam" type="text" aria-describedby="nameHelp" placeholder="">
				</div>
				<div class="col-xl-12 col-sm-12 mb-3">
					<label for="exampleInputName">Email Capo Squadra</label>
					<input class="form-control" id="emailTeam" name="emailTeam" type="email" aria-describedby="nameHelp" placeholder="">
				</div>
				<div class="col-xl-12 col-sm-12 mb-3">
					<label for="exampleInputName">Password</label>
					<input class="form-control" id="passTeam" name="passTeam" type="password" aria-describedby="nameHelp" placeholder="">
	      </div>

	      <div class="modal-footer">
	        <button class="btn btn-primary" id="assign" type="button" onclick="modify_team('<?echo $_SESSION['admin_name']?>',selected_team, document.getElementById('idTeam').value, document.getElementById('passTeam').value, document.getElementById('emailTeam').value)">Modifica</button>
	        <button class="btn btn-secondary" id="undo" type="button" data-dismiss="modal">Annulla</button>
	      </div>

	    </div>

	  </div>

	</div>
</div>
      <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
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
    <script src="js/sb-admin-charts.min.js"></script>
</body>

</html>
