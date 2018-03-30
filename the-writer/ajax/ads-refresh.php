<?php function ocmx_ads_refresh(){
	require_once(get_template_directory()."/ocmx/theme-setup/theme-options.php");
	$ad_count = get_option($_GET["option"]);
	ocmx_ad_form($_GET["prefix"], $_GET["count"], $_GET["width"]);
	die("");
}

function ocmx_ads_remove(){
	require_once(get_template_directory()."/ocmx/theme-setup/theme-options.php");
	$ad_count = get_option($_GET["option"]);
	
	$ad_number = $_GET["ad_number"];
	/*
	for($i = 1; $i <= $ad_count; $i++) :
		if($i > $ad_number) :
			update_option(get_option($_GET["prefix"]."_title_".$i), get_option($_GET["prefix"]."_title_".($i-1)));
			update_option(get_option($_GET["prefix"]."_link_".$i), get_option($_GET["prefix"]."_link_".($i-1)));
			update_option(get_option($_GET["prefix"]."_img_".$i), get_option($_GET["prefix"]."_img_".($i-1)));
			update_option(get_option($_GET["prefix"]."_href_".$i), get_option($_GET["prefix"]."_href_".($i-1)));
			update_option(get_option($_GET["prefix"]."_script_".$i), get_option($_GET["prefix"]."_script_".($i-1)));
		endif;
	endfor;
	update_option($_GET["option"], ($ad_count-1));
	*/
	die("");
}
?>