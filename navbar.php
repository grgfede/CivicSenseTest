<?switch($_SESSION['tipo']){
	case 2:
	include "php/navbar/navbarEnte.php";
	break;
	case 3:
	include "php/navbar/navbarSquadra.php";
	break;
	default:
	include "php/navbar/navbarCittadino.php";
}
?>