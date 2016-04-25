<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
      data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">SocialHSHL</a>

      <form class="navbar-form navbar-left" role="search" action="index.php" method="post">
        <input type="hidden" name="controller" value="FriendsController">
        <input type="hidden" name="action" value="searchFriends">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Freunde suchen" name="search_string">
        </div>
        <button type="submit" class="btn btn-default">Suchen</button>
      </form>

    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?controller=LoginController&action=logout">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>