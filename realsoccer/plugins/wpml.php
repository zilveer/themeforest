<?php
	/*	
	*	Goodlayers WPML Support File
	*/
	
	// add_action('gdlr_top_left_menu', 'gdlr_get_wpml_nav', 1);
	if(!function_exists('gdlr_get_wpml_nav')){
		function gdlr_get_wpml_nav(){
			if( function_exists('icl_get_languages') ){
?>
<li class="gdlr-mega-menu">
	<a href="#"><i class="icon-globe"></i><?php echo ICL_LANGUAGE_NAME; ?></a>
	<div class="sf-mega">
		<div class="sf-mega-section gdlr-wpml-language-selector">
		<?php 
			
				$languages = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str'); 
				foreach($languages as $language){
					echo '<div class="sub-menu-item">';
					echo '<img src="' . $language['country_flag_url'] . '" alt="" />';
					echo '<a href="' . $language['url'] . '" >' . $language['translated_name'] . '</a>';
					echo '</div>';
					
				}
		?>
		</div>
	</div>
</li>
<?php		
			}
		}
	}
	
	// Translate the wpml shortcode
	// [wpml_translate lang=en]LANG EN[/wpml_translate]
	// [wpml_translate lang=de]LANG DE[/wpml_translate]
	add_shortcode('wpml_translate', 'wpml_translate_shortcode');	
	if( !function_exists('wpml_translate_shortcode') ){
		function wpml_translate_shortcode( $atts, $content = null ) {
			extract(shortcode_atts(array( 'lang' => '' ), $atts));
			
			$lang_active = ICL_LANGUAGE_CODE;
			if($lang == $lang_active){
				return $content;
			}
		}	
	}
	
?>