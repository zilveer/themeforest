<?php

	/*	
	*	Goodlayers Theme Customizer File
	*	---------------------------------------------------------------------
	*	Add the ability to support the color for theme customization
	*	---------------------------------------------------------------------
	*/
	
	add_action( 'customize_register', 'themename_customize_register' );
	function themename_customize_register($wp_customize) {
		global $goodlayers_element, $goodlayers_menu;	
		
		$color_priority = 0;
		
		$color_menus = $goodlayers_menu[ __('Elements Color', 'gdl_back_office') ];
		foreach( $color_menus as $color_menu_name => $color_menu_slug ){
		
			// add the section of the elements color menu to theme customization
			$wp_customize->add_section( $color_menu_slug, array('title' => __('Color : ', 'gdl_back_office') . $color_menu_name, 'priority' => 1000 ) );
			
			// add each color inside
			foreach( $goodlayers_element[$color_menu_slug] as $element_name => $element ){
				if( !empty($element['name']) ){
					$wp_customize->add_setting( $element['name'], array(
						'default' => $element['default'],
						'type' => 'option',
						'capability' => 'edit_theme_options',
						'transport' => 'postMessage'
					));
					$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $element['name'] . '_id', array(
						'label'   => $element_name,
						'section' => $color_menu_slug,
						'settings' => $element['name'],
						'priority' => $color_priority
					)));	
					$color_priority++;
				}
			}
		}						
		
		// add the script of preview customization to the footer
		if ( $wp_customize->is_preview() && ! is_admin() ){
			add_action( 'wp_footer', 'gdl_customize_preview', 21);
		}		
		
		save_option(THEME_SHORT_NAME . '_stylesheet_generated', '', 'No');

	}
		
	function gdl_customize_preview() {		
		global $goodlayers_element, $goodlayers_menu;	
	
		echo '<script type="text/javascript">' . "\n";
		echo '(function($){' . "\n";
		echo 'var cur_color;' . "\n";
		echo 'var cur_bg_color;' . "\n";
		
		$color_menus = $goodlayers_menu[ __('Elements Color', 'gdl_back_office') ];
		foreach( $color_menus as $color_menu_name => $color_menu_slug ){		
			foreach( $goodlayers_element[$color_menu_slug] as $element ){
				if( !empty($element['attr']) && !empty($element['selector']) ){
					echo 'wp.customize("' . $element['name'] . '", function(value){';
					echo 'value.bind(function(to){';
					foreach($element['attr'] as $css_attr){
						if( strpos($element['selector'], ':hover') > 0 ){
							// if is hover
							$cur_selector = str_replace(':hover', '', $element['selector']);
							echo '$("' . $cur_selector . '").hover(function(){';
							echo 'cur_color = $(this).css("color");';
							echo 'cur_bg_color = $(this).css("background-color");';
							echo '$(this).css("' . $css_attr . '", to);';
							echo '}, function(){';
							if( $css_attr == 'background-color' ){
								echo '$(this).css("' . $css_attr . '", cur_bg_color);';
							}else{
								echo '$(this).css("' . $css_attr . '", cur_color);';
							}
							echo '});'; 
						}else{
							echo '$(\'' . $element['selector'] . '\').css("' . $css_attr . '", to);'; 
						}
					}
					echo '});'; // value.bind
					echo '});'; // wp.customize
					echo "\n";
				}
			}
		}
		
// contact / comment script
$temp_sel = 'div.contact-form-wrapper input[type="text"], div.contact-form-wrapper input[type="password"], div.contact-form-wrapper textarea, ';
$temp_sel = $temp_sel . 'div.sidebar-wrapper #search-text input[type="text"], ';
$temp_sel = $temp_sel . 'div.sidebar-wrapper .contact-widget input, div.custom-sidebar .contact-widget textarea, ';
$temp_sel = $temp_sel . 'div.comment-wrapper input[type="text"], div.comment-wrapper input[type="password"], div.comment-wrapper textarea';

?>
var cur_inner_shadow = '<?php echo get_option(THEME_SHORT_NAME.'_contact_form_inner_shadow', '#ececec'); ?>';
var cur_frame = '<?php echo get_option(THEME_SHORT_NAME.'_contact_form_frame_color', '#f7f7f7'); ?>'; 
wp.customize("<?php echo THEME_SHORT_NAME.'_contact_form_background_color'; ?>", function(value){value.bind(function(to){
	$('<?php echo $temp_sel; ?>').css("background-color", to);
});});
wp.customize("<?php echo THEME_SHORT_NAME.'_contact_form_text_color'; ?>", function(value){value.bind(function(to){
	$('<?php echo $temp_sel; ?>').css("color", to);
});});
wp.customize("<?php echo THEME_SHORT_NAME.'_contact_form_border_color'; ?>", function(value){value.bind(function(to){
	$('<?php echo $temp_sel; ?>').css("border-color", to);
});});
wp.customize("<?php echo THEME_SHORT_NAME.'_contact_form_frame_color'; ?>", function(value){value.bind(function(to){
	$('<?php echo $temp_sel; ?>').css("box-shadow", cur_inner_shadow + ' 0px 1px 4px inset, ' + to + ' -5px -5px 0px 0px, ' + to + ' 5px 5px 0px 0px, ' + to + ' 5px 0px 0px 0px, ' + to + ' 0px 5px 0px 0px, ' + to + ' 5px -5px 0px 0px, ' + to + ' -5px 5px 0px 0px');
	$('<?php echo $temp_sel; ?>').css("-webkit-box-shadow", cur_inner_shadow + ' 0px 1px 4px inset, ' + to + ' -5px -5px 0px 0px, ' + to + ' 5px 5px 0px 0px, ' + to + ' 5px 0px 0px 0px, ' + to + ' 0px 5px 0px 0px, ' + to + ' 5px -5px 0px 0px, ' + to + ' -5px 5px 0px 0px');
	cur_frame = to;
});});
wp.customize("<?php echo THEME_SHORT_NAME.'_contact_form_inner_shadow'; ?>", function(value){value.bind(function(to){
	$('<?php echo $temp_sel; ?>').css("box-shadow", to + ' 0px 1px 4px inset, ' + cur_frame + ' -5px -5px 0px 0px, ' + cur_frame + ' 5px 5px 0px 0px, ' + cur_frame + ' 5px 0px 0px 0px, ' + cur_frame + ' 0px 5px 0px 0px, ' + cur_frame + ' 5px -5px 0px 0px, ' + cur_frame + ' -5px 5px 0px 0px');
	$('<?php echo $temp_sel; ?>').css("-webkit-box-shadow", to + ' 0px 1px 4px inset, ' + cur_frame + ' -5px -5px 0px 0px, ' + cur_frame + ' 5px 5px 0px 0px, ' + cur_frame + ' 5px 0px 0px 0px, ' + cur_frame + ' 0px 5px 0px 0px, ' + cur_frame + ' 5px -5px 0px 0px, ' + cur_frame + ' -5px 5px 0px 0px');
	cur_inner_shadow = to;
});});
<?php
		echo '} )( jQuery );' . "\n";
		echo '</script>';
		
	} 	
	
	add_action('init', 'is_custom_style_generated');
	function is_custom_style_generated(){
		if( get_option(THEME_SHORT_NAME . '_stylesheet_generated') == 'No' ){
			gdl_generate_style_custom();
			save_option(THEME_SHORT_NAME . '_stylesheet_generated', 'No', '');				
		}	
	}

	
?>