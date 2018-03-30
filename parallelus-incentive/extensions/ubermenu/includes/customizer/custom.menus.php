<?php

/***********

MENU STYLES

************/



///////////////////////////////////////
//////// THE MANAGEMENT
///////////////////////////////////////


function ubermenu_generate_all_menu_styles( $menu_styles = false ){

	$styles = '';

	if( !$menu_styles ){
		$menu_styles = get_option( UBERMENU_MENU_STYLES , array() );
	}

	foreach( $menu_styles as $menu_id => $rules ){
		
		if( empty( $rules ) ) continue;

		$styles.= "/* $menu_id */\n";

		foreach( $rules as $selector => $property_map ){
			$styles.= "$selector { ";
			foreach( $property_map as $property => $value ){

				if( is_array( $value ) ){
					//Multiple instances of this property  (for example, when using browser prefix gradients)
					foreach( $value as $v ){
						$styles.= "$property:$v; ";
					}
				}
				else{
					$styles.= "$property:$value; ";
				}
			}
			$styles.= "}\n";
		}
	}

	return $styles;

}


/**
 * Call ubermenu_save_menu_styles() for each menu instance
 */
add_action( 'ubermenu_settings_panel_updated' , 'ubermenu_save_all_menu_styles' );
add_action( 'customize_save_after' , 'ubermenu_save_all_menu_styles' );
function ubermenu_save_all_menu_styles(){

	ubermenu_save_menu_styles( 'main' );

	if( function_exists( 'ubermenu_get_menu_instances' ) ){
		$menus = ubermenu_get_menu_instances();
		foreach( $menus as $menu_id ){
			ubermenu_save_menu_styles( $menu_id );
		}
	}

	ubermenu_reset_generated_styles();	//clears transient

	add_settings_error( 'menu' , 'menu-styles' , 'Custom menu styles updated.' , 'updated' );

}


/**
 * For each field, checks to see if it has a custom style callback.
 * If callback exists, runs it to generate the style and adds that 
 * style to the master array of styles.  Then saves all styles back
 * to the DB in an array format 
 * ($menu_id => $selector => $property => $value )
 * 
 * @param  string  $menu_id The ID of the menu instance to save
 * @param  boolean $fields  An optional set of fields to use.  
 *                          Uses all registered settings by default
 */
function ubermenu_save_menu_styles( $menu_id , $fields = false ){

	$menu_key = UBERMENU_PREFIX . $menu_id;

	if( !$fields ){
		$all_fields = ubermenu_get_settings_fields();
		$fields = $all_fields[$menu_key];
	}

	$menu_styles = array();

	/*
	if( !isset( $menu_styles[$menu_id] ) ){
		$menu_styles[$menu_id] = array();
	}
	*/

	foreach( $fields as $field ){

		if( isset( $field['custom_style'] ) ){
			$callback = 'ubermenu_get_menu_style_'. $field['custom_style'];

			if( function_exists( $callback ) ){
				$callback( $field , $menu_id , $menu_styles );
			}
		}

	}

	//up( $menu_styles );
	
	$all_styles = get_option( UBERMENU_MENU_STYLES , array() );
	$all_styles[$menu_id] = $menu_styles;
//up( $all_styles );
	update_option( UBERMENU_MENU_STYLES , $all_styles );

}





///////////////////////////////////////
//////// HELPERS
///////////////////////////////////////


/*
 * HELPER: BACKGROUND GRADIENT
 */

function ubermenu_set_menu_style_background_gradient( $val , $selector , &$menu_styles ){
	
		
	$colors = explode( ',' , $val );

	switch( count( $colors ) ){

		/* Flat */
		case 1:
			$menu_styles[$selector]['background'] = $val;
			break;

		/* Gradient */
		case 2:

			$c1 = $colors[0];
			$c2 = $colors[1];

			//Check for leading #hash
			if( $c1[0] != '#' ) $c1 = '#'.$c1;
			if( $c2[0] != '#' ) $c2 = '#'.$c2;

			//$property_map = array();


			$menu_styles[$selector]['background-color'] = $c1;

			//Multiple background values 
			$menu_styles[$selector]['background'] = array();

			$menu_styles[$selector]['background'][] = "-webkit-gradient(linear,left top,left bottom,from($c1),to($c2))";
			$menu_styles[$selector]['background'][] = "-webkit-linear-gradient(top,$c1,$c2)";
			$menu_styles[$selector]['background'][] = "-moz-linear-gradient(top,$c1,$c2)";
			$menu_styles[$selector]['background'][] = "-ms-linear-gradient(top,$c1,$c2)";
			$menu_styles[$selector]['background'][] = "-o-linear-gradient(top,$c1,$c2)";
			$menu_styles[$selector]['background'][] = "linear-gradient(top,$c1,$c2)";

	}
}




