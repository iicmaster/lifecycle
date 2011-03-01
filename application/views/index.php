<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Life Cycle</title>
<!-- CSS -->
<?php echo css_asset('reset.css'); ?>
<?php echo css_asset('ui-lightness/jquery-ui-1.8rc2.custom.css'); ?>
<?php echo css_asset('jquery.tipTip.css'); ?>
<?php echo css_asset('interface.css'); ?>
<?php echo css_asset('interface.worldmap.css'); ?>
<?php echo css_asset('interface.guidepost.css'); ?>
<?php echo css_asset('interface.battle.css'); ?>
<?php echo css_asset('interface.content.css'); ?>
<?php echo css_asset('interface.content.friend.css'); ?>
<?php echo css_asset('interface.conversation.css'); ?>
<?php echo css_asset('interface.popup.css'); ?>

<!-- JS -->
<script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
<?php echo js_asset('jquery-1.5.1.min.js'); ?>
<?php echo js_asset('jquery-ui-1.8.9.custom.min.js'); ?>
<?php echo js_asset('jquery.qtip.min.js'); ?>

<?php echo js_asset('interface.config.js'); ?>
<?php echo js_asset('interface.js'); ?>
<?php echo js_asset('interface.worldmap.js'); ?>
<?php echo js_asset('interface.guidepost.js'); ?>
<?php echo js_asset('interface.conversation.js'); ?>
<?php echo js_asset('interface.battle.js'); ?>
</head>
<body>
<!--<div id="banner">Advertising</div>-->
<div id="interface">
	<div id="section_top">
		<span id="section_top_player_profile_image" rel="<?php echo $this->session->userdata('id_character') ?>"><?php echo '<img src="' . $this->session->userdata('image') . '" width="40" heigth="40" />' ?></span> 
		<div id="section_top_player_detail">
			<span id="section_top_player_name"><?php echo $this->session->userdata('name') ?></span>
			<span id="section_top_player_level">ระดับ: <i><?php echo $this->session->userdata('level') ?></i></span> 
			<span id="section_top_player_job">อาชีพ: <i><?php echo $this->session->userdata('id_job') ?></i></span> 
			<span id="section_top_player_job_lavel">ระดับ: <i><?php echo $this->session->userdata('job_level') ?></i></span> 
			<span id="section_top_player_money">เงินสด: <i><?php echo $this->session->userdata('money') ?></i> ฿</span> 
		</div>
		<a id="bt_popup_feedback" href="#nogo">Feed Back & Bug Report</a> 
	</div>
	<!--end section_top-->
	<div id="section_main">
		<div id="tab_heading">
			<div id="tab_heading_menu">
				<a id="bt_popup_status" href="#nogo">Status</a> 
				<!--<a id="bt_popup_skill" href="#nogo">Skill</a> -->
				<!--<a id="bt_popup_equip" href="#nogo">Equip</a> -->
				<a id="bt_popup_item" href="#nogo">Item</a> 
				<!--<a id="bt_popup_quest" href="#nogo">Quest</a> -->
				<!--<a id="bt_popup_help" href="#nogo">Help</a> -->
				<!--<a id="bt_popup_skill" href="#nogo">P.E.N.</a>-->
				<!--<a id="bt_popup_skill" href="#nogo">Option</a>-->
			</div>
			<div id="tab_heading_button_group">
				<a id="tab_heading_button_1" href="#nogo">แผนที่</a> 
				<a id="tab_heading_button_2" href="#nogo">ป้ายบอกทาง</a> 
				<a id="tab_heading_button_3" href="#nogo">สนทนา</a>
				<a id="tab_heading_button_4" href="#nogo">ต่อสู้</a>
			</div>
			<input name="teleport_target" id="teleport_target" type="text" size="5" />
			<input name="teleport"  id="teleport" type="button" value="Teleport !!" />
		</div>
		<!--end section_main_tab_heading-->
		<div id="tab_content">
			<div id="tab_content_preload">Loading...</div>
			<div id="tab_content_1" class="tab_content_full">
				<div id="worldmap">		
					<?php echo $map_icon; ?>
				</div>
				<div id="mapDetail">
					<a id="bt_worldmap">World Map</a>
					<a id="bt_map_info_open">Info</a>
					<div id="map_info">
						<a id="bt_map_info_close" class="ui-icon ui-icon-closethick">close</a>
						<?php echo image_asset('map/path/4.png', '', array('alt'=>'Path')); ?>
						<div id="map_description">
							<h2></h2>
							<p></p>
						</div>
						<div style="clear:both"></div>
					</div>
				</div>
			</div>
			<div id="tab_content_2">
				<div class="tab_content_left">
					<div id="section_desctiption">	
						<img id="section_pathroot" />	
						<h2 id="section_top_player_location_map" rel="" ></h2>
						<h3 id="section_top_player_location_section" rel="<?php echo $this->session->userdata('location') ?>" ></h3> 
					</div>
					<ul id="content_guidepost" class="list"></ul>
				</div>
				<div class="tab_content_right">	
					<ul id="content_npc" class="list"></ul>	
					<ul id="content_monster" class="list"></ul>	
				</div>
			</div>
			<div id="tab_content_3">
				<div id="conversation">
					<div class="tab_content_left">		
						<div id="dialog">
							<p></p>
							<ul></ul>
						</div>
					</div>
					<div class="tab_content_right">
						<ul id="content_npc_item" class="list"></ul>	
					</div>
				</div>
			</div>
			<div id="tab_content_4">
				<?php echo image_asset('icon_sowrd.png', '', array('alt'=>'Battle', 'id'=>'icon_sowrd')); ?>
				<div class="tab_content_left">
					<div id="character_battle_image"></div>
					<div class="battle_status">
						<h2 class="battle_win">WIN</h2>
						<p>
							<span id="character_battle_attack">Attack: <i>300</i></span>
							<span id="character_battle_defend">Defend: <i>500</i></span>
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
							<span id="monster_battle_defend">Defend: <i>500</i></span>
							<br />
							<span id="monster_battle_damage">Total Damage: <i>1756</i></span>
						</p>
					</div>
				</div>
			</div>
			<div id="section_main_tab_content_left_button"></div>
			<div id="section_main_tab_content_right_button"></div>
		</div><!--end section_main_tab_content-->
		<div id="popup_window">
			<div id="popup_status" title="Status">
				<h3>Main Status</h3>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<th>STR:</th>
						<td id="character_str"><?php echo $this->session->userdata('strength') ?></td>
						<th>COM:</th>
						<td id="character_com"><?php echo $this->session->userdata('comunication') ?></td>
					</tr>
					<tr>
						<th>VIT:</th>
						<td id="character_vit"><?php echo $this->session->userdata('vitality') ?></td>
						<th>INT:</th>
						<td id="character_int"><?php echo $this->session->userdata('intelligent') ?></td>
					</tr>
					<tr>
						<th>SPD:</th>
						<td id="character_spd"><?php echo $this->session->userdata('speed') ?></td>
						<th>DEX:</th>
						<td id="character_dex"><?php echo $this->session->userdata('dexterity') ?></td>
					</tr>
				</table>

				<h3>General Status</h3>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<th>LP:</th>
						<td id="character_lp"><?php echo $this->session->userdata('life_point') ?></td>
						<th>MP:</th>
						<td id="character_mp"><?php echo $this->session->userdata('mind_power') ?></td>
					</tr>
					<tr>
						<th>ATK:</th>
						<td id="character_atk"><?php echo $this->session->userdata('attack') ?></td>
						<th>DEF:</th>
						<td id="character_def"><?php echo $this->session->userdata('defend') ?></td>
					</tr>
					<tr>
						<th>DOD:</th>
						<td id="character_dod"><?php echo $this->session->userdata('dodge') ?></td>
						<th>ACC:</th>
						<td id="character_acc"><?php echo $this->session->userdata('accuracy') ?></td>
					</tr>
					<tr>
						<th>NEG:</th>
						<td id="character_neg"><?php echo $this->session->userdata('negotiation') ?></td>
						<th>CAR:</th>
						<td id="character_car"><?php echo $this->session->userdata('charisma') ?></td>
					</tr>
					<tr>
						<th>STA:</th>
						<td id="character_sta"><?php echo $this->session->userdata('stamina_point') ?></td>
						<th>HS:</th>
						<td id="character_hs">100%</td>
					</tr>
				</table>
			</div>
			<div id="popup_skill" title="Skill">
				<h3>Skill name 5</h3>
				<?php echo image_asset('skill/1.png', '', array('alt'=>'Skill Image', 'width'=>'64', 'height'=>'64')); ?>
				<p>Desc: </p>
				<h3>Skill name 13</h3>
				<?php echo image_asset('skill/2.png', '', array('alt'=>'Skill Image', 'width'=>'64', 'height'=>'64')); ?>
				<p>Desc: </p>
			</div>
			<div id="popup_item" title="Item">
				<ul id="content_character_item">
					
				</ul>
			</div>
			<div id="popup_feedback" title="Feedback & Bug Report">
				<ul>
					<li>
						<input id="feedback" name="type" type="radio" value="0" checked />
						<label for="feedback">Feedback</label>
						<input id="bug" name="type" type="radio" value="1" />
						<label for="bug">Bug Report </label>
					</li>
					<li>
						<label for="topic">Topic</label>
						<input id="topic" name="topic" type="text" />
					</li>
					<li>
						<label for="detail">Detail</label>
						<textarea id="detail" name="detail"></textarea>
					</li>
					<li>
						<input id="send_feedback" type="button" value="  Send  " />
					</li>
				</ul>
			</div>
			<div id="popup_notification" title="">
				<ul id="content_notification">
					
				</ul>
			</div>
		</div><!--end popup_window-->
	</div><!--end section_main-->
	<div id="section_bottom">
		<div id="section_bottom_status">
			<ul>
				<li rel="<?php echo $this->session->userdata('life_point') ?>" title="Life Point : <?php echo $this->session->userdata('life_point') ?> / <?php echo $this->session->userdata('life_point') ?>"><b>LP</b><div id="LP_bar"><i>100%</i></div></li>
				<li rel="100" title="Health Status : Normal"><b>HS</b><div id="HS_bar"><i>ปกติ</i></div></li>
				<li rel="<?php echo $this->session->userdata('mind_power') ?>" title="Mind Power : <?php echo $this->session->userdata('mind_power') ?> / <?php echo $this->session->userdata('mind_power') ?>"><b>MP</b><div id="SP_bar"><i>100%</i></div></li>
				<li rel="<?php echo $this->session->userdata('stamina_point') ?>" title="Stamina Point : <?php echo $this->session->userdata('stamina_point') ?> / <?php echo $this->session->userdata('stamina_point') ?>"><b>STA</b><div id="STA_bar"><i>100%</i></div></li>
				<li rel="<?php echo $this->session->userdata('expericence') ?>" title="Experience Point : <?php echo $this->session->userdata('expericence') ?> / <?php echo $this->session->userdata('expericence') ?>"><b>EXP</b><div id="EXP_bar"><i>100%</i></div></li>
			</ul>
		</div>
		<div id="section_bottom_friend">
			<a id="button_next" class="button_friend" href="#" title="Next">&#x25B6;</a>
			<a id="button_prev" class="button_friend" href="#" title="Previous">&#x25C0;</a>
        	<ul>
			</ul>
        </div>
		<div id="krama_orb" title="ชีวิตตกต่ำ เพราะกรรมนำพา"></div>
	</div><!--end section_bottom-->
</div>
<!-- Facebook JS -->
<div id="fb-root"></div>
<?php echo js_asset('facebook.js'); ?>
</body>
</html>