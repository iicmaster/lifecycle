/* ------------------------------------------------------------------------ */
/* interface.js */	
/* ------------------------------------------------------------------------ */
$(function()
{
	/*$("#tab_content_1").fadeIn(350);*/
	$("#tab_heading_button_2").addClass("active");
	$("#tab_content_2").show();
	
	
	$("#tab_heading_button_1").click(function()
	{
		// active tab heading button
		$("#tab_heading_button_group a").removeClass();
		$(this).addClass('active');
		
		// show tab content
		$("div[id^=tab_content_]:not(:hidden)").fadeOut(350, function(){
			$("#tab_content_preload").fadeIn(350, function(){
				$(this).fadeOut(350, function(){
					$("#tab_content_1").fadeIn(350);
				})
			})
		});
		
		$("#LP_bar div").animate({width:"50%"});
		$("#LP_bar i").text("50%");
		
		$("#HS_bar div").animate({width:"100%", backgroundPosition:"0px -60px"});
		$("#HS_bar i").text("ปกติ");
		
		$("#SP_bar div").animate({width:"100%"});
		$("#SP_bar i").text("100%");
		
		$("#STA_bar div").animate({width:"32%"});
		$("#STA_bar i").text("32%");
		
		$("#EXP_bar div").animate({width:"90%"});
		$("#EXP_bar i").text("90%");
		
	});
	
	$("#tab_heading_button_2").click(function()
	{
		// active tab heading button
		$("#tab_heading_button_group a").removeClass();
		$(this).addClass('active');
		
		// change background to current location
		var id_location = $('#section_top_player_location_map').attr('rel');
		$("#interface").css('backgroundImage', 'url(http://localhost/lifecycle/assets/images/map/bg/' + id_location + '.jpg)');
		
		
		// show tab content
		$("div[id^=tab_content_]:not(:hidden)").fadeOut(350, function(){
			$("#tab_content_preload").fadeIn(350, function(){
				$(this).fadeOut(350, function(){
					$("#tab_content_2").fadeIn(350);
				})
			})
		});
		
		
		$("#LP_bar div").animate({width:"99%"});
		$("#LP_bar i").text("99%");
		
		$("#HS_bar div").animate({width:"37%", backgroundPosition:"0px -20px"});
		$("#HS_bar i").text("เล็บขบ");
		
		$("#SP_bar div").animate({width:"2%"});
		$("#SP_bar i").text("2%");
		
		$("#STA_bar div").animate({width:"88%"});
		$("#STA_bar i").text("88%");
		
		$("#EXP_bar div").animate({width:"15%"});
		$("#EXP_bar i").text("15%");
	});
	
	$("#tab_heading_button_3").click(function()
	{
		// active tab heading button
		$("#tab_heading_button_group a").removeClass();
		$(this).addClass('active');
		
		// show tab content
		$("div[id^=tab_content_]:not(:hidden)").fadeOut(350, function(){
			$("#tab_content_preload").fadeIn(350, function(){
				$(this).fadeOut(350, function(){
					$("#tab_content_3").fadeIn(350);
				})
			})
		});
	});
	
	$("#LP_bar").progressbar({value: 50});
	$("#HS_bar").progressbar({value: 100});
	$("#SP_bar").progressbar({value: 100});
	$("#STA_bar").progressbar({value: 32});
	$("#EXP_bar").progressbar({value: 90});
	
	$("#popup_status").dialog({
		autoOpen: false,
		show: 'drop',
		hide: 'drop'
	});
	
	$("#bt_popup_status").click(function() {
		$('#popup_status').dialog('open');
	})
	
	$("#popup_skill").dialog({
		autoOpen: false,
		show: 'drop',
		hide: 'drop'
	});
	
	$("#bt_popup_skill").click(function() {
		$('#popup_skill').dialog('open');
	});
	
})

/* End of file interface.js */
/* Location: ./assets/js/interface.js */	