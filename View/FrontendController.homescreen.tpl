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

<div class="row">
  <div class="col-lg-12">
    <form class="form-horizontal" method="post" action="index.php">
      <input type="hidden" name="controller" value="FrontendController">
      <input type="hidden" name="action" value="postTweet">
      <fieldset>
        <div class="form-group">
          <div class="col-lg-10">
            <textarea class="form-control" rows="2" id="textArea" name="content" placeholder="Was machst du gerade?"></textarea>
          </div>
          <div class="col-lg-2">
            <button type="submit" class="btn btn-primary">Posten</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</div>

<script>
  $(function() {
    $(".like").click(function() {
      var id = $(this).attr("id");
      $.post("index.php",
      {
        controller: "LikeController",
        action: "like",
        mode: "service",
        id: id
      },
      function(data, status) {
        $("#liked_" + id).text(data);
      });
    }),

    $(".dislike").click(function() {
      var id = $(this).attr("id");
      $.post("index.php",
      {
        controller: "LikeController",
        action: "dislike",
        mode: "service",
        id: id
      },
      function(data, status) {
        $("#disliked_" + id).text(data);
      });
    })
  });
</script>

{foreach from=$tweets item=t}
<div class="row">
  <div class="col-lg-12">
    <article class="well well-sm">
      <h6>{$t["owner"]->getFirstname()} {$t["owner"]->getlastName()} :</h6>
      <p>{$t["tweet"]->getContent()}</p>
      <a id="{$t["tweet"]->getId()}" class="like btn btn-primary btn-xs">Like</a>
      <span id="liked_{$t["tweet"]->getId()}" class="label label-primary">0</span>
      <a id="{$t["tweet"]->getId()}" class="dislike btn btn-danger btn-xs">Dislike</a>
      <span id="disliked_{$t["tweet"]->getId()}" class="label label-danger">0</span>
    </article>
  </div>
</div>
{/foreach}

</div>
</div>