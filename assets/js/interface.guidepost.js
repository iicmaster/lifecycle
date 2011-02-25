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
	  
	var id_location = $('#section_top_player_location_section').attr('rel');
	
	get_guidepost(id_location);
	get_npc(id_location);
	get_section_detail(id_location);
	
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
			
			var url_image = 'http://192.168.9.33/lifecycle/assets/images/guidepost/';
			var content;
			
			$("#content_guidepost").html('');
			
			$.each(data, function(index){
				
				content = 	'<li rel="' + data[index].id_target + '">' +
								'<img src="' + url_image + data[index].image + '.png" />' +
								'<h3>' + data[index].name + '</h3>' +
								'<p>' + data[index].description + '</p>' +
							'</li>';
				
				$("#content_guidepost").append(content);
				//alert(content);
			});
			
			//$("#tab_content_left ul.list").html();
			
			
		},'json');	
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
			
			$("#content_npc").html('');
			
			$.each(data, function(index){
				
				content = 	'<li>' +
								'<img src="' + url_image + data[index].image + '.png" />' +
								'<h3>' + data[index].name + '</h3>' +
								'<p>' + data[index].description + '</p>' +
							'</li>';
				
				$("#content_npc").append(content);
				//alert(content);
			});
			
			//$("#tab_content_left ul.list").html();
			
			
		},'json');
	}
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Change player location
	  */
	  
	function set_character_location(id_location)
	{  
		get_guidepost(id_location);
		get_npc(id_location);
		get_section_detail(id_location);
		
		
		set_location_name('section', id_location);
		get_map_detail(id_location)
	}
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * 
	  */
	  
	function get_section_detail(id_section)
	{  
		var url_image = 'http://192.168.9.33/lifecycle/assets/images/map/path_section/';
		var section_map_pathroot = '<img src="' + url_image + id_section + '.png" />'
		$("#section_pathroot").html(section_map_pathroot);
	}
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Set location name
	  */
	  
	function set_location_name(location_type, id_location)
	{  
		/* Ajax */
		
		var url = 'http://192.168.9.33/lifecycle/main/get_detail/' + location_type  + '/' + id_location;
		
		$.post(url, function(data){
				
			$("#section_top_player_location_"+location_type).html(data['name']);
			$("#section_top_player_location_"+location_type).attr('rel', id_location);			
		},'json');	
	}
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Get map id
	  */
	  
	function get_map_detail(id_section)
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
	
});

/* End of file interface.guidepost.js */
/* Location: ./assets/js/interface.guidepost.js */	