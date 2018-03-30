<?php
/**
 *
 */
class mysiteImages {
	
	function fancy_images( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Fancy Images', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'fancy_images',
				'options' => array(
					array(
						'name' => __( 'Width', MYSITE_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Set the width for your image.  Leave this blank if you do not want your image to be resized.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'width',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Height', MYSITE_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Set the width for your image.  Leave this blank if you do not want your image to be resized.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'height',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Number of images', MYSITE_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Select how many images you wish to display.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'options' => range(1,20),
						'type' => 'select',
						'shortcode_multiplier' => true
					),
					array(
						'name' => __( 'Image 1 URL', MYSITE_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'You can upload the image you wish to use here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'type' => 'upload',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Image 1 Title Attribute <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Type out the title text you wish to use with your image.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Image 1 Alt Attribute <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Type out the alt text you wish to use with your image.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'alt',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Image 1 Caption <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Type out the caption text you wish to use with your image.<br /><br />This text will be displayed below your image.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'caption',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Image 1 Custom Link <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'By default when a reader clicks on your image it will open in a lightbox.<br /><br />You can paste a URL here to use instead.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'link_to',
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
		
		global $mysite;
		
		extract(shortcode_atts(array(
			'width'  => '',
			'height' => '',
			'group' => '',
			'class' => 'true'
		), $atts));
		
		$out = '';
		
		$width = ( !empty( $width ) ) ? trim(str_replace(' ', '', str_replace('px', '', $width ) ) ) : $mysite->layout['images']['three_column_portfolio'][0];
		$height = ( !empty( $height ) ) ? trim(str_replace(' ', '', str_replace('px', '', $height ) ) ) : $mysite->layout['images']['three_column_portfolio'][1];
		
		if ( !preg_match_all( '/(.?)\[(image)\b(.*?)(?:(\/))?\](?:(.+?)\[\/image\])?(.?)/s', $content, $matches ) ) {
			
			if( preg_match_all( '!https?://.+\.(?:jpe?g|png|gif)!Ui', $content, $matches ) ){
				
				if( empty( $group ) )
					$group = 'fancy_img_group_'.rand(1,1000);
				
				$out .= '<div class="fancy_images">';
				
				foreach ( $matches[0] as $img ) {
					$out .= '<div class="fancy_image">';
					
					$out .= mysite_display_image( array(
									'src' => $img, 
									'alt' => '',
									'title' => '',
									'height' => $height,
									'width' => $width,
									'class' => ( $class == 'true' ? 'hover_fade_js' : '' ),
									'link_to' => $img,
									'link_class' => 'fancy_image_load',
									'prettyphoto' => true,
									'group' => $group,
									'preload' => ( isset( $mysite->mobile ) ? false : true ),
								) );
					
					$out .= '</div>';
				}
				$out .= '</div>';
			}
			
		} else {
			
			for( $i = 0; $i < count( $matches[0] ); $i++ ) {
				
				$matches[3][$i] = str_replace( "&#8221;", '"', $matches[3][$i] );
				
				$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
				if( isset( $matches[3][$i]['caption'] ) )
					$has_caption = true;
			}
			
			if( empty( $group ) )
				$group = 'fancy_img_group_'.rand(1,1000);
			
			$out .= '<div class="fancy_images' . ( isset( $has_caption ) ? ' has_captions' : '' ) . '">'; 

			for( $i = 0; $i < count($matches[0] ); $i++ ) {
				
				$img = $matches[5][$i];
				$alt = ( isset( $matches[3][$i]['alt'] ) ) ? $matches[3][$i]['alt'] : '';
				$title = ( isset( $matches[3][$i]['title'] ) ) ? $matches[3][$i]['title'] : '';
				
				$link_to = ( !empty( $matches[3][$i]['link_to'] ) ) ? $matches[3][$i]['link_to'] : $img;
				$prettyphoto = ( ( !empty( $matches[3][$i]['link_to'] ) ) && ( strpos( $matches[3][$i]['link_to'], 'iframe' ) === false ) ) ? false : true;
				
				$out .= '<div class="fancy_image">';
				$out .= mysite_display_image( array(
								'src' => $img, 
								'alt' => $alt,
								'title' => $title,
								'height' => $height,
								'width' => $width,
								'class' => ( $class == 'true' ? 'hover_fade_js' : '' ),
								'link_to' => $link_to,
								'link_class' => 'fancy_image_load',
								'prettyphoto' => $prettyphoto,
								'group' => $group,
								'preload' => ( isset( $mysite->mobile ) ? false : true ),
							) );
				
				if( isset( $has_caption ) )			
					$out .= '<span class="fancy_image_caption" style="display:none;">' . $matches[3][$i]['caption'] . '</span>';
							
				$out .= '</div>';
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
			'name' => __( 'Fancy Images', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'fancy_images',
			'options' => $shortcode
		);
		
		return $options;
	}
	
}

?>