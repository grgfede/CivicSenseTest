<?php if ($nome == "Ospite"){ ?>
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="modalLoginLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
 <h5 class="modal-title" id="modalLoginLabel">Confermi di voler effettuare l'accesso?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="cancel">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="modal-body">Selezionando "Login" confermi di voler effettuare l'accesso.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">No, voglio continuare come ospite</button>
        <a href="login.php"><button class="btn btn-primary" name="login">Login</button></a>

<?php } else { ?>
  <div class="modal fade" id="modalLogout" tabindex="-1" role="dialog" aria-labelledby="modalLogoutLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLogoutLabel">Confermi di voler uscire?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Selezionando "Logout" confermi di uscire e quindi di chiudere la sessione.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancella</button>
        <a href="logout.php"><button class="btn btn-primary">Logout</button></a>
<?php } ?>

      </div>
    </div>
  </div>
</div>