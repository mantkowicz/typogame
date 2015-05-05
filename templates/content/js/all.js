function go()
{
	jsonobj = null;
	
	$.ajax({
		type: 'post',  
		url: '"._URL."ws.php/?action=getJobs',
		data: '',
		success: function(data) 
		{
			refreshContentHtml( JSON.parse(data).jobs );
		}
	});
}

function refreshContentHtml(jsonobj)
{
	$('#id_content').html( '<button class=\'btn btn-lg btn-success center-block\' disabled><span class=\'glyphicon glyphicon-refresh glyphicon-refresh-animate\'></span> Loading...</button>' );

	contentHTML = 'znaleziono: <strong> ' + jsonobj.length + ' </strong> rekordów <br><br>';
	
	for(var x in jsonobj)
	{
		contentHTML += createElement(jsonobj[x]);
	}
	
	$('#id_content').html(contentHTML);
}

function createElement(json)
{
	var panelHtml = '';
	panelHtml += '<div class=\'panel panel-success\'>';
	panelHtml += '	<div class=\'panel-heading\' style=\'text-align:right;\'>';
	panelHtml += '		<div class=\'avatar-xs\' style=\'float: left;\'> ' + json.user_name.substring(0,1) + ' </div> <div style=\'float: left;\'> <strong> ' + json.user_name + ' </strong> </div> ';
	panelHtml += '		# ' + json.id;
	panelHtml += '	</div>';
	panelHtml += '	<div class=\'panel-body\'>';
	panelHtml += '		<table>';
	panelHtml += '			<tr>';
	panelHtml += '				<td> <strong> Data: </strong> </td>';
	panelHtml += '				<td> <span class=\'glyphicon glyphicon-calendar\' style=\'white-space:nowrap\'> ' + json.date_start + ' </span> </td> ';
	panelHtml += '			</tr>';
	panelHtml += '			<tr>';
	panelHtml += '				<td></td>';
	panelHtml += '				<td> <span colspan=\'3\' class=\'glyphicon glyphicon-calendar\' style=\'white-space:nowrap\'> ' + json.date_end + ' </span> </td> ';
	panelHtml += '			</tr>';
	panelHtml += '			<tr>';
	panelHtml += '				<td> <strong> Punkty: </strong> </td>';
	panelHtml += '				<td colspan=\'3\'> <span class=\'glyphicon glyphicon-star\'></span> ' + json.points + ' </td> ';
	panelHtml += '			</tr>';	
	panelHtml += '			<tr>';
	panelHtml += '				<td> <strong> Czcionka: </strong> </td>';
	panelHtml += '				<td colspan=\'3\'> <span class=\'glyphicon glyphicon-font\'></span> <span style=\'white-space:nowrap\'> ' + json.font_name + ' </span> </td>';
	panelHtml += '			</tr>';
	panelHtml += '		</table>';
	panelHtml += '		<a class=\'btn btn-primary\' style=\'float:right;\'> <span class=\'glyphicon glyphicon-eye-open\'></span> Zobacz szczegóły </a>';
	panelHtml += '	</div>	';
	panelHtml += '</div>';
	panelHtml += '<br>';
	
	return panelHtml;
}

function showme(e, fd)
{
	alert( fd );
	e.preventDefault();
}

$(document).ready(
	function()
	{
		$('#id_filter').submit( function(event) { sendForm(event, getFormData(event.target), refreshContentHtml) } )
		$('.btn-form-reset').click( function(event) { event.preventDefault(); $('#id_filter')[0].reset(); } )
	}
);