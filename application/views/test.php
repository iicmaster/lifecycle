<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://www.facebook.com/2008/fbml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test</title>
<?php echo $isFirst ?>
<?php echo js_asset('jquery-1.4.4.min.js') ?>
</head>
<body>
<div id="friends"></div>
<div id="fb-root"></div>
<script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>

<?php echo js_asset('facebook.js') ?>
<script>
$(function(){
	setTimeout(get_friends, 3000);
});
</script>
</body>
</html>