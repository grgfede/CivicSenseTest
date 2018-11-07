<?php

	session_start();
	$nome = $_SESSION['admin_name'];
	if ($nome == ""){
		$nome = "Ospite";
		$tipo = 0;
		$_SESSION['tipo'] = $tipo;
	}
?>

   <!-- Navigation Bar -->

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">

    <a class="navbar-brand" href="index.php">
<?
       if ($nome == "Ospite") { echo "Benvenuto "; }
          else { echo "Bentornato "; }
                echo $nome;
?>
    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <!-- PRIMO ITEM-->
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>

        <!--SECONDO ITEM-->
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Segnalazione">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseSegnalazione" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-exclamation-circle"></i>
            <span class="nav-link-text">Segnalazione</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseSegnalazione">
        <!--SOTTOITEM-->
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Crea segnalazione">
         <a class="nav-link" id="detailTicketLink" href="onclick="detail()"">
           <i class="fa fa-fw fa-plus-circle"></i>
           <span class="nav-link-text">Dettagli segnalazione</span>
         </a>
       </li>
        <!--SOTTOITEM-->
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Segnalazioni seguite">
          <a class="nav-link" href="completedReports.php">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Storico segnalazioni</span>
          </a>
        </li>
      </ul>
    </li>
        <!--TERZO ITEM-->
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Statistiche">
          <a class="nav-link" href="charts.php">
            <i class="fa fa-fw fa-bar-chart"></i>
            <span class="nav-link-text">Statistiche</span>
          </a>
        </li>
        <!--QUARTO ITEM-->
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="I nostri Partners">
          <a class="nav-link" href="partners.php">
            <i class="fa fa-fw fas fa-handshake-o"></i>
            <span class="nav-link-text">Partners</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <!--<li class="nav-item dropdown">
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2" action="findTicket.php" method="get">
            <div class="input-group">
                 <input class="form-control" type="text" name="chiave" placeholder="Cerca CDT...">
               <span class="input-group-append">
                 <button class="btn btn-primary">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li>-->
        <li class="nav-item">
          <?if ($nome == "Ospite"){?>
          <a href="" class="nav-link" data-toggle="modal" data-target="#modalLogin">&nbspLogin
            <i class="fa fa-fw fa-sign-in"></i></a>
            <?} else {?>
          <a href="" class="nav-link" data-toggle="modal" data-target="#modalLogout">&nbspLogout
            <i class="fa fa-fw fa-sign-out"></i></a>
              <?}?>
        </li>
      </ul>
    </div>
  </nav>
