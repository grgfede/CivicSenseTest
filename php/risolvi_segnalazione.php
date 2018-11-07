<?

include 'dbconnection_session.php';
//DATA ODIERNA PER SETTARE LA DATA DI COMPLETAMENTO
$data_fine = date ("Y-m-d");
$email = "";
$cdt = $_POST['cdt'];
$squadra = $_SESSION['admin_name'];

//QUERY CHE PRENDE LE EMAIL DEI CITTADINI CHE SEGUONO UNA DETERMINATA SEGNALAZIONE
$queryMail ="select seguono.id_cittadino, cittadino.email from cittadino inner join (select * from crea_segue where cdt = $cdt) as seguono on cittadino.id_cittadino = seguono.id_cittadino";
$queryEsegui = mysqli_query($connect, $queryMail);
$rigaEmail = mysqli_num_rows($queryEsegui);

//QUERY CHE PRENDE LA EMAIL DELL'ENTE DA AVVISARE
$queryEnte = "select * from squadra_risoluzione where id_squadra = '$squadra'";
$eseguiEnte = mysqli_query($connect, $queryEnte);
$arrayEnte = mysqli_fetch_array($eseguiEnte);
$nomeEnte = $arrayEnte['ente'];

$queryEmailEnte = "select * from ente where id_ente = '$nomeEnte'";
$eseguiEmailEnte = mysqli_query($connect, $queryEmailEnte);
$infoEmail = mysqli_fetch_array($eseguiEmailEnte);
$emailEnte = $infoEmail['email'];
echo $squadra;



$mysqlNomeSegnalazione = "Select * from segnalazione where cdt = ".$cdt;
$sqlNomeEsegui = mysqli_query($connect, $mysqlNomeSegnalazione);
$infoSegnalazione = mysqli_fetch_array($sqlNomeEsegui);
$nome_segnalazione = $infoSegnalazione['nome_evento'];

$queryUpdateSegnalazione = "update segnalazione set data_completamento = '$data_fine', stato='Risolta' where cdt=".$_POST['cdt']."";
$eseguiUpdateSegnalazione = mysqli_query($connect, $queryUpdateSegnalazione) or die ("Errore Segnalazione");

$queryUpdateSquadra = "update squadra_risoluzione set occupata=0 where id_squadra='".$_SESSION['admin_name']."'";
$eseguiUpdateSquadra = mysqli_query($connect, $queryUpdateSquadra) or die ("Errore Squadra");


//INVIO EMAIL PER AVVISARE I CITTADINI
if (($eseguiUpdateSegnalazione) && ($eseguiUpdateSquadra)){
  if($rigaEmail > 0){
    while ($cicle = mysqli_fetch_array($queryEsegui)){
      $email = $cicle['email'];
      invioEmail($email, $cdt, $nome_segnalazione);
    }
  }
}
invioEmailEnte($emailEnte, $cdt, $nome_segnalazione, $squadra);


function invioEmail($email, $cdt, $nomeEvento){
    // definisco mittente e destinatario della mail
    $nome_mittente = "CivicSense";
    $mail_mittente = "civicsense2018@altervista.org";
    $mail_destinatario = "$email";

    // definisco il subject ed il body della mail
    $mail_oggetto = "Una segnalazione che segui è stata conclusa";
    $mail_corpo = "La segnalazione ". $nomeEvento . " è stata conclusa! \n";
    $mail_corpo = $mail_corpo . "La segnalazione è: www.civicsense2018.altervista.org/detailTicket.php?id=". $cdt;
    //echo $email;
    // aggiusto un po' le intestazioni della mail
    // E' in questa sezione che deve essere definito il mittente (From)
    // ed altri eventuali valori come Cc, Bcc, ReplyTo e X-Mailer
    $mail_headers = "From: " .  $nome_mittente . " <" .  $mail_mittente . ">\r\n";
    $mail_headers .= "Reply-To: " .  $mail_mittente . "\r\n";
    $mail_headers .= "X-Mailer: PHP/" . phpversion();

    mail($mail_destinatario, $mail_oggetto, $mail_corpo, $mail_headers);

}


function invioEmailEnte($emailEnte, $cdt, $nomeEvento, $id_squadra){
    // definisco mittente e destinatario della mail
    $nome_mittente = "CivicSense";
    $mail_mittente = "civicsense2018@altervista.org";
    $mail_destinatario = "$emailEnte";

    // definisco il subject ed il body della mail
    $mail_oggetto = "La squadra ".$id_squadra." ha concluso una segnalazione";
    $mail_corpo = "La segnalazione ". $nomeEvento . " è stata conclusa dalla squadra di risoluzione: ".$id_squadra . "\n";
    $mail_corpo = $mail_corpo . "La segnalazione è: www.civicsense2018.altervista.org/detailTicket.php?id=". $cdt;
    echo $email;
    // aggiusto un po' le intestazioni della mail
    // E' in questa sezione che deve essere definito il mittente (From)
    // ed altri eventuali valori come Cc, Bcc, ReplyTo e X-Mailer
    $mail_headers = "From: " .  $nome_mittente . " <" .  $mail_mittente . ">\r\n";
    $mail_headers .= "Reply-To: " .  $mail_mittente . "\r\n";
    $mail_headers .= "X-Mailer: PHP/" . phpversion();

    mail($mail_destinatario, $mail_oggetto, $mail_corpo, $mail_headers);

}


header("location:/index.php");

?>
