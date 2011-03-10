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
	
/*	$("#LP_bar").progressbar({value: 100});
	$("#MP_bar").progressbar({value: 100});
	$("#AGE_bar").progressbar({value: 10});
	$("#STA_bar").progressbar({value: 100});
	$("#EXP_bar").progressbar({value: 50.5});
	$("#LP_bar i").text("50%");*/
	
	set_status_bar('lp');
	set_status_bar('mp');
	set_status_bar('age');
	set_status_bar('sta');
	set_status_bar('exp');
		
	
	/* ------------------------------------------------------------------------ */
	/* tab_heading */	
	/* ------------------------------------------------------------------------ */
	
	$("a[id^=tab_heading_button_]").click(function()
	{
		var id_tab = $(this).attr("rel");
		//alert(id_tab);
		if(! $(this).hasClass("active"))
		{		
			change_tab(id_tab);
		}
	});
	
	$("#button_status").click(function()
	{
		update_status_bar('sta')
	});
	
/*	$("#tab_heading_button_1").click(function()
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
		$("#EXP_bar i").text("90%");
		
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
	});*/
})

function update_status_bar(status)
{
	var value = $("#character_" + status).find("i").text()
	var value_max = $("#character_" + status).find("b").text()
	var percen = value * 100 / value_max;
	var title = "";
	
	percen = String(percen).slice(0,4)
	
	switch(status)
	{
		case 'lp':
		  title = "Life Point: "
		  break;
		case 'mp':
		  title = "Mind Power: "
		  break;
		case 'age':
		  title = "Age: "
		  break;
		case 'sta':
		  title = "Staminar : "
		  break;
		case 'exp':
		  title = "Experience: "
		  break;
	}
	
	$("#" + status + "_bar").find("div").animate({width: percen + "%"})
	$("#" + status + "_bar").find("i").text(percen + "%");
	$("li[rel=" + status + "]").attr('title', title + value + " / " + value_max);
}

function set_status_bar(status)
{
	var value = $("#character_" + status).find("i").text()
	var value_max = $("#character_" + status).find("b").text()
	var percen = value * 100 / value_max
	percen = String(percen).slice(0,4)
	
	$("#" + status + "_bar")
	.progressbar({value: parseFloat(percen)})
	.find('i').text(percen + " %");
}

function change_tab(id_tab)
{
	if(! $("#tab_heading_button_" + id_tab).hasClass("active"))
	{	
		// active tab heading button
		if(id_tab != 'preload')
		{
			$("#tab_heading_button_group a").removeClass();
			$("#tab_heading_button_3, #tab_heading_button_4").hide();
			$("#tab_heading_button_" + id_tab).addClass('active').show();
			
			// clear tab content
			switch(id_tab)
			{
				case 1:
				  
					break;
				  
				case 2:
					if(! $("#tab_heading_button_2").hasClass("active"))
					{		
						alert('55');
						$("#content_npc_item").empty();
						$("#conversation div.tab_content_left").css('backgroundImage', 'none');
						$("#conversation div.tab_content_right").css('backgroundImage', 'none');
						$("#tab_content_4 div.tab_content_right").css('backgroundImage', 'none');
					}
					break;
				  
				case 3:
					$("#content_npc_item").empty();
					$("#conversation div.tab_content_left").css('backgroundImage', 'none');
					break;
				  
				case 4:
				  
					break;
			}
		}
		
		// show tab content
		$("div[id^=tab_content_]:not(:hidden)").fadeOut(350, function(){
			
			$("#tab_content_" + id_tab).fadeIn(350);
			
		});
	}
}

/* End of file interface.js */
/* Location: ./assets/js/interface.js */	