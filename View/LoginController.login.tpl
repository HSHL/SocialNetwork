<h1>Login</h1>

<form class="form-horizontal" method="post" action="index.php">
  <input type="hidden" name="controller" value="LoginController">
  <input type="hidden" name="action" value="login">
  <fieldset>
  	<legend>Bitte melden Sie sich mit Ihren Nutzerdaten an, oder <a href="index.php?controller=LoginController&action=createNewAccount">erstellen Sie ein neues Konto</a>.</legend>
    {if isset($error_msg)}
    <div class="alert alert-danger" role="alert">
      {$error_msg}
    </div>
    {/if}
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">E-Mail</label>
      <div class="col-lg-10">
        <input class="form-control" id="inputEmail" placeholder="E-Mail" type="text" name="email" {if isset($email)}value="{$email}"{/if}>
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Passwort</label>
      <div class="col-lg-10">
        <input class="form-control" id="inputPassword" placeholder="Passwort" type="password" name="password">
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="submit" class="btn btn-primary">Ok</button>
      </div>
    </div>
  </fieldset>
</form>