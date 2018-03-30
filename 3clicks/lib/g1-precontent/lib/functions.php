<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Precontent_Module
 * @since G1_Precontent_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php


/**
 * Strip the precontent shortcode from the content
 *
 * @param 			string $content
 */
function g1_precontent_strip_shortcode( $content ){
    $multibyte_supported = function_exists('mb_strpos');

    if ($multibyte_supported) {
        $start 	= mb_strpos($content, '[precontent]');
        $end 	= mb_strpos($content, '[/precontent]');

        if ( false !== $start && false !== $end ) {
            $content = mb_substr($content, 0, $start).mb_substr($content, $end + strlen('[/precontent]'));
        }
    } else {
        $start 	= strpos($content, '[precontent]');
        $end 	= strpos($content, '[/precontent]');

        if ( false !== $start && false !== $end ) {
            $content = substr_replace ( $content , '', $start, $end + strlen('[/precontent]') - $start );
        }
    }

    return $content;
}

add_filter( 'the_content', 'g1_precontent_strip_shortcode', 5 );



/**
 * Captures the precontent from the first [precontent] shortcode used in the entry content.
 */
function g1_precontent_capture() {
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
    $precontent = '###G1_START###' . $precontent . '###G1_END###';

    // protects the precontent against content added via 'echo'
    ob_start();
        // buddyPress workaround
        $bpLoaded = function_exists('bp_replace_the_content');

        if ($bpLoaded) remove_filter( 'the_content', 'bp_replace_the_content' );

        $precontent = apply_filters('the_content', $precontent);

        if ($bpLoaded) add_filter( 'the_content', 'bp_replace_the_content' );

    ob_end_clean();

    $precontent = str_replace(']]>', ']]&gt;', $precontent);

    $start 	= strpos($precontent, '###G1_START###');
    $end 	= strpos($precontent, '###G1_END###');
    if ( false !== $start && false !== $end ) {
        $start += strlen('###G1_START###');

        $precontent = substr( $precontent , $start, $end - $start );
    } else {
        $precontent = '';
    }

    $precontent = preg_replace('#^<\/p>|<p>$#', '', $precontent);

    if ( strlen( $precontent ) ) {
        $precontent =
            '<div id="g1-precontent-shortcode" class="g1-layout-inner">' .
                $precontent .
            '</div>';
    }

	return $precontent;
}
function g1_precontent_render() {
    $out = '';

    if ( is_singular() ) {
        while ( have_posts() ) {
            the_post();
            $out .= trim( g1_precontent_capture() );
        }
    }

    echo $out;
}
add_action( 'g1_precontent', 'g1_precontent_render' );