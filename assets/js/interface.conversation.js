/* ------------------------------------------------------------------------ */
/* interface.conversation.js */	
/* ------------------------------------------------------------------------ */

$(function()
{
	
	/* ------------------------------------------------------------------------ */
	/* Conversation */	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Open conversation windows when click NPC
	  */
	  
	$("#content_npc li").live('click', function(){
		
		id_npc = $(this).attr('rel');
		$("#dialog p").attr('rel', id_npc);
		
		// active tab heading button
		$("#tab_heading_button_group a").removeClass();
		$('#tab_heading_button_3').addClass('active').show();
		
		// show tab content
		$("div[id^=tab_content_]:not(:hidden)").fadeOut(350, function(){
			
			$("#content_npc_item").empty();
			$("#conversation div.tab_content_left").css('backgroundImage', 'none');
			$("#conversation div.tab_content_right").css('backgroundImage', 'url('+ server_url + 'assets/images/npc/' + id_npc + '.png)');
			
			get_npc_dialog(id_npc);
			
			$("#tab_content_3").fadeIn(350);
				
		});
		
	});
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Exit Store or company
	  */
	  
	$("#dialog li[type=2]").live('click', function(){
		
		$("#tab_content_3").fadeOut(350, function(){
					
			$("#content_npc_item").empty();
			$("#conversation div.tab_content_right").css('backgroundImage', 'none');
			
			$("#tab_heading_button_3").hide();	
			$("#tab_content_2").fadeIn(350);
			
		})
		
	});
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Taking with NPC
	  */
	  
	$("#dialog li[type=0]").live('click', function(){
		
		var id_npc = $("#dialog p").attr('rel');
		var id_dialog_group = $(this).attr('rel');
		
		get_npc_dialog(id_npc, id_dialog_group);
		
	});
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Buy item from NPC
	  */
	  
	$("#dialog li[type=3]").live('click', function(){
		
		$(this).hide();
		
		var id_npc = $("#dialog p").attr('rel');		
		
		$("#conversation div.tab_content_right").css('backgroundImage', 'none');
		$("#conversation div.tab_content_left").css('backgroundImage', 'url('+ server_url + 'assets/images/npc/' + id_npc + '.png)');
		
		get_npc_item(id_npc);
		
	});
	
	/* ------------------------------------------------------------------------ */

	/**
	  * Get conversation list
	  */
	  
	function get_npc_dialog(id_npc, id_dialog_group)
	{  
		if( id_dialog_group === undefined ) 
		{
			id_dialog_group = '';
		}
		else
		{
			id_dialog_group = '/' + id_dialog_group;	
		}
		
		/* Ajax */
		
		var url = server_url + 'main/get_npc_dialog/' + id_npc + id_dialog_group;
		
		$.post(url, function(data){
			
			$("#dialog p").empty();
			$("#dialog ul").empty();
		
			var url_image = server_url + 'assets/images/guidepost/';
			var content;
			
			$.each(data, function(index){
				
				if(data[index].ordering == 0)
				{
					$("#dialog p").append(data[index].dialog);
				}
				else
				{
					content = '<li rel="' + data[index].id_target + '" type="' + data[index].target_type + '">' + data[index].dialog + '</li>';
								
					$("#dialog ul").append(content);
				}
				
			});
			
		},'json')
		.error(function() { alert('Error get_npc_dialog(' + id_npc + ', ' + id_dialog_group + ')'); })
	}
	
	/* ------------------------------------------------------------------------ */

	/**
	  * Get NPC item for buy
	  */
	  
	function get_npc_item(id_npc)
	{  		
		/* Ajax */
		
		var url = server_url + 'main/get_npc_item/' + id_npc;
		
		$.post(url, function(data){
			
			$("#content_npc_item").empty();
			
			var url_image = server_url + 'assets/images/item/icon/';
			var content;
			
			$.each(data, function(index){
				
				//alert(data[index]);
				//break;
				
				content = 	'<li type="npc_item" rel="'+ data[index][0] +'">' +
								'<img src="' + url_image + data[index][0] + '.png" />' +
								'<h3>' + data[index][1] + '</h3>' +
								'<p class="price">' + data[index][2] + 
								'<span>' + data[index][3] + ' ฿</span>'+
								'</p>' +
							'</li>';
				
				$("#content_npc_item").append(content);
			});
			
		},'json')
		.error(function() { alert('Error get_npc_item(' + id_npc + ')'); })
	}
	
	
});

/* End of file interface.conversation.js */
/* Location: ./assets/js/interface.conversation.js */	