<?php

/***********

MENU ITEM STYLES

***********/

function ubermenu_generate_item_styles(){
	$item_styles = get_option( UBERMENU_MENU_ITEM_STYLES , array() );

	$styles = '';

	foreach( $item_styles as $item_id => $rules ){

		if( empty( $rules ) ) continue;

		$spacing = 12;
		$delim = "/* $item_id */";
		$remainder = $spacing - strlen( $delim );
		$styles.= $delim . str_repeat( ' ' , $remainder );

		$k = 0;
		foreach( $rules as $selector => $property_map ){
			if( $k > 0 ) $styles.= str_repeat( ' ' , $spacing );
			$k++;

			$styles.= "$selector { ";
			foreach( $property_map as $property => $value ){
				$styles.= "$property:$value; ";
			}
			$styles.= "}\n";
		}
	}
	return $styles;
}


//Saving is deferred until after all properties have been processed for efficiency
add_action( 'ubermenu_after_menu_item_save' , 'ubermenu_update_item_styles' );
function ubermenu_update_item_styles(){
	_UBERMENU()->update_item_styles();
}


function ubermenu_set_item_style( $item_id , $selector , $property_map ){
	_UBERMENU()->set_item_style( $item_id , $selector , $property_map );
}


function ubermenu_item_save_background_color( $item_id , $setting , $val , &$saved_settings ){
	//up( $setting ); //echo $val; //die();
	
	if( !$val ) return;

	$selector = ".ubermenu .ubermenu-item.ubermenu-item-$item_id > .ubermenu-target";

	$property_map = array(
		'background'	=> $val
	);

	ubermenu_set_item_style( $item_id , $selector , $property_map );

}
function ubermenu_item_save_font_color( $item_id , $setting , $val , &$saved_settings ){

	if( !$val ) return;

	$selector = ".ubermenu .ubermenu-item.ubermenu-item-$item_id > .ubermenu-target";

	$property_map = array(
		'color'	=> $val
	);

	ubermenu_set_item_style( $item_id , $selector , $property_map );
	
}

function ubermenu_item_save_background_color_active( $item_id , $setting , $val , &$saved_settings ){
	//up( $setting ); //echo $val; //die();
	
	if( !$val ) return;

	$selector = ".ubermenu .ubermenu-item.ubermenu-item-$item_id.ubermenu-active > .ubermenu-target, .ubermenu .ubermenu-item.ubermenu-item-$item_id > .ubermenu-target:hover, .ubermenu .ubermenu-submenu .ubermenu-item.ubermenu-item-$item_id.ubermenu-active > .ubermenu-target, .ubermenu .ubermenu-submenu .ubermenu-item.ubermenu-item-$item_id > .ubermenu-target:hover";	//removed notouch

	$property_map = array(
		'background'	=> $val
	);

	ubermenu_set_item_style( $item_id , $selector , $property_map );

}
function ubermenu_item_save_font_color_active( $item_id , $setting , $val , &$saved_settings ){

	if( !$val ) return;

	//$selector = ".ubermenu .ubermenu-item.ubermenu-item-$item_id.ubermenu-active > .ubermenu-target, .ubermenu .ubermenu-submenu .ubermenu-item.ubermenu-item-$item_id.ubermenu-active > .ubermenu-target";
	$selector = ".ubermenu .ubermenu-item.ubermenu-item-$item_id.ubermenu-active > .ubermenu-target, .ubermenu .ubermenu-item.ubermenu-item-$item_id:hover > .ubermenu-target, .ubermenu .ubermenu-submenu .ubermenu-item.ubermenu-item-$item_id.ubermenu-active > .ubermenu-target, .ubermenu .ubermenu-submenu .ubermenu-item.ubermenu-item-$item_id:hover > .ubermenu-target";

	$property_map = array(
		'color'	=> $val
	);

	ubermenu_set_item_style( $item_id , $selector , $property_map );
	
}

/*
 * ITEM PADDING
 */
