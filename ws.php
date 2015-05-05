<?php
	
	require_once '/home/mantkowi/domains/mantkowicz.pl/public_html/kerning/webapp/config.php';
	require_once _PATH.'handlers/Webservice.php';

	$action = $_GET["action"];
	
	switch ($action)
	{
		case "addFont":
			echo Webservice::getInstance()->addFont();
			break;
		default:
			echo "Wrong action!";
	}

?>