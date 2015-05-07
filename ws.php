<?php
	
	session_start();

	require_once '/home/mantkowi/domains/mantkowicz.pl/public_html/kerning/webapp/config.php';
	require_once _PATH.'handlers/Webservice.php';

	$action = $_GET["action"];
	
	switch ($action)
	{
		case "login":
			echo Webservice::getInstance()->login($_GET['login'], $_GET['password']);
			break;
		case "logout":
			echo Webservice::getInstance()->logout();
			break;
		case "addFont":
			echo Webservice::getInstance()->addFont();
			break;
		default:
			echo "Wrong action!";
	}

?>