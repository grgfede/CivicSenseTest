<?
include "dbconnection_session.php";

$ente = $_POST['ente'];
$cdt = $_POST['cdt'];

mysqli_query($connect,"insert into segnalazioni_rifiutate values('$ente','$cdt')") or die("rimozione della segnalazione non riuscito");
header("location:/index.php");

?>