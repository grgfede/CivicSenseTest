
<?php
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['admin_name'])) {
header('Location: index.html');
}

$info_segnalazione = mysqli_query($connect,"select * from segnalazione where stato='In lavorazione' and squadra_risoluzione='".$_SESSION['admin_name']."'");
$segnalazione = mysqli_fetch_array($info_segnalazione);

$allegati_segnalazione = mysqli_query($connect,"select * from allegati where cdt=".$segnalazione['cdt']);
$num_allegati = mysqli_num_rows($allegati_segnalazione);
?>

<script type="text/javascript">
	function risolvi_segnalazione(cdt){
		var form = document.createElement("form");
    	document.body.appendChild(form);
    	form.method = "POST";
    	form.action = "php/risolvi_segnalazione.php";
    	var f_cdt = document.createElement("input");
    	f_cdt.type="hidden";
    	f_cdt.name = "cdt";
    	f_cdt.value = cdt;
    	form.appendChild(f_cdt);
        form.submit();
	}
</script>
    <div class="container-fluid">
		<div class="row"><div class="col-12"><h1>Dashboard</h1><hr></div></div>
		<div class="row">
			<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
				<div class="card h-100">
					<div class="card-header"><i class="fa fa-info-circle"></i>&nbsp;Dettagli segnalazione</div>

					<?if (isset($segnalazione)){?>

					<div class="card-body">
						<div class="row mb-3">
							<div class="col-9 col-sm-9 col-md-9 col-xl-9">
								<h5 class="panel-title"><?echo utf8_encode($segnalazione['nome_evento']);?></h5>
							</div>
							<div class="col-3 col-sm-3 col-md-3 col-xl-3">
								<div class="d-flex mr-3 rounded-circle w-30 h-30 gravita" id="gravita"></div>
							</div>
						</div>
            <div class="row mb-3">
              <div class="col-12 col-sm-6 col-md-6 col-xl-6">
                <b>Categoria: </b><?echo utf8_encode($segnalazione['categoria']);?>
              </div>
              <div class="col-12 col-sm-6 col-md-6 col-xl-6">
                <b>Data creazione: </b><?echo date("d-m-Y", strtotime($segnalazione['data_creazione']));?>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-12 col-sm-6 col-md-6 col-xl-6">
                <b>Citt&agrave: </b><?echo utf8_encode($segnalazione['citta']);?>
              </div>
              <div class="col-12 col-sm-6 col-md-6 col-xl-6">
                <b>Indirizzo: </b><?echo utf8_encode($segnalazione['indirizzo']);?>
              </div>
            </div>
						<div class="row mb-3">
							<div class="col-12">
							<p class="mb-3"><b>Descrizione</b></p>
								<textarea class="form-control" style="min-height: 150px;" readonly><?echo utf8_encode($segnalazione['descrizione']);?></textarea>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-6">
                <? if($num_allegati >0 ){ ?>
								<button type="button" class="btn btn-dark float-left" data-toggle="modal" data-target="#ModalGallery">Vedi allegati</button>
              <? } else { ?>
                <button type="button" class="btn btn-secondary float-left" disabled>Nessun allegato</button>
              <? } ?>
							</div>
							<div class="col-6">
								<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#ModalReportResolution">Segna come Risolta</button>
							</div>
						</div>
					</div>

					<?}else{	?>
						<div class="card-body d-flex align-items-center">
                <p class="w-100 text-center">Nessuna segnalazione assegnata</p>
            </div>
            <div class="card-footer small text-muted mt-auto" id="date">
              <script>
              data = new Date();
              ora =data.getHours();
              minuti=data.getMinutes();
              secondi=data.getSeconds();
              if(minuti < 10) minuti="0"+minuti;
              if(secondi < 10) secondi="0"+secondi;
              if(ora <10) ora="0"+ora;
              document.getElementById("date").innerHTML= "Ultimo aggiornamento oggi alle "+ora+":"+minuti+":"+secondi;
            </script>
            </div>
					<?	}	?>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
				<div class="card h-100">
					<div class="card-header"><i class="fa fa-map"></i>&nbsp;Luogo della segnalazione</div>
						<div class="map" id="map"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 mb-3">
				<div class="card">
					<div class="card-header"><i class="fa fa-check"></i>&nbsp;Segnalazioni completate</div>
					<div class="card-body">
						<div class="row">
							<div class="col-12">
	<!--tabella delle segnalazioni risolte dalla squadra-->
    <div class="table-responsive">
            <table class="table table-bordered dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>CDT</th>
                  <th>Nome Segnalazione</th>
                  <th>Citt&agrave</th>
                  <th>Data Risoluzione</th>
                </tr>
              </thead>
              <tbody>
<?php
  // query che prende tutte le segnalazioni completate dalla squadra
	  $segnalazioni_in_lavorazione = mysqli_query($connect,"Select * from segnalazione where squadra_risoluzione='".$_SESSION['admin_name']."' and stato='Risolta'");
    $count=1;
    while($segnalazione_in_lavorazione=mysqli_fetch_array($segnalazioni_in_lavorazione)){
      echo '<tr><td>'.$count++.'</td>';
      echo '<td>'.$segnalazione_in_lavorazione['cdt'].'</td>';
      echo '<td><a href="detailTicket.php?id='.$segnalazione_in_lavorazione['cdt'].'">'.$segnalazione_in_lavorazione['nome_evento'].'</a></td>';
      echo "<td>".$segnalazione_in_lavorazione['citta']."</td>";
      $data_completamento = $segnalazione_in_lavorazione['data_completamento'];
      $data_completamento = date("d-m-Y", strtotime($data_completamento));
      echo "<td>".$data_completamento."</td>";
      echo "</tr>";
} ?>

              </tbody>
            </table>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>

