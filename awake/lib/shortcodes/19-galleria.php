<?php
/**
 *
 */
class mysiteGalleria {
	
	/**
	 *
	 */
	function galleria( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Galleria', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'galleria',
				'options' => array(
					array(
						'name' => __( 'Transition Effect', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'The transition effect is the animation that displays when changing from one image to the next.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'transition',
						'default' => '',
						'options' => array(
							'fade' => __( 'Fade', MYSITE_ADMIN_TEXTDOMAIN ),
							'slide' => __( 'Slide', MYSITE_ADMIN_TEXTDOMAIN ),
							'fadeslide' => __( 'Fade Slide', MYSITE_ADMIN_TEXTDOMAIN ),
							'pulse' => __( 'Pulse', MYSITE_ADMIN_TEXTDOMAIN ),
							'flash' => __( 'Flash', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Transition Speed', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'The transition speed is how fast the transition animation will take to complete.<br /><br />This number is in milliseconds, 1 second = 1000 milliseconds.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'speed',
						'default' => '',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Height', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the height that you want the galleria to use.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'height',
						'default' => '',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Width', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the width that you want the galleria to use.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'width',
						'default' => '',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Enable Galleria Options', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can select various galleria options to use here.', MYSITE_ADMIN_TEXTDOMAIN ),						
						'id' => 'enable',
						'options' => array(
							'image_crop' => __( 'Image Crop', MYSITE_ADMIN_TEXTDOMAIN ),
							'show_counter' => __( 'Show Counter', MYSITE_ADMIN_TEXTDOMAIN ),
							'show_imagenav' => __('Show Image Nav', MYSITE_ADMIN_TEXTDOMAIN ),
							'pause_on_interaction' => __('Pause on Hover', MYSITE_ADMIN_TEXTDOMAIN ),
							'lightbox' => __( 'Lightbox', MYSITE_ADMIN_TEXTDOMAIN )
							
						),
						'default' => '',
						'type' => 'checkbox',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Number of images', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select how many images you wish to display in the galleria.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'default' => '',
						'options' => range(1,10),
						'type' => 'select',
						'shortcode_multiplier' => true
					),
					array(
						'name' => __( 'Image 1 URL', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can upload an image to use here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'upload',
						'shortcode_multiply' => true
					),
					
					array(
						'name' => __( 'Image 1 Title Attribute <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the title text that you would like to use for this image.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Image 1 Alt Attribute <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the alt text that you would like to use for this image.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'alt',
						'default' => '',
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
		
		extract(shortcode_atts(array(
	        'transition' => 'fade',
			'speed' => 'true',
			'height' => '',
			'width' => '',
			'enable' => ''
	    ), $atts));
	
		global $wp_query, $mysite;
		
		$mobile_disable_shortcodes = mysite_get_setting( 'mobile_disable_shortcodes' );
		if( isset( $mysite->mobile ) && is_array( $mobile_disable_shortcodes ) && in_array( 'galleria', $mobile_disable_shortcodes ) )
			return;
		
		$out = '';
	
		$galleria_id = 'galleria_' . rand(1,1000);
		
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
		
		$image_crop = 'false';
		$show_counter = 'false';
		$show_imagenav = 'false';
		$pause_on_interaction = 'false';
		$lightbox = '';
		
		if( strpos( $enable, 'image_crop' ) !== false )
			$image_crop = 'true';
			
		if( strpos( $enable, 'show_counter' ) !== false )
			$show_counter = 'true';
			
		if( strpos( $enable, 'show_imagenav' ) !== false )
			$show_imagenav = 'true';
			
		if( strpos( $enable, 'pause_on_interaction' ) !== false )
			$pause_on_interaction = 'true';
		
		if( strpos( $enable, 'lightbox' ) !== false ) {
			$lightbox = ' extend: function(options) {
		        	this.bind(Galleria.IMAGE, function(e) {
		        		jQuery(e.imageTarget).click(this.proxy(function() {
		                  	this.openLightbox();
		         	}));
		           });
			},';
		}
			
		$script = '<script type="text/javascript">
		/* <![CDATA[ */
		jQuery(document).ready(function() {
			jQuery("#' . $galleria_id . '").galleria({
				autoplay: ' . $speed . ',' . $lightbox . '
				thumbCrop: true,
				image_crop: ' . $image_crop . ',
				show_counter: ' . $show_counter . ',
				show_imagenav: ' . $show_imagenav . ',
				pause_on_interaction: ' . $pause_on_interaction . ',
				transition: "' . $transition . '"
			});
		});
		/* ]]> */
		</script>';
		
		if ( !preg_match_all("/(.?)\[(image)\b(.*?)(?:(\/))?\](?:(.+?)\[\/image\])?(.?)/s", $content, $sc_matches ) ) {
			
			if( preg_match_all( '!https?://.+\.(?:jpe?g|png|gif)!Ui', $content, $matches ) ) {
				
				echo $script;
				
				$out .=  '<div id="' . $galleria_id . '" style="width:' . $width . 'px;height:' . $height . 'px;">';
				
				foreach ( $matches[0] as $img ) {
					$out .= mysite_display_image( array( 'src' => $img, 'title' => '', 'alt' => '' ) );
				}
				
				$out .= '</div>';
			}
			
		} else {
			
			echo $script;
			
			$out .=  '<div id="' . $galleria_id . '" style="width:' . $width . 'px;height:' . $height . 'px;">';
			
			for( $i = 0; $i < count( $sc_matches[0] ); $i++ ) {
				$sc_matches[3][$i] = shortcode_parse_atts( $sc_matches[3][$i] );
			}
			
			for( $i = 0; $i < count( $sc_matches[0] ); $i++ ) {
				$title = ( !empty( $sc_matches[3][$i]['title'] ) ) ? $sc_matches[3][$i]['title'] : '';
				$alt = ( !empty( $sc_matches[3][$i]['alt'] ) ) ? $sc_matches[3][$i]['alt'] : '';
				
				$out .= mysite_display_image( array( 'src' => $sc_matches[5][$i], 'title' => $title, 'alt' => $alt ) );
			}
			
			$out .= '</div>';
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
			'name' => __( 'Galleria', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'galleria',
			'options' => $shortcode
		);

		return $options;
	}

}

?>