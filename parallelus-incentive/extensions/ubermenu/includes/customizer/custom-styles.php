<?php

require_once 'custom.menu-items.php';
require_once 'custom.menus.php';


/*
Array formats

UBERMENU_SKIN_GENERATOR_STYLES	=> array(
	'my_skin'					=> array(		//Skin ID

	),
);

UBERMENU_MENU_STYLES		=> array(
	'main'			 		=> array(			//Menu ID => Rules
		'.ubermenu'			=> array(			//Selector
			'color'			=> 'red',			//Property => Value
		)
	)
);

UBERMENU_MENU_ITEM_STYLES	=> array(
	'51'					=> array(			//Menu Item ID => Rules
		'.ubermenu #menu-item-51'	=> array(	//Selector
			'color'		=>	'red',				//Property => Value
			'background'=>	'blue',				//Property => Value
		)
	),

);
*/

function ubermenu_get_custom_styles(){

	$styles = get_transient( UBERMENU_GENERATED_STYLE_TRANSIENT );

	//No valid transient - regenerate
	if( $styles === false ){
		$styles = ubermenu_generate_custom_styles();
		set_transient( UBERMENU_GENERATED_STYLE_TRANSIENT , $styles , UBERMENU_GENERATED_STYLE_TRANSIENT_EXPIRATION );
		$styles.= "\n/* Status: Regenerated */\n";
	}
	//Valid transient, good to go
	else{
		$styles.= "\n/* Status: Loaded from Transient */\n";
	}	

	return $styles;
}

add_action( 'ubermenu_after_menu_item_save' , 'ubermenu_reset_generated_styles' );
function ubermenu_reset_generated_styles(){
	delete_transient( UBERMENU_GENERATED_STYLE_TRANSIENT );
}

/**
 * Build the custom CSS from the various arrays of CSS property/values
 * @return [type] [description]
 */
function ubermenu_generate_custom_styles(){

	$styles = array();

	//Skin Generator
	//$skin_styles = '';
	//$skin_styles = "\n/** UberMenu Skin Generator **/\n".$skin_styles;
	//$styles[10] = $skin_styles;


	//Responsive Styles
	$responsive_styles = ubermenu_custom_responsive_styles();
	if( $responsive_styles ){
		$responsive_styles = "\n/** UberMenu Responsive Styles (Breakpoint Setting) **/\n".$responsive_styles;
		$styles[10] = $responsive_styles;	
	}



	//Menu Styles
	global $wp_customize;
	if( !isset( $wp_customize ) ){
		$menu_styles = ubermenu_generate_all_menu_styles();
		if( $menu_styles ){
			$menu_styles = "\n/** UberMenu Custom Menu Styles (Customizer) **/\n".$menu_styles;
			$styles[20] = $menu_styles;
		}
	}


	//Menu Item Styles
	$item_styles = ubermenu_generate_item_styles();
	if( $item_styles ){
		$item_styles = "\n/** UberMenu Custom Menu Item Styles (Menu Item Settings) **/\n" . $item_styles;
	}
	$styles[30] = $item_styles;	
	
	


	//Custom Styles
	$custom_styles = ubermenu_op( 'custom_tweaks' , 'general' );
	if( $custom_styles ){
		$custom_styles = "\n/** UberMenu Custom Tweaks (General Settings) **/\n".$custom_styles;
		$styles[50] = $custom_styles;
	}

	//Custom Styles - Mobile
	$custom_styles_mobile = ubermenu_op( 'custom_tweaks_mobile' , 'general' );
	if( $custom_styles_mobile ){
		$max_width = ubermenu_op( 'responsive_breakpoint' , 'general' );
		if( !$max_width ) $max_width = 959;
		if( is_numeric( $max_width ) ) $max_width.='px';
		$custom_styles_mobile = 
			"\n/** UberMenu Custom Tweaks - Mobile **/\n".
			"@media screen and (max-width:".$max_width."){\n".
				$custom_styles_mobile.
			"\n}";
		$styles[60] = $custom_styles_mobile;
	}


	//Custom Styles - Desktop
	$custom_styles_desktop = ubermenu_op( 'custom_tweaks_desktop' , 'general' );
	if( $custom_styles_desktop ){
		$min_width = ubermenu_op( 'responsive_breakpoint' , 'general' );
		if( !$min_width ) $min_width = 960;
		else{ $min_width = $min_width + 1; }

		if( is_numeric( $min_width ) ) $min_width.='px';
		$custom_styles_desktop = 
			"\n/** UberMenu Custom Tweaks - Desktop **/\n".
			"@media screen and (min-width:".$min_width."){\n".
				$custom_styles_desktop.
			"\n}";
		$styles[100] = $custom_styles_desktop;
	}
		

	$styles = apply_filters( 'ubermenu_custom_styles' , $styles );

	return implode( "\n" , $styles );
}

function ubermenu_custom_responsive_styles(){
	

	$breakpoint_primary = ubermenu_op( 'responsive_breakpoint' , 'general' );
	if( !$breakpoint_primary ){
		//$breakpoint_primary = 959;
		return;
	}

	$dir = UBERMENU_DIR . 'assets/css/less/';
	$css = '';
	
	$breakpoint_primary = intval( $breakpoint_primary );
	$breakpoint_expand = $breakpoint_primary+1;
	$breakpoint_secondary = 480;

	//Above
	$above = file_get_contents( $dir.'responsive_breakpoint_above.less' );
	if( $above ){
		$above.= ' .ubermenu-responsive-toggle{ display:none; }';
		$above = str_replace( '&' , '' , $above );
		$above = str_replace( "\t" , '' , $above );
		$above = str_replace( "\n" , ' ' , $above );
		$above = "@media screen and (min-width: {$breakpoint_expand}px){\n  ".
					$above.
					"\n}\n";
		$css.= $above;
	}

	//Primary
	$primary = file_get_contents( $dir.'responsive_breakpoint_primary.less' );
	if( $primary ){
		$primary.= ' .ubermenu-responsive-toggle{ display:block; }';
		$primary = str_replace( '&' , '' , $primary );
		$primary = str_replace( "\t" , '' , $primary );
		$primary = str_replace( "\n" , ' ' , $primary );
		$primary = "@media screen and (max-width: {$breakpoint_primary}px){\n  ".
					$primary.
					"\n}\n";

		$css.= $primary;
		//$primary = str_replace( '}' , "}\n" , $primary );
		
	}

	//Secondary
	$secondary = file_get_contents( $dir.'responsive_breakpoint_secondary.less' );
	if( $secondary ){
		$secondary = str_replace( '&' , '' , $secondary );
		$secondary = str_replace( "\t" , '' , $secondary );
		$secondary = str_replace( "\n" , ' ' , $secondary );
		$secondary = "@media screen and (max-width: {$breakpoint_secondary}px){\n  ".
					$secondary.
					"\n}\n";

		$css.= $secondary;
		//$primary = str_replace( '}' , "}\n" , $primary );
		
	}


	//echo '<pre>'.$css.'</pre>';
	return $css;

}





