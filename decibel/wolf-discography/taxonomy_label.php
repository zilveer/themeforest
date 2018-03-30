<?php
/**
 * The Template for displaying the main discography page
 *
 * Override this template by copying it to yourtheme/wolf-discography/discography-template.php
 *
 * @author WolfThemes
 * @package WolfDiscography/Templates
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'discography' );
wolf_page_before(); // before page hook


if ( get_query_var( 'paged' ) ) {

	$paged = get_query_var( 'paged' );

} elseif ( get_query_var( 'page' ) ) {

	$paged = get_query_var( 'page' );

} else {

	$paged = 1;
}

$posts_per_page = ( wolf_get_theme_option( 'release_posts_per_page' ) ) ? wolf_get_theme_option( 'release_posts_per_page' ) : -1;

$current_tax = get_query_var( 'label' );

$args = array(
	'post_type' => 'release',
	'posts_per_page' => $posts_per_page,
	'label' => $current_tax,
	'meta_query' => array(
		array(
			'key' => '_thumbnail_id',
			'compare' => '!=',
			'value' => 'NULL'
		),
	),
);

/*if ( wolf_get_theme_option( 'release_reorder' ) ) {
	$args['order'] = 'ASC';
	$args['meta_key'] = '_position';
	$args['orderby'] = 'meta_value_num';
}*/

if ( -1 != $posts_per_page ) {
	$args['paged'] = $paged;
}

/* Release Post Loop */
$loop = new WP_Query( $args );

	if ( $loop->have_posts() ) : ?>

		<?php wolf_discography_loop_start(); ?>

			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

				<?php wolf_discography_get_template_part( 'content', 'release' ); ?>

			<?php endwhile; ?>

		<?php wolf_discography_loop_end(); ?>

		<?php else : ?>

			<?php wolf_discography_get_template( 'loop/no-releases-found.php' ); ?>

		<?php endif; ?>
<?php
/**
 * Pagination
 */
wolf_pagination( $loop );

wolf_page_after(); // before page hook
get_footer( 'discography' );
