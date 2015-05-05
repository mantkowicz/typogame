<?php require_once _PATH.'handlers/SessionManager.php';?>

<div class='row' style='font-size:18px;'>
	<div class='well well-sm col-xs-12' style='margin-bottom:50px;'>
		<div class='avatar' style='float:left; color:hsl(<?php echo SessionManager::getInstance()->getColor()?>, 75%, 75%); background-color:hsl($color, 25%, 50%'>
			<?php echo SessionManager::getInstance()->getFirstLetter()?>
		</div>

		<div style='float:left;'>
			Witaj, <strong> <?php echo SessionManager::getInstance()->getName()?> </strong> <br>
			<h6 style='margin:0px;'><span class='glyphicon glyphicon-star' aria-hidden='true'></span> <strong>120</strong> punktów</h6>
		</div>

		<a class='btn btn-default hidden-xs' href='index.php?logout=true' style='float:right; margin-top:7px;'> <span class='glyphicon glyphicon-off'></span> Wyloguj</a>
		<a class='btn btn-default btn-lg hidden-lg hidden-md hidden-sm' href='index.php?logout=true' style='float:right; margin-top:3px;'> <span class='glyphicon glyphicon-off'></span> </a>
	</div>
</div>