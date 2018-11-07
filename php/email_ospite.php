<?php

session_start();

$email = $_POST['email_ospite'];

// definisco mittente e destinatario della mail
		$nome_mittente = "Civic Sense";
		$mail_mittente = "civicsense@altervista.org";
		$mail_destinatario = "$email";

		// definisco il subject ed il body della mail
		$mail_oggetto = "Ticket inserito con successo!";
		$mail_corpo = "Ciao, Ospite. \n La sua richiesta di apertura ticket è stata caricata con successo. Il suo ticket ha identificativo: ". $_SESSION['last_cdt'] ."";

		// aggiusto un po' le intestazioni della mail
		// E' in questa sezione che deve essere definito il mittente (From)
		// ed altri eventuali valori come Cc, Bcc, ReplyTo e X-Mailer
		$mail_headers = "From: " .  $nome_mittente . " <" .  $mail_mittente . ">\r\n";
		$mail_headers .= "Reply-To: " .  $mail_mittente . "\r\n";
		$mail_headers .= "X-Mailer: PHP/" . phpversion();

		if (mail($mail_destinatario, $mail_oggetto, $mail_corpo, $mail_headers))
  			header ("Location: ../index.php");
		else
 		 echo "Errore. Nessun messaggio inviato.";
		
?>