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
			echo Webservice::getInstance()->addJob($_POST['font_size'], $_POST['content'], $_POST['width'], $_POST['height'], $_POST['padding'], $_POST['points'], $_POST['font'], $_POST['indent'], $_POST['lineHeight'], $_POST['hyphen']);
			break;
		case "removeJob":
			echo Webservice::getInstance()->removeJob($_GET['id']);
			break;
		case "getJobs":
			echo Webservice::getInstance()->getJobs($_GET['author'], $_GET['fnt_id'], $_GET['points_start'], $_GET['points_end'], $_GET['date_start'], $_GET['date_end']);
			break;
		case "getFont":
			header("Location: ".Webservice::getInstance()->getFontPath($_GET['id']));
			die();
			break;
		case "getUsers":
			echo Webservice::getInstance()->getUsers();
			break;
		case "getFonts":
			echo Webservice::getInstance()->getFonts();
			break;
		case "addOffer":
			echo Webservice::getInstance()->addOffer(0, $_POST['job_id'], $_POST['usr_id'], $_POST['date'], $_POST['html'], $_POST['score'], 0);
			break;
		case "setOfferWin":
			Webservice::getInstance()->setOfferWin($_GET['id']);
			header("Location: http://www.mantkowicz.pl/kerning/jobs/mine/");
			die();
			break;
		case "getOffers":
			echo Webservice::getInstance()->getOffers();
			break;
		default:
			echo "Wrong action!";
	}

?>