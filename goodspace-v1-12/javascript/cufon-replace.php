jQuery(document).ready(function(){
	<?php 
		global $all_font;

		$used_font = substr(get_option(THEME_SHORT_NAME.'_header_font'), 2);
		
		if($used_font != 'default -'){
			if($all_font[$used_font]['type'] == 'Cufon'){
				echo "Cufon.replace(jQuery('h1, h2, h3, h4, h5, h6, .gdl-title').not('.nivo-caption .gdl-title'), {fontFamily: '" . $used_font . "' , hover: true});";
			}
		}
		
		$used_font = substr(get_option(THEME_SHORT_NAME.'_stunning_text_font'), 2);
		
		if($used_font != 'default -'){
			if($all_font[$used_font]['type'] == 'Cufon'){
				echo "Cufon.replace('.stunning-text-title', {fontFamily: '" . $used_font . "'});";
			}
		}

		$used_font = substr(get_option(THEME_SHORT_NAME.'_slider_title_font'), 2);
		
		if($used_font != 'default -'){
			if($all_font[$used_font]['type'] == 'Cufon'){
				echo "Cufon.replace('.gdl-slider-title', {fontFamily: '" . $used_font . "'});";
			}
		}		
	?>
});