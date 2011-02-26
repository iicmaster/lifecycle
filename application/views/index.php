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
<?php echo css_asset('interface.content.css'); ?>
<?php echo css_asset('interface.content.friend.css'); ?>
<?php echo css_asset('interface.conversation.css'); ?>

<!-- JS -->
<script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
<?php echo js_asset('jquery-1.5.1.min.js'); ?>
<?php echo js_asset('jquery-ui-1.8.9.custom.min.js'); ?>
<?php echo js_asset('jquery.qtip.min.js'); ?>
<?php echo js_asset('jquery.tipTip.min.js'); ?>
<?php echo js_asset('interface.js'); ?>
<?php echo js_asset('interface.guidepost.js'); ?>
<?php echo js_asset('interface.worldmap.js'); ?>
</head>
<body>
<!--<div id="banner">Advertising</div>-->
<div id="interface">
	<div id="section_top">
		<span id="section_top_player_profile_image"><?php echo '<img src="' . $this->session->userdata('image') . '" width="40" heigth="40" />' ?></span> 
		<div id="section_top_player_detail">
			<span id="section_top_player_name"><?php echo $this->session->userdata('name') ?></span>
			<span id="section_top_player_level">ระดับ: <i>45</i></span> 
			<span id="section_top_player_job">อาชีพ: <i>พนักงานเงินเดือน</i></span> 
			<span id="section_top_player_job_lavel">ระดับ: <i>4</i></span> 
			<span id="section_top_player_money">เงินสด: <i>3,589,741</i> ฿</span> 
		</div>
		<div id="section_top_player_location">
		</div>
		<a id="section_top_feedback" href="#">Feed Back & Bug Report</a> 
	</div>
	<!--end section_top-->
	<div id="section_main">
		<div id="tab_heading">
			<div id="tab_heading_menu">
				<a id="bt_popup_status" href="#nogo">Status</a> 
				<a id="bt_popup_skill" href="#nogo">Skill</a> 
				<a id="bt_popup_equip" href="#nogo">Equip</a> 
				<a id="bt_popup_item" href="#nogo">Item</a> 
				<a id="bt_popup_quest" href="#nogo">Quest</a> 
				<a id="bt_popup_help" href="#nogo">Help</a> 
				<!--<a id="bt_popup_skill" href="#nogo">P.E.N.</a>-->
				<!--<a id="bt_popup_skill" href="#nogo">Option</a>-->
			</div>
			<div id="tab_heading_button_group">
				<a id="tab_heading_button_1" href="#nogo">แผนที่</a> 
				<a id="tab_heading_button_2" href="#nogo">ป้ายบอกทาง</a> 
				<!--<a id="tab_heading_button_3" href="#nogo">สนทนา</a>-->
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
						<h2 id="section_top_player_location_map" rel="73" ></h2>
						<h3 id="section_top_player_location_section" rel="408" ></h3> 
					</div>
					<ul id="content_guidepost" class="list"></ul>
				</div>
				<div class="tab_content_right">	
					<ul id="content_environment" class="list"></ul>	
				</div>
			</div>
			<div id="tab_content_3">
				<div id="conversation">
					<div class="tab_content_left">		
						<div id="dialog">
							<p>เธอต้องการอะไร?</p>
							<ul>
								<li>สอบถาม</li>
								<li>ซื้อของ</li>
								<li>จบการสนทนา</li>
							</ul>
						</div>
					</div>
					<div class="tab_content_right">
						<ul class="list">
						<li>
							<?php echo image_asset('item/icon_227.png', '', array('alt'=>'สารเรืองแสง', 'title'=>'')); ?>
							<h3>สารเรืองแสง</h3>
							<p class="price"><a href="#">คำอธิบายเพิ่มเติม...</a> <span>฿ 1,500</span></p>
						</li>
						<li>
							<?php echo image_asset('item/icon_327.png', '', array('alt'=>'หญ้า', 'title'=>'หญ้า...มีแต่คนโง่เท่านั้นที่กิน เพิ่ม HP 15')); ?>
							<h3>หญ้า</h3>
							<p class="price"><a href="#">คำอธิบายเพิ่มเติม...</a> <span>20 ฿</span></p>
						</li>
					</ul>	
					</div>
				</div>
			</div>
			<div id="section_main_tab_content_left_button"></div>
			<div id="section_main_tab_content_right_button"></div>
		</div><!--end section_main_tab_content-->
		<div id="popup_window">
			<div id="popup_status" title="Status">
				<h3>Main Status</h3>
				<p>STR: </p>
				<p>COM: </p>
				<p>VIT: </p>
				<p>INT: </p>
				<p>SPD: </p>
				<p>DEX: </p>
				<h3>General Status</h3>
				<p>LP: </p>
				<p>MP: </p>
				<p>ATK: </p>
				<p>DEF: </p>
				<p>DOD: </p>
				<p>ACC: </p>
				<p>CRI: </p>
				<p>NEG: </p>
				<p>CAR: </p>
			</div>
			<div id="popup_skill" title="Skill">
				<h3>Skill name 5</h3>
				<?php echo image_asset('skill/1.png', '', array('alt'=>'Skill Image', 'width'=>'64', 'height'=>'64')); ?>
				<p>Desc: </p>
				<h3>Skill name 13</h3>
				<?php echo image_asset('skill/2.png', '', array('alt'=>'Skill Image', 'width'=>'64', 'height'=>'64')); ?>
				<p>Desc: </p>
			</div>
		</div><!--end popup_window-->
	</div><!--end section_main-->
	<div id="section_bottom">
		<div id="section_bottom_status">
			<ul>
				<li title="Life Point : 340 / 680"><b>LP</b><div id="LP_bar"><i>50%</i></div></li>
				<li title="Health Status : Normal"><b>HS</b><div id="HS_bar"><i>ปกติ</i></div></li>
				<li title="Mind Power : 200 / 200"><b>MP</b><div id="SP_bar"><i>100%</i></div></li>
				<li title="Stamina Point : 320 / 1000"><b>STA</b><div id="STA_bar"><i>32%</i></div></li>
				<li title="Experience Point : 1800 / 2000"><b>EXP</b><div id="EXP_bar"><i>90%</i></div></li>
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