<?php

	$path = dirname(__FILE__);
	$os = ((strpos(strtolower(PHP_OS), 'win') === 0) || (strpos(strtolower(PHP_OS), 'cygwin') !== false)) ? 'win' : 'other';
	$abspath = ($os === "win") ? substr($path, 0, strpos($path, "\wp-content"))."\wp-load.php" : substr($path, 0, strpos($path, "/wp-content"))."/wp-load.php";
	require_once($abspath);

	$template_name = $_POST['template'];
	$newname = "";
	$name = "";
	if (isset($_POST['newname'])){
		$newname = $_POST['newname'];	
		$name = preg_replace("/[^0-9a-zA-Z_]/", "_", $newname);
	} 
	
	switch ($_POST['action']){
		case "load_template":
			$opts = get_option($_POST['current']);
			echo json_encode($opts);
		break;
		case "save_current":
			$output = array("des_template_tab" => array("type" => $_POST['template'], "nicename"=> $newname, "name"=> $name));
			$idx = 0;
			foreach ($_POST['opts'] as $op){
				array_push($output, array($_POST['opts'][$idx], $_POST['values'][$idx]));
				$idx++;
			}
			$response = "";
			if (update_option($_POST['current'], $output)){
				$response .= "1";
			} else $response .= "0";
			echo $response;
		break;
		case "save_new":
			if (get_option("des_template_[$template_name]_$name") == false){
				$output = array("des_template_tab" => array("type" => $_POST['template'], "nicename"=> $newname, "name"=> $name));
				$idx = 0;
				foreach($_POST['opts'] as $op){
					array_push($output, array($_POST['opts'][$idx], $_POST['values'][$idx]));
					$idx++;
				}
				add_option("des_template_[$template_name]_$name", $output, null, "no");
				$des_styletemplates = array();
				global $wpdb;
				$q = "SELECT * from ".$wpdb->prefix."options WHERE option_name LIKE 'des_template_[%'";
				$res = $wpdb->get_results($q, OBJECT);
				foreach($res as $r){
					array_push($des_styletemplates, $r->option_name);
				}
				update_option("des_styletemplates",$des_styletemplates);
			}
			echo json_encode($output);
		break;
		case "delete_current":
			$fail = true;
			if (delete_option($_POST['current'])) $fail = false;
			$output = array();
			global $wpdb;
			$q = "SELECT * from ".$wpdb->prefix."options WHERE option_name LIKE 'des_template_[%'";
			$res = $wpdb->get_results($q, OBJECT);
			foreach($res as $r){
				array_push($output, $r->option_name);
			}
			update_option("des_styletemplates",$output);
			if ($fail){
				echo json_encode("something went wrong");
			} else {
				echo json_encode("itemdeleted");
			}
		break;
	}
	
?>