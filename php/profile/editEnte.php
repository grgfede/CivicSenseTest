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

     <!-- <div class="row"> -->
       <!-- <div class="col-12">-->
      <!--<div class="col-md-5  toppad  pull-right col-md-offset-3 ">
           <--<A href="edit.html" >Edit Profile</A>

        <A href="edit.html" >Logout</A>
       <br>
<p class=" text-info">May 05,2014,03:00 pm </p>
      </div>-->
      <!--INIZIO FORM-->
        <form name="edit" id="form" action="php/editProfileE.php" method="post" enctype="multipart/form-data">
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
        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="data:image/jpeg;base64,<?php echo $url; ?>" class="img-thumbnail img-fluid">
         <input type="file" name="logo" id="logo" multiple> </div>
        <div class=" col-md-9 col-lg-9 ">
          <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><b>Denominazione</b></td>
                        <td><input style="width:250px" class="form-control" name="denominazioneText" value="" type="text" placeholder="<?php echo $denominazione ?>"></td>
                      </tr>
                      <tr>
                        <td><b>Sede Legale</b></td>
                        <td><input style="width:250px" class="form-control" name="sedelegaleText" value="" type="text" placeholder="<?php echo $sede_legale ?>"></td>
                      </tr>
                      <tr>
                        <td><b>Sede Operativa</b></td>
                        <td><input style="width:250px" class="form-control" name="sedeoperativaText" value="" type="text" placeholder="<?php echo $sede_operativa ?>"></td>
                      </tr>
                      <tr>
                       <tr>
                        <td><b>Descrizione</b></td>
                        <td><textarea name="descrizioneText" placeholder="<? echo $descrizione ?>"></textarea></td>
                      </tr>
                        <tr>
                        <td><b>Email</b></td>
                        <td><input style="width:250px" class="form-control" name="emailText" value="" type="text" placeholder="<?php echo $email ?>"></td>
                      </tr>
                    <tr>
                        <td><b>Nuova password</b></td>
            <?php if ($_SESSION['errore_password'] == true){
              $_SESSION['errore_password'] = false;
              echo "<font color=red size=2> Le password non combaciano </font>";
            } ?>
                        <td><input style="width:250px" class="form-control" name="passwordText1" type="password"></td>
                    </tr>
          <tr>
                        <td><b>Ripeti password</b></td>
                        <td><input style="width:250px" class="form-control" name="passwordText2" type="password"></td>
                    </tr>


                      </tr>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>

                 <!--<div class="card-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-envelope"></i></a>
                        <span class="pull-right">
                            <a href="editProfile.php?id=<?php echo $nome ?>" data-original-title="Modifica Profilo" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-remove"></i></a>
                        </span>
                    </div>-->
            </div>
        <!--<a href="#" class="btn btn-primary">My Sales Performance</a>-->
        <button class="btn btn-primary btn-block" name="edit">Aggiorna profilo</button>
        </form>
</div>
