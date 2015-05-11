<?php
	
	session_start();

	require_once '/home/mantkowi/domains/mantkowicz.pl/public_html/kerning/webapp/config.php';
	require_once _PATH.'handlers/Webservice.php';

	$action = $_GET["action"];
	
	switch ($action)
	{
		case "register":
			echo Webservice::getInstance()->register($_GET['login'], $_GET['password']);
			break;
		case "authorize":
			echo Webservice::getInstance()->login($_GET['login'], $_GET['password']);
			break;
		case "logout":
			echo Webservice::getInstance()->logout();
			break;
		case "addFont":
			echo Webservice::getInstance()->addFont();
			break;
		case "addJob":
			echo Webservice::getInstance()->addJob($_POST['properties'], $_POST['points'], $_POST['font']);
			break;
		case "getJobs":
			echo Webservice::getInstance()->getJobs();
		default:
			echo "Wrong action!";
	}

?>