///////////////////////////////////////
//////// CALLBACKS
///////////////////////////////////////


/* 
 * MENU BAR BACKGROUND
 */
function ubermenu_get_menu_style_menu_bar_background( $field , $menu_id , &$menu_styles ){
//echo 'mbback';
	$val = ubermenu_op( $field['name'] , $menu_id );
	$selector = ".ubermenu-$menu_id";
	if( $val ){
		ubermenu_set_menu_style_background_gradient( $val , $selector , $menu_styles );
		//$menu_styles[$selector]['background'] = $background;
	}
	else{
		//echo 'unset';
		//unset( $menu_styles[$selector]['background'] );
	}

}

/* 
 * MENU BAR BORDER
 */
function ubermenu_get_menu_style_menu_bar_border( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id";
		$color = $val[0] == '#' ? $val : '#'.$val;		
		$menu_styles[$selector]['border'] = "1px solid $color";
	}
	else{
		if( ubermenu_op( 'skin' , $menu_id ) == 'none' ){
			$menu_styles[".ubermenu-$menu_id.ubermenu-transition-fade .ubermenu-item .ubermenu-submenu-drop"]['margin-top'] = 0;
		}
	}

}

/* 
 * MENU BAR RADIUS
 */
function ubermenu_get_menu_style_menu_bar_radius( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id, .ubermenu-$menu_id > .ubermenu-target";

		$radius = $val;
		if( is_numeric( $radius ) ) $radius.= 'px';
		
		$menu_styles[$selector]['-webkit-border-radius'] = $radius;
		$menu_styles[$selector]['-moz-border-radius'] = $radius;
		$menu_styles[$selector]['-o-border-radius'] = $radius;
		$menu_styles[$selector]['border-radius'] = $radius;
	}

}



/* 
 * TOP LEVEL FONT SIZE
 */
function ubermenu_get_menu_style_top_level_font_size( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-item-level-0 > .ubermenu-target";

		$size = is_numeric( $val ) ? $val.'px' : $val;
		
		$menu_styles[$selector]['font-size'] = $size;
	}
}

/* 
 * TOP LEVEL TEXT TRANSFORM
 */
function ubermenu_get_menu_style_top_level_text_transform( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-item-level-0 > .ubermenu-target";		
		$menu_styles[$selector]['text-transform'] = $val;
	}
}

/* 
 * TOP LEVEL FONT WEIGHT
 */
function ubermenu_get_menu_style_top_level_font_weight( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-nav .ubermenu-item.ubermenu-item-level-0 > .ubermenu-target";		
		$menu_styles[$selector]['font-weight'] = $val;
	}
}


/* 
 * TOP LEVEL FONT COLOR
 */
function ubermenu_get_menu_style_top_level_font_color( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-item-level-0 > .ubermenu-target";
		
		$menu_styles[$selector]['color'] = $val;
	}
}

/* 
 * TOP LEVEL FONT COLOR - HOVER
 */
function ubermenu_get_menu_style_top_level_font_color_hover( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu.ubermenu-$menu_id .ubermenu-item-level-0:hover > .ubermenu-target, .ubermenu-$menu_id .ubermenu-item-level-0.ubermenu-active > .ubermenu-target";	//removed notouch
		
		$menu_styles[$selector]['color'] = $val;
	}
}

/* 
 * TOP LEVEL FONT COLOR - CURRENT
 */
function ubermenu_get_menu_style_top_level_font_color_current( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-item-level-0.ubermenu-current-menu-item > .ubermenu-target, ".
					".ubermenu-$menu_id .ubermenu-item-level-0.ubermenu-current-menu-parent > .ubermenu-target, ".
					".ubermenu-$menu_id .ubermenu-item-level-0.ubermenu-current-menu-ancestor > .ubermenu-target";
		
		$menu_styles[$selector]['color'] = $val;
	}
}

/* 
 * TOP LEVEL FONT COLOR - HIGHLIGHT
 */
function ubermenu_get_menu_style_top_level_font_color_highlight( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-item.ubermenu-item-level-0 > .ubermenu-highlight";		
		$menu_styles[$selector]['color'] = $val;
	}
}

