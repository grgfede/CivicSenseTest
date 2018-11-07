<!--
  #################################################################################
  #   REGOLE PER UNA BUONA PERMANENZA DI GRUPPO     #
  # 1 Se scrivi del nuovo codice, COMMENTA QUELLO CHE FAI     #
  # 2 Modifichi del codice? COMMENTA LA MODIFICA        #
  # 3 Modifichi del codice e non funziona? RIMETTI TUTTO A POSTO    #
  # 4 Hai dubbi su qualche parte del codice? NON METTERE MANI   #
  # 5 CERCA DI COMMENTARE CODICE CHE APPARE COMPLICATO AL RESTO DEL GRUPPO  #
  #                   #
  #  Chi infrange le regole siamo obbligati a dare della puttana alla madre #
  #  Buon lavoro :)               #
  #################################################################################
-->
<?php

include "php/dbconnection_session.php";

$nome = $_SESSION['admin_name'];

$query ="SELECT * FROM segnalazione where squadra_risoluzione = '".$_SESSION['admin_name']."'";

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
  <title>Civic Sense - Storico segnalazioni</title>
  <!-- Latest compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  
    <!-- Css per table -->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!--SCRIPT E CSS PER LE ICONE DELLA GRAVITA'-->
  <script src="js/gravita.js"></script>
  <link href="css/gravita.css" rel="stylesheet">
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
        <li class="breadcrumb-item active">Storico segnalazioni</li>
      </ol>
      <h1>Storico segnalazioni</h1>
      <hr>
      <div  class="row">
        <div class="col">
          <div class="card h-100">
            <div class="card-header">
              <h3 class="panel-title">Segnalazioni risolte</h3>
            </div>
          <div class="card-body h-100">
<?php
  if ($errorevuoto) { ?>
    <div class="col"></div>
    <div class="col"><p class="text-center">Non hai ancora risolto nessuna segnalazione!<br>Mettiti a lavoro!</p></div>
<?php
  } else { ?>
<!--TABELLA CHE MOSTRA I RISULTATI-->
 <div class="table-responsive">
            <table class="table table-bordered dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>CDT</th>
                  <th>Nome Segnalazione</th>
                  <th>Citt&agrave</th>
                  <th>Indirizzo</th>
                  <th>Gravit&agrave</th>
                  <th>Descrizione</th>
                  <th>Data <span style="white-space: nowrap;">Presa in carico</span></th>
                  <th>Data Risoluzione</th>
                </tr>
              </thead>
              <tbody>

<?php 
    
    $count = 1;  //VARIABILE PER CONTARE I TICKET NELLA TABELLA
   	$td_a = "<td>";
   	$td_c = "</td>";
    while($cicle=mysqli_fetch_array($risultato)){
      echo '<tr><td><b>'.$count++.'</b></td>';
      echo $td_a.$cicle['cdt'].$td_c;
      echo '<td><a href="detailTicket.php?id='.$cicle['cdt'].'">'.$cicle['nome_evento'].'</a></td>';
      echo $td_a.$cicle['citta'].$td_c;
      echo $td_a.$cicle['indirizzo'].$td_c;

      $gravita = $cicle['gravita'];
        switch($gravita){
          case 1:
            $gravita_colore="green.png";
            break;
          case 2:
            $gravita_colore="yellow.png";
            break;
          case 3:
            $gravita_colore="red.png";
            break;
            default:
            break;
        }?>

      <td><div class="d-flex mr-3 rounded-circle w-30 h-30 gravita" style="background-image: url('images/icons/<?echo $gravita_colore?>');"></div></td>
      <?
      echo $td_a.$cicle['descrizione'].$td_c;
      $data_presa_carico = $cicle['data_presa_carico'];
      $data_presa_carico = date("d-m-Y", strtotime($data_presa_carico));
      echo $td_a.$data_presa_carico.$td_c;
      $data_completamento = $cicle['data_completamento'];
      $data_completamento = date("d-m-Y", strtotime($data_completamento));
      echo $td_a.$data_completamento.$td_c;
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
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
</body>

</html>
