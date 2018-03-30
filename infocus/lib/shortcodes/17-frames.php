<?php
/**
 *
 */
class mysiteFrames {
	
	/**
	 *
	 */
	function image_frame( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Image Frames', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'image_frame',
				'options' => array(
					array(
						'name' => __( 'Type', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose which type of frame you wish to use.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'style',
						'default' => '',
						'options' => array(
							'border' => __( 'Transparent Border', MYSITE_ADMIN_TEXTDOMAIN ),
							'reflect' => __( 'Reflection', MYSITE_ADMIN_TEXTDOMAIN ),
							'framed' => __( 'Framed', MYSITE_ADMIN_TEXTDOMAIN ),
							'shadow' => __( 'Shadow', MYSITE_ADMIN_TEXTDOMAIN ),
							'reflect_shadow' => __( 'Reflection + Shadow', MYSITE_ADMIN_TEXTDOMAIN ),
							'framed_shadow' => __( 'Framed + Shadow', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select'
					),
					array(
						'name' => __( 'Image URL', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can upload your image that you wish to use here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'upload',
					),
					array(
						'name' => __( 'Align <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Set the alignment for your image here.<br /><br />Your image will float along the center, left or right hand sides depending on your choice.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'align',
						'default' => '',
						'options' => array(
							'left' => __( 'left', MYSITE_ADMIN_TEXTDOMAIN ),
							'right' => __( 'right', MYSITE_ADMIN_TEXTDOMAIN ),
							'center' => __( 'center', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select'
					),
					array(
						'name' => __( 'Alt Attribute <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type the alt text that you would like to display with your image here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'alt',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Title Attribute <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type the title text that you would like to display with your image here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Image Height <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can set the image height here.  Leave this blank if you do not want to resize your image.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'height',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Image Width <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can set the image width here.  Leave this blank if you do not want to resize your image.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'width',
						'default' => '',
						'type' => 'text'
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
	        'style'		  => '',
			'align'		  => '',
			'alt'		  => '',
			'title'		  => '',
			'height'	  => '',
			'width'		  => '',
			'link_to' 	  => 'true',
			'prettyphoto' => 'true'
		), $atts));
		
		global $wp_query, $mysite;
	
		$out = '';
		
		$effect = trim( $style );
		$effect = ( !empty( $effect ) ) ? $effect : 'framed';
		$align = ( $align == 'left' ? ' alignleft' : ( $align == 'right' ? ' alignright' : ( $align == 'center' ? ' aligncenter' : ' alignleft' ) ) );
		$class = ( $effect == 'reflect' ? "reflect{$align}" : ( $effect == 'reflect_shadow' ? 'reflect' : ( $effect == 'framed' ? "framed{$align}" : ( $effect == 'framed_shadow' ? 'framed' : '' ) ) ) );
		
		$width = ( !empty( $width ) ) ? trim(str_replace(' ', '', str_replace('px', '', $width ) ) ) : '';
		$height = ( !empty( $height ) ) ? trim(str_replace(' ', '', str_replace('px', '', $height ) ) ) : '';
		
		if( preg_match( '!https?://.+\.(?:jpe?g|png|gif)!Ui', $content, $matches ) ) {
			
			$out .= mysite_display_image(array(
				'src' 			=> $matches[0],
				'alt' 			=> $alt,
				'title' 		=> $title,
				'class' 		=> $class,
				'height' 		=> $height,
				'width'			=> $width,
				'link_to' 		=> ( $link_to == 'true' ? $matches[0] : false ),
				'prettyphoto'	=> ( $prettyphoto == 'true' ? true : false ),
				'align'			=> $align,
				'effect' 		=> $effect,
				'wp_resize' 	=> ( mysite_get_setting( 'image_resize_type' ) == 'wordpress' ? true : false )
			));
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
			'name' => __( 'Image Frames', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'image_frame',
			'options' => $shortcode
		);

		return $options;
	}

}

?>