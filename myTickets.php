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

// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['admin_name'])) {
header('Location: index.html');
}


	$nome = $_SESSION['admin_name'];
	$connect = mysqli_connect("localhost", "civicsense2018", "", "my_civicsense2018");
	$query = "SELECT * FROM crea_segue where id_cittadino = '$nome'";
	$risultato = mysqli_query($connect, $query);
	$righe = mysqli_num_rows($risultato);


?>


<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Civic Sense - Segnalazioni seguite</title>

  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
    <!-- Css per table -->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
   <div class="content-wrapper">
		 <!-- Navigation-->
		<? include "navbar.php";?>
    <div class="container-fluid">
     <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Segnalazioni seguite</li>
      </ol>
      <h1>Segnalazioni seguite</h1>
      <hr>
	<?php if ($righe == 0){ ?>
	<!-- SE NON CI SONO TICKET -->
	<div> Non segui ancora nessuna segnalazione!, creala oppure cercala ed aggiungila alla tua lista! </div>
	<?php } else { ?>

<div class="card-body">
 <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nome Ticket</th>
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

		$db_connection= mysql_connect(localhost,civicsense2018,"");
		$db_selection = mysql_select_db(my_civicsense2018,$db_connection);

		$count = 1;  //VARIABILE PER CONTARE I TICKET NELLA TABELLA
		$nomeUtente = $_SESSION['admin_name'];

		$query = mysql_query("SELECT * FROM crea_segue inner join segnalazione on crea_segue.cdt = segnalazione.cdt where crea_segue.id_cittadino = '$nomeUtente'");


		while($cicle=mysql_fetch_array($query)){
			echo '<tr><td><b>'.$count++.'</b></td>';
			echo '<td><a href="detailTicket.php?id='.$cicle['cdt'].'">'.$cicle['nome_evento'].'</a></td>';
			echo "<td>".$cicle['stato']."</td>";
			$data_creazione = $cicle['data_creazione'];
			$data_creazione = date("d-m-Y", strtotime($data_creazione));
			echo "<td>".$data_creazione."</td>";
			//echo "<td>";
			/*if ($cicle['stato'] == "Pendente"){
				echo '<div align="center"><a href="new-ticket.php?cdt='.$cicle['cdt'].'&autore='.$cicle['id_cittadino'].'"><img src="images/edit-ticket.png"></div>';
			}*/
			echo /*"</td>*/"</tr>";



			}

?>

              </tbody>
            </table>
          </div>
	</div>
<?php } ?>

<br><br>

   </div><!-- /.container-fluid-->

    <div class="row">
      <? include 'footer.php';?>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
        <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
  </div>    <!-- /.content-wrapper-->
</body>

</html>
