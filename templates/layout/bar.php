<?php require_once _PATH.'handlers/SessionManager.php';?>
<?php require_once _PATH.'classes/models/user.php';?>

<div class='row' style='font-size:18px;'>
	<div class='well well-sm col-xs-12' style='margin-bottom:50px;'>
		<div class='avatar' style='float:left; color:hsl(<?php echo SessionManager::getInstance()->getUser()->getColor();?>, 75%, 75%); background-color:hsl(<?php echo SessionManager::getInstance()->getUser()->getColor();?>, 25%, 50%'>
			<?php echo substr(SessionManager::getInstance()->getUser()->login, 0, 1);?>
		</div>

		<div style='float:left;'>
			Witaj, <strong> <?php echo SessionManager::getInstance()->getUser()->login;?> </strong> <br>
			<h6 style='margin:0px;'><span class='glyphicon glyphicon-star' aria-hidden='true'></span> <strong>120</strong> punktów</h6>
		</div>

		<a class='btn btn-default hidden-xs' href='ws.php?action=logout' style='float:right; margin-top:7px;'> <span class='glyphicon glyphicon-off'></span> Wyloguj</a>
		<a class='btn btn-default btn-lg hidden-lg hidden-md hidden-sm' href='ws.php?action=logout' style='float:right; margin-top:3px;'> <span class='glyphicon glyphicon-off'></span> </a>
	</div>
</div>