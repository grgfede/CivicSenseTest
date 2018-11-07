<?php
  include "dbconnection_session.php";

  $tipo = $_SESSION['tipo'];
  $nomeEnte = $_SESSION['admin_name'];

  //VARIABILI DI SESSIONE PER LA GESTIONE DI ERRORI
  $_SESSION['erroreId'] = False;
  $_SESSION['errorePassword'] = False;
  $_SESSION['erroreMail'] = False;

  $_SESSION['MailEsistente'] = False;
  $_SESSION['IdEsistente'] = False;
  $_SESSION['errore'] = False;

  //MI PASSO I VALORI INSERITI NEL FORM
  $nomeSquadra = $_POST['id_squadra'];
  $passSquadra = $_POST['pass_squadra'];
  $email = $_POST['email_squadra'];

  //ESEGUO CONTROLLI
  if (empty($_POST['id_squadra'])){
    $_SESSION['erroreId'] = True;
    $_SESSION['errore'] = True;
  }
  if (empty($_POST['email_squadra'])){
    $_SESSION['erroreMail'] = True;
    $_SESSION['errore'] = True;
  }
  if(empty($_POST['pass_squadra'])){
    $_SESSION['errorePassword'] = True;
    $_SESSION['errore'] = True;
  }
  //CONTROLLO SE IL NOME DELLA SQUADRA ESISTE
  $sqlNomeSquadra = "select * from squadra_risoluzione where id_squadra = '$nomeSquadra' or email_capo = '$email'";
  $query_eseguiNome = mysqli_query($connect, $sqlNomeSquadra);
  $riga3 = mysqli_num_rows($query_eseguiNome);
  if ($riga3 > 0){
    $_SESSION['IdEsistente'] = True;
    $_SESSION['MailEsistente'] = True;
    $_SESSION['errore'] = True;
  }
  //SE CI SONO ERRORI, AVVISO L'ENTE
  if ($_SESSION['errore']){
    header ("Location: ../newTeam.php");
  }

  //CREO LA PASSWORD CRIPTATA
  $passSquadra = md5($passSquadra);


  //INSERISCO NEL DATABASE I VALORI DELLA NUOVA SQUADRA
  $queryCreazioneTeam = "insert into squadra_risoluzione (id_squadra, ente, email_capo) values ('$nomeSquadra', '$nomeEnte', '$email')";
  $query_esegui = mysqli_query($connect, $queryCreazioneTeam) or die ("Non riesco a creare la squadra");
  $queryLoginTeam = "insert into login values ('$nomeSquadra', '$passSquadra', 3)";
  $query_esegui2 = mysqli_query($connect, $queryLoginTeam) or die ("Non riesco ad aggiungere in login");

  if(!((mysqli_error($connect, $result1)) || (mysqli_error($connect, $result2)))){
 ?>
 <script>
   alert("Squadra creata con successo!");
   window.location.replace("../index.php");
 </script>
 <?}?>
