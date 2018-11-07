<?php
include "php/dbconnection_session.php";
  $nome = $_SESSION['admin_name'];

  $query = mysqli_query($connect,"SELECT * FROM ente where id_ente = '$nome'");
  $queryPass = mysqli_query($connect,"SELECT * FROM login where username = '$nome'");

  while ($cicle2 = mysqli_fetch_array($queryPass)){
    $password = $cicle2['password'];
  }

  while($cicle=mysqli_fetch_array($query)){
    $url = $cicle['logo'];
    $nomeEnte = $cicle['id_ente'];
    $email = $cicle['email'];
    $denominazione = $cicle['denominazione'];
    $sede_legale =  $cicle['sede_legale'];
    $sede_operativa = $cicle['sede_operativa'];
    $descrizione = $cicle['descrizione'];
  }


  $_SESSION['logo'] = $url;                             //VARIABILE PER LA IMMAGINE DEL PROFILO
  $_SESSION['nomeEnte'] = $nomeEtente;                  //VARIABILE PER IL NOME DELL'UTENTE
  $_SESSION['email'] = $email;                          //VARIABILE PER IL COGNOME
  $_SESSION['denominazione'] = $denominazione;      //VARIABILE PER LA LOCALITA
  $_SESSION['sede_legale'] = $sede_legale;              //VARIABILE PER LA NASCITA
  $_SESSION['sede_operativa'] = $sede_operativa;        //VARIABILE PER IL SESSO
  $_SESSION['descrizione'] = $descrizione;              //VARIABILE PER LA EMAIL
  $_SESSION['password'] = $password;                    //VARIABILE PER LA PASSWORD


  $errore_password = $_SESSION['errore_password'];

?>
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.html">Dashboard</a>
        </li>
        <li class="breadcrumb-item"><a href="profile.php">Il tuo profilo</a></li>
    <li class="breadcrumb-item active">Modifica profilo</li>
      </ol>

        <form name="edit" id="form" action="php/editProfileE.php" method="post" enctype="multipart/form-data">
          <div class="card mb-3">
            <div class="card-header">
              <h3 class="panel-title">Modifica profilo</h3>
            </div>

            <div class="card-body">
              <div class="row">
        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="data:image/jpeg;base64,<?php echo $url; ?>" class="img-thumbnail img-fluid">
         <input type="file" name="logo" id="logo" multiple> </div>
        <div class=" col-md-9 col-lg-9 ">
          <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><strong>Denominazione</strong></td>
                        <td><input style="width:250px" class="form-control" name="denominazioneText" value="" type="text" placeholder="<?php echo $denominazione ?>"></td>
                      </tr>
                      <tr>
                        <td><strong>Sede Legale</strong></td>
                        <td><input style="width:250px" class="form-control" name="sedelegaleText" value="" type="text" placeholder="<?php echo $sede_legale ?>"></td>
                      </tr>
                      <tr>
                        <td><strong>Sede Operativa</strong></td>
                        <td><input style="width:250px" class="form-control" name="sedeoperativaText" value="" type="text" placeholder="<?php echo $sede_operativa ?>"></td>
                      </tr>
                      <tr>
                       <tr>
                        <td><strong>Descrizione</strong></td>
                        <td><textarea name="descrizioneText" placeholder="<? echo $descrizione ?>"></textarea></td>
                      </tr>
                        <tr>
                        <td><strong>Email</strong></td>
                        <td><input style="width:250px" class="form-control" name="emailText" value="" type="text" placeholder="<?php echo $email ?>"></td>
                      </tr>
                    <tr>
                        <td><strong>Nuova password</strong></td>
            <?php if ($_SESSION['errore_password'] == true){
              $_SESSION['errore_password'] = false;
              echo "<font color=red size=2> Le password non combaciano </font>";
            } ?>
                        <td><input style="width:250px" class="form-control" name="passwordText1" type="password"></td>
                    </tr>
          <tr>
                        <td><strong>Ripeti password</strong></td>
                        <td><input style="width:250px" class="form-control" name="passwordText2" type="password"></td>
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
</div>
