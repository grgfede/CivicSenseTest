<?php

  include "dbconnection_session.php";

  //RECUPER LE VECCHIE INFORMAZIONI
  $titolo = $_SESSION['titolo'];
  $gravita = $_SESSION['gravita'];
  $descrizione = $_SESSION['descrizione'];
  $categoria = $_SESSION['categoria'];

  //GESTIONE ERRORI
  $_SESSION['erroreTitolo'] = False;
  $_SESSION['erroreDescrizione'] = False;
  $_SESSION['errore'] = False;

  //RECUPERO LE NUOVE INFORMAZIONI
  $newTitolo = $_POST['newTitolo'];
  $newGravita = $_POST['radio'];
  $newDescrizione = $_POST['newDescrizione'];
  $newCategoria = utf8_decode(addslashes($_POST['newCat']));
  $id = $_SESSION['id'];

  //CONTROLLO SE CI SONO ERRORI
  if (empty($_POST['newTitolo'])){
    $newTitolo = $titolo;
  } else {
    $newTitolo = $_POST['newTitolo'];
  }
  if(empty($_POST['newDescrizione'])){
    $newDescrizione = $descrizione;
} else {
  $newDescrizione = $_POST['newDescrizione'];
}

  $sql = "UPDATE segnalazione set nome_evento = '$newTitolo', gravita = $newGravita, descrizione = '$newDescrizione', categoria = '$newCategoria' where cdt = $id";
  $sqlEsegui = mysqli_query($connect, $sql);
  if($sqlEsegui){?>
    <script>
      window.location.replace("../detailTicket.php?id=<? echo $id;?>");
    </script>
  <?}
?>
