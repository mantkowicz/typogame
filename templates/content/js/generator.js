settingsObject = new Object();
settingsObject.text = new Object();
settingsObject.area = new Object();

function refresh()
{
	settingsObject.text.fontSize = document.getElementById("id_form").elements["fontSize"].value;

	var fontSelect = document.getElementById("id_form").elements["font"];
	
	settingsObject.text.fontFamily =  fontSelect.value;
	settingsObject.text.fontFamilyName = fontSelect.options[fontSelect.selectedIndex].text;
	
	settingsObject.text.content = document.getElementById("id_form").elements["text"].value;
	
	settingsObject.area.width = document.getElementById("id_form").elements["width"].value;
	settingsObject.area.height = document.getElementById("id_form").elements["height"].value;
	settingsObject.area.padding = document.getElementById("id_form").elements["padding"].value;
	
	$("#id_text").css("font-family", settingsObject.text.fontFamilyName);
	
	$("#id_text").css("width", settingsObject.area.width + "px");
	$("#id_text").css("height", settingsObject.area.height + "px");
	$("#id_text").css("padding", settingsObject.area.padding + "px");
	
	$("#id_text").css("font-size", settingsObject.text.fontSize + "px");
	$("#id_text").css("font-family", "kerning_font_"+settingsObject.text.fontFamilyName);
	
	$("#id_text").html(settingsObject.text.content);
}

function handleResponse(data)
{
	if( data.status > 0 )
	{
		window.location.replace("<?php echo _URL?>jobs/mine");
	}
	else
	{
		alert( data.message );
	}
}

function showFileName()
{	
	var filename = $("#id_fontFile").val().replace(/^.*[\\\/]/, "")
	
	if( filename.length > 12 )
	{
		filename = "<abbr title=\""+filename+"\">" + filename.substr(0,12) + "... </abbr>";
	}
	
	$("#id_fontFileLabel").html( "<span class=\"glyphicon glyphicon-file\"></span>" + filename);
}

$(document).ready(
	function()
	{
		$("#id_form").submit( function(event) { sendForm(event, "&properties="+JSON.stringify(settingsObject)+"&points=100&font="+settingsObject.text.fontFamily, handleResponse) } )
		$("#id_form").change( function(event) { refresh() } )
		
		refresh()
	}
);