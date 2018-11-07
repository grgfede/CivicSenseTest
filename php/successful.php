<?php
session_start();
$connect = mysqli_connect("localhost", "civicsense2018", "", "my_civicsense2018");

if($_SESSION['admin_name'] == ""){
	$nome_utente = "Ospite";
} else {
	$nome_utente = $_SESSION['admin_name'];
}
$status = $_GET['status'];
if ($status !== 'ok'){
	header ('Location: ../index.php');
}

$last_cdt=$_SESSION['last_cdt'];




?>

<html>
<title>CivicSense - Segnalazione Creata!</title>
<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

	<script src="/push.js"></script>
	<!------ Include the above in your HEAD tag ---------->
</head>
<body>


	<div class="container container-fluid">

		<div class="row text-center">

			<div class="col-sm-6 col-sm-offset-3">

				<br><br> <h2 style="color:#0fad00">Complimenti!</h2>

				<img src="../images/verificato.png">

				<h3>Ciao, <?php echo $nome_utente; ?></h3>

				<p style="font-size:20px;color:#5C5C5C;">Grazie per aver creato una nuova segnalazione. Al pi&ugrave; presto la tua segnalazione sar&agrave; assegnata a chi di dovere. </p>

				<?php
				if($nome_utente == "Ospite"){ ?>
					<p style="font-size:20px; color:#5C5C5C;"> La tua segnalazione &egrave; identificata come <?php echo $_SESSION['last_cdt'] ?> cercala nella barra ricerca. </p>
					<p style="font-size:20px; color:#5C5C5C;"> Vuoi ricevere l'identificativo via email? Inserisci qui sotto il tuo indirizzo e dai la conferma. </p>

					<form action="email_ospite.php" method="post">
						<input class="form-control" id="email_ospite" name="email_ospite" type="email" aria-describedby="nameHelp" placeholder="Inserisci la tua email">
						<br>
						<button class="btn btn-primary" name="login">Invia Email</button>
					</form>

				<?php } ?>

				 <div id="home" align="center">
					 	<a href="../index.php" class="btn btn-success">Torna alla home</a>
					</div>
				<br><br>
			</div>

		</div>

	</div>
</body>
</html>
