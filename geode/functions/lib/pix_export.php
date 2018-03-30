<?php
	date_default_timezone_set('America/Los_Angeles');
	header("Content-Type: plain/text");
	header("Content-Disposition: Attachment; filename=Geode_admin_panel_".date("d-m-Y_H-i",time()).".txt");
	header("Pragma: no-cache");

	$host =  $_POST['export_host']; 
	$user =  $_POST['export_user'];
	$pass =  $_POST['export_password']; 
	$db = $_POST['export_db']; 
	$upload_dir = $_POST['export_upload_dir']; 
	$theme_dir = $_POST['export_theme_dir']; 
	$table = $_POST['export_table']; 

	$sidebars = $_POST['export_sidebars']; 
	$sidebars = explode(',',$sidebars); 
	
	$link = mysql_connect($host, $user, $pass) or die("Can not connect." . mysql_error());
	
	mysql_select_db($db) or die("Can not connect."); 
	
	$i = 0;
	$txt_output = '';
	
	$values = mysql_query("SELECT option_name, option_value FROM $table WHERE option_name LIKE 'pix_content_%' OR option_name LIKE 'pix_style_%' OR option_name LIKE 'pix_geode_array%' OR option_name LIKE 'shortcodelic_%' OR option_name LIKE 'pixgridder_%'");
	while ($rowr = mysql_fetch_assoc($values)) {
		$option_value = str_replace($upload_dir, "%pix_upload_dir%", $rowr['option_value']);
		$option_value = str_replace($theme_dir, "%pix_theme_dir%", $option_value);
		$txt_output .= '[option_name]'.$rowr['option_name'].'[option_value]'.$option_value;
	}
	foreach ($sidebars as &$sidebar) {
		$txt_output .= '[option_name][sidebar_name][option_value]'.$sidebar;
	}
	echo $txt_output;
	exit;
?>