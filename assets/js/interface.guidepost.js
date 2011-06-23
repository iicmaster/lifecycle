/* ------------------------------------------------------------------------ */
/* interface.guidepost.js */	
/* ------------------------------------------------------------------------ */

$(function()
{
	/* ------------------------------------------------------------------------ */
	
	var id_location = ""
	var location_type = ""
	if($('#section_top_player_location_store').attr('rel') == "")
	{
		location_type = 'section'
		id_location = $('#section_top_player_location_section').attr('rel');
	}
	else
	{
		location_type = 'store';
		id_location = $('#section_top_player_location_store').attr('rel');
	}
	
	change_location(location_type, id_location);
	
	//change_tab(2);
	
	/* ------------------------------------------------------------------------ */
	  
	$("#content_guidepost li").live('click', function(){
		 
		 var id_location = $(this).attr('rel');
		 var location_type = $(this).attr('type');
		 
		 change_location(location_type, id_location);
	
	});
	
	/* ------------------------------------------------------------------------ */
	/**
	  * Teleport
	  */

	$('#teleport_target').keypress(function(event) {
		
		if (event.which == '13') 
		{
			var id_section = $('#teleport_target').val();
			
			change_location('section', id_section);
	
			change_tab(2);
		}
		
	});

	$('#button_teleport').click(function() {
		
		var id_section = $('#teleport_target').val();
		
		change_location('section', id_section);
	
		change_tab(2);
		
	});
	
	/* ------------------------------------------------------------------------ */
	
});

/* ------------------------------------------------------------------------ */
/**
  * Get guidepost in location
  */
  
function get_guidepost(id_location)
{  
	$("#content_guidepost").fadeOut(350, function(){
		
		/* Ajax */
		var url = URL_SERVER + 'main/get_guidepost/' + id_location;
		
		$.post(url, function(data){
			
			$("#content_guidepost").empty();
		
			var url_image = URL_IMAGE + 'guidepost/';
			var content;
			
			$.each(data, function(index){
				
				var alphabet = (data[index].target_type == 'section') ? '[ ' + data[index].alphabet.toUpperCase() + ' ] ' : '';
				
				content = 	'<li rel="' + data[index].id_target + '" type="' + data[index].target_type + '">' +
								'<img src="' + url_image + data[index].image + '.png" />' +
								'<h3>' + alphabet + data[index].name + '</h3>' +
								'<p>' + data[index].description + '</p>' +
							'</li>';
				
				$("#content_guidepost").append(content);
				
			});
			
		},'json')
		.error(function() { alert('Error: get_guidepost(' + id_location + ') แก๊บเช็คด่วนที่ Section: ' + id_location); })
		.complete(function() { $("#content_guidepost").fadeIn(350); });
		
	});
}

/* ------------------------------------------------------------------------ */

/**
  * Get NPC in location
  */
  
function get_npc(id_location)
{  
	$("#content_npc").fadeOut(350, function(){
		
		/* Ajax */
		var url = URL_SERVER + 'main/get_npc/' + id_location;
		
		$.post(url, function(data){
			
			$("#content_npc").empty();
			
			var url_image = URL_IMAGE + 'npc/icon/';
			var content;
			
			$.each(data, function(index){
				
				content = 	'<li type="npc" rel="'+ data[index].id_npc +'">' +
								'<img src="' + url_image + data[index].id_npc + '.png" />' +
								'<h3>' + data[index].name + '</h3>' +
								'<p>' + data[index].description + '</p>' +
							'</li>';
				
				$("#content_npc").append(content);
			});
			
		},'json')
		.error(function() { alert('Error: get_npc(' + id_location + ') แก๊บเช็คด่วนที่ Section: ' + id_location); })
		.complete(function() { $("#content_npc").fadeIn(350); });
		
	});
}

/* ------------------------------------------------------------------------ */

/**
  * Get Monster in location
  */
  
function get_monster(id_location)
{  
	$("#content_monster").fadeOut(350, function(){
		
		/* Ajax */
		var url = URL_SERVER + 'main/get_monster/' + id_location;
		
		$.post(url, function(data){
			
			$("#content_monster").empty();
			
			var url_image = URL_IMAGE + 'monster/icon/';
			var content;
			
			$.each(data, function(index){
				
				content = 	'<li type="monster" rel="'+ data[index].id_monster +'">' +
								'<img src="' + url_image + data[index].id_monster + '.png" alt="' + data[index].id_monster + ' - ' + data[index].name + '" />' +
								'<h3>' + data[index].name + '</h3>' +
								'<p>' + data[index].description + '</p>' +
							'</li>';
				
				$("#content_monster").append(content);
				
			});
			
		},'json')
		.error(function() { alert('Error: get_monster(' + id_location + ') แก๊บเช็คด่วนที่ Section: ' + id_location); })
		.complete(function() { $("#content_monster").fadeIn(350); });	
		
	});
}

