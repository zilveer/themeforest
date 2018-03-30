<?php
/**
 * The Template for displaying the main videos page
 *
 * Override this template by copying it to yourtheme/wolf-videos/videos-template.php
 *
 * @author WolfThemes
 * @package WolfVideos/Templates
 * @since 1.0.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
get_header( 'videos' );
wolf_page_before(); // before page hook

if ( get_query_var( 'paged' ) ) {

	$paged = get_query_var( 'paged' );

} elseif ( get_query_var( 'page' ) ) {

	$paged = get_query_var( 'page' );
} else {

	$paged = 1;
}

$current_tax = get_query_var( 'video_type' );

$args = array(
	'post_type' => 'video',
	'posts_per_page' => $posts_per_page,
	'video_type' => $current_tax,
	'meta_query' => array(
		array(
			'key' => '_thumbnail_id',
			'compare' => '!=',
			'value' => 'NULL'
		),
	),
);

$loop = new WP_Query( $args );
?>
	<div class="video-search-inner inner wrap">
		<?php get_template_part( 'searchform', 'video' ); ?>
	</div>
	<div class="video-inner inner">
		<?php
			if ( $loop->have_posts() ) :

				echo '<section class="clearfix video-category ' . esc_attr( $current_tax ) . '">';
				//echo '<h2 class="video-tax-title"><a href="' . esc_url( get_term_link( $current_tax ) ) . '">' . $cat->name . '</a></h2>';

			while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<?php
				$post_id = get_the_ID();
				$views = wolf_format_number( absint( get_post_meta( $post_id, '_wolf_views', true ) ) );
				$likes =wolf_format_number( absint( get_post_meta( $post_id, '_wolf_likes', true ) ) );
				$thumb_size = wolf_get_image_size( 'classic-thumb' );
				?>
				<article <?php post_class( 'clearfix' ); ?>   id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>">
					<span class="video-thumbnail">
						<a class="entry-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( $thumb_size ); ?></a>
					</span>
					<span class="video-title">
						<a class="entry-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</span>
					<?php if ( wolf_get_theme_option( 'video_author' ) ) : ?>
						<span class="video-author-name">
							<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'from %s', 'wolf' ), wolf_the_author( false ) ); ?>
							</a>
						</span>
					<?php endif; ?>
					<?php if ( wolf_get_theme_option( 'video_views' ) ) : ?>
						<span class="item-views-count"><?php printf( _n( '1 view', '%s views', $views, 'wolf' ), $views ); ?></span>
					<?php endif; ?>
					<span class="video-date">
						<?php printf( __( '%s ago', 'wolf' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
					</span>
				</article>

			<?php endwhile; ?>
			<?php echo '</section>'; ?>
			<?php endif; wp_reset_postdata(); ?>

	</div>

<?php
wolf_page_after(); // after page hook
get_footer( 'videos' );
?>