/* 
 * TOP LEVEL BACKGROUND - HOVER
 */
function ubermenu_get_menu_style_top_level_background_hover( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu.ubermenu-$menu_id .ubermenu-item-level-0:hover > .ubermenu-target, .ubermenu-$menu_id .ubermenu-item-level-0.ubermenu-active > .ubermenu-target";	//removed notouch
		
		//$menu_styles[$selector]['background'] = $val;
		ubermenu_set_menu_style_background_gradient( $val , $selector , $menu_styles );
	}
}

/* 
 * TOP LEVEL BACKGROUND - CURRENT
 */
function ubermenu_get_menu_style_top_level_background_current( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-item-level-0.ubermenu-current-menu-item > .ubermenu-target, ".
					".ubermenu-$menu_id .ubermenu-item-level-0.ubermenu-current-menu-parent > .ubermenu-target, ".
					".ubermenu-$menu_id .ubermenu-item-level-0.ubermenu-current-menu-ancestor > .ubermenu-target";
		
		//$menu_styles[$selector]['background'] = $val;
		ubermenu_set_menu_style_background_gradient( $val , $selector , $menu_styles );
	}
}

/* 
 * TOP LEVEL BACKGROUND - HIGHLIGHT
 */
function ubermenu_get_menu_style_top_level_background_highlight( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-item.ubermenu-item-level-0 > .ubermenu-highlight";
		
		//$menu_styles[$selector]['background'] = $val;
		ubermenu_set_menu_style_background_gradient( $val , $selector , $menu_styles );
	}
}

function ubermenu_force_styles( $menu_id ){
	if( ubermenu_op( 'force_styles' , $menu_id ) == 'on' ){
		return true;
	}
	return false;
}

/* 
 * TOP LEVEL ITEM DIVIDER COLOR
 */
function ubermenu_get_menu_style_top_level_item_divider_color( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-item-level-0 > .ubermenu-target";
		if( ubermenu_force_styles( $menu_id ) ){
			$menu_styles[$selector]['border-left'] = "1px solid $val";
		}
		else{
			$menu_styles[$selector]['border-left-color'] = $val;
		}
	}
}

/* 
 * TOP LEVEL ITEM GLOW OPACITY
 */
function ubermenu_get_menu_style_top_level_item_glow_opacity( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val != '' ){
		$selector = ".ubermenu-$menu_id .ubermenu-item-level-0 > .ubermenu-target";
		$menu_styles[$selector]['-webkit-box-shadow'] = 'inset 1px 0 0 0 rgba(255,255,255,'. $val.')';
		$menu_styles[$selector]['-moz-box-shadow'] = 'inset 1px 0 0 0 rgba(255,255,255,'. $val.')';
		$menu_styles[$selector]['-o-box-shadow'] = 'inset 1px 0 0 0 rgba(255,255,255,'. $val.')';
		$menu_styles[$selector]['box-shadow'] = 'inset 1px 0 0 0 rgba(255,255,255,'. $val.')';
	}
}

/* 
 * TOP LEVEL ITEM GLOW OPACITY - Hover
 */
function ubermenu_get_menu_style_top_level_item_glow_opacity_hover( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( is_numeric( $val ) ){
		$selector = ".ubermenu-$menu_id .ubermenu-item-level-0.ubermenu-active > .ubermenu-target";
		$menu_styles[$selector]['-webkit-box-shadow'] = 'inset 1px 0 0 0 rgba(255,255,255,'. $val.')';
		$menu_styles[$selector]['-moz-box-shadow'] = 'inset 1px 0 0 0 rgba(255,255,255,'. $val.')';
		$menu_styles[$selector]['-o-box-shadow'] = 'inset 1px 0 0 0 rgba(255,255,255,'. $val.')';
		$menu_styles[$selector]['box-shadow'] = 'inset 1px 0 0 0 rgba(255,255,255,'. $val.')';
	}
}


/*
 * TOP LEVEL VERTICAL PADDING
 */
function ubermenu_get_menu_style_top_level_padding( $field , $menu_id , &$menu_styles ){

	$padding = ubermenu_op( $field['name'] , $menu_id );

	if( $padding ){

		if( is_numeric($padding) ) $padding.= 'px';

		$selector = ".ubermenu-$menu_id .ubermenu-item-level-0 > .ubermenu-target";
		
		$menu_styles[$selector]['padding-top'] = $padding;
		$menu_styles[$selector]['padding-bottom'] = $padding;
	}
}

