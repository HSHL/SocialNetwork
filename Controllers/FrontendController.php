<?php

class FrontendController {

    private $user_repository;
    private $tweet_repository;
    private $current_user;
    private $friends;

    public function __construct() {
        if (!isset($_SESSION["user_id"]))
            die;

        $this->user_repository = new userRepository();
        $this->current_user = $this->user_repository->getById($_SESSION["user_id"]);
        $this->friends = $this->user_repository->getFriends($_SESSION["user_id"]);
        $this->tweet_repository = new TweetRepository();

        global $smarty;
        $smarty->assign("user", $this->current_user);
        $smarty->assign("friends", $this->friends);
    }
    
    private function makeTweetArray($tweet_objects) {
        $tweets = array();
        foreach ($tweet_objects as $tweet) {
            $owner = $this->user_repository->getById($tweet->getOwnerId());
            $tweets[] = array("tweet" => $tweet, "owner" => $owner);
        }
        
        return $tweets;
    }

    public function main() {
        $tweet_objects = $this->tweet_repository->getTweets($this->friends);
        $tweets = $this->makeTweetArray($tweet_objects);
        $own_tweet_count = $this->tweet_repository->getTweetCount(array($this->current_user));

        global $smarty;
        $smarty->assign("tweets", $tweets);
        $smarty->assign("own_tweet_count", $own_tweet_count);
        return $smarty->fetch("FrontendController.homescreen.tpl");
    }

    public function postTweet() {
        if ($_REQUEST["content"]) {
            $tweet = new Tweet();
            $tweet->setContent($_REQUEST["content"]);
            $tweet->setOwnerId($_SESSION["user_id"]);
            $this->tweet_repository->save($tweet);
        }

        return $this->main();
    }
    
    public function ownTweets() {
        $myself = array($this->current_user);
        $tweet_objects = $this->tweet_repository->getTweets($myself);
        $tweets = $this->makeTweetArray($tweet_objects);
        $own_tweet_count = $this->tweet_repository->getTweetCount(array($this->current_user));

        global $smarty;
        $smarty->assign("tweets", $tweets);
        $smarty->assign("own_tweet_count", $own_tweet_count);
        return $smarty->fetch("FrontendController.owntweets.tpl");
    }
}
