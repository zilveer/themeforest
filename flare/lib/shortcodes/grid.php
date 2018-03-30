<?php	
/**
 * This file is part of the BTP_Flare_Theme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * @package			BTP_Flare_Theme
 * @subpackage		BTP_Shortcodes
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/* Add "Columns" subgroup to the global shortcode generator */
btp_shortgen_add_subgroup( 
	'columns', 
	array( 
		'label' => __( 'Columns', 'btp_theme' ),
	), 
	'general', 
	50
);



/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** one_fourth + three_fourth',
	array(
		'label'			=> __('[one_fourth] + [three_fourth]', 'btp_theme'),
		'result'		=> '[one_fourth]' 
							. "\n\n" 
							. 'some text goes here...' 
							. "\n\n"
							. '[/one_fourth]'
							. "\n\n"  	
							. '[three_fourth_last]'
							. "\n\n"
							. 'some text goes here...'
							. "\n\n"
							. '[/three_fourth_last]',
		'group'			=> 'general',
		'subgroup'		=> 'columns',	
		'position'		=> 100,															
	)			 
);	



/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** 2 equal columns',
	array(
		'label'			=> __('2 equal columns', 'btp_theme'),
		'result'		=> '[one_half]' 
							. "\n\n" 
							. 'some text goes here...' 
							. "\n\n"
							. '[/one_half]'
							. "\n\n" 	
							. '[one_half_last]'
							. "\n\n"
							. 'some text goes here...'
							. "\n\n"
							. '[/one_half_last]',
		'group'			=> 'general',
		'subgroup'		=> 'columns',	
		'position'		=> 110,					
	)			 
);



/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item( 
	'*** 3 equal columns',
	array(
		'label'			=> __('3 equal columns', 'btp_theme'),
		'result'		=> '[one_third]' 
							. "\n\n" 
							. 'some text goes here...' 
							. "\n\n"
							. '[/one_third]'
							. "\n\n"
							. '[one_third]'
							. "\n\n"
							. 'some text goes here...'
							. "\n\n"
							. '[/one_third]'
							. "\n\n" 	
							. '[one_third_last]'
							. "\n\n"
							. 'some text goes here...'
							. "\n\n"
							. '[/one_third_last]',
		'group'			=> 'general',
		'subgroup'		=> 'columns',	
		'position'		=> 120,					
	)			 
);


/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item( 
	'*** 4 equal columns',
	array(
		'label'			=> __('4 equal columns', 'btp_theme'),
		'result'		=> '[one_fourth]' 
							. "\n\n" 
							. 'some text goes here...' 
							. "\n\n"
							. '[/one_fourth]'
							. "\n\n"
							. '[one_fourth]'
							. "\n\n"
							. 'some text goes here...'
							. "\n\n"
							. '[/one_fourth]'
							. "\n\n"
							. '[one_fourth]'
							. "\n\n"
							. 'some text goes here...'
							. "\n\n"
							. '[/one_fourth]'
							. "\n\n"  	
							. '[one_fourth_last]'
							. "\n\n"
							. 'some text goes here...'
							. "\n\n"
							. '[/one_fourth_last]',
		'group'			=> 'general',
		'subgroup'		=> 'columns',	
		'position'		=> 130,							
	)			 
); 



foreach ( array( 
			'one_half', 
			'one_half_last',
			'one_third',
			'one_third_last',
			'two_third',
			'two_third_last',
			'one_fourth',
			'one_fourth_last',
			'three_fourth',
			'three_fourth_last',
			'one_fifth',
			'one_fifth_last',
			'two_fifth',
			'two_fifth_last',
			'three_fifth',
			'three_fifth_last',
			'four_fifth',
			'four_fifth_last',
			'one_sixth',
			'one_sixth_last',
			'five_sixth',
			'five_sixth_last' ) as $i => $s ) {
	btp_shortgen_add_item(
		$s, 
		array(
			'label' 	=> '[' . $s. ']',
			'content' 	=> array( 'view' => 'Text' ),
			'type'		=> 'block',
			'group'		=> 'general',
			'subgroup'	=> 'columns',
			'position'	=> $i,	
		)	
	);
}



