<?php
// Remove deprecated Elements From Visual Composer
vc_remove_element('vc_tabs');
vc_remove_element('vc_accordion');
vc_remove_element('vc_accordion_tab');
vc_remove_element('vc_posts_grid');
vc_remove_element('vc_carousel');
vc_remove_element('vc_button');
vc_remove_element('vc_button2');
vc_remove_element('vc_cta_button');
vc_remove_element('vc_cta_button2');
vc_remove_element('vc_tour');

// Elments Remove
vc_remove_element('vc_flickr');
vc_remove_element('vc_progress_bar');


/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
add_action('vc_before_init', 'sama_vcSetAsTheme' );
function sama_vcSetAsTheme() {
    vc_set_as_theme();
}

// Disable update for Visual Composer 
vc_set_as_theme( $disable_updater = false );



// Filter to replace default css class names for vc_row shortcode and vc_column
add_filter( 'vc_shortcodes_css_class', 'sama_custom_css_classes_for_vc_row_and_vc_column', 10, 2 );
function sama_custom_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {
  if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
	$class_string = preg_replace( '/vc_hidden/', 'hidden', $class_string );
	$class_string = preg_replace( '/vc_col-/', 'col-', $class_string );
  }
  return $class_string; // Important: you should always return modified or original $class_string
}


/* Custom Shortcode parm new fields for VC
---------------------------------------------------------- */
function sama_get_iconsmoon_font() {
	$icons = array(
		'' => '',
		'icon-intro' 		=> 'icon-intro',
		'icon-breakfast' 	=> 'icon-breakfast',
		'icon-desert' 		=> 'icon-desert',
		'icon-dinner' 		=> 'icon-dinner',
		'icon-drinks' 		=> 'icon-drinks',
		'icon-launch' 		=> 'icon-launch',
		'icon-home-ico' 	=> 'icon-home-ico',
		'icon-bottom-draw' 	=> 'icon-bottom-draw',	
	);
	return $icons;
}
//	Custom Icon Select
function sama_icons_moon_settings_field($settings, $value) {
	$fa_icons		= sama_get_iconsmoon_font();
	$dependency 	= vc_generate_dependencies_attributes($settings);
	$return 		= '<div class="icongroup"><input type="hidden" name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$settings['param_name'].' '.$settings['type'].'_field vc-icon-select" value="'.$value.'" '.$dependency.'>';
	$icon_value 	= $value;			
	$return 	.= '<div class="vc-icon-select wpb-icon-prefix">';
	foreach( $fa_icons as $k => $fontmoon_icon) { 
		 $return .= '<i class="'.$fontmoon_icon.' '.($icon_value == $k ? "selected" : "" ).'" data-icon="'.$k.'"></i>';
	}	
	$return .= '</div></div>';
	
	return $return;
}
vc_add_shortcode_param('iconsmoon', 'sama_icons_moon_settings_field' , get_template_directory_uri().'/includes/vc-extend/js/iconselect.js');


// CSS3 Animation Type
function sama_add_animation( $param_name = 'css_animation_type' ) {
	
	$sama_add_animation = array(
		'type' 		=> 'dropdown',
		'heading' 	=> esc_html__('CSS Animation', 'theme-majesty'),
		'param_name' 	=> $param_name,
		'admin_label' => true,
		'value' 		=> array (
			'No' 					=> '',
			'bounce' 				=> 'bounce',
			'flash' 				=> 'flash',
			'pulse' 				=> 'pulse',
			'rubberBand' 			=> 'rubberBand',
			'shake' 				=> 'shake',
			'swing' 				=> 'swing',
			'tada' 					=> 'tada',
			'wobble' 				=> 'wobble',
			'bounceIn' 				=> 'bounceIn',
			'bounceInDown' 			=> 'bounceInDown',
			'bounceInLeft' 			=> 'bounceInLeft',
			'bounceInRight' 		=> 'bounceInRight',
			'bounceInUp' 			=> 'bounceInUp',
			'bounceOut' 			=> 'bounceOut',
			'fadeIn' 				=> 'fadeIn',
			'fadeInDown' 			=> 'fadeInDown',
			'fadeInDownBig' 		=> 'fadeInDownBig',
			'fadeInLeft' 			=> 'fadeInLeft',
			'fadeInLeftBig' 		=> 'fadeInLeftBig',
			'fadeInRight' 			=> 'fadeInRight',
			'fadeInRightBig' 		=> 'fadeInRightBig',
			'fadeInUp' 				=> 'fadeInUp',
			'fadeInUpBig' 			=> 'fadeInUpBig',
			'flip' 					=> 'flip',
			'flipInX' 				=> 'flipInX',
			'flipInY' 				=> 'flipInY',
			'flipOutX' 				=> 'flipOutX',
			'flipOutY' 				=> 'flipOutY',
			'lightSpeedIn' 			=> 'lightSpeedIn',
			'lightSpeedOut' 		=> 'lightSpeedOut',
			'rotateIn' 				=> 'rotateIn',
			'rotateInDownLeft' 		=> 'rotateInDownLeft',
			'rotateInDownRight' 	=> 'rotateInDownRight',
			'rotateInUpLeft' 		=> 'rotateInUpLeft',
			'rotateInUpRight' 		=> 'rotateInUpRight',
			'hinge' 				=> 'hinge',
			'rollIn' 				=> 'rollIn',
			'rollOut' 				=> 'rollOut',
			'zoomIn' 				=> 'zoomIn',
			'zoomInDown' 			=> 'zoomInDown',
			'zoomInLeft' 			=> 'zoomInLeft',
			'zoomInRight' 			=> 'zoomInRight',
			'zoomInUp' 				=> 'zoomInUp',
		)
	);
	
	return $sama_add_animation;
}

// CSS3 Animation Delay
function sama_data_animation_delay( $param_name = 'css_animation_delay' ) {

	$sama_data_animation_delay = array(
		'type' 		=> 'dropdown',
		'heading' 	=> esc_html__('CSS Animation Delay', 'theme-majesty'),
		'param_name' 	=> $param_name,
		'std'			=> '',
		'value' 		=> array (
			'No'   => '',
			'100'  => '100',
			'200'  => '200',
			'300'  => '300',
			'400'  => '400',
			'500'  => '500',
			'600'  => '600',
			'700'  => '700',
			'800'  => '800',
			'900'  => '900',
			'1000' => '1000',
			'1100' => '1100',
			'1200' => '1200',
			'1300' => '1300',
			'1400' => '1400',
			'1500' => '1500',
			'1600' => '1600',
			'1700' => '1700',
			'1800' => '1800',
			'1900' => '1900',
			'2000' => '2000',
			'2100' => '2100',
			'2200' => '2200',
			'2300' => '2300',
			'2400' => '2400',
			'2500' => '2500',
			'2600' => '2600',
			'2700' => '2700',
			'2800' => '2800',
			'2900' => '2900',
			'3000' => '3000',
		)
	);
	
	return $sama_data_animation_delay;
}

// Link target
$target_arr = array(
	esc_html__( 'Same window', 'theme-majesty' ) => '_self',
	esc_html__( 'New window', 'theme-majesty' )  => '_blank'
);

// Button Background Color
$colors_arr = array(
	esc_html__( 'Pomegranate', 'theme-majesty' ) 	=> 'alizarin-btn',
	esc_html__( 'Red light', 'theme-majesty' ) 	=> 'pomegranate-btn',
	esc_html__( 'Turquoise', 'theme-majesty' ) 	=> 'turqioise-btn',
	esc_html__( 'Green Sea', 'theme-majesty' ) 	=> 'green_sea-btn',
	esc_html__( 'emerald', 'theme-majesty' ) 		=> 'emerald-btn',
	esc_html__( 'nephritis', 'theme-majesty' ) 	=> 'nephritis-btn',
	esc_html__( 'peter river', 'theme-majesty' ) 	=> 'peter_river-btn',
	esc_html__( 'belize hole', 'theme-majesty' ) 	=> 'belize_hole-btn',
	esc_html__( 'amethyst ', 'theme-majesty' ) 	=> 'amethyst-btn',
	esc_html__( 'belize hole', 'theme-majesty' ) 	=> 'wisteria-btn',
	esc_html__( 'amethyst ', 'theme-majesty' ) 	=> 'wet_asphalt-btn',
	esc_html__( 'belize hole', 'theme-majesty' ) 	=> 'midnight_blue-btn',
	esc_html__( 'Sun flower', 'theme-majesty' ) 	=> 'sun_flower-btn',
	esc_html__( 'Orange', 'theme-majesty' ) 		=> 'orange-btn',
	esc_html__( 'Carrot', 'theme-majesty' ) 		=> 'carrot-btn',
	esc_html__( 'Pumpkin', 'theme-majesty' ) 		=> 'pumpkin-btn',
	esc_html__( 'Brown', 'theme-majesty' ) 		=> 'brown-btn',
	esc_html__( 'Concrete', 'theme-majesty' ) 		=> 'concrete-btn',
	esc_html__( 'Asbestos', 'theme-majesty' ) 		=> 'asbestos-btn',
	esc_html__( 'Silver', 'theme-majesty' ) 		=> 'silver-btn',
	esc_html__( 'Custom Color', 'theme-majesty' ) 	=> 'custom',
	
);

$transparent = array(
		esc_html__('No','theme-majesty')				=> '',
		esc_html__('Pattern','theme-majesty') 			=> 'bg-pattern',
		esc_html__('Transparent 0.1','theme-majesty') 	=> 'transparent-bg-1',
		esc_html__('Transparent 0.2','theme-majesty') 	=> 'transparent-bg-2',
		esc_html__('Transparent 0.3','theme-majesty') 	=> 'transparent-bg-3',
		esc_html__('Transparent 0.4','theme-majesty') 	=> 'transparent-bg-4',
		esc_html__('Transparent 0.5', 'theme-majesty')	=> 'transparent-bg-5',
		esc_html__('Transparent 0.6', 'theme-majesty')	=> 'transparent-bg-6',
		esc_html__('Transparent 0.7','theme-majesty') 	=> 'transparent-bg-7',
		esc_html__('Transparent 0.8', 'theme-majesty')	=> 'transparent-bg-8',
		esc_html__('Transparent 0.9', 'theme-majesty')	=> 'transparent-bg-9',
);

$yes_array = array(
	esc_html__( 'Yes',  'theme-majesty' ) 	=> 'yes',
	esc_html__( 'No',	'theme-majesty' ) 	=> 'no',
);

