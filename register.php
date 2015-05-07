<!DOCTYPE html>
<html lang="pl">

<?php

	session_start();

	require_once '/home/mantkowi/domains/mantkowicz.pl/public_html/kerning/webapp/config.php'; //to musi byc zalaczone do najbardziej nadrzednego pliku
	require_once _PATH.'handlers/TestManager.php';
	require_once _PATH.'handlers/Webservice.php';

	$page_title = "Kerning - logowanie";
	
	include (_PATH.'templates/Header.php');
?>
			
	<script>	
			
		function handleResponse(response)
		{
			window.location.replace('http://www.mantkowicz.pl/tp/');
		}
			
		$(document).ready(
			function(){
				$("#form_login").submit( function(event) {sendForm(event, getFormData(event.target), handleResponse) } )
			}
		);
	</script>
	
	<body>
		<div class="container">
		
			<br><br><br>
		
			<img src="_libs//images/logo-xs.png" class="center-block hidden-lg hidden-md hidden-sm" style="margin-bottom:30px;" />
			<img src="_libs//images/logo.png" class="center-block hidden-xs" style="margin-bottom:50px;" />
		
			<div class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Błąd!</strong> <span class="alert-message"></span>
			</div>
		
			<div class="col-sm-8 col-sm-offset-2">
				<form id="form_login" action="ws.php?action=register" method="GET">
					<div class="form-group">
						<label class="sr-only" for="id_login">Login</label>
						<div class="input-group">
							<div class="input-group-addon"> <span class="glyphicon glyphicon-user"></span> </div>
							<input id="id_login" name="login" type="text" class="form-control input-lg" placeholder="login">
							<div class="input-group-addon input-group-status"> &#9679; </div>
						</div>
					</div>
									
					<div class="form-group">
						<label class="sr-only" for="id_password">Hasło</label>
						<div class="input-group">
							<div class="input-group-addon"> <span class="glyphicon glyphicon-lock"></span> </div>
							<input id="id_password" name="password" type="password" class="form-control input-lg" placeholder="hasło">
							<div class="input-group-addon input-group-status"> &#9679; </div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="sr-only" for="id_password">Potwierdź hasło</label>
						<div class="input-group">
							<div class="input-group-addon"> <span class="glyphicon glyphicon-lock"></span> </div>
							<input id="id_password" name="confirmPassword" type="password" class="form-control input-lg" placeholder="potwierdź hasło">
							<div class="input-group-addon input-group-status"> &#9679; </div>
						</div>
					</div>
					
					<p style="text-align:center; margin-bottom:20px;"> Masz już konto? <a href="login.html"> <span class="glyphicon glyphicon-log-in"></span> Zaloguj się</a> </p>
					
					<button type="submit" class="btn btn-lg btn-success" style="width:100%;"> <span class="glyphicon glyphicon-edit"></span> Załóż konto</button>
				</form>
			</div>
		
		</div>
	</body>
</html>