<!DOCTYPE html>
<html lang="en">

<?php

	require_once '/home/mantkowi/domains/mantkowicz.pl/public_html/kerning/webapp/config.php'; //to musi byc zalaczone do najbardziej nadrzednego pliku
	require_once _PATH.'handlers/TestManager.php';
	require_once _PATH.'handlers/Webservice.php';
	
	$body_content = _PATH."templates/content/mine.php";
	
	$page_title = "Kerning - moje zlecenia";
	
	include (_PATH.'templates/Header.php');
	include (_PATH.'templates/Body.php');

?>

</html>