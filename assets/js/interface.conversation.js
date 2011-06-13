/* ------------------------------------------------------------------------ */
/* interface.conversation.js */	
/* ------------------------------------------------------------------------ */

$(function()
{
	/**
	  * Open conversation windows when click NPC
	  */
	  
	$("#content_npc li").live('click', function(){
		
		id_npc = $(this).attr('rel');
		
		$("#dialog p").attr('rel', id_npc);
		$("#conversation div.tab_content_right").css('backgroundImage', 'url('+ URL_IMAGE + 'npc/' + id_npc + '.png)');
			
		get_npc_dialog(id_npc);
		
		change_tab(3);
		
	});
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Buy item
	  */
	  
	$("li.buy").live('click', function(){
		
		$('#popup_notification').dialog( "option", "title", 'ซื้อไอเท็ม' );
								  
		var id_item = $(this).attr('rel');
		var item_name = $(this).find('h3').text();
		var item_price = $(this).find('span').find('i').text();
		
		var url_image = URL_IMAGE + '/item/icon/' + id_item + '.png';
		var content =	'<li>' +
							'<div>' +
							'<img id="popup_buy_item_image" src="' + url_image + '" />' +
							'<h3 id="popup_buy_item_name">' + item_name + '</h3>' +
								'<span id="popup_buy_item_price">ราคา: ' + item_price + ' ฿ </span>' +
								'<label for="buy_qty">จำนวน: </label>' +
								'<input id="buy_qty" type="text" value="1" size="10" />' +
							'</div>' +
							'<div id="popup_buy_total">' +
								'<p>รวมเป็นเงิน : <span><i>' + item_price + '</i> ฿</span></p>'+
							'</div>' +
						'</li>';
		
		// clear notification data
		$("#content_notification").removeClass()
								  .addClass('popup_buy_item')
								  .html(content)
								  
		$('#buy_qty').spinner({min: 1, max: 999});
								  
		$('#popup_notification').dialog({
			
			hide: "drop",
			buttons: {
				'ซื้อ': function() {
					
					//alert('buy item');
					$(this).dialog( "close" )
					//$(this).effect('tranfer', {to: $('#bt_popup_item')});
				}
			}
			
		}).dialog('open');
		
	});
	
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Exit Store or company
	  */
	  
	$("#dialog li[type=2]").live('click', function(){
		
		change_tab(2);
		
	});
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Taking with NPC
	  */
	  
	$("#dialog li[type=0]").live('click', function(){
		
		var id_npc = $("#dialog p").attr('rel');
		var id_dialog_group = $(this).attr('rel');
		
		get_npc_dialog(id_npc, id_dialog_group);
		
	});
	
	/* ------------------------------------------------------------------------ */
	
	/**
	  * Buy item from NPC
	  */
	  
	$("#dialog li[type=3]").live('click', function(){
		
		$(this).hide();
		
		var id_npc = $("#dialog p").attr('rel');		
		
		$("#conversation div.tab_content_right").css('backgroundImage', 'none');
		$("#conversation div.tab_content_left").css('backgroundImage', 'url('+ URL_IMAGE + '/npc/' + id_npc + '.png)');
		
		get_npc_item(id_npc);
		
	});
	
});
	
/* ------------------------------------------------------------------------ */

/**
  * Get conversation list
  */
  
function get_npc_dialog(id_npc, id_dialog_group)
{  
	if( id_dialog_group === undefined ) 
	{
		id_dialog_group = '';
	}
	else
	{
		id_dialog_group = '/' + id_dialog_group;	
	}
	
	/* Ajax */
	
	var url = URL_SERVER + 'main/get_npc_dialog/' + id_npc + id_dialog_group;
	
	$.post(url, function(data){
		
		$("#dialog p").empty();
		$("#dialog ul").empty();
	
		var url_image = URL_IMAGE + '/guidepost/';
		var content;
		
		$.each(data, function(index){
			
			if(data[index].ordering == 0)
			{
				$("#dialog p").append(data[index].dialog);
			}
			else
			{
				content = '<li rel="' + data[index].id_target + '" type="' + data[index].target_type + '">' + data[index].dialog + '</li>';
							
				$("#dialog ul").append(content);
			}
			
		});
		
	},'json')
	.error(function() { alert('Error: get_npc_dialog(' + id_npc + ', ' + id_dialog_group + ')'); })
}

/* ------------------------------------------------------------------------ */

/**
  * Get NPC item for buy
  */
  
function get_npc_item(id_npc)
{  		
	/* Ajax */
	
	var url = URL_SERVER + 'main/get_npc_item/' + id_npc;
	
	$.post(url, function(data){
		
		$("#content_npc_item").empty();
		
		var url_image = URL_IMAGE + '/item/icon/';
		var content;
		
		$.each(data, function(index){
			
			//alert(data[index]);
			//break;
			
			content = 	'<li type="npc_item" rel="'+ data[index]['id_item'] +'" class="buy">' +
							'<img src="' + url_image + data[index]['id_item'] + '.png" />' +
							'<h3>' + data[index]['name'] + '</h3>' +
							'<p class="price">' + data[index]['description'] + 
							'<span><i>' + data[index]['price'] + '</i> ฿</span>'+
							'</p>' +
						'</li>';
			
			$("#content_npc_item").append(content);
		});
		
	},'json')
	.error(function() { alert('Error: get_npc_item(' + id_npc + ')'); })
}

/* ------------------------------------------------------------------------ */

/**
  * Buy Item
  *
  * process:
  * 			1. Update Table: character_item
  * 			2. Update character's money
  */
  
function buy_item(id_item, quantity, price)
{  		
	/* Ajax */
	
	var url = URL_SERVER + 'main/buy_item/' + id_item + '/' + quantity;
	
	$.post(url, function(data){
		
		var money = $("#character_money").find('i').text();
		var totle = quantity * price;
		var money_new = parseInt(money) - totle;
		
		// update money
		$("#character_money").find('i').text(money_new);
	
	},'json')
	.error(function() { alert('Error: buy_item(' + id_item + ', ' + quantity + ')'); })
}

/* ------------------------------------------------------------------------ */

/**
  * Sell Item
  *
  * process:
  * 			1. Update Table: character_item
  * 			2. Update character's money
  */
  
function sell_item(id_item, quantity, price)
{  		
	/* Ajax */
	
	var url = URL_SERVER + 'main/sell_item/' + id_item + '/' + quantity;
	
	$.post(url, function(data){
		
		var money = $("#character_money").find('i').text();
		
	},'json')
	.error(function() { alert('Error: sell_item(' + id_item + ', ' + quantity + ')'); })
}

/* End of file interface.conversation.js */
/* Location: ./assets/js/interface.conversation.js */	