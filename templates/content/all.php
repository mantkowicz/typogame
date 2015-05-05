<script> <?php include(_PATH."templates/content/js/all.js");?> </script>


<div class='col-xs-12'>
	<form id='id_filter' action='/tp/ws.php?action=getJobs' method='post'>	
		<div class='col-md-3 col-sm-3'>
			<div class='form-group'>
				<label class='sr-only' for='id_author'>Autor</label>
				<div class='input-group'>
					<div class='input-group-addon'> <span class='glyphicon glyphicon-user'></span> </div>
					<input type='text' class='form-control' id='id_author' name='author' placeholder='Autor'>
				</div>
			</div>
		</div>
		
		<div class='col-md-3 col-sm-3'>
			<div class='form-group'>
				<label class='sr-only' for='id_points_start'>Ilość punktów minimalna</label>
				<div class='input-group'>
					<div class='input-group-addon'> <span class='glyphicon glyphicon-star'></span> </div>
					<input type='number' class='form-control' id='id_points_start' name='points_start' placeholder='Punkty'>
				</div>
			</div>
			
			<div class='form-group'>
				<label class='sr-only' for='id_points_end'>Ilość punktów maksymalna</label>
				<div class='input-group'>
					<div class='input-group-addon'> <span class='glyphicon glyphicon-star'></span> </div>
					<input type='number' class='form-control' id='id_points_end' name='points_end' placeholder='Punkty'>
				</div>
			</div>
		</div>
		
		<div class='col-md-3 col-sm-4' style='padding-right:20px;'>
			<div class='form-group'>
				<label class='sr-only' for='id_date_start'>Data utworzenia minimalna</label>
				<div class='input-group'>
					<div class='input-group-addon'> <span class='glyphicon glyphicon-calendar'></span> </div>
					<input type='date' class='form-control' id='id_date_start' name='date_start'>
				</div>
			</div>
			
			<div class='form-group'>
				<label class='sr-only' for='id_date_end'>Data utworzenia maksymalna</label>
				<div class='input-group'>
					<div class='input-group-addon'> <span class='glyphicon glyphicon-calendar'></span> </div>
					<input type='date' class='form-control' id='id_date_end' name='date_end'>
				</div>
			</div>
		</div>
		
		<div class='col-md-3 hidden-lg hidden-sm hidden-xs'>
			<button class='btn btn-danger center-block btn-form-reset' style='width:80%;'> <span class='glyphicon glyphicon-remove-circle'></span> Wyczyść</button>
			<button class='btn btn-success center-block' style='width:80%; margin-top:15px;'> <span class='glyphicon glyphicon-filter'></span> Filtruj</button>
		</div>
		
		<div class='col-md-3 col-sm-2 hidden-lg hidden-md hidden-xs'>
			<button class='btn btn-danger btn-form-reset' style='width:70px; margin-left: 20px;'> <span class='glyphicon glyphicon-remove-circle'></span> </button>
			<button class='btn btn-success' style='width:70px; margin-top:15px; margin-left: 20px;'> <span class='glyphicon glyphicon-filter'></span> </button>
		</div>
		
		<div class='col-md-3 hidden-md hidden-sm'>
			<button class='btn btn-danger center-block btn-form-reset' style='width:100%;'> <span class='glyphicon glyphicon-remove-circle'></span> Wyczyść</button>
			<button class='btn btn-success center-block' style='width:100%; margin-top:15px;'> <span class='glyphicon glyphicon-filter'></span> Filtruj</button>
		</div>
		
		<div class='hidden-lg hidden-md' style='width:100%;height:20px;'></div>
						
	</form>		
	
	<div class='col-xs-12'>
		<hr style='border-color:#DDD; margin-top: 0px !important;'></hr>
	</div>
</div>
	
<div id='id_content' class='col-xs-12'>
	
	<button class='btn btn-lg btn-success center-block' disabled><span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span> Loading...</button>

</div>
