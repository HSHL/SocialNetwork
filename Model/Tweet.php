<?php

class Tweet {
    private $id = 0;
    private $content = "";
    private $created;
    private $owner_id = 0;

    public function __construct() {
        $this->created = date("Y-m-d H:i:s");
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getCreated() {
        return $this->created;
    }

    public function setCreated($created) {
        $this->created = $created;
    }

    public function getOwnerId() {
        return $this->owner_id;
    }

    public function setOwnerId($owner_id) {
        $this->owner_id = $owner_id;
    }

}