// Return all of categories for posts as array 
function sama_get_all_categories() {
	$cats['All Categories'] = -1;
	$categories = get_terms( 'category', array(
		'orderby'    => 'name',
		'hide_empty' => 0,
	));
	foreach ( $categories as $cat ) {
		$cats[$cat->name] = $cat->term_id ;
	}
	
	return $cats;
}

// WooCommerce Categories
// Used for checkbox
function sama_get_woocommerce_categories() {
		
	if ( class_exists('woocommerce') ) {
		
		$args = array(
			'orderby' => 'id',
			'order' => 'ASC',
			'hide_empty' => false,
			'hierarchical' => 1,
			'child_of' => 0,
			'parent' => '',
			'pad_counts' => false,
		);
		$categories = get_terms( 'product_cat', $args );
		$cats = array();
		if( ! empty( $categories ) ) {
			foreach ( $categories as $category ) {
				$cats[$category->name] = $category->slug ;
			}
			return $cats;
		} else {
			return array( esc_html__('No WooCommerce Categories to Display', 'theme-majesty'), -1 );
		}
	}
}

function sama_order_by_values() {
	$order_by_values = array(
		'',
		esc_html__( 'Date', 'theme-majesty' ) => 'date',
		esc_html__( 'ID', 'theme-majesty' ) => 'ID',
		esc_html__( 'Author', 'theme-majesty' ) => 'author',
		esc_html__( 'Title', 'theme-majesty' ) => 'title',
		esc_html__( 'Modified', 'theme-majesty' ) => 'modified',
		esc_html__( 'Random', 'theme-majesty' ) => 'rand',
		esc_html__( 'Comment count', 'theme-majesty' ) => 'comment_count',
		esc_html__( 'Menu order', 'theme-majesty' ) => 'menu_order',
	);
	
	return $order_by_values;
}

function sama_order_way_values() {
	$order_way_values = array(
		'',
		esc_html__( 'Descending', 'theme-majesty' ) => 'DESC',
		esc_html__( 'Ascending', 'theme-majesty' ) => 'ASC',
	);
	
	return $order_way_values;
}



/* Edit Elments in Visual Composer
---------------------------------------------------------- */
/*	
 * Edit VC Row 
 */
vc_remove_param( "vc_row", "full_width" );
vc_remove_param( "vc_row", "parallax" );
vc_remove_param( "vc_row", "parallax_image" );
vc_remove_param( "vc_row", "video_bg" );
vc_remove_param( "vc_row", "video_bg_url" );
vc_remove_param( "vc_row", "video_bg_parallax" );
vc_remove_param( "vc_row", "content_placement" );

vc_add_param( 'vc_row' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> esc_html__('Row stretch', 'theme-majesty'),
		  'param_name' 	=> 'full_width',
		  'description' => esc_html__( 'Place content elements inside the row', 'theme-majesty' ),
		  'weight'		=> 1,
		  'value' 		=> array(
							esc_html__( 'Default', 'theme-majesty' ) => '',
							esc_html__( 'Stretch row', 'theme-majesty' ) => 'stretch_row',
						)
		)
);

vc_add_param( 'vc_row' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> esc_html__('Add Padding Top Bottom', 'theme-majesty'),
		  'param_name' 	=> 'box_padding',
		  'description' => esc_html__('Add padding to this box at top and bottom 100px', 'theme-majesty'),
		  'std'			=> 'pad-top-bottom',
		  'value' 		=> array(
							esc_html__('no','theme-majesty') 						=> 'no-padding',
							esc_html__('padding top bottom 30px', 'theme-majesty')	=> 'padding-30',
							esc_html__('padding top bottom 40px', 'theme-majesty')	=> 'padding-40',
							esc_html__('padding top bottom 50px', 'theme-majesty')	=> 'padding-50',
							esc_html__('padding top bottom 60px', 'theme-majesty')	=> 'padding-60',
							esc_html__('padding top bottom 80px', 'theme-majesty')	=> 'padding-80',
							esc_html__('padding top bottom 100px', 'theme-majesty')	=> 'padding-100',
							esc_html__('padding top bottom 150px', 'theme-majesty')	=> 'padding-150',
							esc_html__('padding top bottom 250px', 'theme-majesty')	=> 'padding-250',
							esc_html__('padding top 20px', 'theme-majesty')			=> 'padding-t-20',
							esc_html__('padding top 40px', 'theme-majesty')			=> 'padding-t-40',
							esc_html__('padding top 50px', 'theme-majesty')			=> 'padding-t-50',
							esc_html__('padding top 60px', 'theme-majesty')			=> 'padding-t-60',
							esc_html__('padding top 80px', 'theme-majesty')			=> 'padding-t-80',
							esc_html__('padding top 100px', 'theme-majesty')		=> 'padding-t-100',
							esc_html__('padding top 150px', 'theme-majesty')		=> 'padding-t-150',	
							esc_html__('padding bottom 20px', 'theme-majesty')		=> 'padding-b-20',
							esc_html__('padding bottom 40px', 'theme-majesty')		=> 'padding-b-40',
							esc_html__('padding bottom 50px', 'theme-majesty')		=> 'padding-b-50',
							esc_html__('padding bottom 60px', 'theme-majesty')		=> 'padding-b-60',
							esc_html__('padding bottom 70px', 'theme-majesty')		=> 'padding-b-70',
							esc_html__('padding bottom 80px', 'theme-majesty')		=> 'padding-b-80',
							esc_html__('padding bottom 100px', 'theme-majesty')		=> 'padding-b-100',
							esc_html__('padding bottom 120px', 'theme-majesty')		=> 'padding-b-120',
							esc_html__('padding bottom 150px', 'theme-majesty')		=> 'padding-b-150',	
						)
		)
);
vc_add_param( 'vc_row' , array(
	'type' 			=> 'dropdown',
	'heading' 		=> esc_html__('Box Background', 'theme-majesty'),
	'param_name' 	=> 'theme_color',
	'description' 	=> esc_html__('Choose dark when you used background image, and choose grey background to change background for this box to gray', 'theme-majesty'),
	'value' 		=> array(
					esc_html__('Default','theme-majesty') 			=> '',
					esc_html__('Dark', 'theme-majesty')				=> 'dark',
					esc_html__('Grey background', 'theme-majesty')	=> 'gray-bg',
					esc_html__('Theme Color', 'theme-majesty')		=> 'theme-color',
				)
	)
);
vc_add_param( 'vc_row' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> esc_html__('Background Opacity Overlay', 'theme-majesty'),
		  'param_name' 	=> 'overlay',
		  'description' => esc_html__('Choose transparent background when you choose darkness from box background', 'theme-majesty'),
		  'std'			=> '',
		  'value' 		=> $transparent,
		"dependency" => array( 'element' => 'theme_color', 'value' =>  array('dark') )
		)
);
vc_add_param( 'vc_row' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> esc_html__('Choose extra CSS class', 'theme-majesty'),
		  'param_name' 	=> 'extra_css',
		  'description' => esc_html__('Choose this when you need to make this block like demo', 'theme-majesty'),
		  'std'			=> '',
		  'value' 		=> array(
							'' 														=> '',
							esc_html__('paragraph welcome block', 'theme-majesty') 	=> 'welcome-block',
							esc_html__('paragraph discover', 'theme-majesty') 	=> 'discover',
							esc_html__('paragraph discover', 'theme-majesty') 	=> 'discover',
							esc_html__('Black Background', 'theme-majesty') 	=> 'black-bg',
							esc_html__('Chef Block Style 1', 'theme-majesty') 	=> 'chef-style-2',
							esc_html__('Chef Block Style 2', 'theme-majesty') 	=> 'chef-message',
							esc_html__('Art Block', 'theme-majesty') 	=> 'art-3',
							esc_html__('Pricing table without margin', 'theme-majesty') => 'pricing-off-marg',
							esc_html__('Video Block with image aboslute positions', 'theme-majesty') => 'video',
							esc_html__('App Blocks', 'theme-majesty') => 'app',
							esc_html__('Clients Images', 'theme-majesty') => 'clients-container',
						)
		)
);

/* Parallax*/
vc_add_param( 'vc_row' , array(
	'type' 			=> 'dropdown',
	'heading' 		=> esc_html__( 'Parallax', 'theme-majesty' ),
	'param_name' 	=> 'parallax',
	'group' 		=> 'Parallax Background',
	'value' 		=> array(
		esc_html__( 'None', 		'theme-majesty' ) => '',
		esc_html__( 'Image', 		'theme-majesty' ) => 'image',
		esc_html__( 'HTML5 Video', 	'theme-majesty' ) => 'html5video',
		esc_html__( 'Youtube', 		'theme-majesty' ) => 'youtube',
	),
	'description' => esc_html__( 'Add parallax type background for row.', 'theme-majesty' ),
	)
);
vc_add_param( 'vc_row' , array(
		'type' 			=> 'attach_image',
		'heading' 		=> esc_html__( 'Image', 'theme-majesty' ),
		'param_name' 	=> 'parallax_image',
		'group' 		=> 'Parallax Background',
		'value' 		=> '',
		'description' 	=> esc_html__( 'Select image from media library Or Poster For Video.', 'theme-majesty' ),
		'dependency' 	=> array( 'element' => 'parallax', 'value' =>  array('image', 'html5video', 'youtube') )
	)
);

vc_add_param( 'vc_row' , array(
	'type' 		=> 'textfield',
	'heading' 	=> esc_html__('MP4 File URL', 'theme-majesty'),
	'param_name' 	=> 'mp4',
	'group' 		=> 'Parallax Background',
	'std'			=> '',
	'dependency'  => array( 'element' => 'parallax', 'value' =>  array('html5video') )
));
vc_add_param( 'vc_row' , array(
	'type' 		=> 'textfield',
	'heading' 	=> esc_html__('WebM File URL', 'theme-majesty'),
	'param_name' 	=> 'webm',
	'group' 		=> 'Parallax Background',
	'std'			=> '',
	'dependency'  => array( 'element' => 'parallax', 'value' =>  array('html5video') )
));
vc_add_param( 'vc_row' , array(
	'type' 		=> 'textfield',
	'heading' 	=> esc_html__('Youtube URL', 'theme-majesty'),
	'param_name' 	=> 'youtube',
	'group' 		=> 'Parallax Background',
	'std'			=> '',
	'dependency'  => array( 'element' => 'parallax', 'value' =>  array('youtube') )
));

/*	
 * Edit VC Column 
 */
