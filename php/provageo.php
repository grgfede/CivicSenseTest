<?
			$latitudine = $_GET['lat'];
			$longitudine = $_GET['lon'];

			$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$latitudine,$longitudine&key=AIzaSyBNEuVJiKb4mSWwfqRYsCArxJWrv7il68w";
			$pickup_data = file_get_contents($url);
			$pickup_result = json_decode($pickup_data, true);

			$citta = $pickup_result['results'][0]['address_components'][ 'administrative_area_level_3'];
			$indirizzo = $pickup_result['results'][0]['formatted_address'];

		echo "citta:" . $citta . "\n| Indirizzo: " . $indirizzo . "\n| Latitudine" . $latitudine . "\n|Longitudine:" . $longitudine;
?>