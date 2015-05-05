settingsObject = new Object();
settingsObject.text = new Object();
settingsObject.area = new Object();

function refresh()
{
	settingsObject.text.fontSize = document.getElementById("id_form").elements["fontSize"].value;
	settingsObject.text.fontFamily = JSON.parse( document.getElementById("id_form").elements["font"].value ).fontId;
	settingsObject.text.fontFamilyName = JSON.parse( document.getElementById("id_form").elements["font"].value ).fontName;
	
	settingsObject.text.content = document.getElementById("id_form").elements["text"].value;
	
	settingsObject.area.width = document.getElementById("id_form").elements["width"].value;
	settingsObject.area.height = document.getElementById("id_form").elements["height"].value;
	settingsObject.area.padding = document.getElementById("id_form").elements["padding"].value;
	
	$("#id_text").css("font-family", settingsObject.text.fontFamilyName);
	
	$("#id_text").css("width", settingsObject.area.width + "px");
	$("#id_text").css("height", settingsObject.area.height + "px");
	$("#id_text").css("padding", settingsObject.area.padding + "px");
	
	$("#id_text").css("font-size", settingsObject.text.fontSize + "px");
	$("#id_text").css("font-family", settingsObject.text.fontFamily);
	
	$("#id_text").html(settingsObject.text.content);
}

function ss(a)
{
	if( a.status == false )
	{
		alert( "Wystąpił błąd bazy danych!" );
	}
	else
	{
		window.location.replace("<?php echo _URL?>jobs/mine");
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
		$("#id_form").submit( function(event) { sendForm(event, "&properties="+JSON.stringify(settingsObject), ss) } )
	}
);