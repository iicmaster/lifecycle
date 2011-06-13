/* ------------------------------------------------------------------------ */
/* interface.battle.js */	
/* ------------------------------------------------------------------------ */

$(function()
{
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Start battle when click monster
	  */
	  
	$("#content_monster li").live('click', function(){
		
		id_monster = $(this).attr('rel');
		
		//change_tab('preload');
		get_battle_result(id_monster);
		
	});
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Exit battle mode return to guidpost monde
	  */
	  
	$("#button_finish_battle").click(function(){
		
		change_tab(2);
		
	});
	
});	

/* ------------------------------------------------------------------------ */

/**
  * Get battel result
  */
  
function get_battle_result(id_monster)
{  
	$("#tab_content_4 div.tab_content_right").css('backgroundImage', 'url('+ URL_IMAGE + 'monster/' + id_monster + '.png)');
	
	/* Ajax */
	
	var url = URL_SERVER + 'main/get_battle_result/' + id_monster;
	
	$.post(url, function(data){
		
		var url_image = URL_IMAGE + 'monster/';
		var content;
		
			
		if(data.win == 'character')
		{
			var msg_lose = (data.monster_die == 0) ? 'LOSE' : 'DIE';
			
			// clear notification data
			$("#content_notification").removeClass()
									  .addClass('popup_item')
									  .html('')
									  .append('<li><h3>คุณได้รับ...</h3></li>')
									  .append('<li><h3>ค่าประสบการณ์: ' + data.battle_exp + '</h3></li>');
									  
			$("#tab_content_4 div.tab_content_left h2").removeClass().addClass('battle_win').html('WIN');
			$("#tab_content_4 div.tab_content_right h2").removeClass().addClass('battle_lose').html(msg_lose);
			$("#button_finish_battle").html('จบการต่อสู้');
			
			// set receive item to notification
			var url_image = URL_IMAGE + 'item/icon/';
			$(data.item).each(function(index){
				
				//alert(this.name);
				
				content = 	'<li>' +
								'<img src="' + url_image + this.id_item + '.png" />' +
								'<h3>' + this.name + ' <span>' + this.quantity + '</span></h3>' +
							'</li>';
				
				$("#content_notification").append(content);
			});
			
			$('#popup_notification').dialog( "option", "title", 'คุณชนะการต่อสู้' );
			$('#popup_notification').dialog('open');
		
			// Update EXP
			var EXP = parseInt($("#character_exp").find("i").text()) +  parseInt(data.battle_exp);
			$("#character_exp").find("i").text(EXP);
			update_status_bar('exp');
		}
		else
		{
			var msg_lose = (data.character_die == 0) ? 'LOSE' : 'DIE';
			
			$("#tab_content_4 div.tab_content_right h2").removeClass().addClass('battle_win').html('WIN');
			$("#tab_content_4 div.tab_content_left h2").removeClass().addClass('battle_lose').html(msg_lose);
			
			if(data.character_die == 1)
			{
				$("#button_finish_battle").html('ไปเกิดใหม่');
			}
			else
			{
				$("#button_finish_battle").html('จบการต่อสู้');
			}
		}
					
		$("#character_battle_attack i").html(data.character_attack);
		$("#character_battle_defend i").html(data.character_defend);
		$("#character_battle_damage i").html(data.character_damage);
		
		$("#monster_battle_attack i").html(data.monster_attack);
		$("#monster_battle_defend i").html(data.monster_defend);
		$("#monster_battle_damage i").html(data.monster_damage);
		
	},'json')
	.error(function() { alert('Error get_battle_result(' + id_monster + ')'); })
	.complete(function() { change_tab(4); });
}

/* ------------------------------------------------------------------------ */

/* End of file interface.battle.js */
/* Location: ./assets/js/interface.battle.js */	