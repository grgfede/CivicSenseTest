<?php
  session_start();
  include "dbconnection_session.php";

  $nomeEnte = $_POST['ente'];
  $nomeSquadra = $_POST['nomeSquadra'];
  $emailSquadra = "";
  $nuovaSquadra = $_POST['nuovaSquadra'];
  $nuovaPass = $_POST['nuovaPass'];
  $nuovaEmail = $_POST['nuovaEmail'];

  /*
    Controllo se esiste un gruppo con il nuovo nome che si sta passando
  */
  if($nuovaSquadra != ""){
  $sqlControlloNome = "select * from squadra_risoluzione where id_squadra = '$nuovaSquadra'";
  $eseguiControllo = mysqli_query($connect, $sqlControlloNome);
  $riga = mysqli_num_rows($eseguiControllo);
  if ($riga > 0){?>
    <script>
      alert("Attenzione! Nome già assegnato ad una squadra!");
      window.location.replace("../teams.php");
    </script>
  <?
  } else if ($nuovaEmail != ""){
    $sqlControlloNome = "select * from squadra_risoluzione where email_capo = '$nuovaEmail'";
    $eseguiControllo = mysqli_query($connect, $sqlControlloNome);
    $riga = mysqli_num_rows($eseguiControllo);
    if ($riga > 0){?>
      <script>
        alert("Attenzione! Email già assegnato ad una squadra!");
        window.location.replace("../teams.php");
      </script>
      <?
    }
  }
}

  $sqlEmailSquadra = "Select * from squadra_risoluzione where id_squadra = '$nomeSquadra'";
  $eseguiEmailSquadra = mysqli_query($connect, $sqlEmailSquadra);
  $cicle = mysqli_fetch_array($eseguiEmailSquadra);
  $emailSquadra = $cicle['email_capo'];

  if ($nuovaSquadra == ""){
    $nuovaSquadra = $nomeSquadra;
  }
  if ($nuovaEmail == ""){
    $nuovaEmail = $emailSquadra;
  }
  if ($nuovaPass == ""){
    $sql = "update squadra_risoluzione set id_squadra = '$nuovaSquadra', email_capo = '$nuovaEmail' where id_squadra = '$nomeSquadra'";
    $esegui = mysqli_query($connect, $sql);
    $sql2 = "update login set username = '$nuovaSquadra' where username = '$nomeSquadra'";
    $esegui2 = mysqli_query($connect, $sql2);
    if ($esegui2){?>
      <script>
        alert("Squadra moificata con successo");
        window.location.replace("../teams.php");
      </script>
    <? }
  } else if ($nuovaPass != ""){
    $sql = "update squadra_risoluzione set id_squadra = '$nuovaSquadra', email_capo = '$nuovaEmail' where id_squadra = '$nomeSquadra'";
    $esegui = mysqli_query($connect, $sql);
    $nuovaPass = md5($nuovaPass);
    $sql2 = "update login set username = '$nuovaSquadra', password = '$nuovaPass' where username = '$nomeSquadra'";
    $esegui2 = mysqli_query($connect, $sql2);

    if(($esegui) && ($esegui2)){?>
      <script>
        alert("Squadra modificata con successo");
        window.location.replace("../teams.php");
      </script>
    <? }
  }
?>
