    <!--
	#################################################################################
	#		REGOLE PER UNA BUONA PERMANENZA DI GRUPPO								                    #
	#	1 Se scrivi del nuovo codice, COMMENTA QUELLO CHE FAI			               			#
	#	2 Modifichi del codice? COMMENTA LA MODIFICA							                   	#
	#	3 Modifichi del codice e non funziona? RIMETTI TUTTO A POSTO	           			#
	#	4 Hai dubbi su qualche parte del codice? NON METTERE MANI		             			#
	#	5 CERCA DI COMMENTARE CODICE CHE APPARE COMPLICATO AL RESTO DEL GRUPPO	     	#
	#																			                                        	#
	#  Chi infrange le regole siamo obbligati a dare della puttana alla madre	    	#
	#  Buon lavoro :)											                                 					#
	#################################################################################
-->

<?php
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['admin_name'])) {
header('Location: index.html');
}
//query per visualizzare le segnalazioni non assegnate a nessun ente che si riferiscono alla categoria dell'ente loggato
$nuove_segnalazioni = mysqli_query($connect,"select * from segnalazione where ente IS NULL and categoria=(select categoria from ente where id_ente='".$_SESSION['admin_name']."') and segnalazione.cdt not in (select segnalazione from segnalazioni_rifiutate where ente='".$_SESSION['admin_name']."') order by data_creazione desc");
$num_nuove_segnalazioni = mysqli_num_rows($nuove_segnalazioni);
$elenco_squadre_disponibili = mysqli_query($connect,"select id_squadra,occupata from squadra_risoluzione where ente='".$_SESSION['admin_name']."'");
?>

 <?php
  // query che prende tutte le segnalazioni accettate dall'ente e che sono in lavorazione
  $segnalazioni_in_lavorazione = mysqli_query($connect,"Select * from segnalazione where ente='".$_SESSION['admin_name']."' and stato='In lavorazione' order by data_presa_carico desc");
    // query che prende tutte le segnalazioni risolte dalle squadre dell'ente
  $segnalazioni_risolte = mysqli_query($connect,"Select * from segnalazione where ente='".$_SESSION['admin_name']."' and stato='Risolta' order by data_completamento desc");
?>

<script type="text/javascript">
  //FUNZIONI CHE MEMORIZZANO IL CDT E LA SQUADRA PER ASSEGNARE LA SEGNALAZIONE
  var selected_cdt="";
  var selected_team="";
  function select_cdt(cdt) {
    selected_cdt = cdt;
}
  function select_team(team) {
    selected_team = team;
}
//FUNZIONE CHE SI PRENDE ENTE,CDT E SQUADRA DI RISOLUZIONE E CREA UN FORM PER L'ASSEGNAZIONE DELLA SEGNALAZIONE
  function assegna_segnalazione(ente,cdt,squadra){
    if(selected_team !=""){
      var form = document.createElement("form");
    document.body.appendChild(form);
    form.method = "POST";
    form.action = "php/assegna_segnalazione.php";
    var f_ente = document.createElement("input"); 
    f_ente.type="hidden";
    f_ente.name = "ente";
    f_ente.value = ente;
    form.appendChild(f_ente);
    var f_cdt = document.createElement("input"); 
    f_cdt.type="hidden";
    f_cdt.name = "cdt";
    f_cdt.value = cdt; 
    form.appendChild(f_cdt);
    var f_squadra = document.createElement("input"); 
    f_squadra.type="hidden";
    f_squadra.name = "squadra";
    f_squadra.value = squadra;
    form.appendChild(f_squadra);
    form.submit();
  }else{
    document.getElementById('teamModalLabel').style.color="red";
  }
  }
//FUNZIONE CHE PRENDE ENTE E CDT E CREA UN FORM CHE PERMETTE ALL'ENTE DI RIFIUTARE (QUINDI NON VISUALIZZARE) LE SEGNALAZIONI
  function rimuovi_segnalazione(ente,cdt){
    var form = document.createElement("form");
    document.body.appendChild(form);
    form.method = "POST";
    form.action = "php/rimuovi_segnalazione.php";
    var f_ente = document.createElement("input"); 
    f_ente.type="hidden";
    f_ente.name = "ente";
    f_ente.value = ente;
    form.appendChild(f_ente);
    var f_cdt = document.createElement("input"); 
    f_cdt.type="hidden";
    f_cdt.name = "cdt";
    f_cdt.value = cdt; 
    form.appendChild(f_cdt);
    form.submit();
  }
