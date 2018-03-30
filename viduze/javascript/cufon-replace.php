jQuery(document).ready(function(){
	<?php 
		global $all_font;

		$used_font = substr(get_option(THEME_NAME_S.'_header_font'), 2);
		
		if($used_font != 'default -'){
			if($all_font[$used_font]['type'] == 'Cufon'){
				echo "Cufon.replace(jQuery('.sf-menu li a strong, h1, h2, h3, h4, h5, h6, .cp-title').not('.nivo-caption .cp-title'), {fontFamily: '" . $used_font . "' , hover: true});";
			}
		}
		
		$used_font = substr(get_option(THEME_NAME_S.'_text_widget_font'), 2);
		
		if($used_font != 'default -'){
			if($all_font[$used_font]['type'] == 'Cufon'){
				echo "Cufon.replace(' .text-widget-title', {fontFamily: '" . $used_font . "'});";
			}
		}
	?>
});