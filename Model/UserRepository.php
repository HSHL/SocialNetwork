<?php

class UserRepository {

    public function getUserByEmailAndPassword($email, $password) {
        global $db;
        $sql = "select id, firstname, lastname, email, password_hash from users where email like " .
                $db->quote($email) . " and password_hash=" . $db->quote(sha1($password));

        $result = $db->query($sql);
        if ($result->rowCount() == 1) {
            $row = $result->fetch();
            return $this->fromRow($row);
        } else {
            return NULL;
        }
    }

    private function fromRow($row) {
        $user = new User();
        $user->setId($row["id"]);
        $user->setFirstname($row["firstname"]);
        $user->setLastname($row["lastname"]);
        $user->setEmail($row["email"]);
        $user->setPasswordHash($row["password_hash"]);
        return $user;
    }

    public function save($user) {
        global $db;

        $sql = "insert into users (firstname, lastname, email, password_hash) values (" .
                $db->quote($user->getFirstname()) . ", " .
                $db->quote($user->getLastname()) . ", " .
                $db->quote($user->getEmail()) . ", " .
                $db->quote($user->getPasswordHash()) . ")";

        $db->exec($sql);
        $id = $db->lastInsertId();
        $user->setId($id);
    }

    public function getById($id) {
        global $db;

        $sql = "select id, firstname, lastname, email, password_hash from users where id=" . $db->quote($id);

        $result = $db->query($sql);
        if ($result->rowCount() == 1) {
            $row = $result->fetch();
            return $this->fromRow($row);
        } else {
            return NULL;
        }
    }

    public function getFriends($user_id) {
        global $db;

        $sql = "select id,firstname,lastname,email,password_hash from friends, " .
                "users where friends.friend_id=users.id and friends.user_id=" . $user_id;

        $result = array();
        foreach ($db->query($sql) as $row) {
            $result[] = $this->fromRow($row);
        }

        return $result;
    }

    public function searchPeople($search_string, $friends) {
        global $db;

        $friend_ids = array();
        foreach ($friends as $friend) {
            $friend_ids[] = $friend->getId();
        }

        $search_string = "%" . $search_string . "%";
        $sql = "select * from users where (firstname like " . $db->quote($search_string) .
                " or lastname like " . $db->quote($search_string) . ") and id not in (" . implode(",", $friend_ids) . ")";

        $result = array();
        foreach ($db->query($sql) as $row) {
            $result[] = $this->fromRow($row);
        }

        return $result;
    }

    public function addFriend($user_id, $friend_id) {
        global $db;

        $sql = "insert into friends (user_id, friend_id) values (" . $user_id . "," . $friend_id . ")";
        $db->exec($sql);

        $sql = "insert into friends (user_id, friend_id) values (" . $friend_id . "," . $user_id . ")";
        $db->exec($sql);
    }

    public function removeFriend($user_id, $friend_id) {
        global $db;

        $sql = "delete from friends where " .
                "(user_id=" . $db->quote($user_id) . " and friend_id=" . $db->quote($friend_id) . ") or " .
                "(user_id=" . $db->quote($friend_id) . " and friend_id=" . $db->quote($user_id) . ")";

        $db->exec($sql);
    }

}