function ubermenu_item_save_padding( $item_id , $setting , $val , &$saved_settings ){

	if( $val || is_numeric( $val ) ){	//include '0'
		if( is_numeric( $val ) ){
			$val.= 'px';
		}
		$selector = 
			".ubermenu .ubermenu-item.ubermenu-item-$item_id > .ubermenu-target,".
			".ubermenu .ubermenu-item.ubermenu-item-$item_id > .ubermenu-content-block,".
			".ubermenu .ubermenu-item.ubermenu-item-$item_id.ubermenu-custom-content-padded";
		
		$property_map = array(
			'padding'	=> $val
		);

		ubermenu_set_item_style( $item_id , $selector , $property_map );
	}
}


/*
 * ROW PADDING
 */
function ubermenu_item_save_row_padding( $item_id , $setting , $val , &$saved_settings ){

	if( $val || is_numeric( $val ) ){	//include '0'
		if( is_numeric( $val ) ){
			$val.= 'px';
		}
		$selector = ".ubermenu .ubermenu-row-id-$item_id";

		$property_map = array(
			'padding'	=> $val
		);

		ubermenu_set_item_style( $item_id , $selector , $property_map );
	}
}

/*
 * TAB PANELS PADDING
 */
function ubermenu_item_save_panels_padding( $item_id , $setting , $val , &$saved_settings ){

	if( $val || is_numeric( $val ) ){	//include '0'
		if( is_numeric( $val ) ){
			$val.= 'px';
		}
		$selector = ".ubermenu .ubermenu-tabs.ubermenu-item-$item_id > .ubermenu-tabs-group > .ubermenu-tab > .ubermenu-tab-content-panel";

		$property_map = array(
			'padding'	=> $val
		);

		ubermenu_set_item_style( $item_id , $selector , $property_map );
	}
}




function ubermenu_item_save_submenu_background_color( $item_id , $setting , $val , &$saved_settings ){

	if( !$val ) return;

	$selector = ".ubermenu .ubermenu-submenu.ubermenu-submenu-id-$item_id";

	$property_map = array(
		'background-color' => $val
	);

	ubermenu_set_item_style( $item_id , $selector , $property_map );
}

function ubermenu_item_save_submenu_color( $item_id , $setting , $val , &$saved_settings ){

	if( !$val ) return;

	$selector = ".ubermenu .ubermenu-submenu.ubermenu-submenu-id-$item_id .ubermenu-target, .ubermenu .ubermenu-submenu.ubermenu-submenu-id-$item_id .ubermenu-target > .ubermenu-target-description";

	$property_map = array(
		'color' => $val
	);

	ubermenu_set_item_style( $item_id , $selector , $property_map );
}

function ubermenu_item_save_submenu_width( $item_id , $setting , $val , &$saved_settings ){

	if( !$val ) return;

	$selector = ".ubermenu .ubermenu-submenu.ubermenu-submenu-id-$item_id";

	if( is_numeric( $val ) ){
		$val.='px';
	}

	$property_map = array(
		'width' => $val,
		'min-width' => $val,
	);

	ubermenu_set_item_style( $item_id , $selector , $property_map );
}

function ubermenu_item_save_submenu_min_width( $item_id , $setting , $val , &$saved_settings ){

	if( !$val ) return;

	$selector = ".ubermenu .ubermenu-submenu.ubermenu-submenu-id-$item_id";

	if( is_numeric( $val ) ) $val.= 'px';

	$property_map = array(
		'min-width' => $val
	);

	ubermenu_set_item_style( $item_id , $selector , $property_map );
}

function ubermenu_item_save_submenu_background_image( $item_id , $setting , $val , &$saved_settings ){

	if( !$val ) return;

	$selector = ".ubermenu .ubermenu-submenu.ubermenu-submenu-id-$item_id";

	$img_src = wp_get_attachment_image_src( $val , 'full' );
	$img_url = $img_src[0];

	$background_image = "url($img_url)";

	$background_repeat = $saved_settings['submenu_background_image_repeat'];
	$background_position = $saved_settings['submenu_background_position'];
	$background_size = $saved_settings['submenu_background_size'];


	$property_map = array(
		'background-image'	=> $background_image,
		'background-repeat'	=> $background_repeat,
		'background-position' => $background_position,
		'background-size'	=> $background_size,
	);

	ubermenu_set_item_style( $item_id , $selector , $property_map );

}

