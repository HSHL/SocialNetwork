<?php

class FriendsController {

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

    public function showList() {
        global $smarty;
        
        $own_tweet_count = $this->tweet_repository->getTweetCount(array($this->current_user));

        $smarty->assign("user", $this->current_user);
        $smarty->assign("friends", $this->friends);
        $smarty->assign("own_tweet_count", $own_tweet_count);
        return $smarty->fetch("FriendsController.showList.tpl");
    }

    public function searchFriends() {
        global $smarty;

        if (isset($_REQUEST["search_string"]) && $_REQUEST["search_string"] != "") {
            $friends = $this->friends;
            $friends[] = $this->current_user;

            $people = $this->user_repository->searchPeople($_REQUEST["search_string"], $friends);
            $own_tweet_count = $this->tweet_repository->getTweetCount(array($this->current_user));
            $smarty->assign("user", $this->current_user);
            $smarty->assign("people", $people);
            $smarty->assign("own_tweet_count", $own_tweet_count);
            return $smarty->fetch("FriendsController.searchFriends.tpl");
        }

        $controller = new FrontendController();
        return $controller->main();
    }

    public function addFriend() {
        if (isset($_REQUEST["user_id"])) {
            $this->user_repository->addFriend($_SESSION["user_id"], $_REQUEST["user_id"]);
        }

        $controller = new FrontendController();
        return $controller->main();
    }

    public function removeFriend() {
        if (isset($_REQUEST["id"])) {
            $this->user_repository->removeFriend($_SESSION["user_id"], $_REQUEST["id"]);
            $this->friends = $this->user_repository->getFriends($_SESSION["user_id"]);
        }

        return $this->showList();
    }

}
