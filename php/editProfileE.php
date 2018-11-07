<?php
include "dbconnection_session.php";

	$username = $_SESSION['admin_name'];

	$controllo = false;
	$controlloPass = false;

	$_SESSION['errore_password'] = false;
$passwordText1 = 'passwordText1';
  $url = $_SESSION['logo'];
  $nomeEnte = $_SESSION['nomeEnte'];
	$email = $_SESSION['email'];
	$denominazione = $_SESSION['denominazione'];
	$sede_legale = $_SESSION['sede_legale'];
	$sede_operativa = $_SESSION['sede_operativa'];
	$descrizione = $_SESSION['descrizione'];
	$password = $_SESSION['password'];


	if(isset($_POST["edit"])){
		if(!empty($_POST["ragionesocialeText"])){
			$denominazione = ucfirst($_POST["denominazioneText"]);
			$controllo = true;
		}
		if (!empty($_POST["sedelegaleText"])){
			$sede_legale = ucfirst($_POST["sedelegaleText"]);
			echo "cognome";
			$controllo = true;
		}
		if(!empty($_POST["sede_operativaText"])){
			$sede_operativa = ucfirst($_POST["sedeoperativaText"]);
			echo "residenza";
			$controllo = true;
		}
    if ($_FILES["logo"]["size"]>0){
      $data = file_get_contents($_FILES["logo"]["tmp_name"]);
      //CODIFICA FOTO IN BASE64
      $url = base64_encode($data);
      $controllo = true;
    }
		if (!empty($_POST['descrizioneText'])){
			$descrizione = $_POST['descrizioneText'];
			echo "nascita";
			$controllo = true;
		}
		if (!empty($_POST["emailText"])){
			$email = $_POST["emailText"];
			echo "mail";
			$controllo = true;
		}
		if ($_POST[$passwordText1] == $_POST['passwordText2']){
			$password = $_POST[$passwordText1];
			$passwordNuova = md5($password);
			$controllo = true;

		} elseif ($_POST[$passwordText1] != $_POST['passwordText2']) {
			$_SESSION['errore_password'] = true;
			$passErrate = true;
		}

		//header("location: ../profilepage.php");
	}







	if ($controllo == true){
		if($passErrate == true){
			header("location: ../editProfile.php");
		}else {
			$sql = "UPDATE ente SET email = '$email', denominazione = '$denominazione', sede_legale = '$sede_legale', sede_operativa = '$sede_operativa', descrizione = '$descrizione', logo = '$url' WHERE id_ente = '$username'";
			$result1 = mysqli_query($connect,$sql) or die ('Non riesco ad aggiungere, errore inserimento in ticket'. mysqli_error($link));
			if (!empty($password)){
				$sql2 = "UPDATE login SET password = '$passwordNuova' where username = '$username'";
				$result2 = mysqli_query($connect, $sql2);
			}
			header("location: ../profile.php");

		}
	}

?>