/*
 * TOP LEVEL HORIZONTAL PADDING
 */
function ubermenu_get_menu_style_top_level_horiz_padding( $field , $menu_id , &$menu_styles ){

	$padding = ubermenu_op( $field['name'] , $menu_id );
	$indicator_width = 15;

	if( $padding ){

		$padding_raw = $padding;

		if( is_numeric($padding) ){
			$padding.= 'px';
		}
		else{
			//$padding_sub_indicator = trim( $padding_sub_indicator , 'px' );
			$padding_raw = trim( $padding_raw , 'px' );
		}

		$padding_sub_indicator = $padding_raw;
		$selector_offset = $padding_raw;

		if( is_numeric( $padding_sub_indicator ) ){
			$padding_sub_indicator+= $indicator_width;
			$padding_sub_indicator.= 'px';
		}
		else{
			$padding_sub_indicator = false;
		}


		$selector = ".ubermenu-$menu_id .ubermenu-item-level-0 > .ubermenu-target";
		
		$menu_styles[$selector]['padding-left'] = $padding;
		$menu_styles[$selector]['padding-right'] = $padding;

		//If a numeric or px value was set, add extra padding for the indicator
		if( $padding_sub_indicator && ( ubermenu_op( 'style_extra_submenu_indicator_padding' , $menu_id ) != 'off' ) ){
			$with_sub_selector = ".ubermenu-{$menu_id}.ubermenu-sub-indicators .ubermenu-item-level-0.ubermenu-has-submenu-drop > .ubermenu-target";
			$menu_styles[$with_sub_selector]['padding-right'] = $padding_sub_indicator;
		}
		else{
			$selector_offset-= $indicator_width;
			if( $selector_offset < 0 ) $selector_offset = 0;
		}

		if( is_numeric( $selector_offset ) && ubermenu_op( 'style_align_submenu_indicator' , $menu_id ) == 'text' ){
			$indicator_selector = ".ubermenu-{$menu_id}.ubermenu-sub-indicators .ubermenu-item-level-0.ubermenu-has-submenu-drop > .ubermenu-target:after";
			$selector_offset.='px';
			$menu_styles[$indicator_selector]['right'] = $selector_offset;
		}
		
	}
}


/*
 * TOP LEVEL ITEM HEIGHT
 */
function ubermenu_get_menu_style_top_level_item_height( $field , $menu_id , &$menu_styles ){

	$height = ubermenu_op( $field['name'] , $menu_id );

	

	if( $height ){

		if( is_numeric($height) ) $height.= 'px';

		$selector = ".ubermenu-$menu_id .ubermenu-item-level-0 > .ubermenu-target";
		
		$menu_styles[$selector]['height'] = $height;
	}
}


/* 
 * SUBMENU BACKGROUND COLOR
 */
function ubermenu_get_menu_style_submenu_background_color( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-submenu.ubermenu-submenu-drop";		
		$menu_styles[$selector]['background-color'] = $val;
	}
}

/* 
 * SUBMENU BORDER COLOR
 */
function ubermenu_get_menu_style_submenu_border_color( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-submenu.ubermenu-submenu-drop";		
		$menu_styles[$selector]['border-color'] = $val;
	}
}

/* 
 * SUBMENU DROPSHADOW OPACITY
 */
function ubermenu_get_menu_style_submenu_dropshadow_opacity( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( is_numeric( $val ) ){

		if( $val > 1 ) $val = $val / 100;

		$propval = "0 0 20px rgba(0,0,0, $val)";
		if( $val == 0 ) $propval = 'none';

		$selector = ".ubermenu-$menu_id .ubermenu-item-level-0 > .ubermenu-submenu-drop";
		$menu_styles[$selector]['box-shadow'] = $propval;
	}
}



/* 
 * SUBMENU FALLBACK FONT COLOR
 */
function ubermenu_get_menu_style_submenu_fallback_font_color( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-submenu.ubermenu-submenu-drop";		
		$menu_styles[$selector]['color'] = $val;
	}
}

/* 
 * SUBMENU MINIMUM COLUMN WIDTH
 */
function ubermenu_get_menu_style_submenu_minimum_column_width( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		if( is_numeric( $val ) ) $val.='px';
		$selector = ".ubermenu-$menu_id .ubermenu-submenu .ubermenu-column";		
		$menu_styles[$selector]['min-width'] = $val;
	}
}

