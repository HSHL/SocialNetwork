<h1>Neues Konto erstellen</h1>

<form id="createNewAccountForm" class="form-horizontal" method="post" action="index.php">
  <input type="hidden" name="controller" value="LoginController">
  <input type="hidden" name="action" value="createNewAccount">
  <fieldset>
  	<legend>Bitte geben Sie Ihre Nutzerdaten ein, damit ein neues Konto angelegt werden kann.</legend>
    <div class="form-group">
      <label for="username" class="col-lg-2 control-label">Vorname</label>
      <div class="col-lg-10">
        <input class="form-control" id="firstname" placeholder="Vorname" type="text" name="firstname">
      </div>
    </div>
    <div class="form-group">
      <label for="username" class="col-lg-2 control-label">Nachname</label>
      <div class="col-lg-10">
        <input class="form-control" id="lastname" placeholder="Nachname" type="text" name="lastname">
      </div>
    </div>
    <div class="form-group">
      <label for="email" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
        <input class="form-control" id="email" placeholder="Email" type="email" name="email">
      </div>
    </div>
    <div class="form-group">
      <label for="password" class="col-lg-2 control-label">Password</label>
      <div class="col-lg-10">
        <input class="form-control" id="password" placeholder="Passwort" type="password" name="password">
      </div>
    </div>
    <div class="form-group">
      <label for="confirm_password" class="col-lg-2 control-label">Password Wiederholung</label>
      <div class="col-lg-10">
        <input class="form-control" id="confirm_password" placeholder="Passwort Wiederholung" type="password" name="password_confirm">
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="submit" class="btn btn-primary">Ok</button>
      </div>
   </fieldset>

   <script>
    $(document).ready(function() {
      $("#createNewAccountForm").validate({
        rules: {
          username: { required:true, minlength:5 },
          email: { required:true, email:true },
          password: { required:true, minlength:5 },
          password_confirm: { required:true, minlength:5, equalTo:"#password"}
        }, 
        messages: {
          username: "Bitte Benutzernamen aus mindestends 5 Buchstaben eingeben!",
          email: "Bitte korrekte E-Mail-Adresse eingeben!",
          password: "Bitte Passwort aus mindestens 5 Zeichen eingeben!",
          password_confirm: "Bitte Passwort wiederholen!"
        }
      }
    )});
   </script>
</form>