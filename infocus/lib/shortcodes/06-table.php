<?php
/**
 *
 */
class mysiteTable {
	
	/**
	 *
	 */
	function fancy_table( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Fancy Table', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'fancy_table',
				'options' => array(
					'name' => __( 'Table Html', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Type out the content of your table.  You need to use the HTML table tags when typing out your content.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'content',
					'default' => '',
					'type' => 'textarea'
				),
				'shortcode_carriage_return' => true
			);
			
			return $option;
		}
			
		return str_replace( '<table>', '<table class="fancy_table">', mysite_remove_wpautop( $content ) );
	}
	
	/**
	 *
	 */
	function minimal_table( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Minimal Table', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'minimal_table',
				'options' => array(
					'name' => __( 'Table Html', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Type out the content of your table.  You need to use the HTML table tags when typing out your content.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'content',
					'default' => '',
					'type' => 'textarea'
				),
				'shortcode_carriage_return' => true
			);
			
			return $option;
		}
		
		return str_replace( '<table>', '<table class="minimal_table">', mysite_remove_wpautop( $content ) );
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
			'name' => __( 'Fancy Tables', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose the style of table you wish to use.', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'table',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>