
<body>
	<div class='container'>
	
		<?php include(_PATH."templates/layout/bar.php");?>
		
		<img src='<?php echo _STATIC?>img/logo-xs.png' class='center-block hidden-lg hidden-md hidden-sm' style='margin-bottom:30px;' />
		<img src='<?php echo _STATIC?>img/logo.png' class='center-block hidden-xs' style='margin-bottom:30px;' />
		
		<?php include(_PATH."templates/layout/menu.php");?>
		
		<div class='row'>
			<div class='well well-lg col-xs-12' style='margin-top:0px;'>
				<?php include($body_content);?>
			</div>
		</div>
		
		<?php include(_PATH."templates/layout/footer.php");?>
	</div>
</body>