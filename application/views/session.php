<?php

require_once('facebook.php');

$app_id = '119204944778534';
$app_secret = '1375dadc2ad75f35365a99ab3cc02c2a';

$facebook = new Facebook(
	array(
		'appId'  => $app_id,
		'secret' => $app_secret,
		'cookie' => true,
		'domain' => 'http://lc.in.th/world/'
	)
);

$session = $facebook->getSession();

if(!$session)
{
	$url = $facebook->getLoginUrl(array(
		'req_perms' => 'publish_stream',
		'canvas'    => 1,
		'fbconnect' => 0,
		'next'      => 'http://apps.facebook.com/thelifecycle/'
	));
	echo '<script>top.location.href = "' . $url . '";</script>';
}
else
{
	$me = $facebook->api('/me');
	$data = array(
		'lang' => $me['locale']
	);
	$this->session->set_userdata($data);
}
	
$data = array(
	'lang' => 'th_TH'
);	
$this->session->set_userdata($data);
	
?>