</script>

    <div class="container-fluid">
      <h1>Dashboard</h1>
      <hr>
      <div class="row">
      <!-- Icon Cards-->
      <div class="col-xl-6 col-sm-6 mb-3">
                  <!-- Example Notifications Card-->
          	<div class="card h-100" id="card-new-reports">
            <div class="card-header"><i class="fa fa-bell-o"></i>&nbspNuove segnalazioni</div>
            <?if ($num_nuove_segnalazioni > 0){?>
            <div class="list-group list-group-flush small">
              <?
              while($segnalazione = mysqli_fetch_array($nuove_segnalazioni)){
                $gravita = $segnalazione['gravita'];
                $gravita_colore;
                switch($gravita){
                  case 1:
                  $gravita_colore="green.png";
                  break;
                  case 2:
                  $gravita_colore="yellow.png";
                  break;
                  case 3:
                  $gravita_colore="red.png";
                  break;
                }
                ?>
              <div class="list-group-item list-group-item-action">
                <div class="media">
                  <div class="d-flex mr-3 rounded-circle w-30 h-30 gravita" style="background-image: url('images/icons/<?echo $gravita_colore?>');"></div>
                  <div class="media-body">
                    <button type="button" class="btn btn-secondary btn-sm" style="float:right;margin-left:10px;" onclick="rimuovi_segnalazione('<?echo $_SESSION["admin_name"]?>',<?echo $segnalazione['cdt']?>)">&nbspRifiuta&nbsp</button>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalResolutionTeam" style="float:right;" onclick="select_cdt(<?echo $segnalazione['cdt']?>)">Accetta</button>
                    <input type="hidden" name="cdt" value="<?echo $segnalazione['cdt'];?>"/>
                    <a href="detailTicket.php?id=<?echo $segnalazione['cdt']?>"><strong><?echo $segnalazione['nome_evento']?>&nbsp</strong></a>
                    <div class="text-muted smaller">Creato a <?echo $segnalazione['citta']?> il <?echo date("d-m-Y", strtotime($segnalazione['data_creazione']))?></div>
                  </div>
                </div>
              </div>
              <?
              }
              ?>
              <!--<a class="list-group-item list-group-item-action" href="#">View all activity...</a>-->
          </div>
          <?}else{?>
            <div class="card-body d-flex align-items-center">
                <p class="w-100 text-center">Nessuna nuova segnalazione</p>
            </div>
         <? }?>
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
          </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-3">
        <div class="card map" id="card-map">
		<div class=" card-header">
        	<i class="fa fa-map"></i>&nbsp; Mappa delle segnalazioni In lavorazione</div>
        <div id="map" class="map"></div>
    	</div>
    	</div>
	</div>
	<div class="row">
		<div class="col-xl-6 col-sm-6 mb-3">
		<div class="card">
		<div class="card-header">
        	<i class="fa fa-gears"></i>&nbsp; In Lavorazione</div>

		<!--Creazione tabella dei CDT in lavorazione-->
		<div class="table-responsive">
            <table class="table table-bordered dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nome Segnalazione</th>
                  <th>Data <span style="white-space: nowrap;">Presa in carico</span></th>
                  <th>Squadra</th>
                </tr>
              </thead>

              <tbody>

<?php

		$count = 1;  //VARIABILE PER CONTARE I TICKET NELLA TABELLA
		$nomeUtente = $_SESSION['admin_name'];

		$query = mysqli_query($connect,"SELECT * FROM segnalazione where (stato = 'In lavorazione' and ente='".$_SESSION['admin_name']."') order by data_presa_carico desc");

		while($segnalazione_in_lavorazione=mysqli_fetch_array($query)){
			echo '<tr><td><b>'.$count++.'</b></td>';
			echo '<td><a href="detailTicket.php?id='.$segnalazione_in_lavorazione['cdt'].'">'.$segnalazione_in_lavorazione['nome_evento'].'</a></td>';
			$data_presa_carico = $segnalazione_in_lavorazione['data_presa_carico'];
			$data_presa_carico = date("d-m-Y", strtotime($data_presa_carico));
			echo "<td>".$data_presa_carico."</td>";
			echo "<td>".$segnalazione_in_lavorazione['squadra_risoluzione']."</td>";
			echo "</tr>";
} ?>

              </tbody>
            </table>
          </div>
        </div>
	</div>

      <div class="col-xl-6 col-sm-6 mb-3">
    <div class="card">
    <div class="card-header">
          <i class="fa fa-check"></i>&nbsp; Risolte</div>

    <!--Creazione tabella dei CDT in lavorazione-->
    <div class="table-responsive">
            <table class="table table-bordered dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nome Segnalazione</th>
                  <th>Data risoluzione</th>
                  <th>Squadra</th>
                </tr>
              </thead>

              <tbody>

<?php

    $count = 1;  //VARIABILE PER CONTARE I TICKET NELLA TABELLA

    while($segnalazione_risolta=mysqli_fetch_array($segnalazioni_risolte)){
      echo '<tr><td><b>'.$count++.'</b></td>';
      echo '<td><a href="detailTicket.php?id='.$segnalazione_risolta['cdt'].'">'.$segnalazione_risolta['nome_evento'].'</a></td>';
      $data_risoluzione = $segnalazione_risolta['data_completamento'];
      $data_risoluzione = date("d-m-Y", strtotime($data_risoluzione));
      echo "<td>".$data_risoluzione."</td>";
			echo "<td>".$segnalazione_risolta['squadra_risoluzione']."</td>";
      echo "</tr>";
} ?>

              </tbody>
            </table>
          </div>
        </div>
  </div>

