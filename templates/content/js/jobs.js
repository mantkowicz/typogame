var USERS = new Array()
var FONTS = new Array()
var OFFERS = new Array()

function getAllUsers()
{
	$.ajax({
		type: 'get',  
		url: 'http://www.mantkowicz.pl/kerning/ws.php?action=getUsers',
		data: '',
		success: function(data) 
		{		
			if( JSON.parse(data).status == 0 || JSON.parse(data).value == null )
			{
				return null;
			}
			else
			{
				var tempArray = JSON.parse( JSON.parse(data).value ).value;
				
				for(var i = 0; i < tempArray.length; i++)
				{
					USERS[ tempArray[i].id ] = tempArray[i];
				}
			}
		}
	});
}

function getAllFonts()
{
	$.ajax({
		type: 'get',  
		url: 'http://www.mantkowicz.pl/kerning/ws.php?action=getFonts',
		data: '',
		success: function(data) 
		{		
			if( JSON.parse(data).status == 0 || JSON.parse(data).value == null )
			{
				return null;
			}
			else
			{
				var tempArray = JSON.parse( JSON.parse(data).value ).value;
				
				for(var i = 0; i < tempArray.length; i++)
				{
					FONTS[ tempArray[i].id ] = tempArray[i];
				}
			}
		}
	});
}

function getAllOffers()
{
	$.ajax({
		type: 'get',  
		url: 'http://www.mantkowicz.pl/kerning/ws.php?action=getOffers',
		data: '',
		success: function(data) 
		{		
			if( JSON.parse(data).status == 0 || JSON.parse(data).value == null )
			{
				return null;
			}
			else
			{
				var tempArray = JSON.parse( JSON.parse(data).value ).value;
				
				for(var i = 0; i < tempArray.length; i++)
				{
					OFFERS[ tempArray[i].id ] = tempArray[i];
				}
			}
		}
	});
}

function getAllJobs()
{
	getAllUsers();
	getAllFonts();
	getAllOffers();
	
	$(document).ajaxStop(
		function () 
		{
			doGetAllJobs();
			
			$(this).unbind("ajaxStop");
		}
	);
}

function doGetAllJobs()
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
		global: false,
		success: function(data) 
		{		
			if( JSON.parse(data).status == 0 || JSON.parse(data).value == null )
			{
				$('#id_content').html( 'Nie znaleziono żadnych wyników' );
			}
			else
			{
				refreshContentHtml( JSON.parse(data) );
			}
		}
	});
}