/* 
 * SUBMENU HIGHLIGHT FONT COLOR
 */
function ubermenu_get_menu_style_submenu_highlight_font_color( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-submenu .ubermenu-highlight";		
		$menu_styles[$selector]['color'] = $val;
	}
}



/* 
 * HEADER FONT SIZE
 */
function ubermenu_get_menu_style_header_font_size( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		if( is_numeric( $val ) ) $val.='px';
		$selector = ".ubermenu-$menu_id .ubermenu-submenu .ubermenu-item-header > .ubermenu-target, .ubermenu-$menu_id .ubermenu-tab > .ubermenu-target";
		$menu_styles[$selector]['font-size'] = $val;
	}
}


/* 
 * HEADER FONT COLOR
 */
function ubermenu_get_menu_style_header_font_color( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-submenu .ubermenu-item-header > .ubermenu-target";		
		$menu_styles[$selector]['color'] = $val;
	}
}

/* 
 * HEADER FONT COLOR - HOVER
 */
function ubermenu_get_menu_style_header_font_color_hover( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-submenu .ubermenu-item-header > .ubermenu-target:hover";
		$menu_styles[$selector]['color'] = $val;
	}
}

/* 
 * HEADER FONT COLOR - CURRENT
 */
function ubermenu_get_menu_style_header_font_color_current( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-submenu .ubermenu-item-header.ubermenu-current-menu-item > .ubermenu-target";
		$menu_styles[$selector]['color'] = $val;
	}
}


/* 
 * HEADER FONT WEIGHT
 */
function ubermenu_get_menu_style_header_font_weight( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-nav .ubermenu-submenu .ubermenu-item-header > .ubermenu-target";
		$menu_styles[$selector]['font-weight'] = $val;
	}
}

/* 
 * HEADER BORDER COLOR
 */
function ubermenu_get_menu_style_header_border_color( $field , $menu_id , &$menu_styles ){

	$selector = ".ubermenu-$menu_id .ubermenu-submenu .ubermenu-item-header.ubermenu-has-submenu-stack > .ubermenu-target";

	if( ubermenu_op( 'display_header_border_color' , $menu_id ) == 'off' ){
		$menu_styles[$selector]['border'] = 'none';
		$menu_styles[".ubermenu-$menu_id .ubermenu-submenu-type-stack"]['padding-top'] = 0;
	}
	else{
		$val = ubermenu_op( $field['name'] , $menu_id );
		if( $val ){
			if( ubermenu_force_styles( $menu_id ) ){
				$menu_styles[$selector]['border-bottom'] = "1px solid $val";
			}
			else{
				$menu_styles[$selector]['border-color'] = $val;
			}
		}
	}

}



/*
 * SUBMENU ITEM PADDING
 */
function ubermenu_get_menu_style_submenu_item_padding( $field , $menu_id , &$menu_styles ){
	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val || is_numeric( $val ) ){	//include '0'
		if( is_numeric( $val ) ){
			$val.= 'px';
		}
		$selector = 
			".ubermenu-$menu_id .ubermenu-item-normal > .ubermenu-target,".
			".ubermenu-$menu_id .ubermenu-submenu .ubermenu-target,".
			".ubermenu-$menu_id .ubermenu-submenu .ubermenu-nonlink,".
			".ubermenu-$menu_id .ubermenu-submenu .ubermenu-widget,".
			".ubermenu-$menu_id .ubermenu-submenu .ubermenu-custom-content-padded,".
			".ubermenu-$menu_id .ubermenu-submenu .ubermenu-retractor,".
			".ubermenu-$menu_id .ubermenu-submenu .ubermenu-colgroup .ubermenu-column,".
			".ubermenu-$menu_id .ubermenu-submenu.ubermenu-submenu-type-stack > .ubermenu-item-normal > .ubermenu-target,".
			".ubermenu-$menu_id .ubermenu-submenu.ubermenu-submenu-padded";
		$menu_styles[$selector]['padding'] = $val;

		//Grid Row
		$menu_styles['.ubermenu .ubermenu-grid-row']['padding-right'] = $val;
		$menu_styles['.ubermenu .ubermenu-grid-row .ubermenu-target']['padding-right'] = 0;
	}
}


/* 
 * NORMAL FONT COLOR
 */
function ubermenu_get_menu_style_normal_font_color( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-item-normal > .ubermenu-target";		
		$menu_styles[$selector]['color'] = $val;
	}
}

