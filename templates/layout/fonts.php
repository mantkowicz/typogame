<style>
<?php
foreach (Font::getAll()->value as $font)
{
	echo "
		@font-face 
		{
			font-family: 'kerning_font_$font->name';
			src: url('$font->path');
		}
		
	";
}
?>
</style>