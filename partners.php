<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Civicsense - Partners</title>
  <!-- Latest compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
<!-- FINE CSS E JS-->

<!-- CSS E JS PER LA GALLERIA DEGLI ENTI-->
  <link rel="stylesheet" type="text/css" href="vendor/jportilio/css/jportilio.css" />
  <link rel="stylesheet" type="text/css" href="vendor/jportilio/css/jportilio_style_codepany.css" />
  <link rel="stylesheet" type="text/css" href="vendor/jportilio/css/jportilio_style_light.css" />
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
   	  <!-- Navigation-->
  	  <?include "navbar.php";?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.html">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">I nostri Partners</li>
      </ol>
      <div class="row">
        <div class="col-12">
          <h1>I nostri Partners</h1>
          <hr>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
<div class="container">
  <div id="gallery">
          <div class='jprt-buttons'>
<?php

  $db_connection= mysql_connect(localhost,civicsense2018,"");
  $db_selection = mysql_select_db(my_civicsense2018,$db_connection);
  $query = mysql_query("SELECT * FROM categoria");
  while($categoria = mysql_fetch_array($query)){

    printf("<button class='jprt-btn' data-jprtgrid='jprt-1' data-tag='%s'>%s</button>\n",utf8_encode($categoria['nome']),utf8_encode($categoria['nome']));
  }

?>

</div>
<!-- grid of items -->

<div id='jprt-1' class='jprt-container jprt-codepany-style'>

<?
  $query = mysql_query("SELECT * FROM ente");
  while($ente = mysql_fetch_array($query)){
?>
      <!-- item -->

  <div class="jprt-item" data-tags="<?echo utf8_encode($ente['categoria']);?>" data-content-show="cover" data-content-show="new_section" style="
    background-image: url(data:image/png;base64,<? echo $ente['logo']?>);
    background-repeat:no-repeat;
    background-position: 50% 50%;
    background-size: contain;
    ">
    <div class='jprt-caption'>
    </div>

    <div class='jprt-content'>
    <div class='jprt-arrow-down-border'>

    <div class='jprt-arrow-down-back'>

      <div class='jprt-arrow-down'></div>

    </div>

  </div>
      <!-- content -->
                <h1>This content is shown in new element, below the item!</h1>

    </div>

    <div class='jprt-hover'>
        <h1 class='jprt-item-title'><? echo utf8_encode($ente['denominazione']);?> </h1>
      <!-- hover -->

    </div>

  </div>
<?
  }
?>

        </div>
      </div>
    </div>
        </div>
      </div>


    <? include "footer.php";?>

<!--SCRIPT PER ADATTARE L'ALTEZZA DEL FRAME AL CONTENUTO DELLO STESSO-->
    <script>
function handleFrameSize(event) {
var iframe=document.getElementById('partner_gallery');
		if(iframe){
    		var altezza = iframe.contentWindow.document.body.offsetHeight;
    		iframe.height = altezza+"px";
}
}
		window.onload=handleFrameSize;
		window.onresize=handleFrameSize;

if (window.DeviceOrientationEvent) {
	window.addEventListener("deviceorientation", handleFrameSize);
}

</script>
  </div>    <!-- /.container-fluid-->
</div>    <!-- /.content-wrapper-->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
  <!--SCRIPT PER LA GALLERIA JPORTILIO-->
  
  <script type="text/javascript" src="vendor/jportilio/js/jportilio.js"></script>
  <script>
  $(function () {

  $('.jprt-container').jportilio({'ratio': '0.75', 'ws_lg': '4'});

});
</script>
</body>

</html>
