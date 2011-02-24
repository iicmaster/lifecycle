$(function()
{
	
/*--------------------------------------------------*/
/* World Map */	
/*--------------------------------------------------*/

	$("#worldmap [title]").qtip({
		content: 
		{
			text: false,
			title: ''
		},
		show: 
		{ 
			effect: 
			{ 
				type: 'fade' 
			}
		},
		hide: 
		{
			fixed: true
		},
		position: 
		{
			corner: 
			{
				target: 'topMiddle',
				tooltip: 'bottomMiddle'
			},
			adjust: 
			{ 
				screen: true 
			}
		},
		style: 
		{ 
			//name: 'light', 
			tip: true, 
			padding: 0,
			width: 
			{ 
				min: 200 
			},
			'text-align': 'center',
			'white-space': 'nowrap',
			title: 
			{
				padding: 5,
				'font-weight': 'normal',
				'text-align': 'center',
				'background-color': '#EEE'
				
			}
		}
	});
	
	$('div[id^=qtip] img, div[id^=map_icon_]').live('click', function(){
		
		$('div.qtip').hide();
		
		// set new value
		var id = $(this).attr('rel');
		//alert(id);
		$("#map_info img").attr('src', 'http://localhost/lifecycle/assets/images/map/path/'+id+'.png');
		$("#mapDetail").css('backgroundImage', 'url(http://localhost/lifecycle/assets/images/map/'+id+'.jpg)');
		$("#interface").css('backgroundImage', 'url(http://localhost/lifecycle/assets/images/map/bg/'+id+'.jpg)');
		
		$("#worldmap").fadeOut(function(){
			
			$("#map_info").css('left', '0');
			$("#bt_map_info_open").hide();
			$("#mapDetail").fadeIn();
		});
	});
	
	
	$('div[id^=map_icon_]').hover(function(){
		var id = $(this).attr('id').replace("map_icon_", "");
		//alert(id);
		var tooltip = $('#map_icon_'+id).qtip('api');
		var title = $(tooltip.elements.content).text();
		var content = '<img alt="'+id+'" rel="'+id+'" src="http://localhost/lifecycle/assets/images/map/icon/'+id+'.jpg" />';
		tooltip.updateTitle(title);
		tooltip.updateContent(content);
	});
	
	
	
/*--------------------------------------------------*/
/* Map Detail */	
/*--------------------------------------------------*/

	$("#bt_map_info_close").click(function(){
		$("#map_info").animate({left: '-720px'});
		$("#bt_map_info_open").fadeIn();
	});
	
	$("#bt_map_info_open").click(function(){
		$("#map_info").css('left', '720px').animate({left: '0'});
		$(this).fadeOut();
	});
	
	$("#bt_worldmap").click(function(){
		$("#mapDetail").fadeOut(function(){
			$("#worldmap").fadeIn();
		});
	});
	
});