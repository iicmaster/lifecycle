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

// users.getinfo fields picture
// pic = 100 * 300
// pic_big = 200 * 600
// pic_small = 50 *150
// pic_square = 50 * 50

function get_friends()
{
	FB.api({'method' : 'friends.getAppUsers'},
		function(fids)
		{
			FB.api(
				{
					'method' : 'users.getinfo',
					'uids' : fids,
					'fields' : 'name,pic_square'
				}, 
				function(response)
				{
					return response;
				}
			);
		}
	);
}