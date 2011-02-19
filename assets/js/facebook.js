FB.init({ 
	'appId' : '119204944778534', 
	'cookie' : true, 
	'status' : true, 
	'xfbml' : true 
});
	
function invite_friends(title, message)
{
	FB.ui({ 
		'method' : 'apprequests', 
		'title' : title,
		'message' : message
	});
}
	
function post_wall(url, picture, name, caption, description)
{
	FB.ui({
		'method' : 'feed',
		'caption' : caption,
		'description' : description, 
		'name' : name,
		'link' : url,
		'picture' : picture	
	});
}

function get_friends()
{
	FB.api({'method' : 'friends.getAppUsers'},
		function(response){
			alert(response);
		}
	);
}