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
<?php echo js_asset('interface.popup.js'); ?>
</head>
<body>
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
				<a id="tab_heading_button_1" rel="1">แผนที่</a> 
				<a id="tab_heading_button_2" rel="2">ป้ายบอกทาง</a> 
				<a id="tab_heading_button_3" rel="3">สนทนา</a>
				<a id="tab_heading_button_4" rel="4">ต่อสู้</a>
			</div>
			<input name="teleport_target" id="teleport_target" type="text" size="5" />
			<input name="teleport"  id="button_teleport" type="button" value="Teleport !!" />
			<input name="teleport"  id="button_status" type="button" value="STA" />
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
						<img alt="Path" />	
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
						<?php 
							if($this->session->userdata('location_type') == 0)
							{
								$this->load->model('map_model');		
								$character_map = $this->map_model->get_map_detail($this->session->userdata('id_location'));
							}
							else
							{
								$character_map = array('id_map'=>'', 'name'=>'');
							}
						?>
						<h2 id="section_top_player_location_map" rel="<?php echo $character_map['id_map']; ?>" ><?php echo $character_map['name']; ?> ( <?php echo $character_map['id_map']; ?> )</h2>
						<h3 id="section_top_player_location_section" rel="<?php if($this->session->userdata('location_type') == 0){ echo $this->session->userdata('id_location'); } ?>" >ย่าน: <i></i></h3> 
						<h4 id="section_top_player_location_store" rel="<?php if($this->session->userdata('location_type') == 1){ echo $this->session->userdata('id_location'); } ?>" >ภายใน: <i></i></h4> 
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
				<a id="button_finish_battle">จบการต่อสู้</a>
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
						<td id="character_str"><?php echo $this->session->userdata('str') ?></td>
						<th>COM:</th>
						<td id="character_com"><?php echo $this->session->userdata('com') ?></td>
					</tr>
					<tr>
						<th>VIT:</th>
						<td id="character_vit"><?php echo $this->session->userdata('vit') ?></td>
						<th>INT:</th>
						<td id="character_int"><?php echo $this->session->userdata('int') ?></td>
					</tr>
					<tr>
						<th>SPD:</th>
						<td id="character_spd"><?php echo $this->session->userdata('spd') ?></td>
						<th>DEX:</th>
						<td id="character_dex"><?php echo $this->session->userdata('dex') ?></td>
					</tr>
				</table>

				<h3>General Status</h3>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<th>LP:</th>
						<td id="character_lp"><i><?php echo $this->session->userdata('lp') ?></i> / <b><?php echo $this->session->userdata('lp_max') ?></b></td>
						<th>MP:</th>
						<td id="character_mp"><i><?php echo $this->session->userdata('mp') ?></i> / <b><?php echo $this->session->userdata('mp_max') ?></b></td>
					</tr>
					<tr>
						<th>ATK:</th>
						<td id="character_atk"><i><?php echo $this->session->userdata('atk') ?></i> / <b><?php echo $this->session->userdata('atk_ori') ?></b></td>
						<th>DEF:</th>
						<td id="character_def"><i><?php echo $this->session->userdata('def') ?></i> / <b><?php echo $this->session->userdata('def_ori') ?></b></td>
					</tr>
					<tr>
						<th>DOD:</th>
						<td id="character_dod"><i><?php echo $this->session->userdata('dod') ?></i> / <b><?php echo $this->session->userdata('dod_ori') ?></b></td>
						<th>STA:</th>
						<td id="character_sta"><i><?php echo $this->session->userdata('sta') ?></i> / <b><?php echo $this->session->userdata('sta_max') ?></b></td>
					</tr>
					<tr>
						<th>ACC:</th>
						<td id="character_acc"><i><?php echo $this->session->userdata('acc') ?></i> / <b><?php echo $this->session->userdata('acc_ori') ?></b></td>
						<th>NEG:</th>
						<td id="character_neg"><i><?php echo $this->session->userdata('neg') ?></i> / <b><?php echo $this->session->userdata('neg_ori') ?></b></td>
					</tr>
					<tr>
						<th>CHA:</th>
						<td id="character_car"><i><?php echo $this->session->userdata('cha') ?></i> / <b><?php echo $this->session->userdata('cha_ori') ?></b></td>
						<th>POP:</th>
						<td id="character_pop"><i><?php echo $this->session->userdata('pop') ?></i> / <b><?php echo $this->session->userdata('pop_ori') ?></b></td>
					</tr>
					<tr>
						<th>AGE:</th>
						<td id="character_age"><i><?php echo $this->session->userdata('age') ?></i> / <b><?php echo $this->session->userdata('age_max') ?></b></td>
						<th>HS:</th>
						<td id="character_hs"><?php echo $this->session->userdata('hs') ?></td>
					</tr>
					<tr>
						<th>EXP:</th>
						<td id="character_exp" colspan="3"><i><?php echo $this->session->userdata('exp') ?></i> / <b><?php echo $this->session->userdata('exp_max') ?></b></td>
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
				<ul id="content_character_item" class="popup_item"></ul>
			</div>
			<div id="popup_notification" title="">
				<ul id="content_notification">
					
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
				<li rel="lp" title="Life Point: <?php echo $this->session->userdata('lp') ?> / <?php echo $this->session->userdata('lp_max') ?>"><b>LP</b><div id="lp_bar"><i><?php echo round($this->session->userdata('lp') * 100 / $this->session->userdata('lp_max')); ?>%</i></div></li>
				<li rel="age" title="Age: <?php echo $this->session->userdata('age') ?>"><b>AGE</b><div id="age_bar"><i></i></div></li>
				<li rel="mp" title="Mind Power: <?php echo $this->session->userdata('mp') ?> / <?php echo $this->session->userdata('mp_max') ?>"><b>MP</b><div id="mp_bar"><i><?php echo round($this->session->userdata('mp') * 100 / $this->session->userdata('mp_max')) ?>%</i></div></li>
				<li rel="sta" title="Stamina Point: <?php echo $this->session->userdata('sta') ?> / <?php echo $this->session->userdata('sta_max') ?>"><b>STA</b><div id="sta_bar"><i><?php echo round($this->session->userdata('sta') * 100 / $this->session->userdata('sta_max')) ?>%</i></div></li>
				<li rel="exp" title="Experience: <?php echo $this->session->userdata('exp') ?> / <?php echo $this->session->userdata('exp_max') ?>"><b>EXP</b><div id="exp_bar"><i><?php echo round($this->session->userdata('exp') * 100 / $this->session->userdata('exp_max')) ?>%</i></div></li>
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
<div id="banner"><?php echo image_asset('logo_sipa.png', '', array('alt'=>'Sipa')); ?> <p>Life Cycle ได้รับเงินรางวัลสนับสนุนจากสำนักงานส่งเสริมอุตส่าหกรรมซอฟต์แวร์แห่งชาติ (องค์กรณ์มหาชน)</p></div>
<!-- Facebook JS -->
<div id="fb-root"></div>
<?php echo js_asset('facebook.js'); ?>
</body>
</html>