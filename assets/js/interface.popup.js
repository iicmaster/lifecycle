/* ------------------------------------------------------------------------ */
/* interface.js */	
/* ------------------------------------------------------------------------ */
$(function()
{
	
	/* ------------------------------------------------------------------------ */
	/* Pop-up */	
	/* ------------------------------------------------------------------------ */
	
	$("#popup_notification, #popup_status, #popup_skill, #popup_item, #popup_feedback").dialog({
		autoOpen: false,
		show: 'drop',
		hide: 'drop'
	});
	
	// ------------------------------------------------------------------------
	// Notification
	// ------------------------------------------------------------------------
	
	$("#popup_notification").dialog({
		show: 'bounce'
	});
	
	// ------------------------------------------------------------------------
	// Status
	// ------------------------------------------------------------------------
	
	$("#bt_popup_status").click(function() {
		$('#popup_status').dialog('open');
	})
	
	// ------------------------------------------------------------------------
	// Skill
	// ------------------------------------------------------------------------
	
	$("#bt_popup_skill").click(function() {
		$('#popup_skill').dialog('open');
	});
	
	// ------------------------------------------------------------------------
	// Item
	// ------------------------------------------------------------------------
	
	$("#bt_popup_item").click(function() {
		
		if(!$('#popup_item').dialog( "isOpen" ))
		{
			get_character_item()
		}
		
		$('#popup_item').dialog('open');
	});
	
	// ------------------------------------------------------------------------
	// Feedback & bug report
	// ------------------------------------------------------------------------
	
	$("#bt_popup_feedback").click(function() {
		$('#popup_feedback').dialog('open');
	});
	
	$("#send_feedback").click(function() {
		
		/* AJAX */
		
		var report_type = ($('#bug:checked').val() == 1) ? 1 : 0;
		var url = URL_SERVER + 'main/feedback/' + report_type + '/' + $('#topic').val() + '/' + $('#detail').val();
		
		$.post(url, '', function(result) {
			$('#topic').val('');
			$('#detail').val('');
			$('#popup_feedback').dialog('close');	
		});
		
	});
	
	// ------------------------------------------------------------------------
	
})
		
function get_character_item()
{  
	/* AJAX */

	var url = URL_SERVER + 'main/get_character_item';
	var url_image = URL_IMAGE + 'item/icon/';
	$("#content_character_item").html('');
	
	$.post(url, function(data) {
		
		$.each(data, function(index){
												
			content = 	'<li>' +
							'<img src="' + url_image + data[index].id_item + '.png" />' +
							'<h3>' + data[index].name + ' <span>' + data[index].quantity + '</span></h3>' +
						'</li>';
			
			$("#content_character_item").append(content);
		
		});
		
	},'json')
	.error(function() { alert('Error get_character_item(), url: '+ url); })
}

/* End of file interface.js */
/* Location: ./assets/js/interface.js */	