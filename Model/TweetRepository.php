<?php

class TweetRepository {

    public function save($tweet) {
        global $db;

        $sql = "insert into tweets (content, created, owner_id) values (" .
                $db->quote($tweet->getContent()) . ", " .
                $db->quote($tweet->getCreated()) . ", " .
                $db->quote($tweet->getOwnerId()) . ")";

        $db->exec($sql);
        $id = $db->lastInsertId();
        $tweet->setId($id);
    }

    private function fromRow($row) {
        $tweet = new Tweet();
        $tweet->setId($row["id"]);
        $tweet->setContent($row["content"]);
        $tweet->setCreated($row["created"]);
        $tweet->setOwnerId($row["owner_id"]);
        return $tweet;
    }
    
    private function makeIdList($objects) {
        $ids = array();
        foreach ($objects as $obj) {
            $ids[] = $obj->getId();
        }
        
        return $ids;
    }
    
    private function makeObjects($rows) {
        $objects = array();
        foreach ($rows as $row) {
            $obj = $this->fromRow($row);
            $objects[] = $obj;
        }

        return $objects;
    }

    public function getTweets($users) {
        global $db;

        if (count($users) == 0)
            return array();

        $user_ids = $this->makeIdList($users);
        $sql = "select id, created, content, owner_id from tweets where owner_id in (" .
                implode(",", $user_ids) . ") order by created desc";

        return $this->makeObjects($db->query($sql));
    }
    
    public function getTweetCount($users) {
        global $db;

        if (count($users) == 0)
            return 0;

        $user_ids = $this->makeIdList($users);
        $sql = "select count(*) as tweet_count from tweets where owner_id in (" .
                implode(",", $user_ids) . ") order by created desc";

        $row = $db->query($sql)->fetch();
        return $row["tweet_count"];
    }
}
