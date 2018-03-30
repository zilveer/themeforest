<?php
global $ocmx_version;
$ocmx_version = "2.9.6";

// The OCMX custom options form
function update_ocmx_options(){
	global $wpdb, $changes_done,$theme_options;
	
	//Clear our preset options, because we're gonna add news ones.
	wp_cache_flush(); 

	parse_str($_POST["data"], $data);
	print_r($data);
	
	$update_options = explode(", ", $data["update_ocmx"]);
	
	foreach($data as $key => $value) :
		if (substr($key, 0, 4) == "ocmx") :
			wp_cache_flush(); 			
			$clear_options = $wpdb->query("DELETE FROM $wpdb->options WHERE `option_name` = '".$key."'");
			update_option($key, stripslashes($value));
		endif;
	endforeach;
	
		
	foreach($update_options as $option) :
		if(is_array($theme_options[$option])):
			foreach($theme_options[$option] as $option) :
				if(isset($option["main_section"])) :
					foreach($option["sub_elements"] as $suboption) :
						if($suboption["input_type"] == "checkbox") :
							$key = $suboption["name"];
							if($data[$key]) :
								update_option($key, "true");
							else :
								update_option($key, "false");
							endif;
						endif;
					endforeach;
				elseif($option["input_type"] == "checkbox") : 
					$key = $option["name"];
					if($data[$key]) :
						update_option($key, "true");
					else :
						update_option($key, "false");
					endif;
				endif;
			endforeach;
		endif;
	endforeach;
	
	if(isset($data["ocmx_home_page_posts"]))
		update_option("posts_per_page", get_option("ocmx_home_page_posts"));
		
	$changes_done = 1;
	die("");
}
function reset_ocmx_options(){
	global $wpdb, $changes_done;
	
	//Clear our preset options, because we're gonna add news ones.
	wp_cache_flush(); 

	parse_str($_POST["data"], $data);
	
	$update_options = explode(",", $data["update_ocmx"]);
	
	foreach($update_options as $option) :
		ocmx_reset_option($option);
	endforeach;
	die("");
}
function ocmx_reset_option($option){
	global $theme_options;
	if(is_array($theme_options[$option])):
	
		foreach($theme_options[$option] as $themeoption) :	
			update_option($themeoption["name"], $themeoption["default"]);
			if($option == "home_page_options") :	
				foreach ($themeoption["options"] as $layout_option => $option_list) :
					ocmx_reset_option($layout_option."_home_options");
				endforeach;
			endif;
			if($option == "font_options") :	
				//Custom reset for the font options, since not all their options are set dynamically
				foreach($theme_options["font_options"]["elements"] as $font_option => $detail) :
					$option_default = $detail["name"]."_color";
					delete_option($option_default);
					$option_default = $detail["name"]."_style";
					delete_option($option_default);
					$option_default = $detail["name"]."_size";
					delete_option($option_default);
				endforeach;
				die("");
			endif;
		endforeach;
	endif;
}

add_action("update_ocmx_options", "update_ocmx_options");
add_action("reset_ocmx_options", "reset_ocmx_options"); ?>