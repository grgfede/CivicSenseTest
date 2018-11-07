    	if (navigator.geolocation) {
	navigator.geolocation.getCurrentPosition(
			mostraPosizione,
			gestisciErrore,
			{
				enableHighAccuracy: true,
				maximumAge: 60000
			});
}else{
  alert('La geo-localizzazione non è possibile');
}

var lat = null;
var lon = null;

function mostraPosizione(position) {
  lat = position.coords.latitude;
  lon = position.coords.longitude;
}

function gestisciErrore(error) {
	switch(error.code) { 
		case error.PERMISSION_DENIED:
			alert("Per poter creare una segnalazione è consigliabile \nautorizzare Civicsense ad accedere alla tua posizione");
			break; 
		case error.POSITION_UNAVAILABLE:
			alert("Impossibile determinare la posizione corrente");
			break;
		/*case error.TIMEOUT:
			alert("Il rilevamento della posizione impiega troppo tempo");
			break;*/
		case error.UNKNOWN_ERROR:
			alert("Si è verificato un errore sconosciuto");
			break;
	}
}