/* 
 * NORMAL FONT COLOR - HOVER
 */
function ubermenu_get_menu_style_normal_font_color_hover( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu.ubermenu-$menu_id .ubermenu-item-normal > .ubermenu-target:hover"; //removed notouch
		$menu_styles[$selector]['color'] = $val;
	}
}

/* 
 * NORMAL FONT COLOR - CURRENT
 */
function ubermenu_get_menu_style_normal_font_color_current( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-item-normal.ubermenu-current-menu-item > .ubermenu-target";
		$menu_styles[$selector]['color'] = $val;
	}
}

/* 
 * NORMAL FONT SIZE
 */
function ubermenu_get_menu_style_normal_font_size( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		if( is_numeric( $val ) ) $val.='px';
		$selector = ".ubermenu-$menu_id .ubermenu-item-normal > .ubermenu-target";		
		$menu_styles[$selector]['font-size'] = $val;
	}
}

/* 
 * NORMAL BACKGROUND COLOR - HOVER
 */
function ubermenu_get_menu_style_normal_background_hover( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu.ubermenu-$menu_id .ubermenu-item-normal > .ubermenu-target:hover, .ubermenu.ubermenu-$menu_id .ubermenu-item-normal.ubermenu-active > .ubermenu-target"; //removed notouch
		$menu_styles[$selector]['background-color'] = $val;
	}
}

/* 
 * FLYOUT VERTICAL PADDING
 */
function ubermenu_get_menu_style_flyout_vertical_padding( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		if( is_numeric( $val ) ) $val.='px';
		$selector = ".ubermenu-$menu_id .ubermenu-submenu-type-flyout > .ubermenu-item-normal > .ubermenu-target";		
		$menu_styles[$selector]['padding-top'] = $val;
		$menu_styles[$selector]['padding-bottom'] = $val;
	}
}


/* 
 * DESCRIPTION FONT SIZE
 */
function ubermenu_get_menu_style_description_font_size( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		if( is_numeric( $val ) ) $val.='px';
		$selector = ".ubermenu-$menu_id .ubermenu-target > .ubermenu-target-description";
		$menu_styles[$selector]['font-size'] = $val;
	}
}

/* 
 * DESCRIPTION FONT COLOR
 */
function ubermenu_get_menu_style_description_font_color( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-target > .ubermenu-target-description, .ubermenu-$menu_id .ubermenu-submenu .ubermenu-target > .ubermenu-target-description";
		$menu_styles[$selector]['color'] = $val;
	}
}

/* 
 * DESCRIPTION TEXT TRANSFORM
 */
function ubermenu_get_menu_style_description_text_transform( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-target > .ubermenu-target-description";
		$menu_styles[$selector]['text-transform'] = $val;
	}
}

/*
 * TOP LEVEL ARROW COLOR
 */
function ubermenu_get_menu_style_top_level_arrow_color( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-item-level-0.ubermenu-has-submenu-drop > .ubermenu-target:after";
		$menu_styles[$selector]['color'] = $val;
	}
}

/*
 * SUBMENU ARROW COLOR
 */
function ubermenu_get_menu_style_submenu_arrow_color( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-submenu .ubermenu-has-submenu-drop > .ubermenu-target:after";
		$menu_styles[$selector]['color'] = $val;
	}
}


/*
 * HR
 */
function ubermenu_get_menu_style_hr( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-submenu .ubermenu-divider > hr";
		$menu_styles[$selector]['border-top-color'] = $val;
	}
}


/*
 * RESPONSIVE MENU MAX HEIGHT
 */
function ubermenu_get_menu_style_responsive_max_height( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		if( is_numeric( $val ) ) $val.='px';
		$selector = ".ubermenu.ubermenu-$menu_id:not(.ubermenu-responsive-collapse)";
		$menu_styles[$selector]['max-height'] = $val;

		//$breakpoint = ubermenu_op( 'responsive_breakpoint' , 'general' );
		//$menu_styles[$selector]['media_query'] = "@media screen and (max-width:$breakpoint)";
	}
}



/* 
 * SEARCH BACKGROUND
 */
function ubermenu_get_menu_style_search_background( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu.ubermenu-$menu_id .ubermenu-search input.ubermenu-search-input";
		$menu_styles[$selector]['background'] = $val;
	}
}

/* 
 * SEARCH TEXT COLOR
 */
