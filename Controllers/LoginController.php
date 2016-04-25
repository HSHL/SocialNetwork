<?php

class LoginController {
	
	public function login() {
		if (isset($_REQUEST["email"])) {
			$repository = new UserRepository();
			$user = $repository->getUserByEmailAndPassword($_REQUEST["email"], $_REQUEST["password"]);
			
			if ($user != NULL) {
				$_SESSION["user_id"] = $user->getId();
				$controller = new FrontendController();
				return $controller->main();
			} else {
				global $smarty;
				$smarty->assign("error_msg", "Benutzer konnte nicht gefunden werden!");
				$smarty->assign("email", $_REQUEST["email"]);
				return $smarty->fetch("LoginController.login.tpl");
			}
		} else {
			global $smarty;
			return $smarty->fetch("LoginController.login.tpl");
		}
	}

	public function createNewAccount() {
		if (isset($_REQUEST["firstname"])) {
			$user = new User();
			$user->setFirstname($_REQUEST["firstname"]);
			$user->setLastname($_REQUEST["lastname"]);
			$user->setEmail($_REQUEST["email"]);
			$user->setPasswordHash(sha1($_REQUEST["password"]));

			$repository = new UserRepository();
			$repository->save($user);

			$_SESSION["user_id"] = $user->getId();

			global $smarty;
			$smarty->assign("user", $user);
			return $smarty->fetch("LoginController.welcomeNewUser.tpl");
		} else {
			global $smarty;
			return $smarty->fetch("LoginController.createNewAccount.tpl");
		}
	}
        
    public function logout() {
        unset($_SESSION["user_id"]);

        global $smarty;
        return $smarty->fetch("LoginController.goodbye.tpl");
    }
}