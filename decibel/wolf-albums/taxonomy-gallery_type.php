<?php
/**
 * The Template for displaying the main albums page
 *
 * Override this template by copying it to yourtheme/wolf-albums/albums-template.php
 *
 * @author WolfThemes
 * @package WolfAlbums/Templates
 * @since 1.0.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'albums' );
wolf_page_before(); // before page hook

if ( get_query_var( 'paged' ) ) {

	$paged = get_query_var( 'paged' );

} elseif ( get_query_var( 'page' ) ) {

	$paged = get_query_var( 'page' );
} else {

	$paged = 1;
}

$posts_per_page = ( wolf_get_theme_option( 'gallery_posts_per_page' ) ) ? wolf_get_theme_option( 'gallery_posts_per_page' ) : -1;

$posts_per_page = ( wolf_get_theme_option( 'gallery_infinite_scroll' ) ) ? $posts_per_page : -1;

$current_tax = get_query_var( 'gallery_type' );

$args = array(
	'post_type' => 'gallery',
	'posts_per_page' => $posts_per_page,
	'gallery_type' => $current_tax,
	'meta_query' => array(
		array(
			'key' => '_thumbnail_id',
			'compare' => '!=',
			'value' => 'NULL',
		),
	),
);

if ( wolf_get_theme_option( 'gallery_reorder' ) ) {
	$args['order'] = 'ASC';
	$args['meta_key'] = '_position';
	$args['orderby'] = 'meta_value_num';
}

if ( -1 != $posts_per_page ) {
	$args['paged'] = $paged;
}

/* Albums Post Loop */
$loop = new WP_Query( $args );
?>
	<div class="albums-container">
		<?php if ( $loop->have_posts() ) : ?>

			<?php
				/**
				 * Albums Category Filter
				 */
				wolf_albums_get_template( 'filter.php' );
			?>

			<?php wolf_albums_loop_start(); ?>

				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

					<?php wolf_albums_get_template_part( 'content', 'gallery' ); ?>

				<?php endwhile; ?>

			<?php wolf_albums_loop_end(); ?>
				<?php if ( wolf_get_theme_option( 'gallery_infinite_scroll_trigger' )
					&& wolf_get_theme_option( 'gallery_infinite_scroll' ) ) :
					$max = $loop->max_num_pages;
					if ( 1 < $max ) : ?>
					<div class="trigger-container">
						<span id="gallery-trigger" class="trigger" data-max="<?php echo esc_attr( $max ); ?>">
							<?php next_posts_link( '', $max ); ?>
							<span class="trigger-spinner"></span>
						</span>
					</div>
					<?php endif; ?>
				<?php endif; ?>
			<?php else : ?>

				<?php wolf_albums_get_template( 'loop/no-album-found.php' ); ?>

			<?php endif; // end have_posts() check ?>
	</div><!-- .album-container -->
<?php
if ( ! wolf_get_theme_option( 'gallery_infinite_scroll_trigger' ) ) {
	/**
	 * Pagination
	 */
	if ( wolf_get_theme_option( 'gallery_infinite_scroll' ) ) {
		wolf_paging_nav( $loop );
	}
}
wolf_page_after(); // after page hook
get_footer( 'albums' );
?>