function refreshContentHtml(jsonstr)
{
	jsonobj = JSON.parse(jsonstr.value);
	
	if( jsonobj == null || jsonobj.status == 0 || jsonobj.value == null )
	{
		$('#id_content').html( 'Nie znaleziono żadnych wyników' );
	}
	else
	{
		var jobs = jsonobj.value;

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

function finishJob(jobId)
{
	
	if (confirm('Czy chcesz zakończyć zlecenie o id = ' + jobId + ' z datą YYYY-MM-DD?') == true)
	{		
		/*$.ajax({
			type: 'get',  
			url: '<?php echo _URL?>ws.php?action=removeJob',
			data: '&id='+jobId,
			success: function(data) 
			{
				console.log(JSON.parse(data).message);
				getAllJobs();
			}
		});*/
	}
}

function showDetails(job)
{
	var htmlContent  = "<div class='modal-header'> <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button> ";
	    htmlContent += "<h4 class='modal-title' id='myModalLabel'> #" + job.id;
	    htmlContent += "</h4> </div> <br>";
	    htmlContent += "<textarea disabled class='center-block' style='resize:none; text-indent: " + job.indent  + "px; line-height: " + job.lineHeight + "px; width:" + job.width + "px; height:" + job.height + "px; padding:" + job.padding + "px; font-size:" + job.font_size + "px; font-family:" + 'kerning_font_' + FONTS[job.fnt_id].name + "'>" + job.content + "</textarea>";
	    htmlContent += "<br> <div class='col-xs-12'> <hr style='border-color:#DDD; margin-top: 0px !important;'></hr> </div> <br>"; 
	
    for(var i = 0; i < OFFERS.length; i++)
	{
		if( OFFERS[i] != null && OFFERS[i].job_id == job.id )
		{
			var modalWidth = $('#detailsModal').find('.modal-dialog').css('width');

			htmlContent += "<hr>";
			htmlContent += "<img src='data:image/png;base64," + OFFERS[i].html + "' style='-webkit-filter: invert(1); filter: invert(1); margin-left:" + (modalWidth.substring(0, modalWidth.length-2) - job.width)/2.0 + "px;' >";
			
			htmlContent += "<div style='text-align:center;'>";
			htmlContent += "<table valign='middle' style='margin-top:20px; margin-left:" + (modalWidth.substring(0, modalWidth.length-2) - 450)/2 + "px;' > <tr> <td> <span class='glyphicon glyphicon-user'></span> " + USERS[OFFERS[i].usr_id].login + " &nbsp&nbsp&nbsp&nbsp </td> <td> <span class='glyphicon glyphicon-calendar'></span> " + OFFERS[i].date  + " &nbsp&nbsp&nbsp&nbsp </td> <td> <span class='glyphicon glyphicon-star'></span> " + OFFERS[i].score + " &nbsp&nbsp&nbsp&nbsp </td>";

			if( OFFERS[i].win == "0" )
				htmlContent += "<td> <a class='btn btn-warning' href='http://www.mantkowicz.pl/kerning/ws.php?action=setOfferWin&id=" + OFFERS[i].id + "'> <span class='glyphicon glyphicon-thumbs-up'></span> dobre rozwiązanie </a> </td>";
			else
				htmlContent += "<td> <span class='label label-success'> <span class='glyphicon glyphicon-sunglasses'></span> nagrodzona oferta </span> </td>";
			
			htmlContent += "</tr> </table>";
			
			htmlContent += "</div>";
			
			htmlContent += "<hr>";
		}
	}
	    
	$('#detailsModal').find('.modal-dialog').find('.modal-content').html(htmlContent);
	$('#detailsModal').modal('toggle');
}

function createElement(job)
{
	var panelHtml = '';
	panelHtml += '<div class=\'panel panel-success\'>';
	panelHtml += '	<div class=\'panel-heading\' style=\'text-align:right;\'>';
	panelHtml += '		<div class=\'avatar-xs\' style=\'float: left;\'> ' + USERS[job.usr_id].login.substring(0,1) + ' </div> <div style=\'float: left;\'> <strong> ' + USERS[job.usr_id].login + ' </strong> </div> ';
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
	panelHtml += '				<td style="padding:10px;" colspan=\'3\'> <span class=\'glyphicon glyphicon-font\'></span> <span style=\'white-space:nowrap\'> ' + FONTS[job.fnt_id].name + ' </span> </td>';
	panelHtml += '			</tr>';
	panelHtml += '		</table>';
	panelHtml += '	</div>	';
	panelHtml += '	<div class=\'panel-footer\'> ';
	<?php if(!$jobs_show_author) echo "panelHtml += '		<a onclick=\'deleteJob(' + job.id + ')\' class=\'btn btn-danger\' style=\'float:right; margin-left:10px;\'> <span class=\'glyphicon glyphicon-trash\'></span> </a>';"?>
	<?php if(!$jobs_show_author) echo "panelHtml += '		<a onclick=\'finishJob(' + job.id + ')\' class=\'btn btn-warning\' style=\'float:right; margin-left:10px;\' > <span class=\'glyphicon glyphicon-flag\'></span> Zakończ</a>'; ";?>
	panelHtml += '		<a onclick=\'showDetails(' + JSON.stringify(job) + ')\' class=\'btn btn-primary\' style=\'float:right;\'> <span class=\'glyphicon glyphicon-eye-open\'></span> Zobacz szczegóły </a>';
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