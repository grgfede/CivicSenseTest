    <div class="container-fluid">
      <!-- Breadcrumbs
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
      </ol>-->
      <h1>Dashboard</h1>
      <hr>
      <!-- Icon Cards-->
      <div class="row">

  <!---INIZIO SCHEDA ROSSA--->
  <div class="col mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-comments"></i>
              </div>
              <div class="mr-5"><font size="2">Hai qualcosa da segnalare?</font></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="newTicket.php">
              <span class="float-left">Crea nuova segnalazione</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <!---FINE SCHEDA ROSSA--->
       <!---INIZIO SCHEDA GIALLA--->
	 <?php
		if ($_SESSION['tipo'] == 1)
  {
    //QUERY CHE TROVA IL NUMERO DI SEGNALAZIONI FATTE DAL RELATIVO CITTADINO
    $query = "SELECT * FROM crea_segue where id_cittadino = '$nome'";
    $risultato = mysqli_query($connect, $query);
    $righe = mysqli_num_rows($risultato);
  ?>
	<div class="col mb-3">
	  <div class="card text-white bg-warning o-hidden h-100">

            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
              </div>
              <div class="mr-5"><font size = 3px>Le mie segnalazioni:</font> <?php echo "$righe"; ?></div>
            </div>
    <?php if($righe == 0)
    {?>
    	<span class="card-footer text-white clearfix small z-1" href="#">
      <span class="float-left">Non hai tickets</span><?
    } else {?>
<a class="card-footer text-white clearfix small z-1" href="myTickets.php">
<span class="float-left">Vedi i dettagli</span>
<? }  ?> <!--//FINE SECONDO IF-->
    <span class="float-right">
    <i class="fa fa-angle-right"></i>
    </span></a>
    </div>
  </div>
<? }  ?> 
<!-- FINE SCHEDA GIALLA-->

	       <!---INIZIO SCHEDA VERDE-->
        <div class="col mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-bar-chart"></i>
              </div>
              <div class="mr-5">Statistiche</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="charts.php">
              <span class="float-left">Vedi le Statistiche</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <!--FINE SCHEDA VERDE--->


        <!---INIZIO SCHEDA BLU--->
        <div class="col mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-handshake-o"></i>
              </div>
              <div class="mr-5">Partners</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="partners.php">
              <span class="float-left">Vedi i nostri Partners</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
   </div> 
   <!--FINE SCHEDA BLU--->


<?php
 $residenza = $_SESSION['c_residenza'];
	//RICAVA LAT E LONG DELLA RESIDENZA
	$url = "https://maps.googleapis.com/maps/api/geocode/json?address=$residenza&key=AIzaSyBNEuVJiKb4mSWwfqRYsCArxJWrv7il68w";
	$pickup_data = file_get_contents($url);
	$pickup_result = json_decode($pickup_data, true);
	$latitudine =  $pickup_result['results'][0]['geometry']['location']['lat'];
	$longitudine = $pickup_result['results'][0]['geometry']['location']['lng'];


  // query che prende tutte le segnalazioni nella città di residenza del cittadino se registrato, altrimenti di Roma
	$queryMark = mysqli_query($connect,"Select * from segnalazione");
	$righeMark = mysqli_num_rows($queryMark);
	$segnalazioni = array();
	$i=0;
	while($cicleMark = mysqli_fetch_array($queryMark)){
    $segnalazioni[$i] = new Segnalazione($cicleMark['cdt'],$cicleMark['nome_evento'],$cicleMark['citta'],$cicleMark['indirizzo'],"",$cicleMark['gravita'],"",$cicleMark['descrizione'],$cicleMark['data_creazione'],$cicleMark['latitudine'],$cicleMark['longitudine']);
        $i++;
	}
?>

<div class="row">
  <div class="col-xl-12 col-sm-12 mb-3">
    <div id="map" class="map card"></div>
  </div>
</div>
    <script>
	  function initMap() {

	  	/* creo una variabile posizione della residenza del cittadino */
    var uluru = {lat: <?php echo $latitudine; ?>, lng: <?php echo $longitudine; ?>};

    /* Creo mappa che centra la residenza "uluru" */
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 6,
      center: uluru
    });

		var contentString ='<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading">' + <?php echo $oggettoMark; ?> + '</h1>'+
            '<div id="bodyContent">'+
            '<p><b>Descrizione: </b><br>' + 'DescrizioneMark' + '</p>'+
            '<p><b>Data creazione: </b><br>' + 'DataMark' + '</p>'+
            '</div>'+
            '</div>';


        /* Creo la posizione della segnalazione
		var posizione = {lat: <?php echo $lat; ?>, lng: <?php echo $lon; ?>};*/
		var marker =[];
		var contentString = [];
		var infowindow = [];
	<?php

	$j=0;
    foreach ($segnalazioni as $segnalazione) {

    	// creo l'oggetto marker con relativa posizione e lo punto sulla mappa
      	echo "marker[".$j."] = new google.maps.Marker({
        position:{lat:".$segnalazione->getLatitudine().",lng:".$segnalazione->getLongitudine()."},
        map:map});\n";

   		// creo il contenuto dell'infobox del marker
        echo 'contentString['.$j.'] ="<div id=\"content\">'.
            '<div id=\"siteNotice\">'.
            '</div>'.
            '<h3 id=\"firstHeading\" class=\"firstHeading\"><a href=\"detailTicket.php?id='.$segnalazione->getCdt().'\">'.$segnalazione->getNomeEvento().'</a></h3>'.
            '<div id=\"bodyContent\">'.
            '<p><b>Descrizione: </b><br>'.$segnalazione->getDescrizione().'</p>'.
            '<p><b>Data creazione: </b><br>'.$segnalazione->getDataCreazione().'</p>'.
            '</div></div>";';
        echo 'infowindow['.$j.'] = new google.maps.InfoWindow({
          content: contentString['.$j.']});';

         // creo la funzione listener per gestire il click sul marker
         echo "marker[".$j."].addListener('click', function() {
        infowindow[".$j."].open(map, marker[".$j."]);});\n";
      $j++;
    }
    ?>

	  }
    </script>
    <script async defer
    src= "https://maps.googleapis.com/maps/api/js?key=AIzaSyBNEuVJiKb4mSWwfqRYsCArxJWrv7il68w&callback=initMap">
    </script>



<!--<?php
	/*MI RICAVO LATITUDINE E LONGITUDINE DA SCRIPT JS E LE SALVO IN VARIABILI PHP*/
	$latitudine = $_COOKIE['latitudine'];
	$longitudine = $_COOKIE['longitudine'];
	echo "Latitudine\r\n".$latitudine;
	echo "Longitudine".$longitudine;
?>-->

    <!-- /.container-fluid-->
	</div>
