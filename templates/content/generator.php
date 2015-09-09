<script> <?php include(_PATH."templates/content/js/generator.js");?> </script>


<form action='<?php echo _URL?>ws.php?action=addFont' method='post' enctype='multipart/form-data' style='margin-bottom:20px;'>
	<div class='col-lg-2 col-md-2 col-sm-3'>
		<input type='file' name='fontFile' id='id_fontFile' class='custom-file-input' onchange='showFileName()'>
	</div>
	<div class='col-lg-2 col-md-3 col-sm-3' style='line-height:35px;'>
		<p id='id_fontFileLabel'><span class='glyphicon glyphicon-file'></span> ... </p>
	</div>
	<div class='hidden-lg hidden-md hidden-sm' style='height:20px;'></div>
	<div class='col-lg-7 col-md-7 col-sm-4'>
		<button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-cloud-upload'></span> Dodaj </button>
	</div>
</form>

<div class='col-xs-12'>
	<hr style='border-color:#DDD;'>
</div>

<form id='id_form' action='<?php echo _URL?>ws.php?action=addJob' method='post'>	
	<div class='col-lg-2 col-sm-4' style='padding: 0px;'>
		<div class='col-xs-12'>
			<div class='form-group'>
				<label class='sr-only' for='id_width'>Szerokość w pikselach</label>
				<div class='input-group'>
					<div class='input-group-addon'> <span class='glyphicon glyphicon-resize-horizontal'></span> </div>
					<input type='number' class='form-control' value='800' id='id_width' name='width' max='2048'>
					<div class='input-group-addon'>px</div>
				</div>
			</div>
		</div>
		
		<div class='col-xs-12'>
			<div class='form-group'>
				<label class='sr-only' for='id_height'>Wysokość w pikselach</label>
				<div class='input-group'>
					<div class='input-group-addon'> <span class='glyphicon glyphicon-resize-vertical'></span> </div>
					<input type='number' class='form-control' value='800' id='id_height' name='height' max='2048'>
					<div class='input-group-addon'>px</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class='col-lg-2 col-sm-4' style='padding: 0px;'>
		<div class='col-xs-12'>
			<div class='form-group'>
				<label class='sr-only' for='id_indent'>wciecie</label>
				<div class='input-group'>
					<div class='input-group-addon'> <span class='glyphicon glyphicon-indent-left'></span> </div>
					<input type='number' class='form-control' value='0' id='id_indent' name='indent' max='999'>
					<div class='input-group-addon'>px</div>
				</div>
			</div>
		</div>
		
		<div class='col-xs-12'>
			<div class='form-group'>
				<label class='sr-only' for='id_lineHeight'>interlinia</label>
				<div class='input-group'>
					<div class='input-group-addon'> <span class='glyphicon glyphicon glyphicon-sort-by-alphabet'></span> </div>
					<input type='number' class='form-control' value='12' id='id_lineHeight' name='lineHeight' max='999'>
					<div class='input-group-addon'>px</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class='col-lg-2 col-sm-4'>
		<div class='form-group'>
			<label class='sr-only' for='id_padding'>Padding</label>
			<div class='input-group'>
				<div class='input-group-addon'> <span class='glyphicon glyphicon-resize-small'></span> </div>
				<input type='number' class='form-control' value='10' id='id_padding' name='padding' max='1024'>
				<div class='input-group-addon'>px</div>
			</div>
		</div>
	</div>
	
	<div class='col-lg-2 col-sm-4'>
		<div class='form-group'>
			<label class='sr-only' for='id_fontSize'>Rozmiar czcionki</label>
			<div class='input-group'>
				<div class='input-group-addon'> <span class='glyphicon glyphicon-text-height'></span> </div>
				<input type='number' class='form-control' value='12' id='id_fontSize' name='fontSize' max='1024'>
				<div class='input-group-addon'>px</div>
			</div>
		</div>
	</div>
		
	<div class='col-lg-2 col-sm-4'>
		<div class='form-group'>
			<label class='sr-only' for='id_font'>Czcionka</label>
			<select class='form-control' id='id_font' name='font' style='font-family: inherit;'>";
		
			<?php 
				foreach(Font::getAll()->value as $font)
				{
					echo "<option value='$font->id'> $font->name </option>";
				}
			?>
			
			</select>
		</div>
	</div>
	
	<div class='col-lg-2 col-sm-4'>
		<button type='submit' class='btn btn-success' style='width:100%;'> <span class='glyphicon glyphicon-save'></span> Zapisz</button>
	</div>
	
	<div class='col-xs-12'>
		<hr style='border-color:#DDD; margin-top:0px !important;'>
	</div>
	
	<div class='col-xs-12'>
		<div class='form-group'>
			<label class='sr-only' for='id_text'>Tekst</label>
			<textarea class='form-control center-block' placeholder='Twój tekst...' rows='4' id='id_text' name='text' style='resize:none;'></textarea>
		</div>
	</div>

</form>