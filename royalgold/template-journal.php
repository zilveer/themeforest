<?php
/**
 *	Template Name: Journal Template
 *
 *	The template for displaying blog posts, archive elements and search results
 */

get_header();
?>

	<section id="main">
		<div class="wrapper">
			<h2><?php if (is_category()) printf( __( '&#8216;%s&#8217; Category', 'royalgold' ), single_cat_title( '', FALSE ) ); elseif( is_tag() ) printf( __( 'Posts tagged &#8216;%s&#8217;', 'royalgold' ), single_tag_title( '', FALSE ) ); elseif( is_day() ) printf( __( 'Archive for %s', 'royalgold' ), get_the_time('F jS, Y') ); elseif( is_month() ) printf( __( 'Archive for %s', 'royalgold' ), get_the_time('F, Y') ); elseif( is_year() ) printf( __( 'Archive for %s', 'royalgold' ), get_the_time('Y') ); elseif( is_author() ) _e( 'Author Archive', 'royalgold' ); elseif (is_search()) printf( __( 'Search results for &#8216;%s&#8217;', 'royalgold' ), esc_attr( get_search_query() ) ); elseif (strpos($_SERVER['REQUEST_URI'],'?s=') !== false) _e( 'Search through the website', 'royalgold' ); else the_title(); ?></h2>
			<div class="sep"><span></span></div>
<?php 
if (is_page()) {
	$page_no = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'paged' => $page_no
	);

	$journal_category = rwmb_meta('base_category');
	if ( ! empty($journal_category) && $journal_category != 0 ) {
		$args['cat'] = $journal_category;
	}
	query_posts($args);
}
get_template_part('part-loop'); ?>

		</div>
	</section>

<?php
wp_reset_query();
get_footer();
?>