$text_align = array(
	'type' 		=> 'dropdown',
	'heading' 	=> esc_html__('Text Align', 'theme-majesty'),
	'param_name' 	=> 'text_align',
	'description' => esc_html__('to make this column text align to center', 'theme-majesty'),
	'std'			=> 'no',
	'value' 		=> array(
				esc_html__('default', 	'theme-majesty')	=> 'no',
				esc_html__('Center',	'theme-majesty') 	=> 'text-center',
				esc_html__('Left',   	'theme-majesty')	=> 'text-left',
				esc_html__('Right',   	'theme-majesty')	=> 'text-right',
			)
);
$extra_css =  array(
	'type' 		=> 'dropdown',
	'heading' 	=> esc_html__('Choose extra CSS class', 'theme-majesty'),
	'param_name' 	=> 'extra_css',
	'description' => esc_html__('Choose this when you need to make this block like demo', 'theme-majesty'),
	'std'			=> '',
	'value' 		=> array(
					'' 								=> '',
					esc_html__('No Padding', 'theme-majesty') 	=> 'nopadding',
					esc_html__('paragraph With absolute position', 'theme-majesty') 	=> 'center',
					esc_html__('Columns have image with absolute position', 'theme-majesty') 	=> 'div-absolute',
					esc_html__('Columns contain one Image with absolute position', 'theme-majesty') 	=> 'col-absolute',
					esc_html__('Center content in screen', 'theme-majesty') 	=> 'vc-col-fullheight slider-content',
					esc_html__('Chef Block Style 1', 'theme-majesty') 	=> 'chef-style-2',
				)
);
vc_add_param( 'vc_column' , $text_align );
vc_add_param( 'vc_column' , $extra_css );
vc_add_param('vc_column', sama_add_animation() );
vc_add_param('vc_column', sama_data_animation_delay() );
vc_add_param( 'vc_column_inner' , $text_align );
vc_add_param( 'vc_column_inner' , $extra_css );


/* Visual Composer single Image Edit
---------------------------------------------------------- */
vc_add_param( 'vc_single_image' , array(
		  'type' 		=> 'dropdown',
		  'heading' 	=> esc_html__('Choose extra CSS class', 'theme-majesty'),
		  'param_name' 	=> 'extra_css',
		  'description' => esc_html__('Choose this when you need to make this image with absolute position', 'theme-majesty'),
		  'std'			=> '',
		  'weight'		=> 2,
		  'value' 		=> array(
							'' ,
							esc_html__('Left Image Bottom', 'theme-majesty') 	=> 'left_bg',
							esc_html__('Right Image', 'theme-majesty') 		=> 'right_bg',
							esc_html__('Right Image Bottom', 'theme-majesty') 	=> 'right_bg2',
							esc_html__('Left For App Block', 'theme-majesty') => 'absolute',
						)
		)
);



