<?php
session_start();

require_once '/home/mantkowi/domains/mantkowicz.pl/public_html/kerning/webapp/config.php'; //to musi byc zalaczone do najbardziej nadrzednego pliku
require_once _PATH.'handlers/TestManager.php';
require_once _PATH.'handlers/Webservice.php';

if( SessionManager::getInstance()->getUser() != null )
{
	header("Location: "._URL);
	die();
}
?>

<!DOCTYPE html>
<html lang="pl">

<?php
	
	$page_title = "Kerning - logowanie";
	
	include (_PATH.'templates/Header.php');
?>

	<body>
		<script>
			function blockSubmit(event)
			{
			}
		
			function handleResponse(response)
			{
				if(response.status > 0)
				{
					window.location.replace('<?php echo _URL;?>');
				}
				else
				{
					changeToError( $('.input-group') );
					
					$(".alert.alert-danger").css('display', 'inherit');
					$(".alert.alert-danger").find(".alert-message").html(response.message);
				}
			}

			function validate()
			{
				if( $("#id_login").val().length > 0 && $("#id_password").val().length > 0 )
				{
					if( $("#id_submit").hasClass("disabled") )
					{
						$("#id_submit").removeClass("disabled");
						
						$("#form_login").unbind();
						$("#form_login").submit( function(event) { sendForm(event, getFormData(event.target), handleResponse) } )
					}
				}
				else
				{
					if( !$("#id_submit").hasClass("disabled") )
					{
						$("#id_submit").addClass("disabled");

						$("#form_login").unbind();
						$("#form_login").submit( function(e){ return false; } )
					}
				}

				setTimeout(validate, 500);
			}
		
			$(document).ready(
				function(){				
					validate();
				}
			);
		</script>
	
		<div class="container">
		
			<br><br><br>
			
			<img src="<?php echo _STATIC?>img/logo-xs.png" class="center-block hidden-lg hidden-md hidden-sm" style="margin-bottom:30px;" />
			<img src="<?php echo _STATIC?>img/logo.png" class="center-block hidden-xs" style="margin-bottom:50px;" />
			
			<div class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>B��d!</strong> <span class="alert-message"></span>
			</div>
			
			<div class="col-sm-8 col-sm-offset-2">
				<form id="form_login" action="ws.php?action=authorize" method="GET">
					<div class="form-group">
						<label class="sr-only" for="id_login">Login</label>
						<div class="input-group login-input-group">
							<div class="input-group-addon"> <span class="glyphicon glyphicon-user"></span> </div>
							<input id="id_login" name="login" type="text" class="form-control input-lg" placeholder="login">
							<div class="input-group-addon input-group-status"> &#9679; </div>
						</div>
					</div>
									
					<div class="form-group">
						<label class="sr-only" for="id_password">Hasło</label>
						<div class="input-group password-input-group">
							<div class="input-group-addon"> <span class="glyphicon glyphicon-lock"></span> </div>
							<input id="id_password" name="password" type="password" class="form-control input-lg" placeholder="hasło">
							<div class="input-group-addon input-group-status"> &#9679; </div>
						</div>
					</div>
					
					<p style="text-align:center; margin-bottom:20px;"> Nie masz konta? <a href="<?php echo _URL?>register.php"> <span class="glyphicon glyphicon-edit"></span> Załóż konto</a> </p>
					
					<button id="id_submit" type="submit" class="btn btn-lg btn-success" style="width:100%;"> <span class="glyphicon glyphicon-log-in"></span> Zaloguj</button>
				</form>
			</div>
		
		</div>
	</body>
</html>