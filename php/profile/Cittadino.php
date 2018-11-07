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
                        <td><strong>Nome</strong></td>
                        <td><?php echo $nomeUtente; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Cognome</strong></td>
                        <td><?php echo $cognome; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Data di nascita</strong></td>
                        <td><?php if ($nascita == ''){$nascita = 'Non definita'; } echo $nascita; ?></td>
                      </tr>

                         <tr>
                       <tr>
                        <td><strong>Sesso</strong></td>
                        <td><?php if($sesso == ''){$sesso = 'Non specificato'; } echo $sesso; ?></td>
                      </tr>
                        <tr>
                        <td><strong>Residenza</strong></td>
                        <td><?php echo $localita; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Email</strong></td>
                        <td><a href="mailto:info@support.com"><?php echo $email; ?></a></td>
                      </tr>
                         </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
                 <div class="card-footer">

                        <span class="pull-right">
                            <a href="editProfile.php" data-original-title="Modifica Profilo" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><em class="fa fa-fw fa-edit"></em> </a>
                        </span>
                    </div>
          </div>
     </div>