/* Theme Heading
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Add_Heading extends WPBakeryShortCode {}
}
vc_map( array(
	'name'			=> esc_html__('Theme Heading', 'theme-majesty'),
	'base' 			=> 'vc_add_heading',
	'icon' 			=> 'theme-icon',
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
	'category' 	  	=> esc_html__('Content', 'theme-majesty'),
	'admin_label' 	=> true,
	'category' 		=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
	
	'params' 		=> array(
		array(
		  'type' 			=> 'dropdown',
		  'heading' 		=> esc_html__('Icon Type', 'theme-majesty'),
		  'param_name' 		=> 'icon_type',
		  'value' 			=> array(
								'',
								esc_html__('Icon Moon', 'theme-majesty') => 'iconmoon',
								esc_html__('Font Awesome', 'theme-majesty') => 'fontawesome',
							)
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Top Icon', 'theme-majesty' ),
			'param_name' => 'iconawesome',
			'settings' => array(
				'emptyIcon' => true,
				'iconsPerPage' => 4000,
			),
			'dependency'  => array( 'element' => 'icon_type', 'value' =>  array('fontawesome') )
		),
		array(
			'type' 			=> 'iconsmoon',
			'heading' 		=> esc_html__('Top Icon', 'theme-majesty'),
			'param_name' 	=> 'icon',
			'std'			=> '',
			'dependency'  => array( 'element' => 'icon_type', 'value' =>  array('iconmoon') )
		),
		array(
		  'type' 			=> 'dropdown',
		  'heading' 		=> esc_html__('Icon Size', 'theme-majesty'),
		  'param_name' 		=> 'icon_size',
		  'value' 			=> array(
								esc_html__('40px', 'theme-majesty') => '',
								esc_html__('60px', 'theme-majesty') => 'icon-60',
								esc_html__('70px',	'theme-majesty') 	=> 'icon-large',							
							)
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__('Title', 'theme-majesty'),
			'param_name' 	=> 'title',
			'admin_label' 	=> true
		),		
		array(
		  'type' 			=> 'textarea',
		  'heading' 		=> esc_html__('Content', 'theme-majesty'),
		  'param_name' 		=> 'subtitle',
		  'admin_label' 	=> true,
		  'description' 	=> esc_html__("Leave blank if you don't want to have a second title or content under title.", 'theme-majesty'),
		),
		array(
		  'type' 			=> 'dropdown',
		  'heading' 		=> esc_html__('Text Align', 'theme-majesty'),
		  'param_name' 		=> 'text_align',
		  'description' 	=> esc_html__('to make this column text align to center', 'theme-majesty'),
		  'std'				=> 'text-center',
		  'value' 			=> array(
								esc_html__('default', 	'theme-majesty')	=> '',
								esc_html__('Center',	'theme-majesty') 	=> 'text-center',
								esc_html__('Left',   	'theme-majesty')	=> 'text-left',
								esc_html__('Right',   	'theme-majesty')	=> 'text-right',
							)
		),
		array(
		  'type' 			=> 'dropdown',
		  'heading' 		=> esc_html__('Element Tag', 'theme-majesty'),
		  'param_name' 		=> 'tag',
		  'std'				=> 'h2',
		  'value' 			=> array(
								esc_html__('h1', 	'theme-majesty')	=> 'h1',
								esc_html__('h2', 	'theme-majesty')	=> 'h2',
								esc_html__('h3',	'theme-majesty') 	=> 'h3',
								esc_html__('h4',   	'theme-majesty')	=> 'h4',
								esc_html__('h5',   	'theme-majesty')	=> 'h5',
								esc_html__('h6',   	'theme-majesty')	=> 'h6',
							)
		),
		array(
		  'type' 			=> 'dropdown',
		  'heading' 		=> esc_html__('Element Tag Margin', 'theme-majesty'),
		  'param_name' 		=> 'tag_marg_bottom',
		  'value' 			=> array(
								''	=> '',
								esc_html__('No Margin',	'theme-majesty') 	=> 'margin0',
								esc_html__('Margin Bottom 0px',	'theme-majesty') 	=> 'mb0',
							)
		),
		array(
		  'type' 			=> 'dropdown',
		  'heading' 		=> esc_html__('Header Margin Bottom', 'theme-majesty'),
		  'param_name' 		=> 'margin_bottom',
		  'std'				=> 'default',
		  'value' 			=> array(
								esc_html__('0px', 		'theme-majesty')	=> 'mb0',
								esc_html__('30px', 		'theme-majesty')	=> 'mb30',
								esc_html__('40px', 		'theme-majesty')	=> 'mb40',
								esc_html__('50px',		'theme-majesty') 	=> 'mb50',
								esc_html__('60px',   	'theme-majesty')	=> 'default',
								esc_html__('70px',   	'theme-majesty')	=> 'mb70',
								esc_html__('80px',   	'theme-majesty')	=> 'mb60',
							)
		),
		sama_add_animation(),
		sama_data_animation_delay(),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__('Extra class name', 'theme-majesty'),
			'param_name' 	=> 'el_class',
			'description' 	=> esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'theme-majesty'),
		),
	)
));

/* Blog Grid
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Vc_Custom_Blog_Grid extends WPBakeryShortCode {
    }
}
vc_map( array(
	'name'			=> esc_html__('Blog Grid', 'theme-majesty'),
	'base' 			=> 'vc_custom_blog_grid',
	'icon' 			=> 'theme-icon',
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
	'admin_label' 	=> true,
	'category' 		=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
    'params' => array(
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Display Blog By', 'theme-majesty' ),
			'param_name' 	=> 'type',
			'admin_label'	=> true,
			'value' 		=> array(
								esc_html__( 'Recent', 'theme-majesty' ) 	=> 'recent',
								esc_html__( 'IDS',  'theme-majesty' ) 		=> 'posts_id',
							)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Posts Category', 'theme-majesty'),
			'param_name' 	=> 'category',
			'value'			=> sama_get_all_categories(),
			'admin_label'	=> true,
			'dependency'  => array( 'element' => 'type', 'value' =>  array('recent') )
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Post IDS', 'theme-majesty' ),
			'param_name' 	=> 'posts_id',
			'description' 	=> esc_html__('use comma to Separates between ids.', 'theme-majesty'),
			'dependency' 	=> array( 'element' => 'type','value' => array( 'posts_id' ) )
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Number of Posts', 'theme-majesty' ),
			'param_name' 	=> 'num',
			'std'			=> 3,
			'admin_label'	=> true,
			'dependency'  => array( 'element' => 'type', 'value' =>  array('recent') )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Display Excerpt', 'theme-majesty' ),
			'param_name' 	=> 'display_excerpt',
			'std'			=> 'no',
			'value' 		=> $yes_array,
		),
		array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Excerpt Length', 'theme-majesty' ),
				'param_name'	=> 'ex_lengs',
				'value' 		=> 16,
				'dependency' 	=> array( 'element' => 'display_excerpt','value' => array( 'yes' ) )
			),
		array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Display link to Blog Page', 'theme-majesty' ),
				'param_name'	=> 'display_view_more',
				'std'			=> 'no',
				'value' 		=> $yes_array,
		),
        array(
            'type' 			=> 'textfield',
            'heading' 		=> esc_html__('Extra class name', 'theme-majesty'),
            'param_name' 	=> 'el_class',
            'description' 	=> esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "theme-majesty")
        ),
    )
));

/* Buttons
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Vc_Feature_Button extends WPBakeryShortCode {
    }
}
vc_map( array(
    'name' 			=> esc_html__('Button Theme', 'theme-majesty'),
    'base' 			=> 'vc_feature_button',
	'icon' 			=> 'theme-icon',
	'category'		=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-custom.css', get_template_directory_uri().'/css/admin/vcicon.css'),
    'params' 	=> array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Button text', 'theme-majesty' ),
			'param_name' 	=> 'title',
			'holder' 		=> 'button',
			'class' 		=> 'wpb_button',
			'value' 		=> esc_html__( 'Text on the button', 'theme-majesty' ),
			'admin_label'	=> true,
		),
		array(
			'type' 			=> 'href',
			'heading' 		=> esc_html__( 'URL (Link)', 'theme-majesty' ),
			'param_name' 	=> 'href',
			'description' 	=> esc_html__( 'Button link.', 'theme-majesty' )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Target', 'theme-majesty' ),
			'param_name' 	=> 'target',
			'value' 		=> $target_arr,
			'dependency' 	=> array( 'element'=>'href', 'not_empty'=>true, 'callback' => 'vc_button_param_target_callback' )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Type', 'theme-majesty'),
			'param_name' 	=> 'type',
			'std'			=> 'bootstrap_btn',
			'value' 		=> array(
								esc_html__('Bootstrap Button', 'theme-majesty') 	=> 'bootstrap_btn',
								esc_html__('Theme Button', 'theme-majesty') 	=> 'theme_btn',
							)
		),
		
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Color', 'theme-majesty' ),
			'param_name' 	=> 'bootstrap_bg',
			'value' 		=> array(
							esc_html__( 'Theme Default Button', 'theme-majesty' ) 		=> 'btn btn-gold dark',
							esc_html__( 'Theme Button Dark', 'theme-majesty' ) => 'btn btn-black',
							esc_html__( 'Bootstrap default', 'theme-majesty' ) 			=> 'btn btn-default',
							esc_html__( 'Bootstrap primary', 'theme-majesty' ) 			=> 'btn btn-primary',
							esc_html__( 'Bootstrap success', 'theme-majesty' ) 			=> 'btn-success',
							esc_html__( 'Bootstrap info', 'theme-majesty' ) 				=> 'btn btn-info',
							esc_html__( 'Bootstrap warning', 'theme-majesty' ) 			=> 'btn btn-warning',
							esc_html__( 'Bootstrap danger', 'theme-majesty' ) 			=> 'btn btn-danger',
			),
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'bootstrap_btn' ) )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Size', 'theme-majesty'),
			'param_name' 	=> 'bootstrap_size',
			'value' 		=> array(
								esc_html__('Extra small', 'theme-majesty') 	=> 'btn-xs',
								esc_html__('Small', 'theme-majesty') 	=> 'btn-sm',
								esc_html__('Medium', 'theme-majesty') 	=> '',
								esc_html__('Large', 'theme-majesty') 	=> 'btn-lg',
								esc_html__('Full Width', 'theme-majesty') 	=> 'btn-lg btn-block',
							),
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'bootstrap_btn' ) )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Color', 'theme-majesty' ),
			'param_name' 	=> 'bgcolor',
			'value' 		=> $colors_arr,
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'theme_btn' ) )
		),
		array(
			'type' 			=> 'colorpicker',
			'heading' 		=> esc_html__( 'Custom color', 'theme-majesty' ),
			'param_name' 	=> 'customcolor',
			'dependency' 	=> array( 'element' => 'bgcolor', 'value' => array( 'custom' ) )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Size', 'theme-majesty'),
			'param_name' 	=> 'size',
			'value' 		=> array(
								esc_html__('small', 'theme-majesty') 	=> 'small-btn',
								esc_html__('Medium', 'theme-majesty') 	=> 'medium-btn',
								esc_html__('Large', 'theme-majesty') 	=> 'big-btn',
								esc_html__('Full Width', 'theme-majesty') 	=> 'medium-btn full-width-btn',
							),
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'theme_btn' ) )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Display Button Without Background', 'theme-majesty'),
			'param_name' 	=> 'border',
			'value' 		=> array(
									'' 	=> '',
									esc_html__('Yes', 'theme-majesty') 	=> 'yes',
								),
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'theme_btn' ) )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Display CORNER', 'theme-majesty'),
			'param_name' 	=> 'corner',
			'value' 		=> array(
								'' 	=> '',
								esc_html__('Yes', 'theme-majesty') 	=> 'yes',
							),
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'theme_btn' ) )
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'theme-majesty' ),
			'param_name' => 'icon',
			'value' => '', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => true, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Icon Position', 'theme-majesty'),
			'param_name' 	=> 'icon_pos',
			'value' 		=> array(
								esc_html__('Left', 'theme-majesty') 	=> 'icon_left',
								esc_html__('Right','theme-majesty') 	=> 'icon_right',
							),
			'dependency' => array(
				'element' => 'icon',
				'not_empty' => true,
			)
		),
		sama_add_animation(),
		sama_data_animation_delay(),
        array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__("Extra class name", "theme-majesty"),
			"param_name" 	=> "el_class",
			"description" 	=> esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "theme-majesty")
        )
    ),
));

/* CountDown Timer
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Countdown_Timer extends WPBakeryShortCode {}
}

vc_map( array(
	'name'		=> esc_html__('Count Down Timer', 'theme-majesty'),
	'base' 		=> 'vc_countdown_timer',
	'icon' 		=> 'theme-icon',
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
	'category'	=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
	'admin_label' => true,
	'params' => array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__('Title', 'theme-majesty'),
			'param_name' 	=> 'title',
			'admin_label' 	=> true,
			'description'	=> esc_html__('Not Display in frontend', 'theme-majesty')
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__('Add date', 'theme-majesty'),
			'param_name' 	=> 'date',
			'value'			=> '',
			'admin_label' 	=> true,
			'description'	=> esc_html__('Date format yy/mm/dd/ ex 2015/10/15 ', 'theme-majesty')
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Countdown size', 'theme-majesty'),
			'param_name' 	=> 'size',
			'std'			=> 'large',
			'value' 		=> array(
								esc_html__('Large', 'theme-majesty') => 'large',
								esc_html__('Small', 'theme-majesty')  => 'smalltimer',
							)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Enable RTL', 'theme-majesty'),
			'param_name' 	=> 'rtl',
			'std'			=> 'false',
			'value' 		=> array(
								esc_html__('False', 'theme-majesty') => 'false',
								esc_html__('True', 'theme-majesty')  => 'true',
							)
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__('Days Label', 'theme-majesty'),
			'param_name' 	=> 'dayslabel',
			'value'			=> 'Days',
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__('Hours Label', 'theme-majesty'),
			'param_name' 	=> 'hourslabel',
			'value'			=> 'Hours',
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__('Minutes Label', 'theme-majesty'),
			'param_name' 	=> 'minuteslabel',
			'value'			=> 'Minutes',
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__('Seconds Label', 'theme-majesty'),
			'param_name' 	=> 'secondslabel',
			'value'			=> 'Seconds',
		),
		array(
			'type' 			=> 'textarea_html',
			'heading' 		=> esc_html__('Content', 'theme-majesty'),
			'param_name' 	=> 'content',
			'description' 	=> esc_html__('Content to display if timer expire.', 'theme-majesty')
		),
		array(
		  'type' => 'textfield',
		  'heading' => esc_html__('Extra class name', 'theme-majesty'),
		  'param_name' => 'el_class',
		  'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'theme-majesty'),
		),	
	)
));

/* Dividers
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Vc_Dividers extends WPBakeryShortCode {
    }
}
vc_map( array(
    'name' 		=> esc_html__('Dividers', 'theme-majesty'),
    'base' 		=> 'vc_dividers',
	'icon' 		=> 'theme-icon',
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
	'category'	=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
    'params' 	=> array(
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Style', 'theme-majesty'),
			'param_name' 	=> 'style',
			'admin_label'	=> true,
			'value' 		=> array(
								esc_html__('Line With Icon', 'theme-majesty') 		=> 'divider-icon',
								esc_html__('Dashed theme color', 'theme-majesty') 	=> 'divider-dashed color-divider',
								esc_html__('Solid line', 'theme-majesty') 			=> 'divider-dotted',
								esc_html__('Solid line big', 'theme-majesty') 		=> 'divider-solid divider-3',
								esc_html__('Dotted line', 'theme-majesty') 		=> 'divider-dotted',
								esc_html__('Image Style 1', 'theme-majesty') 		=> 'divider-img-1',
								esc_html__('Image Style 2', 'theme-majesty') 		=> 'divider-img-2',
							)
		),
        array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__("Extra class name", "theme-majesty"),
			"param_name" 	=> "el_class",
			"description" 	=> esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "theme-majesty")
        )
    ),
));

/* FAQ Box
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Faq_Box extends WPBakeryShortCode {}
}

vc_map( array(
	'name'				=> esc_html__('FAQ Box', 'theme-majesty'),
	'base' 				=> 'vc_faq_box',
	'icon' 				=> 'theme-icon',
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
	'category'			=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
	'admin_label' 		=> true,
	'params' 			=> array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'theme-majesty'),
			'param_name' => 'title',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Number', 'theme-majesty'),
			'param_name' => 'num',
			'admin_label' => true
		),
		array(
			'type' 			=> 'textarea_html',
			'heading' 		=> esc_html__('Content', 'theme-majesty'),
			'param_name' 	=> 'content',
			'admin_label' 	=> true
		),
		sama_add_animation() ,
		sama_data_animation_delay(),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__('Extra class name', 'theme-majesty'),
			'param_name' 	=> 'el_class',
			'description' 	=> esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'theme-majesty'),
		),	
	)
));

/* Feature Box
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Feature_Box extends WPBakeryShortCode {}
}

vc_map( array(
	'name'			=> esc_html__('Feature Box', 'theme-majesty'),
	'base' 			=> 'vc_feature_box',
	'icon' 			=> 'theme-icon',
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
	'category'		=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
	'admin_label' 	=> true,
	'params' 		=> array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'theme-majesty'),
			'param_name' => 'title',
			'admin_label' => true
		),
		array(
			'type' 		 	=> 'dropdown',
			'heading'		=> esc_html__('Text Align', 'theme-majesty'),
			'param_name' 	=> 'text_align',
			'std'			=> 'text-center',
			'value' 		=> array(
								esc_html__('default', 	'theme-majesty')	=> '',
								esc_html__('Center',	'theme-majesty') 	=> 'text-center',
								esc_html__('Left',   	'theme-majesty')	=> 'text-left',
								esc_html__('Right',   	'theme-majesty')	=> 'text-right',
							)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Feature Box Icon Position', 'theme-majesty'),
			'param_name' 	=> 'position',
			'value' 		=> array(
								esc_html__('Centered Box','theme-majesty') => 'icon_centered',
								esc_html__('Icon side', 'theme-majesty') 		=> 'icon_left',
							)
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'theme-majesty' ),
			'param_name' => 'icon',
			'value' => '',
			'settings' => array(
				'emptyIcon' => true,
				'iconsPerPage' => 4000,
			),
		),
		array(
			'type' 			=> 'textarea_html',
			'heading' 		=> esc_html__('Content', 'theme-majesty'),
			'param_name' 	=> 'content',
			'admin_label' 	=> true
		),
		sama_add_animation(),
		sama_data_animation_delay(),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__('Extra class name', 'theme-majesty'),
			'param_name' 	=> 'el_class',
			'description' 	=> esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'theme-majesty'),
		),	
	)
));

/* Feature Box With Image
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Feature_Box_Image extends WPBakeryShortCode {}
}

vc_map( array(
	'name'			=> esc_html__('Feature Box With Image', 'theme-majesty'),
	'base' 			=> 'vc_feature_box_image',
	'icon' 			=> 'theme-icon',
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
	'category'		=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
	'admin_label' 	=> true,
	'params' 		=> array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'theme-majesty'),
			'param_name' => 'title',
			'admin_label' => true
		),
		array(
			'type' 			=> 'attach_image',
			'heading' 		=> esc_html__('Image', 'theme-majesty'),
			'param_name' 	=> 'image',
		),
		array(
			'type' 			=> 'textarea_html',
			'heading' 		=> esc_html__('Content', 'theme-majesty'),
			'param_name' 	=> 'content',
			'admin_label' 	=> true
		),
		sama_add_animation() ,
		sama_data_animation_delay(),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__('Extra class name', 'theme-majesty'),
			'param_name' 	=> 'el_class',
			'description' 	=> esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'theme-majesty'),
		),	
	)
));

/* Custom Google Maps
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Add_Gmaps extends WPBakeryShortCode {}
}
vc_map( array(
	'name'			=> esc_html__('Custom Google Map', 'theme-majesty'),
	'base' 			=> 'vc_add_gmaps',
	'icon' 			=> 'theme-icon',
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
	'category' 	  	=> esc_html__('Content', 'theme-majesty'),
	'admin_label' 	=> true,
	'category' 		=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
	'params' 		=> array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Title', 'theme-majesty' ),
			'param_name' 	=> 'title',
			'admin_label'	=> true,
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Coordinates', 'theme-majesty' ),
			'param_name' 	=> 'latlang',
			'admin_label'	=> true,
			'description' 	=> 'Ex: 30.068476, 31.311973 <a href="'.esc_url('https://support.google.com/maps/answer/18539?hl=en').'">more info</a>',
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Zoom', 'theme-majesty' ),
			'param_name' 	=> 'zoom',
			'value'			=> 17,
			'admin_label'	=> true,
		),
		array(
		  'type' 			=> 'attach_image',
		  'heading' 		=> esc_html__('Image', 'theme-majesty'),
		  'param_name' 		=> 'image',
		  'description' 	=> esc_html__( 'Add Logo here to display in google map','theme-majesty'),
		),
		array(
			'type' 			=> 'textarea_html',
			'heading' 		=> esc_html__('Content', 'theme-majesty'),
			'param_name' 	=> 'content',
			//'admin_label' 	=> true
		),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name", "theme-majesty"),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "theme-majesty")
        ),
	)
));

/* Inline Scroll Menu
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Inline_Scroll_Menu extends WPBakeryShortCode {}
}
vc_map( array(
	'name' 				=> esc_html__( 'Inline Scroll Menu', 'theme-majesty' ),
	'base' 				=> 'vc_inline_scroll_menu',
	'icon' 				=> 'theme-icon',
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
	'category'			=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
	'params' 			=> array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'theme-majesty'),
			'description' 	=> esc_html__('Display On Admin Only', 'theme-majesty'),
			'param_name' => 'title',
			'admin_label' => true,
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_html__( 'Link Label', 'theme-majesty' ),
			'param_name' => 'label_links',
			'description' => esc_html__( 'Enter label for each link (Note: divide label with linebreaks (Enter)).', 'theme-majesty' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_html__( 'ID Label', 'theme-majesty' ),
			'param_name' => 'id_links',
			'description' => esc_html__( 'Enter label for each link do\'nt add (#) (Note: divide label with linebreaks (Enter)).', 'theme-majesty' )
		),
		array(
		  'type' 			=> 'textfield',
		  'heading' 		=> esc_html__('Extra class name', 'theme-majesty'),
		  'param_name' 		=> 'el_class',
		  'description' 	=> esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'theme-majesty'),
		),	
	)
));

/* Light Box
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Light_Box extends WPBakeryShortCode {}
}
vc_map( array(
	'name' 				=> esc_html__( 'Light Box', 'theme-majesty' ),
	'base' 				=> 'vc_light_box',
	'icon' 				=> 'theme-icon',
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
	'category'			=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
	'params' 			=> array(
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Type', 'theme-majesty'),
			'param_name' 	=> 'type',
			'admin_label'	=> true,
			'value' 		=> array(
								esc_html__('Image', 'theme-majesty') 	=> 'image',
								esc_html__('Link', 'theme-majesty') 	=> 'link',
							)
		),
		array(
			'type' 			=> 'attach_image',
			'heading' 		=> esc_html__('Image', 'theme-majesty'),
			'param_name' 	=> 'image',
			'dependency' 	=> array( 'element' => 'type', 'value' => array( 'image' ) )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'theme-majesty'),
			'description' 	=> esc_html__('Optional: if type image.', 'theme-majesty'),
			'param_name' => 'title',
			'admin_label' => true,
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Lightbox URL', 'theme-majesty'),
			'description' 	=> esc_html__('Add URL for Image Or Youtube, vimeo to open in lightbox.', 'theme-majesty'),
			'param_name' => 'lightbox',
			'admin_label' => true,
		),
		array(
		  'type' 			=> 'textfield',
		  'heading' 		=> esc_html__('Extra class name', 'theme-majesty'),
		  'param_name' 		=> 'el_class',
		  'description' 	=> esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'theme-majesty'),
		),
		
	)
));

/* Menu Item List
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Menu_Item_List extends WPBakeryShortCode {}
}
vc_map( array(
	'name' 				=> esc_html__( 'Menu Item List', 'theme-majesty' ),
	'base' 				=> 'vc_menu_item_list',
	'icon' 				=> 'theme-icon',
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
	'category'		=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'theme-majesty'),
			'param_name' => 'title',
			'admin_label' => true
		),
		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Image', 'theme-majesty' ),
			'param_name' => 'image',
			'description' => esc_html__( 'Optional: Select image from media library.', 'theme-majesty' )
		),
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('Link To this Item', 'theme-majesty'),
			'param_name' => 'url',
			'description' => esc_html__( 'Optional', 'theme-majesty' )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Display Dotted', 'theme-majesty'),
			'param_name' 	=> 'dotted',
			'value' 		=> array(
								esc_html__('False', 'theme-majesty') => 'false',
								esc_html__('True', 'theme-majesty')  => 'true',
							)
		),
		
		array(
			'type' => 'textarea',
			'heading' => esc_html__( 'Short Description', 'theme-majesty' ),
			'param_name' => 'desc',
			'value' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Price', 'theme-majesty'),
			'param_name' => 'price',
			'value' => '$45',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Featured Text', 'theme-majesty'),
			'param_name' => 'featured_txt',
			'value' => '',
			'admin_label' => true
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Price Color', 'theme-majesty'),
			'param_name' 	=> 'pricecolor',
			'value' 		=> array(
								esc_html__('Theme Color', 'theme-majesty')  => '',
								esc_html__('Dark', 'theme-majesty') 		=> 'dark',
							)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Featured Text Color', 'theme-majesty'),
			'param_name' 	=> 'featuredcolor',
			'value' 		=> array(
								esc_html__('Theme Color', 'theme-majesty')   => '',
								esc_html__('Red', 'theme-majesty') 		=> 'red',
								esc_html__('Green', 'theme-majesty') 		=> 'green',
								esc_html__('Orange', 'theme-majesty')		=> 'orange',
							)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Margin Bottom', 'theme-majesty'),
			'param_name' 	=> 'marginb',
			'value' 		=> array(
								esc_html__('default', 'theme-majesty') => '',
								esc_html__('30px', 'theme-majesty') => 'itemsmb30',
								esc_html__('40px', 'theme-majesty') => 'itemsmb40',
								esc_html__('60px', 'theme-majesty') => 'mb60',
							)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Display Thumbnail AS circle', 'theme-majesty'),
			'param_name' 	=> 'circleimg',
			'std'			=> 'false',
			'value' 		=> array(
								esc_html__('False', 'theme-majesty') => 'false',
								esc_html__('True', 'theme-majesty')  => 'true',
							)
		),
		sama_add_animation() ,
		sama_data_animation_delay(),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'theme-majesty' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'theme-majesty' )
		)
	)
));

/* Menu Container With Filter */
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Vc_Menu_Filter_Container extends WPBakeryShortCodesContainer {}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Vc_Single_menu_item_has_filter extends WPBakeryShortCode {}
}
// Menu List Filter Container
vc_map( array(
    'name' 			=> esc_html__('Food Menu container With Filter', "theme-majesty"),
    'base' 			=> 'vc_menu_filter_container',
    'as_parent' 	=> array('only' => 'vc_single_menu_item_has_filter'),
    'content_element' => true,
    'show_settings_on_create' => true,
	'category'		=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
	'icon' 				=> 'theme-icon',
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
    'params' 		=> array(
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Filter Menu Background', 'theme-majesty'),
			'param_name' 	=> 'display_filter_as',
			'std'			=> 'dark',
			'value' 		=> array(
								esc_html__('Dark', 'theme-majesty') 	=> 'dark',
								esc_html__('Light', 'theme-majesty') 	=> 'light',
							)
		),
		array(
			'type' => 'exploded_textarea',
			'heading' 		=> esc_html__( 'Catgeories Title', 'theme-majesty' ),
			'param_name' 	=> 'cats_title',
			'description' 	=> esc_html__( 'Note: divide category with linebreaks (Enter).', 'theme-majesty' ),
			'value'			=> 'starter, dishes, desert, drinks',
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_html__( 'Categories CSS Class', 'theme-majesty' ),
			'param_name' => 'cats_css',
			'description' => esc_html__( 'Each category has its own css class in the order, and you need to add this css class for each single menu you add later (Note: divide CSS Class with linebreaks (Enter) to match Category).', 'theme-majesty' ),
			'value'			=> 'starter, dishes, desert, drinks'
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Display Show All Text', 'theme-majesty'),
			'param_name' 	=> 'display_show_all',
			'std'			=> 'true',
			'value' 		=> array(
								esc_html__('True', 'theme-majesty') 	=> 'true',
								esc_html__('Fasle', 'theme-majesty') => 'false',
							)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Show All Text', 'theme-majesty'),
			'param_name' => 'show_all_text',
			'value'		=> 'Daily Menu',
			'dependency' 	=> array( 'element' => 'display_show_all', 'value' => array( 'true' ) )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Width', 'theme-majesty'),
			'param_name' 	=> 'width',
			'std'			=> '1/2',
			'value' 		=> array(
								esc_html__('6 columns - 1/2', 'theme-majesty') 	=> '1/2',
								esc_html__('12 columns - 1/1', 'theme-majesty') => '1/1',
							)
		),
        array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('menu item margin bottom', 'theme-majesty'),
			'param_name' 	=> 'marginb',
			'std'			=> 'itemsmb30',
			'value' 		=> array(
								esc_html__('20px', 'theme-majesty') => 'itemsmb20',
								esc_html__('30px', 'theme-majesty') => 'itemsmb30',
								esc_html__('40px', 'theme-majesty') => 'itemsmb40',
								esc_html__('60px', 'theme-majesty') => 'itemsmb60',
							)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Display Thumbnail AS circle', 'theme-majesty'),
			'param_name' 	=> 'circleimg',
			'std'			=> 'false',
			'value' 		=> array(
								esc_html__('False', 'theme-majesty') => 'false',
								esc_html__('True', 'theme-majesty')  => 'true',
							)
		),
       array(
			"type" => "textfield",
			"heading" => esc_html__("Extra class name", "theme-majesty"),
			"param_name" => "el_class",
			"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "theme-majesty")
        )
    ),
	'js_view' => 'VcColumnView'
));

