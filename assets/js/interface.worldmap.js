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
			}
		},
		style: 
		{ 
			//name: 'light', 
			tip: true, 
			padding: 0,
			'min-width': '200px',
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
	
	$('div[id^=qtip] img').live('click', function(){
		
		$('div.qtip').hide();
		
		// set new value
		var id = $(this).attr('alt');
		$("#map_info img").attr('src', 'http://localhost/lc/assets/images/map/path/'+id+'.png');
		$("#mapDetail").css('backgroundImage', 'url(http://localhost/lc/assets/images/map/'+id+'.jpg)');
		
		$("#worldmap").fadeOut(function(){
			
			$("#map_info").css('left', '0');
			$("#bt_map_info_open").hide();
			$("#mapDetail").fadeIn();
		});
	});
	
	
	$('div[id^=mapIcon_]').hover(function(){
		var id = $(this).attr('id').replace("mapIcon_", "");
		//alert(id);
		var tooltip = $('#mapIcon_'+id).qtip('api');
		var title = $(tooltip.elements.content).text();
		var content = '<img alt="'+id+'" src="http://localhost/lc/assets/images/map/icon/'+id+'.jpg" />';
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