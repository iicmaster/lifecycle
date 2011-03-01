/* ------------------------------------------------------------------------ */
/* interface.battle.js */	
/* ------------------------------------------------------------------------ */

$(function()
{
	
	/* ------------------------------------------------------------------------ */
	/* Battle */	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Start battle when click monster
	  */
	  
	$("#content_monster li").live('click', function(){
		
		id_monster = $(this).attr('rel');
		
		// active tab heading button
		$("#tab_heading_button_group a").removeClass();
		$('#tab_heading_button_4').addClass('active').show();
		
		// show tab content
		$("div[id^=tab_content_]:not(:hidden)").fadeOut(350, function(){
			
			get_battle_result(id_monster);
			$("#tab_content_4 div.tab_content_right").css('backgroundImage', 'url('+ server_url + 'assets/images/monster/' + id_monster + '.png)');
			
			$("#tab_content_4").fadeIn(350);
				
		});
		
	});
	
	
	/* ------------------------------------------------------------------------ */

	/**
	  * Get battel result
	  */
	  
	function get_battle_result(id_monster)
	{  
		/* Ajax */
		
		var url = server_url + 'main/get_battle_result/' + id_monster;
		
		$.post(url, function(data){
			
			var url_image = server_url + 'assets/images/monster/';
			var content;
				
			if(data.win == 'character')
			{
				$("#tab_content_4 div.tab_content_left h2").removeClass().addClass('battle_win').html('WIN');
				$("#tab_content_4 div.tab_content_right h2").removeClass().addClass('battle_lose').html('LOSE');
			}
			else
			{
				$("#tab_content_4 div.tab_content_right h2").removeClass().addClass('battle_win').html('WIN');
				$("#tab_content_4 div.tab_content_left h2").removeClass().addClass('battle_lose').html('LOSE');
			}
						
			$("#character_battle_attack i").html(data.character_attack);
			$("#character_battle_defend i").html(data.character_defend);
			$("#character_battle_damage i").html(data.character_damage);
			
			$("#monster_battle_attack i").html(data.monster_attack);
			$("#monster_battle_defend i").html(data.monster_defend);
			$("#monster_battle_damage i").html(data.monster_damage);
			
			/*<div class="tab_content_left">
				<div id="character_battle_image"></div>
				<div class="battle_status">
					<h2 class="battle_win">WIN</h2>
					<p>
						<span id="character_battle_attack">Attack: <i>300</i></span>
						<span id="character_battle_defence">Defence: <i>500</i></span>
						<br />
						<span id="character_battle_damage">Total Damage: <i>1756</i></span>
					</p>
				</div>
			
			</div>
			<div class="tab_content_right">
				<div class="battle_status">
					<h2 class="battle_lose">LOSE</h2>
					<p>
						<span id="monster_battle_attack">Attack: <i>300</i></span>
						<span id="monster_battle_defence">Defence: <i>500</i></span>
						<br />
						<span id="monster_battle_damage">Total Damage: <i>1756</i></span>
					</p>
				</div>
			</div>*/
			
		},'json')
		.error(function() { alert('Error get_npc_dialog(' + id_npc + ', ' + id_dialog_group + ')'); })
	}
	
	/* ------------------------------------------------------------------------ */
	
});

/* End of file interface.battle.js */
/* Location: ./assets/js/interface.battle.js */	