/**
 * [*column*] shortcode helper function.
 * 
 * @param			string $x column type
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_column_x($x, $atts, $content = null) {
	/* We need static counters to trace first & last tags of a column shortcode set */
	static $counters = array();
	
	$counter = absint( array_pop( $counters ) );			
	
	extract( shortcode_atts( array(
		'last'	=> false,
		), 
		$atts 
	));
	
	$class = '';
	$class .= sanitize_html_class( 'c-' . $x ) . ' ';
	
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
		
	$out = '';
	
	if( !$counter )
		$out .= '<div class="grid"><div class="' . $class . '">' . do_shortcode(shortcode_unautop($content)) . '</div>';
	 else 	 	
		$out .= '<div class="' . $class . '">' . do_shortcode(shortcode_unautop($content)) . '</div>';
	
	$counter++;		
	array_push( $counters, $counter );
	
	if ( $last ) {
		$out .= '</div>';
		array_pop( $counters );
	}	
		
	return $out;
} 


/**
 * [one_half] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_one_half( $atts, $content = null ) { 
	return btp_shortcode_column_x( 'one-half', $atts, $content ); 
}
add_shortcode( 'one_half', 			'btp_shortcode_one_half' );
add_shortcode( '_one_half', 		'btp_shortcode_one_half' );

/**
 * [one_half_last] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */

function btp_shortcode_one_half_last( $atts, $content = null ) { 
	return btp_shortcode_column_x( 'one-half', array_merge( (array) $atts, array( 'last' => true ) ), $content ); 
}
add_shortcode( 'one_half_last', 	'btp_shortcode_one_half_last' );
add_shortcode( '_one_half_last', 	'btp_shortcode_one_half_last' );
	


/**
 * [one_third] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */

function btp_shortcode_one_third( $atts, $content = null ) {
	return btp_shortcode_column_x( 'one-third', $atts, $content ); 
}
add_shortcode( 'one_third', 		'btp_shortcode_one_third' );
add_shortcode( '_one_third', 		'btp_shortcode_one_third' );



