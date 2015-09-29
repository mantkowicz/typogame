<div class="col-md-4">

	<div class="row">
		<div class="page-header" style="margin-top:0px;">
			<h3> <span class="glyphicon glyphicon-user"></span> Twoje konto </h3>
		</div>
		
		<table class="table table-striped">
			<tr>
				<td>Dodanych zleceń</td>
				<td><span class="badge"> <?php $result = DatabaseManager::getInstance()->select("select count(*) from job where usr_id = ".(SessionManager::getInstance()->getUser()->id) ); echo $result[0][0]; ?> </span></td>
			</tr>
			
			<tr>
				<td>Dodanych rozwiązań</td>
				<td><span class="badge"> <?php $result = DatabaseManager::getInstance()->select("select count(*) from offer where usr_id = ".(SessionManager::getInstance()->getUser()->id) ); echo $result[0][0]; ?> </span></td>
			</tr>
						
			<tr>
				<td>Zaakceptowanych rozwiązań</td>
				<td><span class="badge"> <?php $result = DatabaseManager::getInstance()->select("select count(*) from offer where win != 0 and usr_id = ".(SessionManager::getInstance()->getUser()->id) ); echo $result[0][0]; ?> </span></td>
			</tr>
			
		</table>

	</div>
	
	<div class="row">
		<div class="page-header" style="margin-top:0px;">
			<h3> <span class="glyphicon glyphicon-th"></span> Odznaki </h3>
		</div>
		
		<div class="col-lg-6 col-lg-offset-0 col-md-12 col-md-offset-0 col-sm-4 col-sm-offset-2 col-xs-6">
		
			<div class="thumbnail">
				<span class="glyphicon glyphicon-pawn" style="<?php $result = DatabaseManager::getInstance()->select("select count(*) from job where usr_id = ".(SessionManager::getInstance()->getUser()->id) ); if( $result[0][0] >= 1 ) echo 'opacity: 1;'; else echo 'opacity: 0.2;'; ?> width:100%; background-color:#ccc; font-size:80px; text-align:center; line-height:100px;"></span>
				<div class="caption">
					<h3>Amator</h3>
					<p>Dodaj co najmniej jedno zlecenie</p>
				</div>
			</div>
			
			<div class="thumbnail">
				<span class="glyphicon glyphicon-king" style="<?php $result = DatabaseManager::getInstance()->select("select count(*) from job where usr_id = ".(SessionManager::getInstance()->getUser()->id) ); if( $result[0][0] >= 10 ) echo 'opacity: 1;'; else echo 'opacity: 0.2;'; ?> width:100%; background-color:#ccc; font-size:80px; text-align:center; line-height:100px;"></span>
				<div class="caption">
					<h3>Webmaster</h3>
					<p>Dodaj co najmniej dziesięć zleceń</p>
				</div>
			</div>
			
		</div>
		
		<div class="col-lg-6 col-md-12 col-sm-4 col-xs-6">
		
			<div class="thumbnail">
				<span class="glyphicon glyphicon-education" style="<?php $result = DatabaseManager::getInstance()->select("select count(*) from offer where usr_id = ".(SessionManager::getInstance()->getUser()->id) ); if( $result[0][0] >= 1 ) echo 'opacity: 1;'; else echo 'opacity: 0.2;'; ?> width:100%; background-color:#ccc; font-size:80px; text-align:center; line-height:100px;"></span>
				<div class="caption">
					<h3>Fan</h3>
					<p>Dodaj co najmniej jedno rozwiązanie</p>
				</div>
			</div>
			
			<div class="thumbnail">
				<span class="glyphicon glyphicon-sunglasses" style="<?php $result = DatabaseManager::getInstance()->select("select count(*) from offer where usr_id = ".(SessionManager::getInstance()->getUser()->id) ); if( $result[0][0] >= 10 ) echo 'opacity: 1;'; else echo 'opacity: 0.2;'; ?> width:100%; background-color:#ccc; font-size:80px; text-align:center; line-height:100px;"></span>
				<div class="caption">
					<h3>Specjalista</h3>
					<p>Dodaj conajmniej dziesięć rozwiązań</p>
				</div>
			</div>
		
		</div>
		
	</div>

</div>

<div class="col-md-7 col-md-offset-1">

	<div class="row">
		<div class="page-header" style="margin-top:0px;">
			<h3> 
				<span class="glyphicon glyphicon-list-alt"></span> Ranking 
				<small>użytkownicy o niezerowej liczbie punktów</small>  
			</h3> 
		</div>
		
		<table class="table">
			<thead>
				<th>#</th>
				<th>Użytkownik</th>
				<th>Suma punktów</th>
				<th>Średnia ocena</th>
			</thead>
			<tbody>
			<?php 
			$result = DatabaseManager::getInstance()->select("select usr_id, sum(score) from offer group by usr_id order by 2 desc" );
			
			$counter = 1;
			
			if( $result[0] != null )
			{
				foreach($result as $r)
				{					
					echo "<tr>";
					echo "<td>".$counter."</td>";
					echo "<td>mantkowicz</td>";
					echo "<td>".$r[1]."</td>";
					echo "<td>94%</td>";
					echo "</tr>";
					
					$counter++;
				}
			}
			
			?>
			</tbody>
		</table>
	</div>

</div>