<?php
include "dbconnection_session.php";
$nome_utente = $_SESSION['admin_name'];
$last_cdt=$_SESSION['last_cdt'];
if(mysqli_query($connect,"update crea_segue set notifica = 1 where (id_cittadino='$nome_utente' and cdt = $last_cdt) ")){
	?>
	<script type="text/javascript">
		//alert("Complimenti! Ora riceverai le notifiche sulla tua segnalazione.");
		window.location.replace('../index.php');
	</script>
<? 
}

?>