function ubermenu_item_save_submenu_padding( $item_id , $setting , $val , &$saved_settings ){

	if( !$val ) return;

	$selector = ".ubermenu .ubermenu-submenu.ubermenu-submenu-id-$item_id";

	$property_map = array(
		'padding'	=>	$val,
	);

	ubermenu_set_item_style( $item_id , $selector , $property_map );

}

function ubermenu_item_save_image_dimensions( $item_id , $setting , $val , &$saved_settings ){

	if( !$val ) return;

	//If there's no image set, we don't need to do anything
	$img_id = $saved_settings['item_image'];

	if( !$img_id ){
		if( $saved_settings['inherit_featured_image'] == 'on' ){
			$post_id = get_post_meta( $item_id , '_menu_item_object_id' , true );
			$thumb_id = get_post_thumbnail_id( $post_id );
			if( $thumb_id ) $img_id = $thumb_id;
		}
	}


	if( $img_id ){

		if( $val == 'natural' ){

			$layout = $saved_settings['item_layout'];
			if( $layout == 'default' ) $layout = 'image_left';

			if( in_array( $layout , array( 'image_left' , 'image_right' /*, 'image_top' , 'image_bottom'*/ ) ) ){

				$selector = ".ubermenu .ubermenu-item-$item_id > .ubermenu-target.ubermenu-item-layout-$layout > ";

				
				$img_size = $saved_settings['image_size'];
				$img_src = wp_get_attachment_image_src( $img_id , $img_size );
				$img_w = $img_src[1];

				$padding = $img_w + 10;

				$property = '';
				switch( $layout ){

					//Add padding to left of text
					case 'image_left':
						$property = 'padding-left';
						$selector.= '.ubermenu-target-text';
						break;

					//Add padding to right of text
					case 'image_right':
						$property = 'padding-right';
						$selector.= '.ubermenu-target-text';
						break;

					/*
					//Add padding to bottom of image
					case 'image_above':
						$property = 'padding-bottom';
						$selector.= '.ubermenu-image';
						$padding = 10;
						break;

					//Add padding to top of image
					case 'image_below':
						$property = 'padding-top';
						$selector.= '.ubermenu-image';
						$padding = 10;
						break;
					*/
					
				}

				$property_map = array(
					$property => $padding.'px',
				);

				ubermenu_set_item_style( $item_id , $selector , $property_map );
				return;
			}
		}
	}
	//Do this to make sure to trigger reset
	ubermenu_set_item_style( $item_id , false , false );
}

function ubermenu_item_save_image_width_custom( $item_id , $setting , $val , &$saved_settings ){
	
	if( !$val ) return;

	//If there's no image set, we don't need to do anything
	$img_id = $saved_settings['item_image'];

	if( !$img_id ){
		if( $saved_settings['inherit_featured_image'] == 'on' ){
			$post_id = get_post_meta( $item_id , '_menu_item_object_id' , true );
			$thumb_id = get_post_thumbnail_id( $post_id );
			if( $thumb_id ) $img_id = $thumb_id;
		}
	}

	if( $img_id ){

		if( $saved_settings['image_dimensions'] == 'custom' ){

			$layout = $saved_settings['item_layout'];
			if( $layout == 'default' ) $layout = 'image_left';

			if( in_array( $layout , array( 'image_left' , 'image_right' /*, 'image_top' , 'image_bottom'*/ ) ) ){

				$selector = ".ubermenu .ubermenu-item-$item_id > .ubermenu-target.ubermenu-item-layout-$layout > ";
				
				$padding = $val + 10;

				$property = '';
				switch( $layout ){

					//Add padding to left of text
					case 'image_left':
						$property = 'padding-left';
						$selector.= '.ubermenu-target-text';
						break;

					//Add padding to right of text
					case 'image_right':
						$property = 'padding-right';
						$selector.= '.ubermenu-target-text';
						break;
					
				}

				$property_map = array(
					$property => $padding.'px',
				);

				ubermenu_set_item_style( $item_id , $selector , $property_map );
				return;
			}
		}
	}

	//Do this to make sure to trigger reset
	ubermenu_set_item_style( $item_id , false , false );
}