vc_map( array(
	'name' 				=> esc_html__( 'Menu Item List', 'theme-majesty' ),
	'base' 				=> 'vc_single_menu_item_has_filter',
	'as_child' 	=> array('only' => 'vc_feature_list_container'),
	'content_element' => true,
    'show_settings_on_create' => true,
	'icon' 				=> 'theme-icon',
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
	'category'		=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'theme-majesty'),
			'param_name' => 'title',
			'admin_label' => true
		),
		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Image', 'theme-majesty' ),
			'param_name' => 'image',
			'description' => esc_html__( 'Optional: Select image from media library.', 'theme-majesty' )
		),
		array(
			'type' => 'vc_link',
			'heading' => esc_html__('Link To this Item', 'theme-majesty'),
			'param_name' => 'url',
			'description' => esc_html__( 'Optional', 'theme-majesty' )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Display Dotted', 'theme-majesty'),
			'param_name' 	=> 'dotted',
			'value' 		=> array(
								esc_html__('False', 'theme-majesty') => 'false',
								esc_html__('True', 'theme-majesty')  => 'true',
							)
		),
		array(
			'type' => 'textarea',
			'heading' => esc_html__( 'Short Description', 'theme-majesty' ),
			'param_name' => 'desc',
			'value' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Price', 'theme-majesty'),
			'param_name' => 'price',
			'value' => '$45',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Featured Text', 'theme-majesty'),
			'param_name' => 'featured_txt',
			'value' => '',
			'admin_label' => true
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Price Color', 'theme-majesty'),
			'param_name' 	=> 'pricecolor',
			'value' 		=> array(
								esc_html__('Theme Color', 'theme-majesty')  => '',
								esc_html__('Dark', 'theme-majesty') 		=> 'dark',
							)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Featured Text Color', 'theme-majesty'),
			'param_name' 	=> 'featuredcolor',
			'value' 		=> array(
								esc_html__('Theme Color', 'theme-majesty')   => '',
								esc_html__('Red', 'theme-majesty') 		=> 'red',
								esc_html__('Green', 'theme-majesty') 		=> 'green',
								esc_html__('Orange', 'theme-majesty')		=> 'orange',
							)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'theme-majesty' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'theme-majesty' )
		)
	)
));
/* Open Table
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Open_Table extends WPBakeryShortCode {}
}
vc_map( array(
	'name' 				=> esc_html__( 'Open Table Website Reservation', 'theme-majesty' ),
	'base' 				=> 'vc_open_table',
	'icon' 				=> 'theme-icon',
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
	'category'			=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'theme-majesty'),
			'description'	=> esc_html__( 'This Title Display on Admin Only.', 'theme-majesty' ),
			'param_name' => 'title',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Open Table Restaurant ID', 'theme-majesty'),
			'description'	=> esc_html__( 'Please Go to opentable opentable.com and get id from your acount.', 'theme-majesty' ),
			'param_name' => 'restaurantid',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Party Size', 'theme-majesty'),
			'description'	=> esc_html__( 'Please Enter max number for party size.', 'theme-majesty' ),
			'param_name' => 'partysize',
			'value'			=> 20,
		),
				
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_html__('Opening Time', 'theme-majesty'),
			'description' 	=> esc_html__( 'Input opening time here. Divide values with linebreaks (Enter)', 'theme-majesty'),
			'param_name' => 'time',
			'value'			=> '12:00 AM, 12:30 AM, 1:00 AM, 1:30 AM, 2:00 AM, 2:30 AM, 3:00 AM, 3:30 AM, 4:00 AM, 4:30 AM, 5:00 AM, 5:30 AM, 6:00 AM, 6:30 AM, 7:00 AM, 7:30 AM, 8:00 AM, 8:30 AM, 9:00 AM, 9:30 AM, 10:00 AM, 10:30 AM, 11:00 AM, 11:30 AM, 12:00 PM, 12:30 PM, 1:00 PM, 1:30 PM, 2:00 PM, 2:30 PM, 3:00 PM, 3:30 PM, 4:00 PM, 4:30 PM, 5:00 PM, 5:30 PM, 6:00 PM, 6:30 PM, 7:00 PM, 7:30 PM, 8:00 PM, 8:30 PM, 9:00 PM, 9:30 PM, 10:00 PM, 10:30 PM, 11:00 PM, 11:30 PM',
		),
		
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'theme-majesty' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'theme-majesty' )
		)
	)
));

/* Overlay Box
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Overlay_Box extends WPBakeryShortCode {}
}

vc_map( array(
	'name'				=> esc_html__('Overlay Box', 'theme-majesty'),
	'base' 				=> 'vc_overlay_box',
	'icon' 				=> 'theme-icon',
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
	'category'			=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
	'admin_label' 		=> true,
	'params' 			=> array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'theme-majesty'),
			'param_name' => 'title',
			'admin_label' => true
		),
		array(
			'type' 			=> 'attach_image',
			'heading' 		=> esc_html__('Image', 'theme-majesty'),
			'param_name' 	=> 'image',
		),
		array(
			'type' 			=> 'textarea_html',
			'heading' 		=> esc_html__('Content', 'theme-majesty'),
			'param_name' 	=> 'content',
			'admin_label' 	=> true
		),
		sama_add_animation() ,
		sama_data_animation_delay(),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__('Extra class name', 'theme-majesty'),
			'param_name' 	=> 'el_class',
			'description' 	=> esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'theme-majesty'),
		),	
	)
));


/* OWL Carousel
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Images_Owl_Carousel extends WPBakeryShortCode {}
}
vc_map( array(
	'name' => esc_html__( 'OWL Carousel', 'theme-majesty' ),
	'base' => 'vc_images_owl_carousel',
	'icon' 			=> 'theme-icon',
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
	'category'		=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
	'description' => esc_html__( 'Animated carousel with images', 'theme-majesty' ),
	'params' => array(
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Type', 'theme-majesty'),
			'param_name' 	=> 'type',
			'admin_label'	=> true,
			'value' 		=> array(
								esc_html__('Carousel', 'theme-majesty') => 'carousel',
								esc_html__('Slider', 'theme-majesty') 	=> 'slider',
							)
		),
		array(
			'type' => 'attach_images',
			'heading' => esc_html__( 'Images', 'theme-majesty' ),
			'param_name' => 'images',
			'value' => '',
			'description' => esc_html__( 'Select images from media library.', 'theme-majesty' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Carousel size', 'theme-majesty' ),
			'param_name' => 'img_size',
			'value' => 'full',
			'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size. If used slides per view, this will be used to define carousel wrapper size.', 'theme-majesty' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'On click action', 'theme-majesty' ),
			'param_name' => 'onclick',
			'value' => array(
				esc_html__( 'Open prettyPhoto', 'theme-majesty' ) => 'link_image',
				esc_html__( 'None', 'theme-majesty' ) => 'link_no',
				esc_html__( 'Open custom links', 'theme-majesty' ) => 'custom_link'
			),
			'description' => esc_html__( 'Select action for click event.', 'theme-majesty' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_html__( 'Custom links', 'theme-majesty' ),
			'param_name' => 'custom_links',
			'description' => esc_html__( 'Enter links for each slide (Note: divide links with linebreaks (Enter)).', 'theme-majesty' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Custom link target', 'theme-majesty' ),
			'param_name' => 'custom_links_target',
			'description' => esc_html__( 'Select how to open custom links.', 'theme-majesty' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			),
			'value' => $target_arr
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Slider autoplay', 'theme-majesty' ),
			'param_name' => 'autoplay',
			'value' => 'true',
			'description' => esc_html__( 'Change to any integrer for example autoPlay : 5000 to play every 5 seconds. If you set autoPlay: true default speed will be 5 seconds.', 'theme-majesty' )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('stopOnHover', 'theme-majesty'),
			'param_name' 	=> 'stoponhover',
			'std'			=> 'true',
			'value' 		=> array(
								esc_html__('True', 'theme-majesty')   => 'true',
								esc_html__('False', 'theme-majesty') => 'false',
							)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Slide speed', 'theme-majesty' ),
			'param_name' => 'slidespeed',
			'value' => '200',
			'description' => esc_html__( 'Slide speed in milliseconds.', 'theme-majesty' )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Lazy load', 'theme-majesty'),
			'param_name' 	=> 'lazyload',
			'std'			=> 'false',
			'value' 		=> array(
								esc_html__('True', 'theme-majesty')   => 'true',
								esc_html__('False', 'theme-majesty') => 'false',
							)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Display navigation', 'theme-majesty'),
			'description' => esc_html__( 'Display "next" and "prev" buttons.', 'theme-majesty' ),
			'param_name' 	=> 'navigation',
			'std'			=> 'true',
			'value' 		=> array(
								esc_html__('True', 'theme-majesty')   => 'true',
								esc_html__('False', 'theme-majesty') => 'false',
							)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Display pagination', 'theme-majesty'),
			'description' 	=> esc_html__( 'Show pagination.', 'theme-majesty' ),
			'param_name' 	=> 'pagination',
			'std'			=> 'true',
			'value' 		=> array(
								esc_html__('True', 'theme-majesty')   => 'true',
								esc_html__('False', 'theme-majesty') => 'false',
							)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Pagination speed', 'theme-majesty' ),
			'param_name' => 'paginationspeed',
			'value' => '800',
			'description' => esc_html__( 'Pagination speed in milliseconds.', 'theme-majesty' ),
			'dependency' 	=> array( 'element' => 'pagination','value' => array( 'true' ) )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('pagination Margin Top', 'theme-majesty'),
			'param_name' 	=> 'pagination_marg_top',
			'value' 		=> array(
								esc_html__('Default', 'theme-majesty')   => '',
								esc_html__('50px', 'theme-majesty') => '50px',
							),
			'dependency' 	=> array( 'element' => 'pagination','value' => array( 'true' ) )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Display number of items', 'theme-majesty' ),
			'param_name' => 'items',
			'value' => 4,
			'description' => esc_html__( 'This variable allows you to set the maximum amount of items displayed at a time with the widest browser width.', 'theme-majesty' ),
			'dependency' 	=> array( 'element' => 'type','value' => array( 'carousel' ) )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Desktop items', 'theme-majesty' ),
			'param_name' => 'itemsdesktop',
			'value' => 4,
			'description' => esc_html__( 'means that if window <= 1199.', 'theme-majesty' ),
			'dependency' 	=> array( 'element' => 'type','value' => array( 'carousel' ) )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Desktop Small items', 'theme-majesty' ),
			'param_name' => 'itemsdesktopsmall',
			'value' => 3,
			'description' => esc_html__( 'means that if window <= 979.', 'theme-majesty' ),
			'dependency' 	=> array( 'element' => 'type','value' => array( 'carousel' ) )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Tablet items', 'theme-majesty' ),
			'param_name' => 'itemstablet',
			'value' => 2,
			'description' => esc_html__( 'means that if window <= 768.', 'theme-majesty' ),
			'dependency' 	=> array( 'element' => 'type','value' => array( 'carousel' ) )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Tablet items', 'theme-majesty' ),
			'param_name' => 'itemstabletsmall',
			'value' => 2,
			'description' => esc_html__( 'means that if window <= 600.', 'theme-majesty' ),
			'dependency' 	=> array( 'element' => 'type','value' => array( 'carousel' ) )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Mobile items', 'theme-majesty' ),
			'param_name' => 'itemsmobile',
			'value' => 1,
			'description' => esc_html__( 'means that if window <= 479.', 'theme-majesty' ),
			'dependency' 	=> array( 'element' => 'type','value' => array( 'carousel' ) )
		),
		
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'theme-majesty' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'theme-majesty' )
		)
	)
));

/* OWL Carousel With Thumbnails
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Images_Owl_Slider_Thumb extends WPBakeryShortCode {}
}
vc_map( array(
	'name' => esc_html__( 'OWL Slider With Thumbnails', 'theme-majesty' ),
	'base' => 'vc_images_owl_slider_thumb',
	'icon' 			=> 'theme-icon',
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
	'category'		=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
	'params' => array(
		array(
			'type' => 'attach_images',
			'heading' => esc_html__( 'Images', 'theme-majesty' ),
			'param_name' => 'images',
			'value' => '',
			'description' => esc_html__( 'Select images from media library.', 'theme-majesty' )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Display pagination', 'theme-majesty'),
			'description' 	=> esc_html__( 'Show pagination.', 'theme-majesty' ),
			'param_name' 	=> 'pagination',
			'std'			=> 'true',
			'value' 		=> array(
								esc_html__('True', 'theme-majesty')   => 'true',
								esc_html__('False', 'theme-majesty') => 'false',
							)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Display number of Thumbnails', 'theme-majesty' ),
			'param_name' => 'items',
			'value' => 4,
			'description' => esc_html__( 'This variable allows you to set the maximum amount of items displayed at a time with the widest browser width.', 'theme-majesty' ),
			'dependency' 	=> array( 'element' => 'type','value' => array( 'slider' ) )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Desktop number of Thumbnails', 'theme-majesty' ),
			'param_name' => 'itemsdesktop',
			'value' => 4,
			'description' => esc_html__( 'means that if window <= 1199.', 'theme-majesty' ),
			'dependency' 	=> array( 'element' => 'type','value' => array( 'slider' ) )
		),
		
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'theme-majesty' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'theme-majesty' )
		)
	)
));

/* Custom Pricing Table
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Pricing_Column extends WPBakeryShortCode {}
}
vc_map( array(
	'name' 			=> esc_html__( 'Pricing Column', 'theme-majesty' ),
	'base' 			=> 'vc_pricing_column',
	'icon' 			=> 'theme-icon',
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
	'category'		=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
	'description' 	=> esc_html__( 'Pricing column for Pricing Table', 'theme-majesty' ),
	'params' => array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'title', 'theme-majesty' ),
			'param_name' 	=> 'title',
			'admin_label'	=> true,
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Column Style', 'theme-majesty' ),
			'param_name' 	=> 'column_style',
			'std'			=> '',
			'value' 		=> array(
								esc_html__( 'Dark',			'theme-majesty' )	=> '',
								esc_html__( 'Theme Color', 	'theme-majesty' )	=> 'theme-color',
								esc_html__( 'Green',		'theme-majesty' )	=> 'green-price',
								esc_html__( 'Dark Blue',	'theme-majesty' )	=> 'wet-asphelt-price'
							),
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Price', 'theme-majesty' ),
			'param_name' 	=> 'price',
			'admin_label' 	=> true,
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Currency', 'theme-majesty' ),
			'param_name'	=> 'currency',
			'std'			=> '$',
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Price subtitle', 'theme-majesty' ),
			'param_name' 	=> 'price_subtitle',
			'std'			=> 'per month',
		),
		array(
			'type' 			=> 'exploded_textarea',
			'heading' 		=> esc_html__( 'Pricing Features', 'theme-majesty' ),
			'param_name' 	=> 'features',
			'description' 	=> esc_html__( 'Input price column features here. Divide values with linebreaks (Enter)', 'theme-majesty'),
			'admin_label' 	=> true,
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__('Button Text', 'theme-majesty'),
			'param_name' 	=> 'btn_text',
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__('Button URL', 'theme-majesty'),
			'param_name' 	=> 'url',
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Link target', 'theme-majesty'),
			'param_name' 	=> 'target',
			'std'			=> '_self',
			'value' 		=> $target_arr ,
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__('Button Title Attributes ', 'theme-majesty'),
			'param_name' 	=> 'title_attr',
			'description' 	=> esc_html__('Optional: used of a tag attribute title ', 'theme-majesty'),
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__('Extra class name', 'theme-majesty'),
			'param_name' 	=> 'el_class',
			'description' 	=> esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'theme-majesty'),
		),		
	)
));

/* Progress Bar
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Custom_Progress_Bar extends WPBakeryShortCode {}
}
vc_map( array(
	'name' 				=> esc_html__( 'Progress Bar', 'theme-majesty' ),
	'base' 				=> 'vc_custom_progress_bar',
	'icon' 				=> 'theme-icon',
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
	'category'			=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
	'description' 		=> esc_html__( 'Animated progress bar', 'theme-majesty' ),
	'params' => array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'title', 'theme-majesty' ),
			'param_name' 	=> 'title',
			'admin_label'	=> true,
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'value', 'theme-majesty' ),
			'param_name' => 'value',
			'admin_label' => true,
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Unit', 'theme-majesty' ),
			'param_name' => 'unit',
			'std'		 => '%',
			'description' => esc_html__( 'Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.', 'theme-majesty' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Bar color', 'theme-majesty' ),
			'param_name' => 'bgcolor',
			'value' => array(
				esc_html__( 'Theme Color', 'theme-majesty' ) => 'color-progress',
				esc_html__( 'Dark', 'theme-majesty' ) => 'dark-progress',
				esc_html__( 'Bule', 'theme-majesty' ) => 'progress-bar',
				esc_html__( 'Green', 'theme-majesty' ) => 'progress-bar-success',
				esc_html__( 'Viking', 'theme-majesty' ) => 'progress-bar-info',
				esc_html__( 'Orange', 'theme-majesty' ) => 'progress-bar-warning',
				esc_html__( 'Red', 'theme-majesty' ) => 'progress-bar-danger',
				esc_html__( 'Custom Color', 'theme-majesty' ) => 'custom'
			),
			'description' => esc_html__( 'Select bar background color.', 'theme-majesty' ),
			'admin_label' => true
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Bar custom color', 'theme-majesty' ),
			'param_name' => 'custombgcolor',
			'description' => esc_html__( 'Select custom background color for bars.', 'theme-majesty' ),
			'dependency' => array( 'element' => 'bgcolor', 'value' => array( 'custom' ) )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Options', 'theme-majesty' ),
			'param_name' => 'options',
			'value' => array(
				esc_html__( 'Add stripes', 'theme-majesty' ) => 'striped',
				esc_html__( 'Add animation (Note: visible only with striped bar).', 'theme-majesty' ) => 'animated'
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'theme-majesty' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'theme-majesty' )
		)
	)
));
/* Testimonial Box
---------------------------------------------------------- */
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Single_Testimonial extends WPBakeryShortCode {}
}
vc_map( array(
	'name' 			=> esc_html__( 'Testimonial', 'theme-majesty' ),
	'base' 			=> 'vc_single_testimonial',
	'icon' 			=> 'theme-icon',
	'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
	'category'		=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
	'params' 		=> array(
		array(
			'type' 			=> 'attach_image',
			'heading' 		=> esc_html__('Image', 'theme-majesty'),
			'param_name' 	=> 'image',
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__('Align', 'theme-majesty'),
			'param_name' 	=> 'align',
			'admin_label'	=> true,
			'value' 		=> array(
								esc_html__('Left', 'theme-majesty') 		=> 'left',
								esc_html__('Right', 'theme-majesty') 	=> 'right',
							)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('By', 'theme-majesty'),
			'param_name' => 'author',
			'admin_label' => true
		),
		array(
			'type' => 'textarea',
			'heading' => esc_html__('Content', 'theme-majesty'),
			'param_name' => 'content',
			'admin_label' => true
		),
		array(
		  'type' 			=> 'textfield',
		  'heading' 		=> esc_html__('Extra class name', 'theme-majesty'),
		  'param_name' 		=> 'el_class',
		  'description' 	=> esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'theme-majesty'),
		),
		
	)
));


