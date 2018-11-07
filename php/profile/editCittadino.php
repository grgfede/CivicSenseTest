<?php
	$nome = $_SESSION['admin_name'];

	$query = mysqli_query($connect,"SELECT * FROM cittadino where id_cittadino = '$nome'");
	$queryPass = mysqli_query($connect,"SELECT * FROM login where username = '$nome'");

	while ($cicle2 = mysqli_fetch_array($queryPass)){
		$password = $cicle2['password'];
	}

	while($cicle=mysqli_fetch_array($query)){
		$url = $cicle['imageprofile'];
		$nomeUtente = $cicle['nome'];
		$cognome = $cicle['cognome'];
		$localita = $cicle['residenza'];
		$email = $cicle['email'];
		$nascita =  $cicle['data_nascita'];
		$sesso = $cicle['sesso'];
	}

	$url;								                  	//VARIABILE PER LA IMMAGINE DEL PROFILO
	$_SESSION['nomeUtente'] = $nomeUtente;	//VARIABILE PER IL NOME DELL'UTENTE
	$_SESSION['cognome'] = $cognome;	    	//VARIABILE PER IL COGNOME
	$_SESSION['localita'] = $localita;	  	//VARIABILE PER LA LOCALITA
	$_SESSION['nascita'] = $nascita;	    	//VARIABILE PER LA NASCITA
	$_SESSION['sesso'] = $sesso;		       	//VARIABILE PER IL SESSO
	$_SESSION['email'] = $email;		       	//VARIABILE PER LA EMAIL
	$_SESSION['password'] = $password;    		//VARIABILE PER LA PASSWORD


	$errore_password = $_SESSION['errore_password'];

?>

    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item"><a href="profile.php">Il tuo profilo</a></li>
		<li class="breadcrumb-item active">Modifica profilo</li>
      </ol>

			<!--INIZIO FORM-->
					<form name="edit" id="form" action="php/editProfileC.php" method="post">
          <div class="card mb-3">
            <div class="card-header">
              <h3 class="panel-title">Modifica profilo</h3>
            </div>

            <div class="card-body">
              <div class="row">
                <!--<div class="col-md-3 col-lg-3 " align="center"> -->
					<!--<img alt="User Pic" src="?php echo $url; ?>" class="img-thumbnail img-fluid">-->
					<!--<input class="input-group" type="file" name="filetoupload"/>-->
				<!--</div>-->
                <div class=" col-md-9 col-lg-9 m-auto">

				  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><strong>Nome</strong></td>
                        <td><input style="width:250px" class="form-control m-auto" name="nomeText" value="" type="text" placeholder="<?php echo $nomeUtente ?>"></td>
                      </tr>
                      <tr>
                        <td><strong>Cognome</strong></td>
                        <td><input style="width:250px" class="form-control m-auto" name="cognomeText" value="" type="text" placeholder="<?php echo $cognome ?>"></td>
                      </tr>
                      <tr>
                        <td><strong>Data di nascita</strong></td>
                        <td>
						<input style="width:250px" class="form-control m-auto" name="nascitaText" type="date" placeholder = "<?php echo $nascita; ?>" aria-describedby="nameHelp">
						</td>
                      </tr>

                         <tr>
                       <tr>
                        <td><strong>Sesso</strong></td>
                        <td>
							<div class="form-group">
									<select style="width:250px" class="form-control m-auto" id="sel1" name="sessoText">
									<?php if ($sesso == "Maschio" ){ ?>
										<option>Maschio</option>
										<option>Femmina</option>
										<option>Preferisco non specificarlo</option>
									<?php } elseif($sesso == "Femmina") { ?>
										<option>Femmina</option>
										<option>Maschio</option>
										<option>Preferisco non specificarlo</option>
									<?php } else { ?>
										<option>Preferisco non specificarlo</option>
										<option>Maschio</option>
										<option>Femmina</option>
									<?php } ?>

									</select>
							</div>
						</td>
                      </tr>
                        <tr>
                        <td><strong>Residenza</strong></td>
                        <td><input style="width:250px" class="form-control m-auto" name="residenzaText" value="" type="text" placeholder="<?php echo $localita ?>"></td>
                      </tr>
                      <tr>
                        <td><strong>Email</strong></td>
                        <td><input style="width:250px" class="form-control m-auto" name="emailText" value = "" placeholder="<?php echo $email; ?>" type="text"></td>
                      </tr>
					         <tr>
                        <td><strong>Nuova password</strong></td>
						<?php if ($_SESSION['errore_password'] == true){
							$_SESSION['errore_password'] = false;
							echo "<font color=red size=2> Le password non combaciano </font>";
						} ?>
                        <td><input style="width:250px" class="form-control m-auto" name="passwordText1" type="password"></td>
                    </tr>
					          <tr>
                        <td><strong>Ripeti password</strong></td>
                        <td><input style="width:250px" class="form-control m-auto" name="passwordText2" type="password"></td>
                    </tr>


                      </tr>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        <button class="btn btn-primary btn-block" name="edit">Aggiorna profilo</button>
				  </form>
    </div><!-- /.container-fluid-->
