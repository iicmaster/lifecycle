<?php

function print_array($arr)
{
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
	exit();
}

function comma_to_array($text)
{
	return explode(',', $text);
}

function array_to_comma($arr)
{
	return implode(',', $arr);
}

/* End of file MY_array_helper.php */
/* Location: ./application/helpers/MY_array_helper.php */



