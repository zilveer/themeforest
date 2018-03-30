<?php
/**
 * Sets new excerpt length.
 * 
 * @param integer Old excerpt length.
 * @return integer New excerpt length.
 */
function flow_new_excerpt_length( $length ) {
	return 80;
}
add_filter( 'excerpt_length', 'flow_new_excerpt_length' );

/**
 * Sets new excerpt ending.
 * 
 * @param string Old excerpt ellipsis.
 * @return string New excerpt ellipsis.
 */
function flow_new_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'flow_new_excerpt_more' );