function ubermenu_get_menu_style_search_color( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu.ubermenu-$menu_id .ubermenu-search input.ubermenu-search-input";
		$menu_styles[$selector]['color'] = $val;
	}
}

/* 
 * SEARCH PLACEHOLDER COLOR
 */
function ubermenu_get_menu_style_search_placeholder_color( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu.ubermenu-$menu_id .ubermenu-search input.ubermenu-search-input";
		$menu_styles[$selector.'::-webkit-input-placeholder']['color'] = $val;
		$menu_styles[$selector.'::-moz-placeholder']['color'] = $val;
		$menu_styles[$selector.'::-ms-input-placeholder']['color'] = $val;
	}
}

/* 
 * SEARCH ICON COLOR
 */
function ubermenu_get_menu_style_search_icon_color( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu.ubermenu-$menu_id .ubermenu-search .ubermenu-search-submit";
		$menu_styles[$selector]['color'] = $val;
	}
}



/* 
 * TOGGLE BACKGROUND
 */
function ubermenu_get_menu_style_toggle_background( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-responsive-toggle.ubermenu-responsive-toggle-$menu_id";
		$menu_styles[$selector]['background'] = $val;
	}
}
/* 
 * TOGGLE COLOR
 */
function ubermenu_get_menu_style_toggle_color( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-responsive-toggle.ubermenu-responsive-toggle-$menu_id";
		$menu_styles[$selector]['color'] = $val;
	}
}

/* 
 * TOGGLE BACKGROUND - HOVER
 */
function ubermenu_get_menu_style_toggle_background_hover( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-responsive-toggle.ubermenu-responsive-toggle-$menu_id:hover";
		$menu_styles[$selector]['background'] = $val;
	}
}
/* 
 * TOGGLE COLOR - HOVER
 */
function ubermenu_get_menu_style_toggle_color_hover( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-responsive-toggle.ubermenu-responsive-toggle-$menu_id:hover";
		$menu_styles[$selector]['color'] = $val;
	}
}



/*
 * ROW SPACING
 */

function ubermenu_get_menu_style_row_spacing( $field , $menu_id , &$menu_styles ){

	$row_spacing = ubermenu_op( $field['name'] , $menu_id );
	if( $row_spacing !== '' ){
		$selector = ".ubermenu-$menu_id .ubermenu-row";
		
		//Assume pixels if no units provided
		if( is_numeric( $row_spacing ) ){
			$row_spacing.='px';
		}

		$menu_styles[$selector]['margin-bottom'] = $row_spacing;
	}

}

/*
 * ICON WIDTH
 */
function ubermenu_get_menu_style_icon_width( $field , $menu_id , &$menu_styles ){

	$icon_width = ubermenu_op( $field['name'] , $menu_id );
	if( $icon_width !== '' ){
		$selector = ".ubermenu-$menu_id .ubermenu-icon";
		
		//Assume pixels if no units provided
		if( is_numeric( $icon_width ) ){
			$icon_width.='px';
		}

		$menu_styles[$selector]['width'] = $icon_width;
	}

}

/*
 * MENU BAR WIDTH
 */

function ubermenu_get_menu_style_bar_width( $field , $menu_id , &$menu_styles ){

	$bar_width = ubermenu_op( $field['name'] , $menu_id );
	if( $bar_width ){
		$selector = ".ubermenu-$menu_id";
		
		//Assume pixels if no units provided
		if( is_numeric( $bar_width ) ){
			$bar_width.='px';
		}

		$menu_styles[$selector]['max-width'] = $bar_width;
	}

}

/*
 * MENU BAR MARGIN TOP
 */

function ubermenu_get_menu_style_bar_margin_top( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id";
		
		//Assume pixels if no units provided
		if( is_numeric( $val ) ){
			$val.='px';
		}

		$menu_styles[$selector]['margin-top'] = $val;
	}

}

/*
 * MENU BAR MARGIN BOTTOM
 */

function ubermenu_get_menu_style_bar_margin_bottom( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id";
		
		//Assume pixels if no units provided
		if( is_numeric( $val ) ){
			$val.='px';
		}

		$menu_styles[$selector]['margin-bottom'] = $val;
	}

}

/*
 * INNER MENU BAR WIDTH
 */

function ubermenu_get_menu_style_bar_inner_width( $field , $menu_id , &$menu_styles ){

	$bar_width = ubermenu_op( $field['name'] , $menu_id );
	if( $bar_width ){
		$selector = ".ubermenu-$menu_id .ubermenu-nav";
		
		//Assume pixels if no units provided
		if( is_numeric( $bar_width ) ){
			$bar_width.='px';
		}

		$menu_styles[$selector]['max-width'] = $bar_width;
	}

}