<!-- MODAL PER L'ASSEGNAMENTO DELLE SEGNALAZIONE ALLA SQUADRA DI RISOLUZIONE-->
<div class="modal fade" id="ModalReportResolution" tabindex="-1" role="dialog" aria-labelledby="modalResolutionLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">
<h5 class="modal-title" id="modalResoulutionLabel" style="position: relative">Confermi la risoluzione della segnalazione?</h5>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" id="undo" type="button" data-dismiss="modal">Annulla</button>
        <button class="btn btn-primary" id="assign" type="button" onclick="risolvi_segnalazione(<? echo $segnalazione['cdt'];?>)">Conferma risoluzione</button>
      </div>

    </div>

  </div>

</div>

<!-- MODAL PER A VISUALIZZAZIONE DELLA GALLERIA DEGLI ALLEGATI-->
<div class="modal fade" id="ModalGallery" tabindex="-1" role="dialog" aria-labelledby="modalGalleryLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="modalGalleryLabel" style="position: relative">Allegati</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <? 
      for($i=0;$i<$num_allegati;++$i){?>
        <li data-target="#carouselExampleIndicators" data-slide-to="<?echo $i;?>" <?if($i==0){echo "class=\"active\"";}?>></li>
     <? } ?>
  </ol>
  <div class="carousel-inner">
    <? $j=0 ?>
    <? while($allegato = mysqli_fetch_array($allegati_segnalazione)){?>
      <div class="carousel-item <?if($j==0){echo "active";}?>">
        <img class="d-block w-100" style="max-height:300px" src="data:image/jpeg;base64,<?echo $allegato['allegato'];?>">
      </div>
    <? 
      ++$j;
      } ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
      </div>
    </div>
  </div>
</div>
<!--SCRIPT PER FAR PARTIRE IL CAROUSEL-->
<script>
$(document).ready(function(){
$('.carousel').carousel({
interval: 4000
});
});
</script>

    <!--SCRIPT JAVASCRIPT PER LA CREAZIONE DELLA MAPPA-->
  <script>
    function initMap() {

      <?if (isset($segnalazione)){?>
    var uluru = {lat: <?php echo $segnalazione['latitudine'];?>, lng: <?php echo $segnalazione['longitudine']; ?>};
        /* Creo mappa che centra la residenza "uluru" */
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 18,
      center: uluru
    });
     /* Creo il marker della segnalazione*/
    var marker = new google.maps.Marker({
        position:{lat:<? echo $segnalazione['latitudine']?>,lng:<? echo$segnalazione['longitudine']?>},
        map:map});
    var contentString =
    		'<div id="content">'+
    		'<div id="siteNotice"></div>'+
            '<h3 id="firstHeading" class="firstHeading">'+
            '<a href="detailTicket.php?id=<?echo $segnalazione['cdt']?>"><?echo $segnalazione['nome_evento']?></a>'+
            '</h3>'+
            '<div id="bodyContent">'+
            '<p><b>Descrizione: </b>&nbsp<?echo$segnalazione['descrizione']?></p>'+
            '<p><b>Data creazione: </b>&nbsp<?echo date("d-m-Y", strtotime($segnalazione['data_creazione']));?></p>'+
            '</div></div>';

    var infowindow = new google.maps.InfoWindow({
          content: contentString});

    /*marker.addListener('click',function() {
        infowindow.open(map, marker);});*/
<? } else{ ?>
	var uluru = {lat: -34.397, lng: 150.644};
	    /* Creo mappa che centra la residenza "uluru" */
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 18,
      center: uluru,
      disableDefaultUI: true
    });
    map.setCenter(uluru);
    var infoWindow = new google.maps.InfoWindow();
	infoWindow.setPosition(uluru);
	infoWindow.setContent('<h3 class="text-center panel-title">Nessuna nuova segnalazione</h3>');
	infoWindow.open(map);
	 <? } ?>
    }
    </script>
    <!--RICHIAMO LE API DI GOOGLE PER LA CREAZIONE DELLA MAPPA-->
    <script async defer
    src= "https://maps.googleapis.com/maps/api/js?key=AIzaSyBNEuVJiKb4mSWwfqRYsCArxJWrv7il68w&callback=initMap">
    </script>
    <script type="text/javascript">
      <? $link = (isset($segnalazione))? "detailTicket.php?id=".$segnalazione['cdt']."": "#";?>
      document.getElementById("detailTicketLink").href="<?echo $link?>";
    </script>
    <? if(isset($segnalazione)){?>
    <script type="text/javascript">
      document.getElementById("gravita").style.backgroundImage = "url('"+get_gravita(<? echo $segnalazione['gravita'];?>)+"')";
    </script>
    <!--SCRIPT PER MODIFICARE LINK PER DETTAGLIO SEGNALAZIONE-->
    <script type="text/javascript">
        function detail(){
          var cdt = <?echo$segnalazione['cdt'];?>;

          window.location = (cdt != "")? "detailTicket?id="+cdt:"#";
        }
    </script>
    <?}?>
