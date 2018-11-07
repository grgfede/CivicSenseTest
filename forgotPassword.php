<?php
session_start();

?>

<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Civic Sense - Recupera Password</title>
  <!-- Latest compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Recupera Password</div>
      <div class="card-body">
        <div class="text-center mt-4 mb-5">
          <h4>Hai dimenticato la password?</h4>
          <p>Inserisci la tua email e te ne manderemo una nuova.</p>
        </div>
        <form name="lost_psw" action="php/password_sent.php" method="post">
          <div class="form-group">
            <input class="form-control" name="email" type="email" aria-describedby="emailHelp" placeholder="Inserisci indirizzo Email">
          </div>
          <button class="btn btn-primary btn-lg btn-block">Recupera Password</button>
        </form>
        <div class="text-center">
	<?php
		if($_SESSION['errore_mail']){
			echo "<font color=red size = 3>Inserisci un indirizzo email! </font>";
			$_SESSION['errore_mail'] = False;
		}
		if($_SESSION['errore_mail_non_trovata']){
			echo "<font color=red size = 3>Indirizzo email non trovato. </font>";
			$_SESSION['errore_mail_non_trovata'] = False;
		}
	?>
          <a class="d-block small mt-3" href="register.php">Crea un account</a>
          <a class="d-block small" href="login.php">Effettua il Login</a>

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
