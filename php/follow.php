<?php
  session_start();

  include "dbconnection_session.php";

  $cdt = $_POST['cdt'];
  $nomeUtente = $_POST['nome'];

  $queryFollow = "Insert into crea_segue (id_cittadino, cdt) values ('$nomeUtente', $cdt)";
  $queryFollow = mysqli_query($connect, $queryFollow);

    header("location: ../detailTicket.php?id=$cdt");
?>