/* ------------------------------------------------------------------------ */

/**
  * Set map detail
  */
  
function set_map_detail(id_section)
{  
	/* Ajax */
	
	var url = URL_SERVER + 'main/get_map_detail/' + id_section;
	
	$.post(url, function(data){
		
		if(data['id_map'] != $('#section_top_player_location_map').attr('rel'))
		{
			content = 	'<li style="text-align: center;">' +
							'<h3 style="font-size: 16px;margin: 10px auto;">' + data['name'] + '</h3>' +
							'<img alt="' + data['name'] + '" src="' + URL_IMAGE + 'map/icon/' + data['id_map'] + '.jpg" />' +
						'</li>';
			
			$("#content_notification").empty().removeClass().append(content);
			$('#popup_notification').dialog( "option", "title", 'คุณได้เข้าสู่เขตพื้นที่');
			$('#popup_notification').dialog('open');
		}
		
		var map_name = data['name'] + ' ( ' + data['id_map'] + ' )';
		
		$('#section_top_player_location_map').attr('rel', data['id_map']);
		$('#section_top_player_location_map').html(map_name);
		$("#interface").css('backgroundImage', 'url(' + URL_IMAGE + 'map/bg/' + data['id_map'] + '.jpg)');
		
	}, 'json')
	.error(function() { alert('Error: set_map_detail(' + id_section + '), url: ' + url); });	
}

/* ------------------------------------------------------------------------ */

/**
  * Set location name and id in #interface > #section_top
  */
  
function set_secticon_detail(id_section)
{  
	/* Ajax */
	
	var url = URL_SERVER + 'main/get_detail/section/' + id_section;
	
	$.post(url, function(data){
		
		var section_name = data['name'] + ' ( ' + id_section + ' )';
			
		$('#section_top_player_location_section').attr('rel', id_section);	
		$('#section_top_player_location_section').find('i').html(section_name);
		
		var url_image = URL_IMAGE + 'map/path_section/';
		var section_map_pathroot = url_image + id_section + '.png';
		
		$("#section_pathroot").attr('src', section_map_pathroot);
				
	},'json')
	.error(function() { alert('Error: set_secticon_detail(' + id_section + ')'); });	
}

/* ------------------------------------------------------------------------ */

/**
  * Set store detail
  */
  
function set_store_detail(id_store)
{  
	/* Ajax */
	
	var url = URL_SERVER + 'main/get_detail/store/' + id_store;
	
	$.post(url, function(data){
		
		var store_name = data['name'] + ' ( ' + id_store + ' )';
			
		$('#section_top_player_location_store').attr('rel', id_store);	
		$('#section_top_player_location_store').fadeIn().find('i').html(store_name);
		
		set_map_detail(data['id_section']);
		set_secticon_detail(data['id_section']);
		
	},'json')
	.error(function() { alert('Error: set_store_detail(' + id_store + ')'); });	
}

/* ------------------------------------------------------------------------ */

/**
  * Set character location
  */
  
function set_character_location(location_type, id_location)
{  
	/* Ajax */
	
	var url = URL_SERVER + 'main/set_character_location/' + location_type + '/' + id_location;
	
	$.post(url, function(data){
		
		var sta = parseInt($("#character_sta").find("i").text()) - 1;
		$("#character_sta").find("i").text(sta);
		
		update_status_bar('sta');
		
	},'json')
	.error(function() { alert('Error: set_character_location(' + id_section + ')'); });	
}

/* ------------------------------------------------------------------------ */

/**
  * Change player location
  */
  
function change_location(location_type, id_location)
{  
	if(location_type == 'section')
	{
		set_map_detail(id_location);
		set_secticon_detail(id_location);
		
		$('#section_top_player_location_store').attr('rel', '');	
		$('#section_top_player_location_store').fadeOut().find('i').html('');
	}
	else if(location_type == 'store')
	{
		set_store_detail(id_location);
	}
	
	get_guidepost(id_location);
	get_npc(id_location);
	get_monster(id_location);
	
	set_character_location(location_type, id_location);
}

/* ------------------------------------------------------------------------ */


/* End of file interface.guidepost.js */
/* Location: ./assets/js/interface.guidepost.js */	