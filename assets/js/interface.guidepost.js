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
	  
	$("#content_guidepost li").live('click', function(){
		 
		 var id_location = $(this).attr('rel');
		 
		 set_character_location(id_location);
	
	});
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Get guidepost in location
	  */
	  
	function get_guidepost(id_location)
	{  
		
		/* Ajax */
		
		var url = 'http://192.168.9.33/lifecycle/main/get_guidepost/' + id_location;
		
		$.post(url, function(data){
			
			$("#content_guidepost").html('');
		
			var url_image = 'http://192.168.9.33/lifecycle/assets/images/guidepost/';
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
		
		var url = 'http://192.168.9.33/lifecycle/main/get_npc/' + id_location;
		
		$.post(url, function(data){
			
			var url_image = 'http://192.168.9.33/lifecycle/assets/images/npc/icon/';
			var content;
			
			$("#content_environment").html('');
			
			$.each(data, function(index){
				
				content = 	'<li>' +
								'<img src="' + url_image + data[index].id_npc + '.png" />' +
								'<h3>' + data[index].name + '</h3>' +
								'<p>' + data[index].description + '</p>' +
							'</li>';
				
				$("#content_environment").append(content);
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
		
		var url = 'http://192.168.9.33/lifecycle/main/get_monster/' + id_location;
		
		$.post(url, function(data){
			
			var url_image = 'http://192.168.9.33/lifecycle/assets/images/monster/';
			var content;
			
			$.each(data, function(index){
				
				content = 	'<li>' +
								'<img src="' + url_image + data[index].id_monster + '.png" />' +
								'<h3>' + data[index].name + '</h3>' +
								'<p>' + data[index].description + '</p>' +
							'</li>';
				
				$("#content_environment").append(content);
				//alert(content);
				
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
		set_map_detail(id_location)
		set_secticon_name(id_location);
		
		get_guidepost(id_location);
		get_npc(id_location);
		get_monster(id_location);
	}
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Set location name and id in #interface > #section_top
	  */
	  
	function set_secticon_name(id_section)
	{  
		/* Ajax */
		
		var url = 'http://192.168.9.33/lifecycle/main/get_detail/section/' + id_section;
		
		$.post(url, function(data){
				
			$('#section_top_player_location_section').html(data['name'] + ' ( ' + id_section + ' )');
			$('#section_top_player_location_section').attr('rel', id_section);	
			
			var url_image = 'http://192.168.9.33/lifecycle/assets/images/map/path_section/';
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
		
		var url = 'http://192.168.9.33/lifecycle/main/get_map_detail/' + id_section;
		
		$.post(url, function(data){
			$.each(data, function(index){
				
				$('#section_top_player_location_map').html(data[index]['name']);
				$('#section_top_player_location_map').attr('rel', data[index]['id_map']);
				$("#interface").css('backgroundImage', 'url(http://192.168.9.33/lifecycle/assets/images/map/bg/' + data[index]['id_map'] + '.jpg)');

			});
			
		},'json');	
	}
		
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Teleport to section
	  */
	  
	$('#teleport').click(function(){
		
		var id_section = $('#teleport_target').val();
		set_character_location(id_section)
		
		alert('Teleport to Section: ' + id_section);
	});
	/* ------------------------------------------------------------------------ */
	
});

/* End of file interface.guidepost.js */
/* Location: ./assets/js/interface.guidepost.js */	