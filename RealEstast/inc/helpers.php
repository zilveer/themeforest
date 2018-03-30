<?php

if ( ! function_exists( 'is_acf_enable' ) ) {
	function is_acf_enable() {
		return in_array( 'advanced-custom-fields/acf.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
	}
}

if ( ! function_exists( 'PGL_pagination' ) ) {
	function PGL_pagination( $args = array(), $the_query = NULL ) {

        $big = 999999999; // need an unlikely integer
		if ( is_null( $the_query) ) {
			global $wp_query;
		} else {
			$wp_query = $the_query;
		}
		global $wp_rewrite;
		$total_pages = $wp_query->max_num_pages;
		if ( $total_pages > 1 ) {
			$default_array = array(
                'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $total_pages,
                'prev_text' => 'Prev',
                'next_text' => 'Next',
                'type' => 'array',
			);
			$args = wp_parse_args( $args, $default_array );
			return paginate_links( $args );
		}
		else {
			return FALSE;
		}
	}
}