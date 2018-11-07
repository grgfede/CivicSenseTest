<!--
	#################################################################################
	#		REGOLE PER UNA BUONA PERMANENZA DI GRUPPO			#
	#	1 Se scrivi del nuovo codice, COMMENTA QUELLO CHE FAI			#
	#	2 Modifichi del codice? COMMENTA LA MODIFICA				#
	#	3 Modifichi del codice e non funziona? RIMETTI TUTTO A POSTO		#
	#	4 Hai dubbi su qualche parte del codice? NON METTERE MANI		#
	#	5 CERCA DI COMMENTARE CODICE CHE APPARE COMPLICATO AL RESTO DEL GRUPPO	#
	#										#
	#  Chi infrange le regole siamo obbligati a dare della puttana alla madre	#
	#  Buon lavoro :)								#
	#################################################################################
-->

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
  <title>Civic Sense - Registrazione Cittadino</title>
  <!-- Latest compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Crea un account</div>
      <div class="card-body">
        <form name="register" action="php/register_connectivity.php" method="post">

          <div class="form-group">
            <div class="form-row">

              <!-- FORM NOME -->
              <div class="col-md-6">
                <label for="exampleInputName">Nome<span class="text-danger"> *</span></label>
                <input class="form-control" id="nome" name="nome" type="text" aria-describedby="nameHelp" placeholder="Inserisci il Nome">
              </div>

              <!-- FORM COGNOME -->
              <div class="col-md-6">
                <label for="exampleInputLastName">Cognome<span class="text-danger"> *</span></label>
                <input class="form-control" id="cognome" name="cognome" type="text" aria-describedby="nameHelp" placeholder="Inserisci il Cognome">
              </div>
              
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">

              <!-- FORM CITTA -->
              <div class="col-md-6">
                <label for="exampleInputResidenza">Citt&agrave; di provenienza<span class="text-danger"> *</span></label>
                <input class="form-control" id="residenza" name="residenza" type="text" aria-describedby="nameHelp" placeholder="Inserisci la citt&agrave; in cui vivi">
              </div>

              <!-- FORM DATA DI NASCITA -->
              <div class="col-md-6">
                <label for="exampleInputLastName">Data di nascita</label>
                <input class="form-control" id="data_nascita" name="nascita" type="date" aria-describedby="nameHelp">
              </div>

            </div>
          </div>
          <!-- FORM EMAIL -->
          <div class="form-group">
            <label for="exampleInputEmail1">Email<span class="text-danger"> *</span></label>
            <input class="form-control" id="exampleInputEmail1" name="email" type="email" aria-describedby="emailHelp" placeholder="Inserisci la tua email">
          </div>

          <!-- FORM NickName -->
          <div class="form-group">
            <label for="exampleInputEmail1">NickName<span class="text-danger"> *</span></label>
            <input class="form-control" id="exampleInputEmail1" name="username" type="text" aria-describedby="nickHelp" placeholder="Il nickname sar&agrave; il tuo identificativo sulla piattaforma.">
          </div>

          <!-- FORM EMAIL -->
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Password<span class="text-danger"> *</span></label>
                <input class="form-control" id="exampleInputPassword1" name="password1" type="password" placeholder="Password">
              </div>

              <!-- FORM Password -->
              <div class="col-md-6">
                <label for="exampleConfirmPassword">Confirm password<span class="text-danger"> *</span></label>
                <input class="form-control" id="exampleConfirmPassword" name="password2" type="password" placeholder="Conferma password">
              </div>

              <br>
              <br>
              <br>




            </div>
          </div>

	<button class="btn btn-primary btn-lg btn-block">Registrati</button>
        </form>


        <div class="text-center">
	<?php
		if($_SESSION['error'] == True){

			echo "<br><font color=red size=3><b>I seguenti campi sono obbligatori</b></font>";
			echo "<ul>";
			if ($_SESSION['errore_nome']){
				echo '<p align="center"><li><font color=red size=3>Nome</font></li>';
				$_SESSION['errore_nome'] = False;
				$_SESSION['error'] = False;
			}

			if ($_SESSION['errore_cognome']) {
				echo '<li><font color=red size=3>Cognome</font></li>';
				$_SESSION['errore_cognome'] = False;
				$_SESSION['error'] = False;
			}

			if ($_SESSION['errore_residenza']) {
				echo '<li><font color=red size=3>Residenza</font></li>';
				$_SESSION['errore_residenza'] = False;
				$_SESSION['error'] = False;
			}
			if ($_SESSION['errore_mail']) {
				echo '<li><font color=red size=3>Email</font></li>';
				$_SESSION['errore_mail'] = False;
				$_SESSION['error'] = False;
			}
			if ($_SESSION['errore_username']) {
				echo '<li><font color=red size=3>Nickname</font></li>';
				$_SESSION['errore_username'] = False;
				$_SESSION['error'] = False;
			}
			if ($_SESSION['errore_psw']) {
				echo '<li><font color=red size=3>Inserisci una password valida</font></li>';
				$_SESSION['errore_psw'] = False;
				$_SESSION['error'] = False;
			}
			if ($_SESSION['errore_psw_diverse']) {
				echo '<li><font color=red size=3>Le password non combaciano</font></li>';
				$_SESSION['errore_psw_diverse'] = False;
				$_SESSION['error'] = False;
			}
			echo "</ul>";
		}

		if($_SESSION['errore_registrazione']){
			echo '<font color=red size=3><b>Email o NickName gi&agrave; esistenti!</b></font>';
			$_SESSION['errore_registrazione'] = False;
		}
	?>
          <a class="d-block small mt-3" href="login.php">Effettua il Login</a>
          <a class="d-block small" href="forgotPassword.html">Password dimenticata?</a>
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
