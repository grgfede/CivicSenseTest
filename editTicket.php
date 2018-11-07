<!--
	#################################################################################
	#		REGOLE PER UNA BUONA PERMANENZA DI GRUPPO								                    #
	#	1 Se scrivi del nuovo codice, COMMENTA QUELLO CHE FAI				              		#
	#	2 Modifichi del codice? COMMENTA LA MODIFICA							                  	#
	#	3 Modifichi del codice e non funziona? RIMETTI TUTTO A POSTO		           		#
	#	4 Hai dubbi su qualche parte del codice? NON METTERE MANI				            	#
	#	5 CERCA DI COMMENTARE CODICE CHE APPARE COMPLICATO AL RESTO DEL GRUPPO		    #
	#################################################################################
-->

<?php

include "php/dbconnection_session.php";

//SE NON SEI UN ENTE NON SEI AUTORIZZATO
if($_SESSION['tipo'] != 2){?>
  <script>
      window.location.replace("index.php");
  </script>
  <?}
$id_cdt = $_SESSION['id'];

$sqlResume = "SELECT * FROM segnalazione where cdt = $id_cdt";
$sqlResumeEsegui = mysqli_query($connect, $sqlResume);
$riga = mysqli_num_rows($sqlResumeEsegui);
$array = mysqli_fetch_array($sqlResumeEsegui);

$sqlCategorie = "select * from categoria";
$categorieEsegui = mysqli_query($connect, $sqlCategorie);

$nome_evento = $array['nome_evento'];
$_SESSION['titolo'] = $nome_evento;
$gravita = $array['gravita'];
$_SESSION['gravita'] = $gravita;
$descrizione = $array['descrizione'];
$_SESSION['descrizione'] = $descrizione;
$categoria = $array['categoria'];
$_SESSION['categoria'] = $categoria;
?>


<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Civic Sense - Modifica segnalazione</title>
  <!-- Latest compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <!-- CSS PER RADIOBUTTON-->
  <link href="css/radio2.css" rel="stylesheet">

<style>
  textarea {
  height: 150px;
  width: 100%;
  padding: 5px 5px;
  border-radius: 4px;
  background-color: #f8f8f8;
  resize: none;
}
</style>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <div class="content-wrapper">
  <!-- Navigation-->
  <? include "navbar.php";?>
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Dashboard</a>
        </li>
        <? if ($_SESSION['tipo'] == 1) {?><li class="breadcrumb-item"><a href="myTickets.php">Le tue segnalazioni</a><?}?></li>
        	<li class="breadcrumb-item"><a href="detailTicket.php?id=<?echo $id_cdt;?>"><?php echo $nome_evento; ?></a></li>
          <li class="breadcrumb-item active">
              Modifica Segnalazione
          </li>
      </ol>
  <form method="POST" action="php/editTicket.php">
		<div class="card">

				<div class="card-header">

					<div class="row">
						<div class="col-12">
          			<h3 class="panel-title">Modifica Segnalazione</h3>
						</div>
						</div>
					</div>
			<div class="card-body">
        <div class="row">
          <div class="col-xl-8 col-sm-8 md-8">
                <h5>Titolo:</h5><input type="text" name="newTitolo" id="newTitolo" class="form-control" value="<? echo $nome_evento;?>" style="width: 300px;">
          </div>
          <div class="col-xl-4 col-sm-4 md-4">
            <div class="col-xl-12 col-sm-12 md-12">
            <strong>Data creazione:</strong>
              <?php
                if($riga == 0){
                  $newDate = "";
                } else {
                //CONVERTE DATA DA YYYY-MM-GG a GG-MM-YYYY
                $originalDate = $array['data_creazione'];
                $newDate = date("d-m-Y", strtotime($originalDate));
                }
                echo $newDate;
              ?>
            </div>
            <div class="col-xl-12 col-sm-12 md-12">
              <strong>Posizione:</strong> <?php echo $array['citta']; ?>
            </div>
            <div class="col-xl-12 col-sm-12 md-12">
              <strong>Indirizzo:</strong> <?php echo $array['indirizzo']; ?>
            </div>
            <div class="col-xl-12 col-sm-12 md-12">
              <strong>Categoria:</strong>
              <select style="width: 200px" class="form-control" id="newCat" name="newCat">
                <option><?php echo utf8_encode($categoria); ?></option>
                <? while ($arrayCat = mysqli_fetch_array($categorieEsegui)){
                  echo "<option>".utf8_encode($arrayCat['nome']) . "</option>";
                }?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-12 col-sm-12 md-12">
            <h3>Gravit&agrave;</h3>
          </div>

          <div class="col-xl-12 col-sm-12 md-12">
            <div class="control-group">
               <label class="control control-radio">
                  <a data-toggle="tooltip" class="text-success" title="Il problema non viene considerato di grande rilievo. Si concentra un'attenzione minore."><strong>Bassa</strong></a>
                  <input type="radio" name="radio" value = 1 <?if ($gravita == 1){?>checked="checked"<?}?>/>
                  <div class="control_indicator"></div>
                </label>
               <label class="control control-radio">
                  <a data-toggle="tooltip" class="text-warning" title="Il problema potrebbe recare disturbo se non risolto."><strong>Media</strong></a>
                  <input type="radio" name="radio" value = 2 <?if ($gravita == 2){?>checked="checked"<?}?>/>
                  <div class="control_indicator"></div>
               </label>
               <label class="control control-radio">
                  <a data-toggle="tooltip" class="text-danger" title="Il problema &egrave; assolutamente da risolvere."><strong>Alta</strong></a>
                  <input type="radio" name="radio" value = 3 <?if ($gravita == 3){?>checked="checked"<?}?> />
                  <div class="control_indicator"></div>
               </label>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xl-12 col-sm-12 md-12">
            <h2>Descrizione</h2>
          </div>

          <div class="col-xl-12 col-sm-12 md-12">
            <textarea name="newDescrizione" class="mb-3"> <?php echo $descrizione; ?></textarea>
          </div>
        </div>

    			<?php
    			$queryImg = "Select * from allegati where cdt = '$id_cdt'";
          $queryImgEsegui = mysqli_query($connect, $queryImg);
    			$righeImg = mysqli_num_rows($queryImgEsegui);
    				//CONTROLLO SE CI SONO ALLEGATI ASSOCIATI ALLA SEGNALAZIONE
    				if ($righeImg != 0) { ?>
              <div class="row">
                <div class="col-xl-12 col-sm-12 md-12">
                  <?
    					         echo "<h2>Allegati</h2>"; ?>
                </div>
                <div class="col-xl-12 col-sm-12 md-12">
                  <?
    						       while($cicleImg=mysqli_fetch_array($queryImgEsegui)){
      							     $img = $cicleImg['allegato'];
      							     echo '<img height="300" width="300" src="data:image/;base64,'.$img.'">';
    					         }
                  ?>
                </div>
              </div>
            <?	}	?>
		</div>
		<div class="card-footer">
			<span class="pull-right">
			<button data-original-title="Modifica Profilo" data-toggle="tooltip" class="btn btn-sm btn-success"><em class="fa fa-fw fa-check text-white"></em></button>
			</span>
		</div>

</div>  <!-- /.card-->
</form>
</div>  <!-- /.container-fluid-->

<? include 'footer.php';?>
</div>  <!-- /.content-wrapper-->
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
</body>

</html>
