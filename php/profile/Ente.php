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
                        <td><strong>Denominazione</strong></td>
                        <td><?php echo $denominazione; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Sede Legale</strong></td>
                        <td><?php echo $sede_legale; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Sede Operativa</strong></td>
                        <td><?php echo $sede_operativa; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Email</strong></td>
                        <td><a href="mailto:<? echo $email; ?>"><?php echo $email; ?></a></td>
                      </tr>
                      <tr>
                        <? if ($descrizione != ""){ ?>
                          <tr>
                          <td><strong>Descrizione</strong></td>
                          <td><?php echo $descrizione; ?></td>
                        </tr>
                      <? } else {

                      }?>
                         </tr>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
                 <div class="card-footer">
                        <span class="pull-right">
                            <a href="editProfile.php" data-original-title="Modifica Profilo" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><em class="fa fa-fw fa-edit"></em></a>
                        </span>
                    </div>
          </div>
     </div>
