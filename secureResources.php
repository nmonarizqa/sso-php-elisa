<?php

ini_set('include_path', ini_get('include_path').';C:\xampp\htdocs\phpSample\libraries;');

require_once ('\federation\FederatedLoginManager.php');

session_start();

$token = $_POST['wresult'];

$loginManager = new FederatedLoginManager();

if (!$loginManager->isAuthenticated()) {
	if (isset ($token)) {
		try {
			$loginManager->authenticate($token);
		} catch (Exception $e) {
			print_r($e->getMessage());
		}
	} else {
		$returnUrl = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

		header('Pragma: no-cache');
		header('Cache-Control: no-cache, must-revalidate');		
		header("Location: " . FederatedLoginManager :: getFederatedLoginUrl($returnUrl), true, 302);
		exit();
	}
}
?>
