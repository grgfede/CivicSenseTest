<?php
  session_start();

include "dbconnection_session.php";

  $nome_squadra = $_POST['nome_squadra'];
  $ente = $_POST['ente'];

  $query = "select * from squadra_risoluzione where id_squadra = '$nome_squadra' and ente = '$ente'";
  $esegui = mysqli_query($connect, $query);
  $queryElimina = "DELETE FROM squadra_risoluzione WHERE id_squadra = '$nome_squadra'";
  while ($cicle=mysqli_fetch_array($esegui)){
    if ($cicle['occupata']!=0){
      //Se la squadra è impegnata, si blocca l'eliminazione
      ?>
      <script>
        alert("Impossibile eliminare la squadra perché è impegnata con una segnalazione");
        window.location.replace("../teams.php");
      </script>
      <?
    } else {
      $eseguiElimina = mysqli_query($connect, $queryElimina);
      if ($eseguiElimina){
        ?>
        <script>
          alert("Squadra eliminata con successo");
          window.location.replace("../teams.php");
        </script>
      <?
      }


    }
  }


?>
