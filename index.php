<?php session_start();

	require_once '/home/mantkowi/domains/mantkowicz.pl/public_html/kerning/webapp/config.php'; //to musi byc zalaczone do najbardziej nadrzednego pliku
	require_once _PATH.'handlers/TestManager.php';
	require_once _PATH.'handlers/Webservice.php';
	
	if( SessionManager::getInstance()->getUser() == null )
	{
		header("Location: "._URL."login.php");
		die();
	}
?>

<!DOCTYPE html>
<html lang="en">

<?php 
	
	$body_content = _PATH."templates/content/main.php";
	
	$page_title = "Kerning - ustrona główna";
	
	include (_PATH.'templates/Header.php');
	include (_PATH.'templates/Body.php');

?>

</html>