<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Life Cycle</title>
<link rel="stylesheet" type="text/css" href="../css/reset.css"/>
<link rel="stylesheet" type="text/css" href="../css/interface.css"/>
<link rel="stylesheet" type="text/css" href="../css/ui-lightness/jquery-ui-1.8rc2.custom.css" />	
</head>
<body>
	<div id="banner">Advertising</div>
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
	<div id="menuLeft"></div>
	<div id="menuRight"></div>
	<div id="mainDisplay">
		<div id="mainDisplay_tab_heading">
			<div id="tab_heading_menu">
				<a id="bt_popup_status" href="#nogo">Status</a> 
				<a id="bt_popup_skill" href="#nogo">Skill</a> 
				<a href="#nogo">Equip</a> 
				<a href="#nogo">Item</a> 
				<a href="#nogo">P.E.</a>
				<a href="#nogo">Option</a>
			</div>
			<div id="tab_heading_buttonGroup">
				<a id="tab_heading_button_map" href="#nogo" class="active">แผนที่</a> 
				<a id="tab_heading_button_signpost" href="#nogo">ป้ายบอกทาง</a> 
				<a id="tab_heading_button_street" href="#nogo">ถนน</a>
			</div>
		</div>
		<div id="mainDisplay_tab_content">
			<div id="mainDisplay_tab_content_full"></div>
			<div id="mainDisplay_tab_content_left"></div>
			<div id="mainDisplay_tab_content_left_button"></div>
			<div id="mainDisplay_tab_content_right"></div>
			<div id="mainDisplay_tab_content_right_button"></div>
		</div>
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
				<img width="64" height="64" alt="Skill Image" />
				<p>Desc: </p>
				<h3>Skill name 2</h3>
				<img width="64" height="64" alt="Skill Image" />
				<p>Desc: </p>
			</div>
		</div>
	</div>
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
	</div>
</div>
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8rc2.custom.min.js"></script>
<script type="text/javascript">
$(function()
{
	$("#tab_heading_button_map").click(function(){
		$("#mainDisplay_tab_content_left, #mainDisplay_tab_content_right").fadeOut("350", function(){
			$("#mainDisplay_tab_content_full").fadeIn("350");																						
		});
		$("#tab_heading_buttonGroup a").removeClass();
		$(this).addClass('active');
		
		$("#LP_bar div").animate({width:"50%"});
		$("#LP_bar i").text("50%");
		
		$("#HS_bar div").animate({width:"100%"});
		$("#HS_bar i").text("ปกติ");
		
		$("#SP_bar div").animate({width:"100%"});
		$("#SP_bar i").text("100%");
		
		$("#STA_bar div").animate({width:"32%"});
		$("#STA_bar i").text("32%");
		
		$("#EXP_bar div").animate({width:"90%"});
		$("#EXP_bar i").text("90%");
	});
	
	$("#tab_heading_button_signpost, #tab_heading_button_street").click(function(){
		$("#mainDisplay_tab_content_full").fadeOut("350", function(){
			$("#mainDisplay_tab_content_left, #mainDisplay_tab_content_right").fadeIn("350");																						
		});
		$("#tab_heading_buttonGroup a").removeClass();
		$(this).addClass('active');
		
		$("#LP_bar div").animate({width:"99%"});
		$("#LP_bar i").text("99%");
		
		$("#HS_bar div").animate({width:"37%"});
		$("#HS_bar i").text("เล็บขบ");
		
		$("#SP_bar div").animate({width:"2%"});
		$("#SP_bar i").text("2%");
		
		$("#STA_bar div").animate({width:"88%"});
		$("#STA_bar i").text("88%");
		
		$("#EXP_bar div").animate({width:"15%"});
		$("#EXP_bar i").text("15%");
	});
	
	$("#LP_bar").progressbar({value: 50});
	$("#HS_bar").progressbar({value: 100});
	$("#SP_bar").progressbar({value: 100});
	$("#STA_bar").progressbar({value: 32});
	$("#EXP_bar").progressbar({value: 90});
	
	$("#popup_status").dialog({
		autoOpen: false,
		show: 'drop',
		hide: 'drop'
	});
	
	$("#bt_popup_status").click(function() {
		$('#popup_status').dialog('open');
	})
	
	$("#popup_skill").dialog({
		autoOpen: false,
		show: 'drop',
		hide: 'drop'
	});
	
	$("#bt_popup_skill").click(function() {
		$('#popup_skill').dialog('open');
	});
	
})
</script>
</body>
</html>
