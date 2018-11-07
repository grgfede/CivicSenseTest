<?php

	$nome = $_SESSION['admin_name'];

	//QUERY CHE PRENDE LE INFORMAZIONI DELL'UTENTE LOGGATO
	$query = mysqli_query($connect,"SELECT * FROM cittadino where id_cittadino = '$nome'");

	//VARABILI DOVE SALVO LE INFORMAZIONI RICAVATE PRIMA
	$url;
	$nomeUtente;
	$cognome;
	$localita;
	$nascita;
	$sesso;
	$email;

	//MI SALVO NELLE VARIABILI LE INFORMAZIONI
	while($cicle=mysqli_fetch_array($query)){
		$url = $cicle['imageprofile'];
		$nomeUtente = $cicle['nome'];
		$cognome = $cicle['cognome'];
		$localita = $cicle['residenza'];
		$email = $cicle['email'];
		$nascita = $cicle['data_nascita'];
		$sesso = $cicle['sesso'];
	}


?>
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Il tuo profilo</li>
      </ol>

     <!-- <div class="row"> -->
       <!-- <div class="col-12">-->
      <!--<div class="col-md-5  toppad  pull-right col-md-offset-3 ">
           <A href="edit.html" >Edit Profile</A>

        <A href="edit.html" >Logout</A>
       <br>
<p class=" text-info">May 05,2014,03:00 pm </p>
      </div>-->

          <div class="card">
            <div class="card-header">
              <h3 class="panel-title">Il tuo profilo</h3>
            </div>
            <div class="card-body">
              <div class="row">
               <!-- <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="?php echo $url; ?>" class="img-thumbnail img-fluid"> </div>-->
                <div class=" col-md-9 col-lg-9 m-auto">
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><b>Nome</b></td>
                        <td><?php echo $nomeUtente; ?></td>
                      </tr>
                      <tr>
                        <td><b>Cognome</b></td>
                        <td><?php echo $cognome; ?></td>
                      </tr>
                      <tr>
                        <td><b>Data di nascita</b></td>
                        <td><?php if ($nascita == ''){$nascita = 'Non definita'; } echo $nascita; ?></td>
                      </tr>

                         <tr>
                       <tr>
                        <td><b>Sesso</b></td>
                        <td><?php if($sesso == ''){$sesso = 'Non specificato'; } echo $sesso; ?></td>
                      </tr>
                        <tr>
                        <td><b>Residenza</b></td>
                        <td><?php echo $localita; ?></td>
                      </tr>
                      <tr>
                        <td><b>Email</b></td>
                        <td><a href="mailto:info@support.com"><?php echo $email; ?></a></td>
                      </tr>
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
                </div>
              </div>
            </div>
                 <div class="card-footer">
                        <!--<a data-original-title="Invia un messaggio privato" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-envelope"></i></a>-->
                        <span class="pull-right">
                            <a href="editProfile.php" data-original-title="Modifica Profilo" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i></a>
                            <!--<a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-remove"></i></a>-->
                        </span>
                    </div>
          </div>
     </div>