/* Support for 3rd Party plugins
---------------------------------------------------------- */
// Restaurant Reservations
if ( class_exists('rtbInit') ) {
	
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Vc_Restaurant_Reservations extends WPBakeryShortCode {}
	}
	vc_map( array(
		'name' 			=> esc_html__( 'Restaurant Reservations plugin', 'theme-majesty' ),
		'base' 			=> 'vc_restaurant_reservations',
		'icon' 			=> 'theme-icon',
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
		'category'		=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
		'params' 		=> array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Title', 'theme-majesty'),
				'description'	=> esc_html__( 'This Title Display on Admin Only.', 'theme-majesty' ),
				'param_name' => 'title',
				'admin_label' => true
			),
		)
	) );
}

// TeamMembers plugin
if ( class_exists('Woothemes_Our_Team') ) {
	
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Vc_Team_Members_Carousel extends WPBakeryShortCode {}
	}
	vc_map( array(
		'name' 			=> esc_html__( 'Team members carousel', 'theme-majesty' ),
		'base' 			=> 'vc_team_members_carousel',
		'icon' 			=> 'theme-icon',
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
		'category'		=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
		'params' 		=> array(
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Display', 'theme-majesty' ),
				'param_name' 	=> 'display',
				'value' 		=> array(
									esc_html__( 'Recent team members', 'theme-majesty' ) 	=> 'recent',
									esc_html__( 'Team members by ID', 'theme-majesty' ) 	=> 'id',
								),
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Number of members', 'theme-majesty' ),
				'param_name' 	=> 'num',
				'value' 		=> 6,
				'dependency' 	=> array( 'element' => 'display','value' => array( 'recent' ) )
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Order ', 'theme-majesty' ),
				'param_name' 	=> 'order',
				'std'			=> 'DESC',
				'value'			=> array(
									'ASC' 	=> 'ASC',
									'DESC'	=> 'DESC',
								)
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'OrderBy ', 'theme-majesty' ),
				'param_name' 	=> 'orderby',
				'std'			=> 'date',
				'value'			=> array(
									esc_html__( 'ID', 		'theme-majesty' ) 	=> 'ID',
									esc_html__( 'Author', 	'theme-majesty' ) 	=> 'author',
									esc_html__( 'Title', 	'theme-majesty' ) 	=> 'title',
									esc_html__( 'Name', 	'theme-majesty' ) 	=> 'name',
									esc_html__( 'Date', 	'theme-majesty' ) 	=> 'date',
									esc_html__( 'Rand', 	'theme-majesty' ) 	=> 'rand',
									esc_html__( 'Menu Order', 'theme-majesty' ) => 'menu_order',
								)
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Team members IDS', 'theme-majesty' ),
				'param_name' 	=> 'ids',
				'description' 	=> esc_html__('use comma to Separates between ids.', 'theme-majesty'),
				'dependency' 	=> array( 'element' => 'display','value' => array( 'id' ) )
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Display link to post', 'theme-majesty' ),
				'param_name' 	=> 'link',
				'std'			=> 'yes',
				'value'			=> $yes_array,
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Display Email', 'theme-majesty' ),
				'param_name' 	=> 'displayemail',
				'std'			=> 'no',
				'value'			=> $yes_array,
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__('Extra class name', 'theme-majesty'),
				'param_name' 	=> 'el_class',
				'description' 	=> esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'theme-majesty'),
			),
			
		)
	) );
}

