 <?php  

include "dbconnection_session.php";



//MI MEMORIZZO I VALORI CHE RICEVO DAL FORM IN DELLE VARIABILI

$nome = addslashes(ucfirst($_POST['nome']));

$cognome = addslashes(ucfirst($_POST['cognome']));

$residenza = addslashes(ucfirst($_POST['residenza']));

$mail = $_POST['email'];

$username = addslashes($_POST['username']);

$psw1 = addslashes($_POST['password1']);

$psw2 = addslashes($_POST['password2']);

$data = $_POST['nascita'];

$URLimage = "images/avatar/default-avatar.png";

//$data = date ("Y/m/d");





//RESETTO A FALSE TUTTI GLI ERRORI

$_SESSION['errore_nome'] = False;

$_SESSION['errore_cognome'] = False;

$_SESSION['errore_residenza'] = False;

$_SESSION['errore_username'] = False;

$_SESSION['errore_mail'] = False;

$_SESSION['errore_psw'] = False;

$_SESSION['errore_psw_diverse'] = False;

$_SESSION['errore_registrazione'] = False;



$_SESSION['error'] = False;



//ESEGUO I CONTROLLI PER VERIFICARE SE I CAMPI OBBLIGATORI SONO COMPILATI



//SE NON INSERITA NESSUNA DATA, VIENE SETTATA AD UN VALORE DI DEFAULT

if ($data == NULL){

	$data = "1990-01-01";

}



if ($nome == ""){

	$_SESSION['errore_nome'] = True;

	$_SESSION['error'] = True;

} 

if ($cognome == ""){

	$_SESSION['errore_cognome'] = True;

	$_SESSION['error'] = True;

}

if ($residenza == ""){

	$_SESSION['errore_residenza'] = True;

	$_SESSION['error'] = True;

}

if ($username == ""){

	$_SESSION['errore_username'] = True;

	$_SESSION['error'] = True;

}

if (($mail == "") || (!filter_var($mail, FILTER_VALIDATE_EMAIL))){

	$_SESSION['errore_mail'] = True;

	$_SESSION['error'] = True;

}

if (($psw1 == "") || ($psw2 == "")){

	$_SESSION['errore_psw'] = True;

	$_SESSION['error'] = True;

}



if ($psw1 != $psw2){

	$_SESSION['errore_psw_diverse'] = True;

	$_SESSION['error'] = True;

}



if($_SESSION['error']){

	header("Location: ../register.php");

}





//SE TUTTI I CAMPI SONO CORRETTI, VERIFICA SE EMAIL E_O USERNAME ESISTONO GIA



$query = "SELECT * FROM cittadino where id_cittadino = '".$username."' or email = '".$mail."'";



$result = mysqli_query($connect, $query);

$riga = mysqli_num_rows($result);



if($riga > 0){

	$_SESSION['errore_registrazione'] = True;

	header('Location: ../register.php');

} else {

	$tuttok = True;

	$sql_insert = "INSERT INTO cittadino values ('$username', '$nome', '$cognome', '$mail', '$data', '$URLimage', '$residenza')";

	$result_insert = mysqli_query($connect,$sql_insert);

	$psw1 = md5($psw1);

	$sql_insert2 = "INSERT INTO login values ('$username', '$psw1', 1)";

	$result_insert2 = mysqli_query($connect, $sql_insert2);

	if(!($result_insert) || !($result_insert2)){

		$tuttok = False;

	}

	

	if($tuttok){

		// definisco mittente e destinatario della mail

		$nome_mittente = "Civic Sense";

		$mail_mittente = "civicsense@altervista.org";

		$mail_destinatario = "$mail";



		// definisco il subject ed il body della mail

		$mail_oggetto = "Benvenuto su Civic Sense";

		$mail_corpo = "Ciao, $nome. Ti contattiamo per avvisarti che la tua registrazione è andata a buon fine! Qui di seguito ti ricordiamo le tue credenziali:

				Username: $username

				Password: $psw2";



		// aggiusto un po' le intestazioni della mail

		// E' in questa sezione che deve essere definito il mittente (From)

		// ed altri eventuali valori come Cc, Bcc, ReplyTo e X-Mailer

		$mail_headers = "From: " .  $nome_mittente . " <" .  $mail_mittente . ">\r\n";

		$mail_headers .= "Reply-To: " .  $mail_mittente . "\r\n";

		$mail_headers .= "X-Mailer: PHP/" . phpversion();



		if (mail($mail_destinatario, $mail_oggetto, $mail_corpo, $mail_headers))

  			header ("Location: successful_register.php?name=$nome&mail=$mail");

		else

 		 echo "Errore. Nessun messaggio inviato.";

		}

}

	

?>