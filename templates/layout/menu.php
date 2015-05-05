<?php 
	$home = "";
	$mine = "";
	$jobs = "";
	$add = "";
	
	if( strpos(getcwd(),'/jobs/mine') !== false )
	{
		$mine = 'class="active"';
	}
	else if( strpos(getcwd(),'/jobs/add') !== false )
	{
		$add = 'class="active"';
	}
	else if( strpos(getcwd(),'/jobs') !== false )
	{
		$jobs = 'class="active"';
	}
	else
	{
		$home = 'class="active"';
	}
?>


<ul class="nav nav-tabs hidden-xs" style="margin-top:50px;">
  <li role="presentation" <?php echo $home ?> ><a href="<?php echo _URL?>"> <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Strona główna</a></li>
  <li role="presentation" <?php echo $mine ?> ><a href="<?php echo _URL?>jobs/mine/"> <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span> Twoje zlecenia</a></li>
  <li role="presentation" <?php echo $jobs ?> ><a href="<?php echo _URL?>jobs/"> <span class="glyphicon glyphicon-list" aria-hidden="true"></span> Wszystkie zlecenia</a></li>
  <li role="presentation" <?php echo $add  ?> ><a href="<?php echo _URL?>jobs/add/"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Dodaj zlecenie</a></li>
</ul>

<ul class="nav nav-pills nav-stacked hidden-lg hidden-md hidden-sm" style="margin-bottom:20px;">
  <li role="presentation" <?php echo $home ?> ><a href="<?php echo _URL?>"> <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Strona główna</a></li>
  <li role="presentation" <?php echo $mine ?> ><a href="<?php echo _URL?>jobs/mine/"> <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span> Twoje zlecenia</a></li>
  <li role="presentation" <?php echo $jobs ?> ><a href="<?php echo _URL?>jobs/"> <span class="glyphicon glyphicon-list" aria-hidden="true"></span> Wszystkie zlecenia</a></li>
  <li role="presentation" <?php echo $add  ?> ><a href="<?php echo _URL?>jobs/add/"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Dodaj zlecenie</a></li>
</ul>