/* WooCommerce Plugin
---------------------------------------------------------- */
if ( class_exists('woocommerce') ) {

	/* WooCommerce Products Slider Inside Tabs
	---------------------------------------------------------- */
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Vc_Woo_Slider_By_Category extends WPBakeryShortCode {}
	}
	vc_map( array(
		'name' 			=> esc_html__( 'Woo Products Slider', 'theme-majesty' ),
		'base' 			=> 'vc_woo_slider_by_category',
		'icon' 			=> 'theme-icon',
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
		'category'		=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
		'params' 		=> array(
			array(
				'type' 			=> 'checkbox',
				'heading' 		=> esc_html__( 'Display Categories', 'theme-majesty' ),
				'description'	=> esc_html__( 'Check category you to display it.', 'theme-majesty' ),
				'param_name' 	=> 'cats',
				'value' 		=> sama_get_woocommerce_categories(),
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Category IDS', 'theme-majesty' ),
				'param_name' 	=> 'cat_ids',
				'description' 	=> esc_html__('use comma to Separates between ids, usefull to sort woocommerce thats display in slider as you need.', 'theme-majesty'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Per page', 'theme-majesty' ),
				'value' => 4,
				'param_name' => 'per_page',
				'description' => esc_html__( 'The "per_page" shortcode determines how many products to show on the page', 'theme-majesty' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Order by', 'theme-majesty' ),
				'param_name' => 'orderby',
				'value' => sama_order_by_values(),
				'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'theme-majesty' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Order way', 'theme-majesty' ),
				'param_name' => 'order',
				'value' => sama_order_way_values(),
				'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'theme-majesty' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Excerpt Length', 'theme-majesty' ),
				'value' => 13,
				'param_name' => 'excerpt_length',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Categories Link margin top', 'theme-majesty' ),
				'value' => '15%',
				'param_name' => 'links_m_top',
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__('Extra class name', 'theme-majesty'),
				'param_name' 	=> 'el_class',
				'description' 	=> esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'theme-majesty'),
			),
		)
	));
	/* WooCommerce Products Category Carousel
	---------------------------------------------------------- */
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Vc_Woo_Carousel_By_Category extends WPBakeryShortCode {}
	}
	vc_map( array(
		'name' 			=> esc_html__( 'Woo Products Carousel', 'theme-majesty' ),
		'base' 			=> 'vc_woo_carousel_by_category',
		'icon' 			=> 'theme-icon',
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
		'category'		=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
		'params' 		=> array(
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Display Categories', 'theme-majesty' ),
				'description'	=> esc_html__( 'Check category you to display it.', 'theme-majesty' ),
				'param_name' 	=> 'cats',
				'value' 		=> sama_get_woocommerce_categories(),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Per page', 'theme-majesty' ),
				'value' => 12,
				'param_name' => 'per_page',
				'description' => esc_html__( 'The "per_page" shortcode determines how many products to show on the page', 'theme-majesty' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Order by', 'theme-majesty' ),
				'param_name' => 'orderby',
				'value' => sama_order_by_values(),
				'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'theme-majesty' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Order way', 'theme-majesty' ),
				'param_name' => 'order',
				'value' => sama_order_way_values(),
				'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'theme-majesty' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__('Extra class name', 'theme-majesty'),
				'param_name' 	=> 'el_class',
				'description' 	=> esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'theme-majesty'),
			),
		)
	));
	/* WooCommerce Products Categories Filters
	---------------------------------------------------------- */
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Vc_Woo_Filters extends WPBakeryShortCode {}
	}
	$woo_layout = array(
		esc_html__( 'Grid 3 Columns', 	  'theme-majesty') 	=> 'grid',
		esc_html__( 'Grid Four Columns',  'theme-majesty') 	=> 'grid4col',
		esc_html__( 'Grid full width', 	  'theme-majesty') 	=> 'gridfullwidth',
		esc_html__( 'Masonry', 			  'theme-majesty') 	=> 'masonry',
		esc_html__( 'Masonry full width', 'theme-majesty') 	=> 'masonryfullwidth',
		esc_html__( 'List', 			  'theme-majesty') 	=> 'list',
		esc_html__( 'List2 Add to Cart Button under image', 'theme-majesty') => 'list2',
		esc_html__( 'Default WooCommerce 3 Columns', 'theme-majesty') => '3col',
		esc_html__( 'Default WooCommerce 4 Columns', 'theme-majesty') => '4col',
	);
	vc_map( array(
		'name' 			=> esc_html__( 'Woo Filters', 'theme-majesty' ),
		'base' 			=> 'vc_woo_filters',
		'icon' 			=> 'theme-icon',
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vcicon.css'),
		'category'		=>	array( esc_html__('By SamaThemes', 'theme-majesty'),esc_html__('Content', 'theme-majesty') ),
		'params' 		=> array(
			array(
				'type' 			=> 'checkbox',
				'heading' 		=> esc_html__( 'Display Categories', 'theme-majesty' ),
				'description'	=> esc_html__( 'Check category you to display it.', 'theme-majesty' ),
				'param_name' 	=> 'cats',
				'admin_label' => true,
				'value' 		=> sama_get_woocommerce_categories(),
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Display ', 'theme-majesty' ),
				'param_name' 	=> 'display',
				'admin_label' 	=> true,
				'value'			=> $woo_layout,
									
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Show all Text', 'theme-majesty' ),
				'value' => 'SHOW ALL',
				'param_name' => 'txt_show_all',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Per page', 'theme-majesty' ),
				'value' => 12,
				'param_name' => 'per_page',
				'description' => esc_html__( 'The "per_page" shortcode determines how many products to show on the page', 'theme-majesty' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Order by', 'theme-majesty' ),
				'param_name' => 'orderby',
				'value' => sama_order_by_values(),
				'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'theme-majesty' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Order way', 'theme-majesty' ),
				'param_name' => 'order',
				'value' => sama_order_way_values(),
				'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'theme-majesty' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__('Extra class name', 'theme-majesty'),
				'param_name' 	=> 'el_class',
				'description' 	=> esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file. ', 'theme-majesty'),
			),
		)
	));
	if(  is_admin() ) {
		$columns = array(
			'type' 		=> 'dropdown',
			'heading' 	=> esc_html__('Display As', 'theme-majesty'),
			'param_name' 	=> 'columns',
			'description' => esc_html__('to make this column text align to center', 'theme-majesty'),
			'admin_label' 	=> true,
			'value' 		=> $woo_layout,
			'weight'	=> 1,
		);
				
		vc_remove_param( "product_category", "columns" );
		vc_add_param( 'product_category' , $columns);
		
		vc_remove_param( "recent_products", "columns" );
		vc_add_param( 'recent_products' , $columns);
		
		vc_remove_param( "featured_products", "columns" );
		vc_add_param( 'featured_products' , $columns);
		
		vc_remove_param( "best_selling_products", "columns" );
		vc_add_param( 'best_selling_products' , $columns);
		
		vc_remove_param( "sale_products", "columns" );
		vc_add_param( 'sale_products' , $columns);
		
		vc_remove_param( "top_rated_products", "columns" );
		vc_add_param( 'top_rated_products' , $columns);
		
		vc_remove_param( "product_attribute", "columns" );
		vc_add_param( 'product_attribute' , $columns);
		
		vc_remove_param( "products", "columns" );
		vc_add_param( 'products' , $columns);
		
		vc_add_param( 'product' , $columns);
	}
}