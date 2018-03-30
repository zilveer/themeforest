<?php
/**
 *
 */
class mysiteMiscellaneous {

	/**
	 *
	 */
	function fancy_amp( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Fancy Amp', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'fancy_amp'
			);

			return $option;
		}
		
		return '<span class="fancy_amp">&amp;</span>';
	}

	/**
	 *
	 */
	function divider( $atts = null, $content = null, $code = null ) {
		
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Divider', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'divider'
			);

			return $option;
		}
			
		return '<div class="divider"></div>';
	}
	
	/**
	 *
	 */
	function divider_top( $atts = null, $content = null, $code = null ) {
		
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Divider Top', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'divider_top'
			);

			return $option;
		}
			
		return '<div class="divider top"><a href="#">' . __( 'Top', MYSITE_TEXTDOMAIN ) . '</a></div>';
	}
	
	/**
	 *
	 */
	function clearboth( $atts = null, $content = null, $code = null ) {
		
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'Clearboth', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'clearboth'
			);

			return $option;
		}
			
		return '<div class="clearboth"></div>';
	}
	
	/**
	 *
	 */
	function div( $atts = null, $content = null, $code = null ) {
		$option = array( 
			'name' => __( 'Div', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'div',
			'options' => array(
				array(
					'name' => __( 'Class', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Type in the name of the class you wish to assign to this div.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'class',
					'default' => '',
					'type' => 'text'
				),
				array(
					'name' => __( 'Style', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'You can set a custom style here for your div.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'style',
					'default' => '',
					'type' => 'text'
				),
				array(
					'name' => __( 'Content', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Type in the content that you wish to display inside this div.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'content',
					'default' => '',
					'type' => 'textarea'
				),
			'shortcode_has_atts' => true,
			)
		);
		
		if( $atts == 'generator' )
			return $option;
			
		extract(shortcode_atts(array(
			'style'      => '',
			'class'      => '',
	    	), $atts));

	   return '<div class="' . $class . '" style="' . $style . '">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function span( $atts = null, $content = null, $code = null ) {
		$option = array( 
			'name' => __( 'Span', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'span'
		);
		
		if( $atts == 'generator' )
			return $option;
			
		extract(shortcode_atts(array(
			'style'      => '',
			'class'      => '',
	    	), $atts));

	   return '<span class="' . $class . '" style="' . $style . '">' . mysite_remove_wpautop( $content ) . '</span>';
	}
	
	/**
	 *
	 */
	function teaser( $atts = null, $content = null ) {

		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Teaser', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'teaser'
			);

			return $option;
		}

		return '<p class="teaser"><span>' . mysite_remove_wpautop( $content ) . '</span></p>';
	}
	
	/**
	 *
	 */
	function hidden( $atts = null, $content = null ) {

		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Hidden', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'hidden'
			);

			return $option;
		}

		return '<div class="hidden">' . mysite_remove_wpautop( $content ) . '</div>';
	}

	/**
	 *
	 */
	function margin10( $atts = null, $content = null ) {
			
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'margin10', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'margin10'
			);

			return $option;
		}
			
		return '<div class="margin10">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function margin20( $atts = null, $content = null ) {

		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'margin20', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'margin20'
			);

			return $option;
		}
			
		return '<div class="margin20">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function margin30( $atts = null, $content = null ) {
			
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'margin30', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'margin30'
			);

			return $option;
		}
			
		return '<div class="margin30">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function margin40( $atts = null, $content = null ) {
			
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'margin40', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'margin40'
			);

			return $option;
		}
			
		return '<div class="margin40">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function margin50( $atts = null, $content = null ) {
			
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'margin50', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'margin50'
			);

			return $option;
		}
		
		return '<div class="margin50">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function margin60( $atts = null, $content = null ) {

		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'margin60', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'margin60'
			);

			return $option;
		}
			
		return '<div class="margin60">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function margin70( $atts = null, $content = null ) {
			
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'margin70', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'margin70'
			);

			return $option;
		}
			
		return '<div class="margin70">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function margin80( $atts = null, $content = null ) {
			
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'margin80', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'margin80'
			);

			return $option;
		}
			
		return '<div class="margin80">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function margin90( $atts = null, $content = null ) {
			
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'margin90', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'margin90'
			);

			return $option;
		}
		
		return '<div class="margin90">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function mobile_only( $atts = null, $content = null ) {
		
		$option = array( 
			'name' => __( 'Mobile Only', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'mobile_only',
			'options' => array(
				array(
					'name' => __( 'Content', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Type in the content that you wish to display on a mobile device only.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'content',
					'default' => '',
					'type' => 'textarea'
				),
			'shortcode_has_atts' => true,
			)
		);
		
		if( $atts == 'generator' )
			return $option;
			
		extract(shortcode_atts(array(
		), $atts));

		global $mysite;

		if( !isset( $mysite->mobile ) )
			$content = '';

		return $content;
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
			'name' => __( 'Miscellaneous', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Select which Miscellaneous shortcode you wish to use.', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'miscellaneous',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>