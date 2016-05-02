<?php

// starting session
session_start();

require "smarty/libs/Smarty.class.php";
require "Model/User.php";
require "Model/UserRepository.php";
require "Model/Tweet.php";
require "Model/TweetRepository.php";
require "Controllers/LoginController.php";
require "Controllers/FrontendController.php";
require "Controllers/FriendsController.php";
require "Controllers/LikeController.php";

$smarty = new Smarty();
$smarty->setTemplateDir("View");
$smarty->setCompileDir("Compile");
$smarty->setCacheDir("Cache");
global $smarty;

$_CONFIG["absolute_web"] = "http://localhost/Social/";
$_CONFIG["absolute_dir"] = "/xampp/htdocs/Social/";
$_CONFIG["db_host"] = "localhost";
$_CONFIG["db_username"] = "root";
$_CONFIG["db_password"] = "";
$_CONFIG["db_db"] = "social";
global $_CONFIG;

try {
    $db = new PDO("mysql:host=" . $_CONFIG['db_host'] . ";dbname=" . $_CONFIG['db_db'], $_CONFIG['db_username'], $_CONFIG['db_password']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die;
}

global $db;

if (isset($_REQUEST["controller"])) {
    $controller_name = $_REQUEST["controller"];
    $action = $_REQUEST["action"];
} else if (!isset($_SESSION["user_id"])) {
    $controller_name = "LoginController";
    $action = "login";
} else {
    $controller_name = "FrontendController";
    $action = "main";
}

$mode = isset($_REQUEST["mode"]) ? $_REQUEST["mode"] : "template"; 
$controller = new $controller_name;
$output = $controller->$action();

if ($mode == "template") {
    $smarty->assign("bodyContent", $output);
    $smarty->display("main.tpl");
} else {
    echo $output;
}