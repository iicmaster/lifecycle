/* ------------------------------------------------------------------------ */
/* interface.guidepost.js */	
/* ------------------------------------------------------------------------ */

$(function()
{
	
	/* ------------------------------------------------------------------------ */
	/* Guidepost */	
	/* ------------------------------------------------------------------------ */

	// get localtion id
	var id_location = $('#section_top_player_location_section').attr('rel');
	get_guidepost(id_location);
	get_npc(id_location);
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Get guidepost in location
	  */
	  
	function get_guidepost(id_location)
	{  
		/* Ajax */
		
		var url = 'http://localhost/lifecycle/main/get_guidepost/' + id_location;
		
		$.post(url, function(data){
			
			var url_image = 'http://localhost/lifecycle/assets/images/guidepost/';
			var content;
			
			$.each(data, function(index){
				
				content = 	'<li>' +
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
		
		var url = 'http://localhost/lifecycle/main/get_npc/' + id_location;
		
		$.post(url, function(data){
			
			var url_image = 'http://localhost/lifecycle/assets/images/npc/';
			var content;
			
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
	
});

/* End of file interface.guidepost.js */
/* Location: ./assets/js/interface.guidepost.js */	