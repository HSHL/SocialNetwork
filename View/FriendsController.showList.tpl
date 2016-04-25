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
        <span class="badge">{$own_tweet_count}</span>
        <a href="index.php?controller=FrontendController&action=ownTweets">Eigene Beiträge</a>
      </li>
    </ul>
    </div>
  </div>
  <div class="col-lg-9">

  {foreach from=$friends item=friend}
    <div class="row">
      <div class="col-lg-12">
        <article class="well well-sm">
          <h6>{$friend->getFirstname()} {$friend->getLastname()}</h6>
          <a href="index.php?controller=FriendsController&action=removeFriend&id={$friend->getId()}" class="dislike btn btn-danger btn-xs">Freund entfernen</a>
        </article>
      </div>
    </div>
  {/foreach}

  </div>
</div>