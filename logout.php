<!--
	#################################################################################
	#		REGOLE PER UNA BUONA PERMANENZA DI GRUPPO			#
	#	1 Se scrivi del nuovo codice, COMMENTA QUELLO CHE FAI			#
	#	2 Modifichi del codice? COMMENTA LA MODIFICA				#
	#	3 Modifichi del codice e non funziona? RIMETTI TUTTO A POSTO		#
	#	4 Hai dubbi su qualche parte del codice? NON METTERE MANI		#
	#	5 CERCA DI COMMENTARE CODICE CHE APPARE COMPLICATO AL RESTO DEL GRUPPO	#
	#										#
	#  Chi infrange le regole siamo obbligati a dare della puttana alla madre	#
	#  Buon lavoro :)								#
	#################################################################################
--!>



<?php
 session_start();
 
 session_destroy();
 
 setcookie("member_login","", time() - (86400  * 10));
 setcookie("member_password","", time() - (86400  * 10));
 
 header("Location: index.php");
 exit();
?>