<?php
/**
 * The template for displaying pagination for any query.
 *
 * @package Listify
 */

global $wp_query;

if ( $wp_query->max_num_pages == 1 ) {
	return;
}

$big = 999999999;
?>

<div class="content-pagination">
	<?php
		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total' => $wp_query->max_num_pages
		) );
	?>
</div>