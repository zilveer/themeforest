<?php

	// Google Analytics
	add_action('wp_head', 'gdl_google_analytics_code');
	function gdl_google_analytics_code(){
		$gdl_enable_analytics = get_option(THEME_SHORT_NAME.'_enable_analytics','disable');
		if( $gdl_enable_analytics == 'enable' ){
			echo get_option(THEME_SHORT_NAME.'_analytics_code','');
		}
	}	
	
	// Disabling right click
	add_action('wp_footer', 'gdl_disable_right_click');
	function gdl_disable_right_click(){
		$enable_right_click = get_option(THEME_SHORT_NAME.'_disable_right_click','disable');
		$right_click_text = get_option(THEME_SHORT_NAME.'_right_click_alert','');
		
		if( $enable_right_click == 'enable' ){
			echo '<script type="text/javascript">';
			echo 'jQuery(function() {';
			echo 'jQuery(this).bind("contextmenu", function(e) {';
			if( !empty($right_click_text) ){
				echo 'alert("' .  $right_click_text . '");';
				echo 'e.preventDefault();';
			}else{
				echo 'e.preventDefault();';
			}
			echo '});';
			echo '});'; 
			echo '</script>';
		} 
	}
	
	// Included cufon to footer
	add_action('wp_footer', 'gdl_add_cufon');
	function gdl_add_cufon() {
		global $all_font;

		echo '<script type="text/javascript">';
		echo 'jQuery(document).ready(function(){';
		
		$used_font = substr(get_option(THEME_SHORT_NAME.'_header_font'), 2);
		if($used_font != 'default -'){
			if($all_font[$used_font]['type'] == 'Cufon'){
				echo "Cufon.replace(jQuery('h1, h2, h3, h4, h5, h6').not('.gdl-slider-title, .stunning-text-title'), {fontFamily: '" . $used_font . "' , hover: true});";
				echo "jQuery('h1, h2, h3, h4, h5, h6').not('.gdl-slider-title, .stunning-text-title').css('visibility', 'visible');";
			}
		}
		
		$used_font = substr(get_option(THEME_SHORT_NAME.'_navigation_font'), 2);
		if($used_font != 'default -'){
			if($all_font[$used_font]['type'] == 'Cufon'){
				echo "Cufon.replace(jQuery('div.navigation-wrapper'), {fontFamily: '" . $used_font . "' , hover: true});";
				echo "jQuery('div.navigation-wrapper').css('visibility', 'visible');";
			}
		}		
		
		$used_font = substr(get_option(THEME_SHORT_NAME.'_slider_title_font'), 2);
		if($used_font != 'default -'){
			if($all_font[$used_font]['type'] == 'Cufon'){
				echo "Cufon.replace(jQuery('.gdl-slider-title').not('.nivo-caption .gdl-slider-title'), {fontFamily: '" . $used_font . "' , hover: true});";
				echo "jQuery('.gdl-slider-title').not('.nivo-caption .gdl-slider-title').css('visibility', 'visible');";
			}
		}		
		
		$used_font = substr(get_option(THEME_SHORT_NAME.'_stunning_text_font'), 2);
		if($used_font != 'default -'){
			if($all_font[$used_font]['type'] == 'Cufon'){
				echo "Cufon.replace('.stunning-text-title', {fontFamily: '" . $used_font . "'});";
				echo "jQuery('.stunning-text-title').css('visibility', 'visible');";
			}
		}

		echo '});';
		echo '</script>';
	}

?>