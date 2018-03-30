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

$posts_per_page = ( wolf_get_theme_option( 'video_posts_per_page' ) ) ? wolf_get_theme_option( 'video_posts_per_page' ) : -1;
?>
	<div class="video-search-inner inner wrap">
		<?php get_template_part( 'searchform', 'video' ); ?>
	</div>
	<div class="video-inner inner">
		<section class="video-category clearfix">
		<?php

			$args = array(
				'post_type' => 'video',
				'posts_per_page' => $posts_per_page,
				'paged' => $paged,
				'meta_query' => array(
					array(
						'key' => '_thumbnail_id',
						'compare' => '!=',
						'value' => 'NULL'
					),
				),
			);

			$loop = new WP_Query( $args );

			if ( $loop->have_posts() ) :

			while ( $loop->have_posts() ) : $loop->the_post(); ?>

			<?php wolf_videos_get_template_part( 'content', 'video-youtube-all' ); ?>

			<?php endwhile; ?>

		</section>
	</div>

	<?php wolf_pagination( $loop ); ?>

	<?php endif; wp_reset_postdata(); ?>

<?php
wolf_page_after(); // after page hook
get_footer( 'videos' );
?>