</div>

</div> <!-- Content fluid -->

<!-- MODAL PER L'ASSEGNAMENTO DELLE SEGNALAZIONE ALLA SQUADRA DI RISOLUZIONE-->
<div class="modal fade" id="ModalResolutionTeam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">
<h5 class="modal-title" id="teamModalLabel" style="position: relative">Scegli una squadra&nbsp*</h5>
      </div>

      <div class="list-group modal-body" id="mylist">
        <!--PHP PER LA RICERCA DELLE SQUADRE DISPONIBILI-->
        <? 
        while($squadra = mysqli_fetch_array($elenco_squadre_disponibili)){
          ?>
          <button class="list-group-item list-group-item-action" onclick="select_team('<?echo $squadra['id_squadra']?>')" data-toggle="list"<?if($squadra['occupata']){echo "disabled";}?>>
            <?echo $squadra['id_squadra']?>            
          </button>
        <? } ?>
      </div>

      <div class="modal-footer">
        <button class="btn btn-primary" id="assign" type="button" onclick="assegna_segnalazione('<?echo $_SESSION['admin_name']?>',selected_cdt,selected_team)">Assegna</button>
        <button class="btn btn-secondary" id="undo" type="button" data-dismiss="modal">Annulla</button>
      </div>

    </div>

  </div>

</div>

<!--ANIMAZIONE DI ERRORE SUL TESTO "SCEGLI UNA SQUADRA"-->
<script>
$( "#assign" ).on('click',function() {
  
  $( "#teamModalLabel" ).animate(
    {left: "+=2px",top:"-=1px"},100,"swing",
    function(){
    $( "#teamModalLabel" ).animate({ left: "-=4px",top:"+=2px"},100,"swing",function(){
    $( "#teamModalLabel" ).animate({ left: "+=2px",top:"-=1px" },100,"swing");});
    });
});

// AL CLICK DELL'ANNULLA IL COLORE DEL TESTO RITORNA COME ERA PRIMA
$("#undo").click(function(){
	document.getElementById("teamModalLabel").style.color = "inherit";
})
</script>

<!--SCRIPT JAVASCRIPT PER LA CREAZIONE DELLA MAPPA-->
  <script>
    function initMap() {

      /* creo una variabile posizione dell'Italia di default */
    var center_here = {lat: 41.3831064, lng: 13.3479757};

    /* Creo mappa che centra la residenza "uluru" */
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 6,
      center: center_here
    });

        /* Creo la lista di marker*/
    var marker =[];
    var contentString = [];
    var infowindow = [];
    
    //PARTE PHP PER CREARE L'OGGETTO MARKER
    <?php
    $j=0;
    while($segnalazione_in_lav = mysqli_fetch_array($segnalazioni_in_lavorazione)){

      // creo l'oggetto marker con relativa posizione e lo punto sulla mappa
        echo "marker[".$j."] = new google.maps.Marker({
        position:{lat:".$segnalazione_in_lav['latitudine'].",lng:".$segnalazione_in_lav['longitudine']."},
        map:map});\n";

      // creo il contenuto dell'infobox del marker
        echo 'contentString['.$j.'] ="<div id=\"content\">'.
            '<div id=\"siteNotice\">'.
            '</div>'.
            '<h3 id=\"firstHeading\" class=\"firstHeading\"><a href=\"detailTicket.php?id='.$segnalazione_in_lav["cdt"].'\">'.$segnalazione_in_lav["nome_evento"].'</a></h3>'.
            '<div id=\"bodyContent\">'.
            '<p><b>Presa in carico il: </b><br>'.date("d-m-Y", strtotime($segnalazione_in_lav["data_presa_carico"])).'</p>'.
            '<p><b>Squadra all\'opera: </b><br>'.$segnalazione_in_lav["squadra_risoluzione"].'</p>'.
            '</div></div>";';
        echo 'infowindow['.$j.'] = new google.maps.InfoWindow({
          content: contentString['.$j.']});';

         // creo la funzione listener per gestire il click sul marker
         echo "marker[".$j."].addListener('click', function() {infowindow[".$j."].open(map, marker[".$j."]);});\n";
      ++$j;
    }
    ?>
    }
    </script>

    <!--RICHIAMO LE API DI GOOGLE PER LA CREAZIONE DELLA MAPPA-->
    <script async defer
    src= "https://maps.googleapis.com/maps/api/js?key=AIzaSyBNEuVJiKb4mSWwfqRYsCArxJWrv7il68w&callback=initMap">
    </script>