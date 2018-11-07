<?php
include "dbconnection_session.php";
	$username = $_SESSION['admin_name'];

	$controllo = false;
	$controlloPass = false;

	$_SESSION['errore_password'] = false;

	$nome = $_SESSION['nomeUtente'];
	$cognome = $_SESSION['cognome'];
	$localita = $_SESSION['localita'];
	$nascita = $_SESSION['nascita'];
	$sesso = $_SESSION['sesso'];
	$email = $_SESSION['email'];
	$password = $_SESSION['password'];


	if(isset($_POST["edit"])){
		if(!empty($_POST["nomeText"])){
			$nome = ucfirst($_POST["nomeText"]);
			echo "nome";
			$controllo = true;
		}
		if (!empty($_POST["cognomeText"])){
			$cognome = ucfirst($_POST["cognomeText"]);
			echo "cognome";
			$controllo = true;
		}
		if(!empty($_POST["residenzaText"])){
			$localita = ucfirst($_POST["residenzaText"]);
			echo "residenza";
			$controllo = true;
		}
		if ($_POST['nascitaText'] != ""){
			$nascita = $_POST['nascitaText'];
			echo "nascita";
			$controllo = true;
		}
		if ($sesso != $_POST["sessoText"]){
			$sesso = $_POST["sessoText"];
			echo "sesso";
			$controllo = true;
		}
		if (!empty($_POST["emailText"])){
			$email = $_POST["emailText"];
			echo "mail";
			$controllo = true;
		}
		if ($_POST['passwordText1'] == $_POST['passwordText2']){
			$password = $_POST['passwordText1'];
			$passwordNuova = md5($password);
			$controllo = true;

		} elseif ($_POST['passwordText1'] != $_POST['passwordText2']) {
			$_SESSION['errore_password'] = true;
			$passErrate = true;
		}

		//header("location: ../profilepage.php");
	}







	if ($controllo == true){
		if($passErrate == true){
			header("location: ../editProfile.php");
		}else {
			$sql = "UPDATE cittadino SET nome = '$nome', cognome = '$cognome', residenza = '$localita', sesso = '$sesso', email = '$email', data_nascita = '$nascita' WHERE id_cittadino = '$username'";
			$result1 = mysqli_query($connect,$sql) or die ('Non riesco ad aggiungere, errore inserimento in ticket'. mysqli_error($link));
			if (!empty($password)){
				$sql2 = "UPDATE login SET password = '$passwordNuova' where username = '$username'";
				$result2 = mysqli_query($connect, $sql2);
			}
			header("location: ../profile.php");

		}
	}

?>
