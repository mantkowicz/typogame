<?php if($jobs_show_author) echo"<script>JOBS_MINE=false;</script>"; else echo"<script>JOBS_MINE=true;</script>";?>

<script> <?php include(_PATH."templates/content/js/jobs.js");?> </script>


<div class='col-xs-12'>

	<div id="detailsModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content" style="padding:15px;">
				
			</div>
		</div>
	</div>

	<form id='id_filter' action='<?php echo _URL?>ws.php?action=getJobs' method='get'>	
		<div class='col-md-3 col-sm-3'>			
			<div class='form-group'>
				<label class='sr-only' for='id_fnt_id'>Czcionka</label>
				<div class='input-group'>
				<div class='input-group-addon'> <span class='glyphicon glyphicon-font'></span> </div>
					<select class='form-control' id='id_fnt_id' name='fnt_id'>
						
						<?php 
							foreach(Font::getAll()->value as $font)
							{
								echo "<option value='$font->id'> $font->name </option>";
							}
						?>
						
					</select>
				</div>
			</div>
			
			<div class='form-group' <?php if(!$jobs_show_author) echo "style='height:0px; margin:0px; padding:0px;'";?>>
				<label class='sr-only' for='id_author'>Autor</label>
				<div class='input-group'>
					<?php if($jobs_show_author) echo"<div class='input-group-addon'> <span class='glyphicon glyphicon-user'></span> </div>"?>
					<input type='<?php if(!$jobs_show_author) echo "hidden"; else echo "text";?>' class='form-control' id='id_author' name='author' placeholder='Autor' <?php if(!$jobs_show_author) echo "value='".SessionManager::getInstance()->getUser()->login."'"?>>
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
		</div>
		
		<div class='col-md-3 col-sm-3'>
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
	
	<button class='btn btn-lg btn-success center-block' disabled><span style="font-size:14px; margin-right:3px;" class='glyphicon glyphicon-repeat gly-spin'></span> Pobieranie wyników...</button>

</div>