/*
 * SUBMENU INNER WIDTH
 */

function ubermenu_get_menu_style_submenu_inner_width( $field , $menu_id , &$menu_styles ){

	$submenu_width = ubermenu_op( $field['name'] , $menu_id );
	if( $submenu_width ){
		$selector = ".ubermenu-$menu_id .ubermenu-row";
		
		//Assume pixels if no units provided
		if( is_numeric( $submenu_width ) ){
			$submenu_width.='px';
		}

		$menu_styles[$selector]['max-width'] = $submenu_width;
		$menu_styles[$selector]['margin-left'] = 'auto';
		$menu_styles[$selector]['margin-right'] = 'auto';
	}

}

/*
 * SUBMENU MAX HEIGHT
 */

function ubermenu_get_menu_style_submenu_max_height( $field , $menu_id , &$menu_styles ){

	$val = ubermenu_op( $field['name'] , $menu_id );
	if( $val ){
		$selector = ".ubermenu-$menu_id .ubermenu-active > .ubermenu-submenu.ubermenu-submenu-type-mega";
		
		//Assume pixels if no units provided
		if( is_numeric( $val ) ){
			$val.='px';
		}

		$menu_styles[$selector]['max-height'] = $val;
	}

}

/*
 * VERTICAL SUBMENU WIDTH
 */

function ubermenu_get_menu_style_vertical_submenu_width( $field , $menu_id , &$menu_styles ){

	$submenu_width = ubermenu_op( $field['name'] , $menu_id );
	if( $submenu_width ){
		$selector = ".ubermenu-$menu_id.ubermenu-vertical .ubermenu-submenu-type-mega";
		
		//Assume pixels if no units provided
		if( is_numeric( $submenu_width ) ){
			$submenu_width.='px';
		}

		$menu_styles[$selector]['width'] = $submenu_width;
	}

}


/*
 * IMAGE WIDTH
 */
function ubermenu_get_menu_style_image_width( $field , $menu_id , &$menu_styles ){

	$rules = array(
		'image_left' => array(
			'selector'	=> ".ubermenu-$menu_id .ubermenu-item-layout-image_left > .ubermenu-target-text",
			'property'	=> 'padding-left',
		),
		'image_right' => array(
			'selector'	=> ".ubermenu-$menu_id .ubermenu-item-layout-image_right > .ubermenu-target-text",
			'property'	=> 'padding-right',
		),
	);

	$value = ubermenu_op( $field['name'] , $menu_id ); // + 10;
	if( !$value ) return;
	$value+= 10;	//10px padding
	$value.= 'px';
	//echo $value;

	foreach( $rules as $layout => $rule ){

		$selector = $rule['selector'];
		$property = $rule['property'];

		if( !isset( $menu_styles[$selector] ) ){
		//if( !isset( $menu_styles[$menu_id][$selector] ) ){
			$menu_styles[$selector] = array();
			//$menu_styles[$menu_id][$selector] = array();
		}

		$menu_styles[$selector][$property] = $value;
		//$menu_styles[$menu_id][$selector][$property] = $value;

	}

}


/*
 * TRANSITION DURATION
 */
function ubermenu_get_menu_style_transition_duration( $field , $menu_id , &$menu_styles ){

	$duration = ubermenu_op( $field['name'] , $menu_id );

	if( $duration ){

		//Assume seconds if no units provided
		if( is_numeric( $duration ) ){
			$duration.= 's';
		}

		$selector = ".ubermenu-$menu_id .ubermenu-item .ubermenu-submenu-drop";
		$menu_styles[$selector]['-webkit-transition-duration'] = $duration;
		$menu_styles[$selector]['-ms-transition-duration'] = $duration;
		$menu_styles[$selector]['transition-duration'] = $duration;
	}
}


/*
 * DROPDOWN WITHIN MEGA
 */
function ubermenu_get_menu_style_dropdown_within_mega( $field , $menu_id , &$menu_styles ){
	if( ubermenu_op( $field['name'] , $menu_id ) == 'on' ){
		$menu_styles[".ubermenu-$menu_id .ubermenu-item .ubermenu-submenu-drop.ubermenu-submenu-type-mega"]['overflow'] = 'visible';
	}
}
