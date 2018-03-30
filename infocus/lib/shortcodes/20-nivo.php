<?php
/**
 *
 */
class mysiteNivo {
	
	private static $nivo_id = 1;

	/**
	 *
	 */
	function _nivo_id() {
	    return self::$nivo_id++;
	}
	
	function nivo( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Nivo', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'nivo',
				'options' => array(
					array(
						'name' => __( 'Transition Effects', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'The transition effect is the animation that displays when changing from one image to the next.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'effect',
						'target' => 'nivo_effects',
						'type' => 'select',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Slices', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'The Nivo slider transitions are broken up into slices.  You can type out the number of slices you want to use here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'slices',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Animation Speed', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This is how fast the transition animations will take to complete.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'animSpeed',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Slider Transition Speed', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This is how long an image is displayed before changing to the next.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'pauseTime',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Next &amp; Prev Buttons', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'The next and previous buttons display on the left and rigt side and allow the user to manually change the image.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'directionNav',
						'default' => 'disable',
						'options' => array( 
							'button' => __( 'Always Display Next & Previous Buttons', MYSITE_ADMIN_TEXTDOMAIN ),
							'button_hover' => __( 'Display Next & Previous Buttons on Hover', MYSITE_ADMIN_TEXTDOMAIN ),
							'disable' => __( 'Disable Next & Previous Buttons', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'radio',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Display Nav Dots', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'The navigation dots display on the bottom and allow the user to manually change the image.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'controlNav',
						'options' => array( 'true' => __( 'Display Navigation Dots', MYSITE_ADMIN_TEXTDOMAIN ) ),
						'type' => 'checkbox',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Width', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can manually set the width of the slider here.  Your images will be resized to fit.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'width',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Height', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can manually set the height of the slider here.  Your images will be resized to fit.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'height',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Number of images', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose the number of images you wish to display in the slider.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'options' => range(1,20),
						'type' => 'select',
						'shortcode_multiplier' => true
					),
					array(
						'name' => __( 'Image 1 URL', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can upload an image to use here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'type' => 'upload',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Image 1 Caption <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'With the Nivo slider captions are displayed with the images.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'caption',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'value' => 'image',
						'nested' => true
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
		
		global $wp_query, $mysite;
		
		extract(shortcode_atts(array(
			'width'			=> '',
			'height'		=> '',
			'effect'		=> '',
			'slices'		=> '',
			'animspeed'		=> '',
			'pausetime'		=> '',
			'directionnav'	=> '',
			'controlnav'	=> ''
		), $atts));
		
		$mobile_disable_shortcodes = mysite_get_setting( 'mobile_disable_shortcodes' );
		if( isset( $mysite->mobile ) && is_array( $mobile_disable_shortcodes ) && in_array( 'slider', $mobile_disable_shortcodes ) )
			return;
		
		$out = '';
		$nivo_id = self::_nivo_id();
		
		$width = ( !empty( $width ) ) ? trim(str_replace(' ', '', str_replace('px', '', $width ) ) ) : '';
		$height = ( !empty( $height ) ) ? trim(str_replace(' ', '', str_replace('px', '', $height ) ) ) : '';
		
		if( empty( $width ) || empty( $height ) ) {
			$post_obj = $wp_query->get_queried_object();
			$_layout = get_post_meta( $post_obj->ID, '_layout', true );
			$img_size = ( $_layout == 'right_sidebar' ? 'big_sidebar_images' : ( $_layout == 'full_width' ? 'images' : 'small_sidebar_images' ) );
				
			if( empty( $width ) )
				$width = $mysite->layout[$img_size]['one_column_blog'][0];
				
			if( empty( $height ) )
				$height = $mysite->layout[$img_size]['one_column_blog'][1];
		}
		
		$effect = ( !empty( $effect ) ) ? trim( $effect ) : 'sliceDown';
		$slices = ( !empty( $slices ) ) ? trim( $slices ) : 15;
		$animspeed = ( !empty( $animspeed ) ) ? trim( $animspeed ) : 500;
		$pausetime = ( !empty( $pausetime ) ) ? trim( $pausetime ) : 3000;
		$controlnav = ( empty( $controlnav ) ) ? 'false' : 'true';
		
		if( $directionnav == 'button' ) {
			$directionnav = 'true';
			$directionnavhide = 'false';
			
		} elseif( $directionnav == 'button_hover' ) {
			$directionnav = 'true';
			$directionnavhide = 'true';
			
		} elseif( $directionnav == 'disable' || empty( $directionnav ) ) {
			$directionnav = 'false';
			$directionnavhide = 'false';
		}
		
		$get_disable_cufon = mysite_get_setting( 'disable_cufon' );
		$nivo_caption = ( empty( $get_disable_cufon ) ) ? "Cufon.replace('.nivo-caption');" : '';
		
		$script = "<script type=\"text/javascript\">
		/* <![CDATA[ */
		jQuery(document).ready(function() {
			jQuery('#mysite_nivo_sc_{$nivo_id} .nivo_sc_load').preloader({
				selector: '#nivo_slider_{$nivo_id}',
				imgAppend: '',
				fade: false,
				onDone: function(){
					jQuery('.preload_span').remove();
					jQuery('#nivo_slider_{$nivo_id}').nivoSlider({
						effect: '{$effect}',
						slices: {$slices},
						animSpeed: {$animspeed}, //Slide transition speed
						pauseTime: {$pausetime}, // How long each slide will show
						directionNav: {$directionnav}, //Next & Prev
						directionNavHide: {$directionnavhide}, //Only show on hover
						controlNav: {$controlnav}, //1,2,3...
						keyboardNav:false, //Use left & right arrows
						pauseOnHover: true, //Stop animation while hovering
						manualAdvance: false, //Force manual transitions
						customChange: function(){ $nivo_caption }
					});
					jQuery('#nivo_slider_{$nivo_id}').removeClass('noscript');
				}
			});
		});
		/* ]]> */
		</script>";
		
		echo $script;
		
		if ( !preg_match_all( '/(.?)\[(image)\b(.*?)(?:(\/))?\](?:(.+?)\[\/image\])?(.?)/s', $content, $matches ) ) {
			
			if( preg_match_all( '!https?://.+\.(?:jpe?g|png|gif)!Ui', $content, $matches ) ) {
				
				$out ='<div id="mysite_nivo_sc_' . $nivo_id . '" class="mysite_nivo_sc" style="width:' . $width . 'px;height:' . $height . 'px;">';
				
				$out .= '<div class="mysite_preloader">';
				$out .= '<img src="' . esc_url( THEME_IMAGES_ASSETS . '/transparent.gif' ) . '" style="background-image: url(' . THEME_IMAGES_ASSETS . '/preloader.png);">';
				$out .= '</div>';
				
				$out .= '<div class="nivo_sc_load">';
				$out .='<div id="nivo_slider_' . $nivo_id . '" class="noscript">';
				
				foreach ( $matches[0] as $img ) {
					$out .= '<span>';
					$out .= mysite_display_image( array( 'src' => $img, 'alt' => '', 'height' => $height, 'width' => $width ) );
					$out .= '</span>';
				}
				
				$out .= '</div>';
				$out .= '</div>';
				$out .= '</div>';
			}
			
		} else {
			
			for( $i = 0; $i < count( $matches[0] ); $i++ ) {
				$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
			}
			
			$out ='<div id="mysite_nivo_sc_' . $nivo_id . '" class="mysite_nivo_sc" style="width:' . $width . 'px;height:' . $height . 'px;">';
			
			$out .= '<div class="mysite_preloader">';
			$out .= '<img src="' . esc_url( THEME_IMAGES_ASSETS . '/transparent.gif' ) . '" style="background-image: url(' . THEME_IMAGES_ASSETS . '/preloader.png);">';
			$out .= '</div>';
			
			$out .= '<div class="nivo_sc_load">';
			$out .='<div id="nivo_slider_' . $nivo_id . '" class="noscript">';
			
			for( $i = 0; $i < count($matches[0] ); $i++ ) {
				$caption = ( isset( $matches[3][$i]['caption'] ) ) ? $matches[3][$i]['caption'] : '';
				$title = ( !empty( $caption ) ) ? "#htmlcaption_{$i}_{$nivo_id}" : '';
				
				$out .= '<span>';
				$out .= mysite_display_image( array( 'src' => $matches[5][$i], 'title' => $title, 'alt' => '', 'height' => $height, 'width' => $width ) );
				$out .= '</span>';
			}
			
			$out .= '</div>';
			$out .= '</div>';
			$out .= '</div>';
			
			
			for( $i = 0; $i < count($matches[0] ); $i++ ) {
				$caption = ( isset( $matches[3][$i]['caption'] ) ) ? $matches[3][$i]['caption'] : '';
				
				if( !empty( $caption ) ) {
					$out .= '<div id="htmlcaption_' . $i . '_' . $nivo_id . '" class="nivo-html-caption">';
					$out .= $caption;
					$out .= '</div>';
				}
			}
		}
		
		return $out;
	}
	
	/**
	 *
	 */
	function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' )
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
		}
		
		$options = array(
			'name' => __( 'Nivo Slider', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'nivo',
			'options' => $shortcode
		);
		
		return $options;
	}
	
}

?>