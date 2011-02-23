<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Life Cycle</title>
<?php echo css_asset('reset.css'); ?>
<?php echo css_asset('ui-lightness/jquery-ui-1.8rc2.custom.css'); ?>
<?php echo css_asset('interface.css'); ?>
<?php echo css_asset('interface.worldmap.css'); ?>
<?php echo css_asset('interface.conversation.css'); ?>
</head>
<body>
<!--<div id="banner">Advertising</div>-->
<div id="interface">
	<div id="menuTop">
		<span id="menuTop_playerlevel">45</span> 
		<span id="menuTop_playerName">อัสดง นามไพเราะเสนาะหู</span>
		<div id="menuTop_playerDetail"></div>
		<span id="menuTop_playerJob">อาชีพ: <i>พนักงานเงินเดือน</i></span> 
		<span id="menuTop_playerJobLavel">ระดับ: <i>4</i></span> 
		<span id="menuTop_playerMoney">เงินสด: <i>3,589,741</i> ฿</span> 
		<a id="menuTop_feedback" href="#">Feed Back</a> 
	</div>
	<!--end menuTop-->
	<div id="mainDisplay">
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
			<div id="tab_heading_buttonGroup">
				<a id="tab_heading_button_1" href="#nogo">แผนที่</a> 
				<a id="tab_heading_button_2" href="#nogo">ป้ายบอกทาง</a> 
				<a id="tab_heading_button_3" href="#nogo">สนทนา</a>
			</div>
		</div>
		<!--end mainDisplay_tab_heading-->
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
							<h2>เขตเพาะปลูกทิศตะวันออกเฉียงใต้ ทุ่งชูก้า</h2>
							<p>เขตที่นาเก่าของเมืองนิพันนรา เป็นพื้นที่นารกร้าง ที่มีต้นไม้พันธุ์พิเศษซึ่งเอื้อต่อการเจริญเติบโต ของต้นข้าวหอมมะลิสีทองเติบโตอยู่ ทำให้พันธุ์ข้าวของที่นี่มีลักษณะเฉพาะ เป็นเขตการเกษตรมีค่าที่สร้างรายได้และวัตถุดิบหายากให้กับชาวเมือง</p>
						</div>
						<div style="clear:both"></div>
					</div>
				</div>
			</div>
			<div id="tab_content_2">
				<div class="tab_content_left">		
					<ul class="list">
						<li>
							<?php echo image_asset('guidepost/tst_01.png', '', array('alt'=>'')); ?>
							<h3>สถานีขนส่งสาธารณะ</h3>
							<p>-</p>
						</li>
						<li>
							<?php echo image_asset('guidepost/tst_02.png', '', array('alt'=>'')); ?>
							<h3>ตลาดสวนมะม่วง</h3>
							<p>-</p>
						</li>
					</ul>
				</div>
				<div class="tab_content_right">
					<ul class="list">
						<li>
							<?php echo image_asset('npc/icon_7.png', '', array('alt'=>'ดอกเตอร์ มีนา รักวิทย์')); ?>
							<h3>ดอกเตอร์ มีนา รักวิทย์</h3>
							<p>นักวิทยาศาสตร์ประจำสถาบันการวิจัย และพัฒนาแห่งสหพันธ์</p>
						</li>
						<li>
							<?php echo image_asset('npc/icon_55.png', '', array('alt'=>'พ่อเลี้ยง กลั่น')); ?>
							<h3>พ่อเลี้ยง กลั่น</h3>
							<p>เจ้าของบริษัทห้างอาหารและยา หวังเปลี่ยนสี และคู่แข่งทางธุรกิจของเสี่ยเช็ง</p >
						</li>
						<li>
							<?php echo image_asset('npc/icon_57.png', '', array('alt'=>'มิงค์')); ?>
							<h3>มิงค์</h3>
							<p>ลูกสาวสุดรักสุดหวงของพ่อเลี้ยงกลั่น</p>
						</li>
						<li>
							<?php echo image_asset('npc/icon_12.png', '', array('alt'=>'เฟร็ด บุญมี')); ?>
							<h3>เฟร็ด บุญมี</h3>
							<p>ลูกน้องคนสนิทของเสี่ยเช็ง และเป็นพี่คนกลางในบรรดาพี่น้องร่วมสาบานทั้ง 3</p>
						</li>
					</ul>	
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
			<div id="mainDisplay_tab_content_left_button"></div>
			<div id="mainDisplay_tab_content_right_button"></div>
		</div><!--end mainDisplay_tab_content-->
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
				<p>SP: </p>
				<p>ATK: </p>
				<p>DEF: </p>
				<p>DOD: </p>
				<p>ACC: </p>
				<p>CRI: </p>
				<p>NEG: </p>
				<p>CAR: </p>
			</div>
			<div id="popup_skill" title="Skill">
				<h3>Skill name 1</h3>
				<?php echo image_asset('blank.png', '', array('alt'=>'Skill Image', 'width'=>'64', 'height'=>'64')); ?>
				<p>Desc: </p>
				<h3>Skill name 2</h3>
				<?php echo image_asset('blank.png', '', array('alt'=>'Skill Image', 'width'=>'64', 'height'=>'64')); ?>
				<p>Desc: </p>
			</div>
		</div><!--end popup_window-->
	</div><!--end mainDisplay-->
	<div id="menuBottom">
		<div id="menuBottom_status">
			<ul>
				<li title="Life Point : 340 / 680"><b>LP</b><div id="LP_bar"><i>50%</i></div></li>
				<li title="Health Status : Normal"><b>HS</b><div id="HS_bar"><i>ปกติ</i></div></li>
				<li title="Spiritual Point : 200 / 200"><b>SP</b><div id="SP_bar"><i>100%</i></div></li>
				<li title="Stamina Point : 320 / 1000"><b>STA</b><div id="STA_bar"><i>32%</i></div></li>
				<li title="Experience Point : 1800 / 2000"><b>EXP</b><div id="EXP_bar"><i>90%</i></div></li>
			</ul>
		</div>
		<div id="menuBottom_chat">
        
        </div>
		<div id="kramaOrb" title="ชีวิตตกต่ำ เพราะกรรมนำพา"></div>
	</div><!--end menuBottom-->
</div>
<div id="fb-root"></div>
<script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
<?php echo js_asset('facebook.js'); ?>
<?php echo js_asset('jquery-1.4.2.min.js'); ?>
<?php echo js_asset('jquery-ui-1.8rc2.custom.min.js'); ?>
<?php echo js_asset('jquery.qtip.min.js'); ?>

<?php echo js_asset('interface.mainDisplay.js'); ?>
<?php echo js_asset('interface.worldmap.js'); ?>
</body>
</html>