<!--
	#################################################################################
	#		REGOLE PER UNA BUONA PERMANENZA DI GRUPPO								#
	#	1 Se scrivi del nuovo codice, COMMENTA QUELLO CHE FAI						#
	#	2 Modifichi del codice? COMMENTA LA MODIFICA								#
	#	3 Modifichi del codice e non funziona? RIMETTI TUTTO A POSTO				#
	#	4 Hai dubbi su qualche parte del codice? NON METTERE MANI					#
	#	5 CERCA DI COMMENTARE CODICE CHE APPARE COMPLICATO AL RESTO DEL GRUPPO		#
	#################################################################################
-->

<?php
 session_start();
 session_destroy(); 
 header("Location: index.php");
 exit();
?>