/**
 * [one_third_last] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_one_third_last( $atts, $content = null ) {
	return btp_shortcode_column_x( 'one-third', array_merge( (array) $atts, array( 'last' => true ) ), $content ); 
}
add_shortcode( 'one_third_last',	'btp_shortcode_one_third_last' );		
add_shortcode( '_one_third_last',	'btp_shortcode_one_third_last' );



/**
 * [two_third] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_two_third( $atts, $content = null ) { 
	return btp_shortcode_column_x( 'two-third', $atts, $content ); 
}
add_shortcode( 'two_third', 		'btp_shortcode_two_third' );	
add_shortcode( '_two_third', 		'btp_shortcode_two_third' );

/**
 * [two_third_last] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_two_third_last( $atts, $content = null ) {		
	return btp_shortcode_column_x( 'two-third', array_merge( (array) $atts, array( 'last' => true ) ), $content ); 
}
add_shortcode( 'two_third_last',	'btp_shortcode_two_third_last' );
add_shortcode( '_two_third_last',	'btp_shortcode_two_third_last' );



/**
 * [one_fourth] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_one_fourth( $atts, $content = null ) { 
	return btp_shortcode_column_x( 'one-fourth', $atts, $content ); 
}
add_shortcode( 'one_fourth', 		'btp_shortcode_one_fourth' );	
add_shortcode( '_one_fourth', 		'btp_shortcode_one_fourth' );

/**
 * [one_fourth_last] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_one_fourth_last( $atts, $content = null ) {
	return btp_shortcode_column_x( 'one-fourth', array_merge( (array) $atts, array( 'last' => true ) ), $content ); 
}
add_shortcode( 'one_fourth_last',	'btp_shortcode_one_fourth_last' );
add_shortcode( '_one_fourth_last',	'btp_shortcode_one_fourth_last' );



/**
 * [three_fourth] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_three_fourth( $atts, $content = null ) { 
	return btp_shortcode_column_x( 'three-fourth', $atts, $content ); 
}
add_shortcode( 'three_fourth', 		'btp_shortcode_three_fourth' );	
add_shortcode( '_three_fourth', 		'btp_shortcode_three_fourth' );

/**
 * [three_fourth_last] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_three_fourth_last( $atts, $content = null ) { 
	return btp_shortcode_column_x( 'three-fourth', array_merge( (array) $atts, array( 'last' => true ) ), $content );
}
add_shortcode( 'three_fourth_last',	'btp_shortcode_three_fourth_last' );	
add_shortcode( '_three_fourth_last',	'btp_shortcode_three_fourth_last' );



/**
 * [one_fifth] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_one_fifth( $atts, $content = null ) { 
	return btp_shortcode_column_x( 'one-fifth', $atts, $content ); 
}
add_shortcode( 'one_fifth', 		'btp_shortcode_one_fifth' );
add_shortcode( '_one_fifth', 		'btp_shortcode_one_fifth' );

/**
 * [one_fifth_last] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_one_fifth_last($atts, $content = null) { 
	return btp_shortcode_column_x( 'one-fifth', array_merge( (array) $atts, array( 'last' => true ) ), $content ); 
}
add_shortcode( 'one_fifth_last', 	'btp_shortcode_one_fifth_last' );
add_shortcode( '_one_fifth_last', 	'btp_shortcode_one_fifth_last' );
	


/**
 * [two_fifth] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_two_fifth( $atts, $content = null ) { 
	return btp_shortcode_column_x( 'two-fifth', $atts, $content ); 
}
add_shortcode( 'two_fifth', 		'btp_shortcode_two_fifth' );
add_shortcode( '_two_fifth', 		'btp_shortcode_two_fifth' );

/**
 * [two_fifth_last] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_two_fifth_last( $atts, $content = null ) { 
	return btp_shortcode_column_x( 'two-fifth', array_merge( (array) $atts, array( 'last' => true ) ), $content ); 
}
add_shortcode( 'two_fifth_last', 	'btp_shortcode_two_fifth_last' );	
add_shortcode( '_two_fifth_last', 	'btp_shortcode_two_fifth_last' );



/**
 * [three_fifth] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_three_fifth( $atts, $content = null ) { 
	return btp_shortcode_column_x( 'three-fifth', $atts, $content ); 
}
add_shortcode( 'three_fifth', 		'btp_shortcode_three_fifth' );
add_shortcode( '_three_fifth', 		'btp_shortcode_three_fifth' );

/**
 * [three_fifth_last] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_three_fifth_last($atts, $content = null) { 
	return btp_shortcode_column_x( 'three-fifth', array_merge( (array) $atts, array( 'last' => true ) ), $content ); 
}
add_shortcode( 'three_fifth_last', 	'btp_shortcode_three_fifth_last' );
add_shortcode( '_three_fifth_last', 	'btp_shortcode_three_fifth_last' );



/**
 * [four_fifth] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_four_fifth( $atts, $content = null ) { 
	return btp_shortcode_column_x( 'four-fifth', $atts, $content ); 
}
add_shortcode( 'four_fifth', 		'btp_shortcode_four_fifth' );
add_shortcode( '_four_fifth', 		'btp_shortcode_four_fifth' );

/**
 * [four_fifth_last] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_four_fifth_last( $atts, $content = null ) {
	return btp_shortcode_column_x( 'four-fifth', array_merge( (array) $atts, array( 'last' => true ) ), $content ); 
}
add_shortcode( 'four_fifth_last', 	'btp_shortcode_four_fifth_last' );
add_shortcode( '_four_fifth_last', 	'btp_shortcode_four_fifth_last' );



/**
 * [one_sixth] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_one_sixth( $atts, $content = null ) { 
	return btp_shortcode_column_x( 'one-sixth', $atts, $content ); 
}
add_shortcode( 'one_sixth',			'btp_shortcode_one_sixth' );	
add_shortcode( '_one_sixth',			'btp_shortcode_one_sixth' );	

/**
 * [one_sixth_last] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_one_sixth_last( $atts, $content = null ) { 
	return btp_shortcode_column_x( 'one-sixth', array_merge( (array) $atts, array( 'last' => true ) ), $content ); 
}
add_shortcode( 'one_sixth_last', 	'btp_shortcode_one_sixth_last' );
add_shortcode( '_one_sixth_last', 	'btp_shortcode_one_sixth_last' );



/**
 * [five_sixth] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_five_sixth( $atts, $content = null ) { 
	return btp_shortcode_column_x( 'five-sixth', $atts, $content ); 
}
add_shortcode( 'five_sixth', 		'btp_shortcode_five_sixth' );
add_shortcode( '_five_sixth', 		'btp_shortcode_five_sixth' );

/**
 * [five_sixth_last] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_five_sixth_last( $atts, $content = null ) { 
	return btp_shortcode_column_x( 'five-sixth', array_merge( (array) $atts, array( 'last' => true ) ), $content ); 
}
add_shortcode( 'five_sixth_last', 	'btp_shortcode_five_sixth_last' );
add_shortcode( '_five_sixth_last', 	'btp_shortcode_five_sixth_last' );
?>