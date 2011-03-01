/* ------------------------------------------------------------------------ */
/* interface.js */	
/* ------------------------------------------------------------------------ */
$(function()
{
	
	/* ------------------------------------------------------------------------ */
	/* On load */	
	/* ------------------------------------------------------------------------ */
	
	/*$("#tab_content_1").fadeIn(350);*/
	$("#tab_heading_button_3").hide();
	$("#tab_heading_button_4").hide();
	$("#tab_heading_button_2").addClass("active");
	$("#tab_content_2").show();
	
	$("#LP_bar").progressbar({value: 100});
	$("#SP_bar").progressbar({value: 100});
	$("#HS_bar").progressbar({value: 100});
	$("#STA_bar").progressbar({value: 100});
	$("#EXP_bar").progressbar({value: 100});
		
	
	/* ------------------------------------------------------------------------ */
	/* tab_heading */	
	/* ------------------------------------------------------------------------ */
	
	$("#tab_heading_button_1").click(function()
	{
		// active tab heading button
		$("#tab_heading_button_group a").removeClass();
		$(this).addClass('active');
		
		// show tab content
		$("div[id^=tab_content_]:not(:hidden)").fadeOut(350, function(){
			
			$(this).fadeOut(350, function(){
				$("#tab_content_1").fadeIn(350);
			})
			
		});
		
		/*$("#LP_bar div").animate({width:"50%"});
		$("#LP_bar i").text("50%");
		
		$("#STA_bar div").animate({width:"32%"});
		$("#STA_bar i").text("32%");
		
		$("#EXP_bar div").animate({width:"90%"});
		$("#EXP_bar i").text("90%");*/
		
	});
	
	$("#tab_heading_button_2").click(function()
	{
		// active tab heading button
		$("#tab_heading_button_group a").removeClass();
		$("#tab_heading_button_3").hide();
		$(this).addClass('active');
		
		// change background to current location
		var id_location = $('#section_top_player_location_map').attr('rel');
		$("#interface").css('backgroundImage', 'url('+ server_url + 'assets/images/map/bg/' + id_location + '.jpg)');
		
		// show tab content
		$("div[id^=tab_content_]:not(:hidden)").fadeOut(350, function(){
			//$("#tab_content_preload").fadeIn(350, function(){
				$(this).fadeOut(350, function(){
					
					$("#tab_heading_button_4").hide();
					$("#tab_content_2").fadeIn(350);
					
				})
			//})
		});
	});
	
	$("#tab_heading_button_3").click(function()
	{
		// active tab heading button
		$("#tab_heading_button_group a").removeClass();
		$(this).addClass('active');
		
		// show tab content
		$("div[id^=tab_content_]:not(:hidden)").fadeOut(350, function(){
			
			$(this).fadeOut(350, function(){
				$("#tab_content_3").fadeIn(350);
			})
			
		});
	});
	
	/* ------------------------------------------------------------------------ */
	/* Pop-up */	
	/* ------------------------------------------------------------------------ */
	
	// ------------------------------------------------------------------------
	// Status
	// ------------------------------------------------------------------------
	
	$("#popup_status").dialog({
		autoOpen: false,
		show: 'drop',
		hide: 'drop'
	});
	
	$("#bt_popup_status").click(function() {
		$('#popup_status').dialog('open');
	})
	
	// ------------------------------------------------------------------------
	// Skill
	// ------------------------------------------------------------------------
	
	$("#popup_skill").dialog({
		autoOpen: false,
		show: 'drop',
		hide: 'drop'
	});
	
	$("#bt_popup_skill").click(function() {
		$('#popup_skill').dialog('open');
	});
	
	// ------------------------------------------------------------------------
	// Item
	// ------------------------------------------------------------------------
	
	$("#popup_item").dialog({
		autoOpen: false,
		show: 'drop',
		hide: 'drop'
	});
	
	$("#bt_popup_item").click(function() {
		$('#popup_item').dialog('open');
	});
	
	// ------------------------------------------------------------------------
	// Feedback & bug report
	// ------------------------------------------------------------------------
	
	$("#popup_feedback").dialog({
		autoOpen: false,
		show: 'drop',
		hide: 'drop'
	});
	
	$("#bt_popup_feedback").click(function() {
		$('#popup_feedback').dialog('open');
	});
	
	$("#send_feedback").click(function() {
		
		var report_type = ($('#bug:checked').val() == 1) ? 1 : 0;
		var url = server_url + 'main/feedback/' + report_type + '/' + $('#topic').val() + '/' + $('#detail').val();
		
		$.post(url, '', function(result) {
			$('#topic').val('');
			$('#detail').val('');
			$('#popup_feedback').dialog('close');	
		});
		
	});
	
	// ------------------------------------------------------------------------
	
})

/* End of file interface.js */
/* Location: ./assets/js/interface.js */	