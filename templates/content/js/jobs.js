DICTIONARY = new Object();

function getAllJobs()
{
	jsonobj = null;
	
	jobs_url = 'http://www.mantkowicz.pl/kerning/ws.php/?action=getJobs';
	
	if(JOBS_MINE)
	{
		jobs_url = 'http://www.mantkowicz.pl/kerning/ws.php/?action=getJobs&author=<?php echo SessionManager::getInstance()->getUser()->login;?>';
	}
		
	$.ajax({
		type: 'get',  
		url: jobs_url,
		data: '',
		success: function(data) 
		{		
			if( JSON.parse(data).status == 0 || JSON.parse(data).value == null )
			{
				$('#id_content').html( 'Nie znaleziono żadnych wyników' );
			}
			else
			{
				DICTIONARY = JSON.parse(JSON.parse(data).message);
				refreshContentHtml( JSON.parse(data) );
			}
		}
	});
}

function refreshContentHtml(jsonobj)
{
	if( jsonobj.status == 0 || jsonobj.value == null )
	{
		$('#id_content').html( 'Nie znaleziono żadnych wyników' );
	}
	else
	{
		var jobs = JSON.parse(jsonobj.value);

		$('#id_content').html( "<button class='btn btn-lg btn-success center-block' disabled><span style='font-size:14px; margin-right:3px;' class='glyphicon glyphicon-repeat gly-spin'></span> Pobieranie wyników...</button>" );

		contentHTML = 'znaleziono: <strong> ' + jobs.length + ' </strong> rekordów <br><br>';

		for(var job in jobs)
		{
			contentHTML += createElement(jobs[job]);
		}
		
		$('#id_content').html(contentHTML);
	}
}

function deleteJob(jobId)
{
	
	if (confirm('Czy na pewno chcesz usunąć zlecenie o id = ' + jobId + '?') == true)
	{		
		$.ajax({
			type: 'get',  
			url: '<?php echo _URL?>ws.php?action=removeJob',
			data: '&id='+jobId,
			success: function(data) 
			{
				console.log(JSON.parse(data).message);
				getAllJobs();
			}
		});
	}
}

function showDetails(jobId, properties)
{
	var htmlContent  = "<div class='modal-header'> <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button> ";
	    htmlContent += "<h4 class='modal-title' id='myModalLabel'> #" + jobId;
	    <?php if(!$jobs_show_author) echo "htmlContent += '<a class=\'btn btn-danger\' style=\'float:right; margin-right:15px;\' >Zakończ</a>'; ";?>
	    htmlContent += "</h4> </div> <br>";
		htmlContent += "<textarea disabled class='center-block' style='resize:none; width:" + properties.area.width + "px; height:" + properties.area.height + "px; padding:" + properties.area.padding + "px; font-size:" + properties.text.fontSize + "px; font-family:" + 'kerning_font_' + properties.text.fontFamilyName + "'> " + properties.text.content + " </textarea>";
	    htmlContent += "<br> <div class='col-xs-12'> <hr style='border-color:#DDD; margin-top: 0px !important;'></hr> </div> <br>"; 
	
	$('#detailsModal').find('.modal-dialog').find('.modal-content').html(htmlContent);
	$('#detailsModal').modal('toggle');
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
	
	if(job.date_end == '0000-00-00 00:00:00')
	{
		panelHtml += '				<td style="padding:10px;"> <span colspan=\'3\' class=\'glyphicon glyphicon-calendar\' style=\'white-space:nowrap\'> ' + 'nie zakończono' + ' </span> </td> ';
	}
	else
	{
		panelHtml += '				<td style="padding:10px;"> <span colspan=\'3\' class=\'glyphicon glyphicon-calendar\' style=\'white-space:nowrap\'> ' + job.date_end + ' </span> </td> ';
	}
	
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
	<?php if(!$jobs_show_author) echo "panelHtml += '		<a onclick=\'deleteJob(' + job.id + ')\' class=\'btn btn-danger\' style=\'float:right; margin-left:10px;\'> <span class=\'glyphicon glyphicon-trash\'></span> </a>';"?>
	panelHtml += '		<a onclick=\'showDetails(' + job.id + ', ' + job.properties + ')\' class=\'btn btn-primary\' style=\'float:right;\'> <span class=\'glyphicon glyphicon-eye-open\'></span> Zobacz szczegóły </a>';
	panelHtml += '		<br><br> ';
	panelHtml += '	</div> ';
	panelHtml += '</div>';
	panelHtml += '<br>';
	
	return panelHtml;
}

$(document).ready(
	function()
	{
		$('#id_filter').submit( function(event) { sendForm(event, getFormData(event.target), refreshContentHtml) } );
		$('.btn-form-reset').click( function(event) { event.preventDefault(); $('#id_filter')[0].reset(); } );
		
		getAllJobs();
	}
);