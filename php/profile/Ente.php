<?php

	$nome = $_SESSION['admin_name'];

	//QUERY CHE PRENDE LE INFORMAZIONI DELL'UTENTE LOGGATO
	$query = mysqli_query($connect,"SELECT * FROM ente where id_ente = '$nome'");

	//VARABILI DOVE SALVO LE INFORMAZIONI RICAVATE PRIMA
	$nomeEnte;
	$email;
	$denominazione;
	$partita_iva;
	$sede_legale;
	$sede_operativa;
  $logo;
  $descrizione;

	//MI SALVO NELLE VARIABILI LE INFORMAZIONI
	while($cicle=mysqli_fetch_array($query)){
		$logo = $cicle['logo'];
		$nomeEnte = $cicle['id_ente'];
		$email = $cicle['email'];
		$denominazione = $cicle['denominazione'];
		$partita_iva = $cicle['p_iva'];
		$sede_legale = $cicle['sede_legale'];
		$sede_operativa = $cicle['sede_operativa'];
    $descrizione = $cicle['descrizione'];
	}


?>

    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.html">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Il tuo profilo</li>
      </ol>

     <!-- <div class="row"> -->
       <!-- <div class="col-12">-->
      <!--<div class="col-md-5  toppad  pull-right col-md-offset-3 ">
           <--<A href="edit.html" >Edit Profile</A>

        <A href="edit.html" >Logout</A>
       <br>
<p class=" text-info">May 05,2014,03:00 pm </p>
      </div>-->

          <div class="card mb-3">
            <div class="card-header">
              <h3 class="panel-title">Il tuo profilo</h3>
            </div>
            <div class="card-body">
              <div class="row">
               <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="data:image/jpeg;base64,<?php echo $logo; ?>" class="img-thumbnail img-fluid"> </div>
                <div class=" col-md-9 col-lg-9 ">
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><b>Denominazione</b></td>
                        <td><?php echo $denominazione; ?></td>
                      </tr>
                      <tr>
                        <td><b>Sede Legale</b></td>
                        <td><?php echo $sede_legale; ?></td>
                      </tr>
                      <tr>
                        <td><b>Sede Operativa</b></td>
                        <td><?php echo $sede_operativa; ?></td>
                      </tr>
                      <tr>
                        <td><b>Email</b></td>
                        <td><a href="mailto:<? echo $email; ?>"><?php echo $email; ?></a></td>
                      </tr>
                      <tr>
                        <? if ($descrizione != ""){ ?>
                          <tr>
                          <td><b>Descrizione</b></td>
                          <td><?php echo $descrizione; ?></td>
                        </tr>
                      <? } else {

                      }?>


					  <!--<tr>
                        <td><b>Ticket inseriti</b></td>
                        <td><?php echo $localita; ?></td>
                      </tr>-->
                        <!--<td><b>Phone Number</b></td>
                        <td>123-4567-890(Landline)<br><br>555-4567-890(Mobile)
                        </td>-->
                         </tr>

                    </tbody>
                  </table>

                  <!--<a href="#" class="btn btn-primary">My Sales Performance</a>
                  <a href="#" class="btn btn-primary">Team Sales Performance</a>-->
                </div>
              </div>
            </div>
                 <div class="card-footer">
                        <!--<a href="mailto:<? echo $email; ?>" data-original-title="Invia un messaggio privato" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-envelope"></i></a>-->
                        <span class="pull-right">
                            <a href="editProfile.php" data-original-title="Modifica Profilo" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i></a>
                            <!--<a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-remove"></i></a>-->
                        </span>
                    </div>
          </div>
     </div>
