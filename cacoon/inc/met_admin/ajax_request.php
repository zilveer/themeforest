<?php

	if(is_numeric($_POST["id"]) && is_string($_POST["name"]) && is_string($_POST["category"])){
		$ajax_met_options = get_option('met_options');

		if(isset($ajax_met_options[$_POST["category"]][$_POST["name"]])){
			unset($ajax_met_options[$_POST["category"]][$_POST["name"]]);
			update_option($shortname.'_options',$ajax_met_options);
		}
	}else{
		return false;
	}

?>