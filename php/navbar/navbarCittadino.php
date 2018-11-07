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
        <!--PRIMO ITEM-->
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
				 <a class="nav-link" href="newTicket.php">
					 <i class="fa fa-fw fa-plus-circle"></i>
					 <span class="nav-link-text">Crea una segnalazione</span>
				 </a>
			 </li>
       <?if($nome != "Ospite"){?>
        <!--SOTTOITEM-->
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Segnalazioni seguite">
          <a class="nav-link" href="myTickets.php">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Segnalazioni seguite</span>
          </a>
        </li>
        <?}?>
      </ul>
    </li>
		<?
		   if ($nome == "Ospite") {
?>
        <!--TERZO ITEM-->
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Registrati">
          <a class="nav-link" href="register.php">
            <i class="fa fa-fw fa-user-plus"></i>
            <span class="nav-link-text">Registrati</span>
          </a>
        </li>
				<!--<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Registrati">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseRegistrati" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-user-plus"></i>
            <span class="nav-link-text">Registrati</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseRegistrati">
            SOTTOITEM
            <li>
              <a href="register.php">
                <i class="fa fa-fw fa-users"></i>
                <span>Per il Cittadino</span>
              </a>
            </li>
            SOTTOITEM
            li>
              <a href="registerIstitution.php">
                <i class="fa fa-fw fa-building"></i>
                <span>Per l'Ente</span>
              </a>
            </li>
          </ul>
        </li>-->
        <?} else {?>
    <!--QUARTO ITEM-->
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Profilo">
          <a class="nav-link" href="profile.php">
            <i class="fa fa-user-circle"></i>
            <span class="nav-link-text">Profilo</span>
          </a>
        </li>
<?
		   }
?>
        <!--QUINTO ITEM-->
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Statistiche">
          <a class="nav-link" href="charts.php">
            <i class="fa fa-fw fa-bar-chart"></i>
            <span class="nav-link-text">Statistiche</span>
          </a>
        </li>
        <!--SESTO ITEM-->
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
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary">12 New</span>
            </span>
            <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>David Miller</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>Jane Smith</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>John Doe</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all messages</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts

              SE SI VUOLE TOGLIERE LE NOTIFICHE, COMMENTA LA PRIMA RIGA SOTTO
    <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-danger">
                <strong>
                  <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all alerts</a>
          </div>
        </li>-->
        <li class="nav-item">
          <form class="form-group my-2 my-lg-0 my-xl-0" action="findTicket.php" method="get">
            <div class="input-group w-100">
                 <input class="form-control" type="text" name="chiave" placeholder="Cerca CDT...">
               <div class="input-group-append">
                 <button class="btn btn-primary"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </form>
        </li>
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
