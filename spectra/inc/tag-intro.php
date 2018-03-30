<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			tag-intro.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */

global $spectra_opts, $wp_query, $post;
$subtitle = '';
$title = '';


// Categories
if ( is_category() ) {
	$subtitle = __( 'Results for category:', SPECTRA_THEME );
	$title = single_cat_title( '', false );
}
// Tags
elseif ( is_author() ) {
	$subtitle = __( 'Results for author:', SPECTRA_THEME );
	$title = get_the_author();
}
// Tags
elseif ( is_tag() ) {
	$subtitle = __( 'Results for tag:', SPECTRA_THEME );
	$title = single_tag_title( '', false );
}
// Portfolio categories
elseif ( is_tax( 'spectra_portfolio_cats' ) ) {
	$subtitle = __( 'Results for portfolio category:', SPECTRA_THEME );
	$title = single_cat_title('', false);
}
// Events categories
elseif ( is_tax( 'spectra_event_categories' ) ) {
	$subtitle = __( 'Results for event category:', SPECTRA_THEME );
	$title = single_cat_title( '', false );
}
// Archive
elseif (is_archive()) {
	$subtitle = __( 'Archives results for:', SPECTRA_THEME );
	if ( is_year() ) {
		$title = get_the_time( 'Y' );
	}
	if ( is_month() ) { 
		$title = get_the_time( 'F, Y' );
	}
	if ( is_day() || is_time() ) {
		$title  = get_the_time( 'l - ' . $spectra_opts->get_option( 'custom_date' ) );
	}
}
// Search
elseif ( is_search() ) {
	$subtitle = __( 'Search results for:', SPECTRA_THEME );
	$title = get_search_query();
}

?>	
<section class="intro-custom-content intro tag-intro clearfix">
	<div class="container">
		<span class="sub-heading text-center"><?php echo esc_html( $subtitle ); ?></span>
		<h1 class="content-title text-center"><?php echo esc_html( $title ); ?></h1>    
	</div>
</section>