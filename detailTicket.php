<!--
	#################################################################################
	#		REGOLE PER UNA BUONA PERMANENZA DI GRUPPO								#
	#	1 Se scrivi del nuovo codice, COMMENTA QUELLO CHE FAI						#
	#	2 Modifichi del codice? COMMENTA LA MODIFICA								#
	#	3 Modifichi del codice e non funziona? RIMETTI TUTTO A POSTO				#
	#	4 Hai dubbi su qualche parte del codice? NON METTERE MANI					#
	#	5 CERCA DI COMMENTARE CODICE CHE APPARE COMPLICATO AL RESTO DEL GRUPPO		#
	#																				#
	#  Chi infrange le regole siamo obbligati a dare della puttana alla madre		#
	#  Buon lavoro :)																#
	#################################################################################
-->




<?php

// Inialize session
include "php/dbconnection_session.php";
	//mysql_set_charset('utf8', $db_connection);
	$id = $_GET['id'];
  $_SESSION['id'] = $id;

	$query = mysqli_query($connect,"SELECT * FROM segnalazione WHERE cdt = '$id'");
	$array = mysqli_fetch_array($query);		//CONTIENE LE INFORMAZIONI DELLA SEGNALAZIONE
	$righe_res = mysqli_num_rows($query);

	$nome = $_SESSION['admin_name'];
	$eseguiPreferito = mysqli_query($connect,"Select * from crea_segue where id_cittadino = '$nome' and cdt = '$id'");
	$riga = mysqli_num_rows($eseguiPreferito);

	$gravita = $array['gravita'];
?>


<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Civic Sense - Dettaglio segnalazione</title>
  <!-- Latest compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <link href="css/textarea.css" rel="stylesheet">

  <link href="css/gravita.css" rel="stylesheet">

<script>
	function unfollow(cdt, nome){
		var form = document.createElement("form");
		document.body.appendChild(form);
    form.method = "POST";
    form.action = "php/unfollow.php";
    var f_cdt = document.createElement("input");
    f_cdt.type="hidden";
    f_cdt.name = "cdt";
    f_cdt.value = cdt;
    form.appendChild(f_cdt);
    var f_nome = document.createElement("input");
    f_nome.type="hidden";
    f_nome.name = "nome";
    f_nome.value = nome;
    form.appendChild(f_nome);
		form.submit();
	}

	function follow(cdt, nome){
		var form = document.createElement("form");
		document.body.appendChild(form);
    form.method = "POST";
    form.action = "php/follow.php";
    var f_cdt = document.createElement("input");
    f_cdt.type="hidden";
    f_cdt.name = "cdt";
    f_cdt.value = cdt;
    form.appendChild(f_cdt);
    var f_nome = document.createElement("input");
    f_nome.type="hidden";
    f_nome.name = "nome";
    f_nome.value = nome;
    form.appendChild(f_nome);
		form.submit();
	}
</script>


