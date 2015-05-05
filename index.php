<!DOCTYPE html>
<html lang="en">

<?php

	require_once '/home/mantkowi/domains/mantkowicz.pl/public_html/kerning/webapp/config.php'; //to musi byc zalaczone do najbardziej nadrzednego pliku
	require_once _PATH.'handlers/TestManager.php';
	require_once _PATH.'handlers/Webservice.php';
	
	TestManager::getInstance()->testFontClass();
	
	$body_content = _PATH."templates/content/main.php";
	
	$page_title = "Kerning - strona g³ówna";
	
	include (_PATH.'templates/Header.php');
	include (_PATH.'templates/Body.php');

?>

</html>