<?
include "dbconnection_session.php";

$ente = $_POST['ente'];
$cdt = $_POST['cdt'];
$squadra = $_POST['squadra'];
$email = "";

$data_presa_carico = date("Y-m-d");
mysqli_query($connect,"update segnalazione set ente='$ente', squadra_risoluzione='$squadra', data_presa_carico = '$data_presa_carico', stato='In lavorazione' where cdt=$cdt") or die("assegnamento della segnalazione non riuscito");
mysqli_query($connect,"update squadra_risoluzione set occupata=1 where id_squadra='$squadra'") or die("non ho aggiornato lo stato di occupazione della squadra");

$mysqlNomeSegnalazione = "Select * from segnalazione where cdt = ".$cdt;
$sqlNomeEsegui = mysqli_query($connect, $mysqlNomeSegnalazione);
$infoSegnalazione = mysqli_fetch_array($sqlNomeEsegui);
$nome_segnalazione = $infoSegnalazione['nome_evento'];



$queryMail ="select seguono.id_cittadino, cittadino.email from cittadino inner join (select * from crea_segue where cdt = $cdt) as seguono on cittadino.id_cittadino = seguono.id_cittadino";
$queryEsegui = mysqli_query($connect, $queryMail);
$rigaEmail = mysqli_num_rows($queryEsegui);
if ($rigaEmail>0){
  while ($cicle = mysqli_fetch_array($queryEsegui)){
    $email = $cicle['email'];
    invioEmail($email, $cdt, $nome_segnalazione);
  }

}



function invioEmail($email, $cdt, $nomeEvento){
    // definisco mittente e destinatario della mail
    $nome_mittente = "CivicSense";
    $mail_mittente = "civicsense2018@altervista.org";
    $mail_destinatario = "$email";

    // definisco il subject ed il body della mail
    $mail_oggetto = "Una segnalazione che segui è stata presa in carico";
    $mail_corpo = "La segnalazione ". $nomeEvento . " è stata presa in carico!";
    //echo $email;
    // aggiusto un po' le intestazioni della mail
    // E' in questa sezione che deve essere definito il mittente (From)
    // ed altri eventuali valori come Cc, Bcc, ReplyTo e X-Mailer
    $mail_headers = "From: " .  $nome_mittente . " <" .  $mail_mittente . ">\r\n";
    $mail_headers .= "Reply-To: " .  $mail_mittente . "\r\n";
    $mail_headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($mail_destinatario, $mail_oggetto, $mail_corpo, $mail_headers)){
      echo "Messaggio inviato con successo a " . $mail_destinatario;
      echo $cdt;
    }else{
      echo "KTM";
    }
}



header("location:/index.php");
?>