</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<!-- Navigation-->
  <? include "navbar.php";?>
	<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/index.php">Dashboard</a>
        </li>
        <? if ($_SESSION['tipo'] == 1) {?><li class="breadcrumb-item"><a href="myTickets.php">Le tue segnalazioni</a><?}?></li>
	<li class="breadcrumb-item active"><?php echo $array['nome_evento']; ?></li>
      </ol>
		<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-11 ">
      			<h3 class="panel-title"> Titolo:
								<?php
									if($righe_res == 0){
										echo "ERRORE, TICKET NON TROVATO";
									} else {
										echo $array['nome_evento'];
									}
								?>
      				</h3>
						</div>
          <? if ($_SESSION['tipo'] == 1){ ?>
          	<div class="col-1">
							<? if ($riga > 0){?>
								<button class="float-right" onclick="unfollow(<? echo $id; ?>, '<? echo $nome;?>')" style="border:none; background: none"><i class="fa fa-star fa-2x" style="color:yellow"></i></button>
							<?} else {?>
								<button class="float-right" onclick="follow(<? echo $id; ?>, '<? echo $nome;?>')" style="border:none; background: none"><i class="fa fa-star-o fa-2x" style="color:black"></i></button>
								<?}?>
							</div>
              <?}?>
						</div>
					</div>
			<div class="card-body">
        <div class="row">
          <div class="col-xl-2 col-sm-2 md-6">
							<h4 class="text-center">Gravit&agrave;:</h4>
					</div>
					<div class="col-xl-6 col-sm-6 md-6">
						<div class="d-flex mr-3 rounded-circle w-30 h-30 gravita" id="gravita"></div>
          </div>
          <div class="col-xl-4 col-sm-4 md-4">
						<div class="row">
                 <b>Data creazione:&nbsp; </b>
                    <?php
                      if($righe_res == 0){
                        $newDate = "";
                      } else {
                        //CONVERTE DATA DA YYYY-MM-GG a GG-MM-YYYY
                        $originalDate = $array['data_creazione'];
                        $newDate = date("d-m-Y", strtotime($originalDate));
                      }
                      echo $newDate;
                ?>
						</div>
						<div class="row">
                	<b>Citt&agrave:&nbsp; </b><?php echo $array['citta']; ?>
						</div>
						<div class="row">
                  <b>Indirizzo:&nbsp; </b> <?php echo $array['indirizzo']; ?>
						</div>
						<div class="row">
                  <b>Categoria:&nbsp; </b> <?php echo utf8_encode($array['categoria']); ?>
						</div>
          </div>
        </div>


				<div class="row">
					<div class="col">
						<h2>Descrizione</h2>

						<textarea class="mb-3 form-control" readonly> <?php echo $array['descrizione']; ?></textarea>
					</div>
				</div>

			<?php
			$queryImg = mysqli_query($connect,"Select * from allegati where cdt = '$id'");
			$righeImg = mysqli_num_rows($queryImg);
				//CONTROLLO SE CI SONO ALLEGATI ASSOCIATI ALLA SEGNALAZIONE
				if ($righeImg != 0) {?>
				<div class="row">
					<div class="col">
							<h2>Allegati</h2>
						</div>
					</div>
					<div class="row">
						<div class="col">

							<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			  			<ol class="carousel-indicators">
			    <? for($i=0;$i<$righeImg;++$i){?>
			        <li data-target="#carouselExampleIndicators" data-slide-to="<?echo $i;?>" <?if($i==0){echo "class=\"active\"";}?>></li>
			     <? } ?>
			  </ol>
			  <div class="carousel-inner">
			    <? $j=0 ?>
			    <? while($allegato = mysqli_fetch_array($queryImg)){?>
			      <div class="carousel-item bg-dark card <?if($j==0){echo "active";}?>">
			        <img class="d-block h-100 mx-auto" style="max-height: 300px;" src="data:image/jpeg;base64,<?echo $allegato['allegato'];?>">
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


					<? } ?>
		</div><!--CARD BODY-->
    <?
      if ($_SESSION['tipo'] == 2){?>
		<div class="card-footer">
			<!--<a href="mailto:<? echo $email; ?>" data-original-title="Invia un messaggio privato" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-envelope"></i></a>-->
          <span class="pull-right">
    			<a href="editTicket.php" data-original-title="Modifica Segnalazione" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i></a>

      <!--<a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-remove"></i></a>-->
			</span>
		</div>
    <?}?>
</div>
</div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
<? include 'footer.php';?>
</div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <script src="js/gravita.js"></script>
    <!--SCRIPT PER PATH GRAVITA-->
        <? if(isset($array)){?>
    <script type="text/javascript">
      document.getElementById("gravita").style.backgroundImage = "url('"+get_gravita(<? echo $gravita;?>)+"')";
    </script>
    <?}?>
</body>

</html>
