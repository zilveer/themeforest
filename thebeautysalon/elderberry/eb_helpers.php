<?php
/** Elderberry Helper Functions
  *
  * A collection of function to help with the defaults management
  * and other bits and pieces.
  *
  * @package Elderberry
  *
  **/

/** Get Control Item
  *
  * Retrieves a control item. It can also modify
  * the default value through the second parameter.
  *
  * @param string $type The type of control to get
  * @param string $default The default value for the item
  *
  * @return array $item The array containing information about the control item
  *
  **/
function eb_get_control_item( $args = array()  ) {
	extract( $args );

	global $eb_fields;
	$item = $eb_fields[$item];

	if( !empty( $default ) ) {
		$item['control']['default'] = $default;
	}

	if( !empty( $label_below ) ) {
		$item['control']['label_below'] = $label_below;
	}


	return $item;
}




function eb_get_default_option( $setting, $page_type = '' ) {
	global $eb_options;

	$option = '';

	if( !empty( $eb_options[$setting] ) ) {
		$option = $eb_options[$setting];
	}

	if( !empty( $eb_options[$page_type . '_settings'][$setting] ) ) {
		$option = ( $eb_options[$page_type . '_settings'][$setting] == 'default' ) ? $option : $eb_options[$page_type . '_settings'][$setting];
	}



	return $option;

}


function eb_get_layout_title( $type, $layout ) {

	$file = get_template_directory() . '/layouts/' . $type . '/' . $layout . '.php';
	if( file_exists( $file ) )  {
	$handle = @fopen( $file, 'r' );
	if( $handle ) {
		for($i=0; $i<4; $i++ ) {
			$lines[$i] = fgets( $handle );
		}

		$layout = array(
			'id' => $layout,
			'name' => str_replace( '/**', '', trim( $lines[1] ) ),
			'description' => trim( $lines[2] )
		);

		fclose( $handle );
		return $layout['name'];
	}
}
}


function eb_get_default_layout( $type = 'post' ) {
	global $eb_options;
	return @eb_get_layout_title( $type, $eb_options[ $type . '_layout' ] );
}

function eb_pages_dropdown( $exclude_template = array(), $include_template = array() ) {
	$args = array(
		'post_type' => 'page',
		'post_status' => 'publish',
	);

	if( !empty( $exclude_template ) ) {
		$args['meta_query'] = array(
	        array(
	            'key' => '_wp_page_template',
	            'value' => $exclude_template,
	            'compare' => 'NOT IN',
	        )
	    );
	}

	if( !empty( $include_template ) ) {
		$args['meta_query'] = array(
	        array(
	            'key' => '_wp_page_template',
	            'value' => $include_template,
	            'compare' => 'IN',
	        )
	    );
	}
	$pages = new WP_Query( $args );
	$options = array();
	if( $pages->have_posts() ) {
		while( $pages->have_posts() ) {
			$pages->the_post();
			$options[the_title('', '', false )] = get_the_ID();
		}
	}
	return $options;
}






?>
