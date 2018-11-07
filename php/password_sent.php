<?php

session_start();



$email = $_POST['email'];







$db_connection= mysql_connect(localhost,civicsense2018,"");

$db_selection = mysql_select_db(my_civicsense2018,$db_connection); 



$query = mysql_query("SELECT * FROM cittadino where email = '$email'");

$righe = mysql_num_rows($query);



$_SESSION['errore_mail'] = False;

$_SESSION['errore_mail_non_trovata'] = False;



 

if(empty($email)){

	$_SESSION['errore_mail'] = True;

	header ('Location: ../forgot-password.php');

}

if ($righe == 0){

	$_SESSION['errore_mail_non_trovata'] = True;

	header ('Location: ../forgot-password.php');

}



$nuovaPass = randomPassword();			//MEMORIZZO UNA PASSWORD GENERATA IN MANIERA RANDOM IN UNA VARIABILE

invioEmail($nuovaPass, $email);			//RICHIAMO METODO PER MANDARE LA NUOVA PASSWORD ALLA EMAIL

$nuovaPass2 = md5($nuovaPass);



$sql1 = mysql_query("select * from cittadino where email = '$email'");

$username = "";

while($cicle = mysql_fetch_array($sql1)){

	$username = $cicle['id_cittadino'];

}



$_SESSION['nomeUtente'] = $username;

$_SESSION['email'] = $email;



$sql2 = mysql_query("update login set password = '$nuovaPass2' where login.username = '$username'");

//$result2 = mysql_query($sql2) or die ('Non riesco ad aggiungere, errore: inserimento in crea_segue'. mysqli_error($link));















/*

 * Funzione che genera una password di caratteri in maniera random

 */

function randomPassword() {

    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789!_?-";

    $pass = array(); //remember to declare $pass as an array

    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache

    $pass[] = "";

    for ($i = 0; $i < 15; $i++) {

        $n = random_int(0, $alphaLength);

        $pass[] = $alphabet[$n];

    }

    return implode($pass); //turn the array into a string

}





function invioEmail($pass, $email){

	

	

	

	// definisco mittente e destinatario della mail

		$nome_mittente = "Civic Sense";

		$mail_mittente = "civicsense@altervista.org";

		$mail_destinatario = "$email";



		// definisco il subject ed il body della mail

		$mail_oggetto = "Recupero Password CivicSense!";

		$mail_corpo = "Ciao, \n La tua nuova password è: ". $pass."";



		// aggiusto un po' le intestazioni della mail

		// E' in questa sezione che deve essere definito il mittente (From)

		// ed altri eventuali valori come Cc, Bcc, ReplyTo e X-Mailer

		$mail_headers = "From: " .  $nome_mittente . " <" .  $mail_mittente . ">\r\n";

		$mail_headers .= "Reply-To: " .  $mail_mittente . "\r\n";

		$mail_headers .= "X-Mailer: PHP/" . phpversion();

		//SE LA EMAIL VIENE INVIATA SENZA PROBLEMI, AGGIORNO LA PASSWORD VECCHIA CON QUELLA NUOVA

		if (mail($mail_destinatario, $mail_oggetto, $mail_corpo, $mail_headers)){

  			header ("Location: successful_password.php");

			

		}else{

 		 echo "Errore. Nessun messaggio inviato.";

		}

}



?>