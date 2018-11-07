<?php

	session_start();

	$nome = $_GET['name'];

	$mail = $_GET['mail'];

?>


<!DOCTYPE html>
<html>
<head>
	
<title>CivicSense - Registrazione con successo!</title>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">



<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>



<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>



<!------ Include the above in your HEAD tag ---------->

</head>

<body>





<div class="container">



 <div class="row text-center">



	<div class="col-sm-6 col-sm-offset-3">



	        <br><br> <h2 style="color:#0fad00">Complimenti <?php echo $nome; ?></h2>



		<img src="../images/register-ok.png">







		<h3>Ciao, <?php echo $nome; ?></h3>

		  <p style="font-size:20px;color:#5C5C5C;">La registrazione &egrave; completata! Ti abbiamo inviato una email all'indirizzo <span class="text-success"> <?php echo $mail; ?> </span> con le informazioni del tuo account.

Non ti resta altro che effettuare il login! Buona navigazione.</p>



<a href="../login.php" class="btn btn-success">Effettua il Login</a>

    

	<br><br>

	</div>

        

	

 </div>



</div>

</body>

</html>
