<?php

class User {

    private $id = 0;
    private $firstname = "";
    private $lastname = "";
    private $email = "";
    private $password_hash = "";

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPasswordHash() {
        return $this->password_hash;
    }

    public function setPasswordHash($password_hash) {
        $this->password_hash = $password_hash;
    }
}