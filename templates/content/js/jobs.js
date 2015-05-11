DICTIONARY = new Object();

function getAllJobs()
{
	jsonobj = null;
	
	$.ajax({
		type: 'post',  
		url: 'http://www.mantkowicz.pl/kerning/ws.php/?action=getJobs',
		data: '',
		success: function(data) 
		{
			DICTIONARY = JSON.parse(JSON.parse(data).message);
			refreshContentHtml( JSON.parse(data).value );
		}
	});
}

function refreshContentHtml(jsonobj)
{
	var jobs = JSON.parse(jsonobj);

	$('#id_content').html( "<button class='btn btn-lg btn-success center-block' disabled><span style='font-size:14px; margin-right:3px;' class='glyphicon glyphicon-repeat gly-spin'></span> Pobieranie wyników...</button>" );

	contentHTML = 'znaleziono: <strong> ' + jobs.length + ' </strong> rekordów <br><br>';

	for(var job in jobs)
	{
		contentHTML += createElement(jobs[job]);
	}
	
	$('#id_content').html(contentHTML);
}

function createElement(job)
{
	var panelHtml = '';
	panelHtml += '<div class=\'panel panel-success\'>';
	panelHtml += '	<div class=\'panel-heading\' style=\'text-align:right;\'>';
	panelHtml += '		<div class=\'avatar-xs\' style=\'float: left;\'> ' + DICTIONARY.users[job.usr_id].substring(0,1) + ' </div> <div style=\'float: left;\'> <strong> ' + DICTIONARY.users[job.usr_id] + ' </strong> </div> ';
	panelHtml += '		# ' + job.id;
	panelHtml += '	</div>';
	panelHtml += '	<div class=\'panel-body\'>';
	panelHtml += '		<table style="padding:10px;">';
	panelHtml += '			<tr>';
	panelHtml += '				<td style="padding:10px;"> <strong> Data: </strong> </td>';
	panelHtml += '				<td style="padding:10px;"> <span class=\'glyphicon glyphicon-calendar\' style=\'white-space:nowrap\'> ' + job.date_start + ' </span> </td> ';
	panelHtml += '			</tr>';
	panelHtml += '			<tr>';
	panelHtml += '				<td style="padding:10px;"></td>';
	panelHtml += '				<td style="padding:10px;"> <span colspan=\'3\' class=\'glyphicon glyphicon-calendar\' style=\'white-space:nowrap\'> ' + job.date_end + ' </span> </td> ';
	panelHtml += '			</tr>';
	panelHtml += '			<tr>';
	panelHtml += '				<td style="padding:10px;"> <strong> Punkty: </strong> </td>';
	panelHtml += '				<td style="padding:10px;" colspan=\'3\'> <span class=\'glyphicon glyphicon-star\'></span> ' + job.points + ' </td> ';
	panelHtml += '			</tr>';	
	panelHtml += '			<tr>';
	panelHtml += '				<td style="padding:10px;"> <strong> Czcionka: </strong> </td>';
	panelHtml += '				<td style="padding:10px;" colspan=\'3\'> <span class=\'glyphicon glyphicon-font\'></span> <span style=\'white-space:nowrap\'> ' + DICTIONARY.fonts[job.fnt_id] + ' </span> </td>';
	panelHtml += '			</tr>';
	panelHtml += '		</table>';
	panelHtml += '	</div>	';
	panelHtml += '	<div class=\'panel-footer\'> ';
	panelHtml += '		<a onclick=\'deleteJob(' + job.id + ')\' class=\'btn btn-danger\' style=\'float:right; margin-left:10px;\'> <span class=\'glyphicon glyphicon-trash\'></span> </a>';
	panelHtml += '		<a class=\'btn btn-primary\' style=\'float:right;\'> <span class=\'glyphicon glyphicon-eye-open\'></span> Zobacz szczegóły </a>';
	panelHtml += '		<br><br> ';
	panelHtml += '	</div> ';
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
		$('#id_filter').submit( function(event) { sendForm(event, getFormData(event.target), refreshContentHtml) } );
		$('.btn-form-reset').click( function(event) { event.preventDefault(); $('#id_filter')[0].reset(); } );
		
		getAllJobs();
	}
);