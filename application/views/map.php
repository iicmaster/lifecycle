<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test Map</title>
<?php echo js_asset('jquery-1.4.4.min.js') ?>
<script>
	$(function(){
		$(':input.button').click(function(){
			get_detail('map', $(this).attr('id'));
		});
	});
	function get_detail(location_type, id_location){
		$.post('<?php echo base_url(); ?>main/get_detail/' + location_type  + '/' + id_location, function(data){
			alert(data['name']);
			alert(data['description']);
		},'json');	
	}
</script>
</head>
<body>
<input id="1" class="button" type="button" value="Button" />
</body>
</html>