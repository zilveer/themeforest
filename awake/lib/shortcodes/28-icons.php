<?php
/**
 *
 */
class mysiteIcons {

	/**
	 *
	 */
	function icon( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Single Icon', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'icon',
				'options' => array(
					array(
						'name' => __( 'Select Preset Icon', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select one of our icon presets to use.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'type',
						'default' => '',
						'shortcode' => 'icon',
						'type' => 'icon_preset',
					),
					array(
						'id' => 'style',
						'default' => '',
						'type' => 'hidden',
					),
					array(
						'name' => __( 'Upload Custom Icon', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Upload your own icon to use.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'custom_icon',
						'default' => '',
						'type' => 'upload',
					),
					array(
						'name' => __( 'Alignment', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose an alignment for your icon.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'align',
						'default' => '',
						'options' => array(
							'left' => __('Left', MYSITE_ADMIN_TEXTDOMAIN ),
							'right' => __('Right', MYSITE_ADMIN_TEXTDOMAIN ),
							'center' => __('Center', MYSITE_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
		
		extract(shortcode_atts(array(
			'type' 	=> '',
			'style'	=> '',
			'custom_icon' 	=> '',
			'align' => '',
		), $atts));
		
		if ($align == "left") { $align = " alignleft"; }
		if ($align == "right") { $align = " alignright"; }
		if ($align == "center") { $align = " aligncenter"; }
		
		$src = THEME_IMAGES . '/icons/' . $style .'/'. $type . '.png';
		if (!empty($custom_icon)) { $src = $custom_icon; }
		
		$out = '<span class = "icon'.$align.'"><img src = "'.$src.'" alt = "" /></span>';
		
		return $out;
	}
	
	/**
	 *
	 */
	function icon_teaser( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {

			$option = array( 
				'name' => __( 'Icon Teasers', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'icon_teaser',
				'options' => array(
					array(
						'name' => __( 'Select Preset Icon', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select one of our icon presets to use.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'type',
						'default' => '',
						'shortcode' => 'icon_teaser',
						'type' => 'icon_preset',
					),
					array(
						'id' => 'style',
						'default' => '',
						'type' => 'hidden',
					),
					array(
						'name' => __( 'Upload Custom Icon', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Upload your own icon to use.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'custom_icon',
						'default' => '',
						'type' => 'upload',
					),
					array(
						'name' => __( 'Title', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out a title to display alongside your icon.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Teaser', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Upload your own icon to use.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Link Text', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'If you want a link to display beneath your teaser then type some text here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'link_text',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Link Url', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the URL for your link.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'link',
						'default' => '',
						'type' => 'text',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
		
		extract(shortcode_atts(array(
			'type' 	=> '',
			'style'	=> '',
			'custom_icon' 	=> '',
			'title' => '',
			'link_text' => '',
			'link' => '',
		), $atts));
		
		$out = '';
		
		$src = THEME_IMAGES . '/icons/' . $style .'/'. $type . '.png';
		if (!empty($custom_icon)) { $src = $custom_icon; }
		
		$out .= '<div class = "icon_teaser">';
		$out .= '<span class = "icon"><img src = "'.$src.'" alt = ""></span>';
			$out .= '<div class = "icon_text">';
				if (!empty($title)) { $out .= '<h3>'.$title.'</h3>'; }
				if (!empty($content)) { $out .= '<p>'.$content.'</p>'; }
				if (!empty($link)) { $out .= '<p><a class = "icon_teaser_link" href = "'.$link.'">'.$link_text.'</a></p>'; }
			$out .= '</div>';
		$out .= '</div>';
		
		return $out;
	}
	
	/**
	 *
	 */
	function icon_banner( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {

			$option = array( 
				'name' => __( 'Icon Banners', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'icon_banner',
				'options' => array(
					array(
						'name' => __( 'Select Preset Icon', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select one of our icon presets to use.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'type',
						'default' => '',
						'shortcode' => 'icon_banner',
						'type' => 'icon_preset',
					),
					array(
						'id' => 'style',
						'default' => '',
						'type' => 'hidden',
					),
					array(
						'name' => __( 'Upload Custom Icon', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Upload your own icon to use.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'custom_icon',
						'default' => '',
						'type' => 'upload',
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
		
		extract(shortcode_atts(array(
			'type' 	=> '',
			'style'	=> '',
			'custom_icon' 	=> '',
		), $atts));
		
		$src = THEME_IMAGES . '/icons/_banners/'. $type . '.png';
		if (!empty($custom_icon)) { $src = $custom_icon; }
		
		return '<span class = "icon_banner"><span class = "icon"><img src = "'.$src.'" alt = ""></span></span>';
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
			'name' => __( 'Icons', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Select which Icon type you would like to use.', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'icons',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>