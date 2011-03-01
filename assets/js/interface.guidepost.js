/* ------------------------------------------------------------------------ */
/* interface.guidepost.js */	
/* ------------------------------------------------------------------------ */

$(function()
{
	
	/* ------------------------------------------------------------------------ */
	/* Guidepost */	
	/* ------------------------------------------------------------------------ */

	/**
	  * Setup map's name, gutidpost, NPC
	  */
	  
	var id_section = $('#section_top_player_location_section').attr('rel');
	
	set_character_location(id_section);
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Get guidepost in location
	  */
	  
	function get_guidepost(id_location)
	{  
		
		/* Ajax */
		
		var url = server_url + 'main/get_guidepost/' + id_location;
		
		$.post(url, function(data){
			
			$("#content_guidepost").empty();
		
			var url_image = server_url + 'assets/images/guidepost/';
			var content;
			
			$.each(data, function(index){
				
				var alphabet = (data[index].target_type == 'section') ? ' - ' + data[index].alphabet : '';
				
				content = 	'<li rel="' + data[index].id_target + '">' +
								'<img src="' + url_image + data[index].image + '.png" />' +
								'<h3> [ '+ data[index].id_target + alphabet + ' ] ' + data[index].name + '</h3>' +
								'<p>' + data[index].description + '</p>' +
							'</li>';
				
				$("#content_guidepost").append(content);
				
			});
			
		},'json')
		.error(function() { alert('Error get_guidepost(' + id_location + ') แก๊บเช็คด่วนที่ Section: ' + id_location); })
	}
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Get NPC in location
	  */
	  
	function get_npc(id_location)
	{  
		/* Ajax */
		
		var url = server_url + 'main/get_npc/' + id_location;
		
		$.post(url, function(data){
			
			$("#content_npc").empty();
			
			var url_image = server_url + 'assets/images/npc/icon/';
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
		.error(function() { alert('Error get_npc(' + id_location + ') แก๊บเช็คด่วนที่ Section: ' + id_location); })
	}
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Get Monster in location
	  */
	  
	function get_monster(id_location)
	{  
		/* Ajax */
		
		var url = server_url + 'main/get_monster/' + id_location;
		
		$.post(url, function(data){
			
			$("#content_monster").empty();
			
			var url_image = server_url + 'assets/images/monster/icon/';
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
		.error(function() { alert('Error get_monster(' + id_location + ') แก๊บเช็คด่วนที่ Section: ' + id_location); })
	}
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Change player location
	  */
	  
	function set_character_location(id_location)
	{  
	
		//$("#tab_content_2").fadeOut(350, function(){
					
			set_map_detail(id_location)
			set_secticon_name(id_location);
			
			get_guidepost(id_location);
			get_npc(id_location);
			get_monster(id_location);
			
			//$("#tab_content_preload").fadeIn(350, function(){
				
				//$(this).fadeOut(350, function(){
					
					//$("#tab_content_2").fadeIn(350);
					
				//})
				
			//})
			
		//});
	}
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Change
	  */
	  
	$("#content_guidepost li").live('click', function(){
		 
		 var id_location = $(this).attr('rel');
		 
		 set_character_location(id_location);
	
	});
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Set location name and id in #interface > #section_top
	  */
	  
	function set_secticon_name(id_section)
	{  
		/* Ajax */
		
		var url = server_url + 'main/get_detail/section/' + id_section;
		
		$.post(url, function(data){
				
			$('#section_top_player_location_section').html(data['name'] + ' ( ' + id_section + ' )');
			$('#section_top_player_location_section').attr('rel', id_section);	
			
			var url_image = server_url+ 'assets/images/map/path_section/';
			var section_map_pathroot = url_image + id_section + '.png';
			
			$("#section_pathroot").attr('src', section_map_pathroot);
					
		},'json');	
	}
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Set map detail
	  */
	  
	function set_map_detail(id_section)
	{  
		/* Ajax */
		
		var url = server_url + 'main/get_map_detail/' + id_section;
		
		$.post(url, function(data){
			
			$.each(data, function(index){
				
				$('#section_top_player_location_map').html(data[index]['name']);
				$('#section_top_player_location_map').attr('rel', data[index]['id_map']);
				$("#interface").css('backgroundImage', 'url(' + server_url + 'assets/images/map/bg/' + data[index]['id_map'] + '.jpg)');

			});
			
		},'json');	
	}
		
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Teleport to section
	  */
	  
	$('#teleport').click(function(){
			
		var id_section = $('#teleport_target').val();
		set_character_location(id_section);
		
		if($("#tab_content_2").css('display') == 'none')
		{
		
			// show tab content
			$("div[id^=tab_content_]:not(:hidden)").fadeOut(350, function(){
			
				$("#content_npc_item").empty();
				$("#conversation div.tab_content_left").css('backgroundImage', 'none');
				$("#conversation div.tab_content_right").css('backgroundImage', 'none');
			
				$("#tab_heading_button_3").removeClass().hide();
				$('#tab_heading_button_2').addClass('active').show();
				
				$("#tab_content_2").fadeIn(350);
					
			});
		}
		
		//alert('Teleport to Section: ' + id_section);
		
	});
	/* ------------------------------------------------------------------------ */
	
});

/* End of file interface.guidepost.js */
/* Location: ./assets/js/interface.guidepost.js */	