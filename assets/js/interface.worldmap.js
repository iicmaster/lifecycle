/* ------------------------------------------------------------------------ */
/* interface.worldmap.js */	
/* ------------------------------------------------------------------------ */

$(function()
{
	
	/* ------------------------------------------------------------------------ */
	/* World Map */	
	/* ------------------------------------------------------------------------ */

	/**
	  * Set up qtip
	  */
	  
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
	
	/* ------------------------------------------------------------------------ */

	/**
	  * Display map thumpnail when mouseover map icon
	  */
	
	$('div[id^=map_icon_]').hover(function(){
		
		var id = $(this).attr('id').replace("map_icon_", "");
		var tooltip = $('#map_icon_'+id).qtip('api');
		var title = $(tooltip.elements.content).text();
		var content = '<img alt="'+id+'" rel="'+id+'" src="http://localhost/lifecycle/assets/images/map/icon/'+id+'.jpg" />';
		
		tooltip.updateTitle(title);
		tooltip.updateContent(content);
		
	});
	
	/* ------------------------------------------------------------------------ */

	/**
	  * Display map detail when click map's icon or map's thummbnail
	  */
	
	$('div[id^=qtip] img, div[id^=map_icon_]').live('click', function(){
		
		$('div.qtip').hide();
		
		// set new value
		var id_map = $(this).attr('rel');
		
		$("#interface").css('backgroundImage', 'url(http://localhost/lifecycle/assets/images/map/bg/' + id_map + '.jpg)');
		$("#mapDetail").css('backgroundImage', 'url(http://localhost/lifecycle/assets/images/map/' + id_map + '.jpg)');
		$("#map_info img").attr('src', 'http://localhost/lifecycle/assets/images/map/path/' + id_map + '.png');
		
		/* Ajax */
		
		var location_type = 'map';
		var url = 'http://localhost/lifecycle/main/get_detail/' + location_type  + '/' + id_map;
		$.post(url, function(data){
				
			$("#map_description h2").html(data['name']);
			$("#map_description p").html(data['description']);
			
		},'json');	
		
		$("#worldmap").fadeOut(function(){
			
			$("#map_info").css('left', '0');
			$("#bt_map_info_open").hide();
			$("#mapDetail").fadeIn();
		});
		
	});
	
	/* ------------------------------------------------------------------------ */
	/* Map Detail */	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * 1. Close map description
	  * 2. Show button map description
	  */
	  
	$("#bt_map_info_close").click(function(){
		$("#map_info").animate({left: '-720px'});
		$("#bt_map_info_open").fadeIn();
	});
	
	/* ------------------------------------------------------------------------ */

	/**
	  * 1. Open map description
	  * 2. Hide button map description
	  */
	
	$("#bt_map_info_open").click(function(){
		$("#map_info").css('left', '720px').animate({left: '0'});
		$(this).fadeOut();
	});
	
	/* ------------------------------------------------------------------------ */

	/**
	  * 1. Hide map description
	  * 2. Show world map
	  */
	
	$("#bt_worldmap").click(function(){
		$("#mapDetail").fadeOut(function(){
			$("#worldmap").fadeIn();
		});
	});
	
	/* ------------------------------------------------------------------------ */
	
});

/* End of file interface.worldmap.js */
/* Location: ./assets/js/interface.worldmap.js */	