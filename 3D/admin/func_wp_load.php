<?php if(file_exists('../../../../../wp-config.php')){include_once('../../../../../wp-config.php');} ?>
    
<?php
global $wpdb;	$prefix = $wpdb->prefix;
$loadingBar = '<div class="progress"><div class="bar pink" style="width: 100%;"></div></div>';

$three_folder = '../../../../..';


function add_iam($cat_id, $title, $value1, $value2, $value3, $value4, $value5, $value6, $func, $ord)
{
	global $prefix;
	
	$cat_id = trim(mysql_real_escape_string($cat_id));
	$title = trim(mysql_real_escape_string($title));
	$value1 = trim(mysql_real_escape_string($value1));
	$value2 = trim(mysql_real_escape_string($value2));
	$value3 = trim(mysql_real_escape_string($value3));
	$value4 = trim(mysql_real_escape_string($value4));
	$value5 = trim(mysql_real_escape_string($value5));
	$value6 = trim(mysql_real_escape_string($value6));
	$func = trim(mysql_real_escape_string($func));
	$ord = trim(mysql_real_escape_string($ord));
	
	mysql_query("INSERT INTO ".$prefix."iam 
	(cat_id, title, value1, value2, value3, value4, value5, value6, func, ord)
	VALUES
	('$cat_id', '$title', '$value1', '$value2', '$value3', '$value4', '$value5', '$value6', '$func', '$ord')");
	if(mysql_affected_rows() > 0)
	{
		return true;	
	}
	else
	{
		echo mysql_error();
		return false;	
	}
	echo mysql_error();
}


function update_iam($cat_id, $title, $value1, $value2, $value3, $value4, $value5, $value6, $func, $ord, $id)
{
	global $prefix;
	
	$cat_id = trim(mysql_real_escape_string($cat_id));
	$title = trim(mysql_real_escape_string($title));
	$value1 = trim(mysql_real_escape_string($value1));
	$value2 = trim(mysql_real_escape_string($value2));
	$value3 = trim(mysql_real_escape_string($value3));
	$value4 = trim(mysql_real_escape_string($value4));
	$value5 = trim(mysql_real_escape_string($value5));
	$value6 = trim(mysql_real_escape_string($value6));
	$func = trim(mysql_real_escape_string($func));
	$ord = trim(mysql_real_escape_string($ord));
	$id = trim(mysql_real_escape_string($id));
	
	if($id == ''){$where = "cat_id='".$cat_id."' AND title='".$title."'";}
	else
	{
		$where = "id='".$id."'";
	}
	
	if(mysql_num_rows(mysql_query("SELECT * FROM ".$prefix."iam WHERE $where")) > 0)
	{
		$update = mysql_query("UPDATE ".$prefix."iam SET 
		value1='$value1',
		value2='$value2',
		value3='$value3',
		value4='$value4',
		value5='$value5',
		value6='$value6',
		func='$func',
		ord='$ord'
		WHERE $where");
		if(mysql_affected_rows() > 0)
		{
			return true;	
		}
		else
		{
			if($update){return true;}
			else{return false;}	
		}
		echo mysql_error();
	}
	else
	{
		$sonuc = add_iam($cat_id, $title, $value1, $value2, $value3, $value4, $value5, $value6, $func, $ord);
		return $sonuc;
	}
	echo mysql_error();
}


function get_iam($id, $title, $value)
{
	global $prefix;
	if($id == ''){$where = "title='$title'";}
	else{$where = "id='$id'";}
	
	$query = mysql_query("SELECT * FROM ".$prefix."iam WHERE $where");
	while($list = mysql_fetch_assoc($query))
	{
		$q_slider_id = $list['id'];
		$value1 = $list['value1'];
		$value2 = $list['value2'];
		$value3 = $list['value3'];
		$value4 = $list['value4'];
		$value5 = $list['value5'];
		$value6 = $list['value6'];
	}
	
	if($value == '1'){return $value1;}
	else if($value == '2'){return $value2;}
	else if($value == '3'){return $value3;}
	else if($value == '4'){return $value4;}
	else if($value == '5'){return $value5;}
	else if($value == '6'){return $value6;}
	else {return false;}
}
?>