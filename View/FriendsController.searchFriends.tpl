{include 'menu.tpl'}

<div class="row">
  <div class="col-lg-3">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">{$user->getFirstname()} {$user->getLastname()}</h3>
      </div>
      <ul class="list-group">
      <li class="list-group-item">
        <span class="badge">{count($friends)}</span>
        <a href="index.php?controller=FriendsController&action=showList">Freunde</a>
      </li>
      <li class="list-group-item">
        <span class="badge">2</span>
        <a href="index.php?controller=FrontendController&action=ownTweets">Eigene Beiträge</a>
      </li>
    </ul>
    </div>
  </div>
  <div class="col-lg-9">

  {foreach from=$people item=person}
    <div class="row">
      <div class="col-lg-12">
        <article class="well well-sm">
          <h6>{$person->getFirstname()} {$person->getLastname()}</h6>
          <a href="index.php?controller=FriendsController&action=addFriend&user_id={$person->getId()}" class="btn btn-primary btn-xs">Als Freund hinzufügen</a>
        </article>
      </div>
    </div>
  {/foreach}

  </div>
</div>