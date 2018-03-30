<?php
/**
 * This file is part of the BTP_Flare_Theme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/**
 * Custom action for displaying the Precontent Theme Area
 */
function btp_precontent() {	
	$out = '';
	
	$precontent = btp_precontent_capture();

	ob_start();
	do_action( 'btp_precontent' );
	$out .= ob_get_clean();
	
	$out .= !empty( $precontent ) ? $precontent : '';
	
	$out = trim( $out );
		
	echo $out;
} 

/**
 * Captures the precontent from the first [precontent] shortcode used in the entry content.
 */
function btp_precontent_capture() {
    $content = '';

    if( is_singular() ) {
        $content = get_the_content();
    } else {
        $post_id = (int) get_option( 'page_home_page' );
        if ( $post_id ) {
            $content = get_post( $post_id );
            $content = $content->post_content;
        }
    }

    // Get the precontent between shortcode delimiters
    $precontent = '';
    $start 	= strpos($content, '[precontent]');
    $end 	= strpos($content, '[/precontent]');
    if ( false !== $start && false !== $end ) {
        $start += strlen('[precontent]');

        $precontent = substr( $content , $start, $end - $start );
    }

    // workaround protects the precontent against modifications added via wp_content hook
    $precontent = '###BTP_START###' . $precontent . '###BTP_END###';

    // protects the precontent against content added via 'echo'
    ob_start();
    // buddyPress workaround
    $bpLoaded = function_exists('bp_replace_the_content');

    if ($bpLoaded) remove_filter( 'the_content', 'bp_replace_the_content' );

    $precontent = apply_filters('the_content', $precontent);

    if ($bpLoaded) add_filter( 'the_content', 'bp_replace_the_content' );

    ob_end_clean();

    $precontent = str_replace(']]>', ']]&gt;', $precontent);

    $start 	= strpos($precontent, '###BTP_START###');
    $end 	= strpos($precontent, '###BTP_END###');
    if ( false !== $start && false !== $end ) {
        $start += strlen('###BTP_START###');

        $precontent = substr( $precontent , $start, $end - $start );
    }

    $precontent = preg_replace('#^<\/p>|<p>$#', '', $precontent);

    return $precontent;
}

function btp_precontent_render() {
	echo btp_precontent_capture();
}



/* Add [precontent] shortcode to the global shortcode generator */
btp_shortgen_add_item(
	'precontent', 
	array(
		'label' 	=> '[precontent]',
		'content' 	=> array( 'view' => 'Text' ),
		'type'		=> 'block',	
		'group'		=> 'general',
		'subgroup'	=> 'basic',
		'position'	=> 1750,
	)	
);



/**
 * [precontent] shortcode callback function.
 * 
 * This is a fake shortcode - it returns an empty string. 
 * Check the btp_precontent_capture function for the real solution.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_precontent( $atts, $content = null ) {	
	return '';
}
add_shortcode( 'precontent', 'btp_shortcode_precontent' );
?>