<?php
  session_start();

  include "dbconnection_session.php";

  $cdt = $_POST['cdt'];
  $nomeUtente = $_POST['nome'];

  $queryUnfollow = "DELETE FROM crea_segue where id_cittadino = '$nomeUtente' and cdt = $cdt";
  $queryEsegui = mysqli_query($connect, $queryUnfollow);

    header("location: ../detailTicket.php?id=$cdt");
?>
