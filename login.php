 <?php

include "php/dbconnection_session.php";

if(isset($_SESSION["admin_name"]))
{
 header("location:index.php");
}


if(isset($_POST["login"]))
{
 if(!empty($_POST["member_name"]) && !empty($_POST["member_password"]))
 {

  $name = mysqli_real_escape_string($connect, $_POST["member_name"]);
  $password = md5(mysqli_real_escape_string($connect, $_POST["member_password"]));
  $sql = "Select * from login where username = '" . $name . "' and password = '" . $password . "'";
  $result = mysqli_query($connect,$sql);
  $user = mysqli_fetch_array($result);

  if($user)
  {
   if(!empty($_POST["remember"]))
   {
    setcookie ("member_login",$name,time()+ 60*60*7);
    setcookie ("member_password",$password,time()+ 60 * 60 * 7);
   }
   $_SESSION["admin_name"] = $name;
   $_SESSION["tipo"] = $user['tipo'];

//    INIZIALIZZAZIONE DELLE VARIABILI DI SESSIONE DEI TIPI DI UTENTI CONNESSI
//    PER RICHIAMARE LA VARIABILE SI USA $_SESSION['tipoutente_nomecampodb']
//    LEGENDA DEI TIPI DI UTENTE PER RICHIAMARE LE VARIABILI
//      - s = SQUADRA DI RISOLUZIONE
//      - c = CITTADINO
//      - e = ENTE
//
//    SE AVETE BISOGNO DI AGGIUNGERE VARIABILI DI SESSIONE AGGIUNGERE QUI IN BASSO ↓↓↓↓↓↓↓↓↓↓

   switch ($user['tipo']) {
     case 1:
     $query = "select * from cittadino where id_cittadino = '$name'";
     $query_esegui = mysqli_query($connect, $query);
      while($record = mysqli_fetch_array($query_esegui)){
        $_SESSION['c_nome'] = $record['nome'];
        $_SESSION['c_cognome'] = $record['cognome'];
        $_SESSION['c_residenza'] = $record['residenza'];
      }
      break;
      case 2:
      $query = "select * from ente where id_ente = '$name'";
      $query_esegui = mysqli_query($connect, $query);
      while($record = mysqli_fetch_array($query_esegui)){
        $_SESSION['e_ragione_sociale'] = $record['ragione_sociale'];
        $_SESSION['e_email'] = $record['email'];
        $_SESSION['e_descrizione'] = $record['descrizione'];
        $_SESSION['e_logo'] = $record['logo'];
      }
      break;
      case 3:
      $query = "select * from squadra_risoluzione where id_squadra = '$name'";
      $query_esegui = mysqli_query($connect, $query);
      while($record = mysqli_fetch_array($query_esegui)){
        $_SESSION['s_nome_squadra'] = $record['nome_squadra'];
        $_SESSION['s_competenza'] = $record['competenza'];
        $_SESSION['s_regione'] = $record['regione'];
        $_SESSION['s_provincia'] = $record['provincia'];
        $_SESSION['s_comune'] = $record['comune'];
      }
      break;
   }

   header("location:index.php");
  }
  else
  {
   $message = "Login non valido";
  }
 }
 else
 {
  $message = "Sono richiesti entrambi i campi";
 }
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
  <title>Civic Sense - Login</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form name="login" id="form" action="" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input class="form-control" name="member_name" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" type="text" aria-describedby="emailHelp" placeholder="Inserisci Username" autofocus>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" name="member_password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" type="password" placeholder="Password">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" name="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> type="checkbox"> Ricordami</label>
            </div>
          </div>
          <button class="btn btn-primary btn-block" name="login">Login</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Registra un nuovo Account</a>
          <a class="d-block small" href="forgotPassword.php">Password Dimenticata?</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
