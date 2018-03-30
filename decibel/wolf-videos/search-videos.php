<?php
get_header();
wolf_page_before(); // before page hook
?>
<?php if ( have_posts() && wolf_get_video_results_count() ) : ?>
	<div class="wrap">
		<p><?php printf( _n( '1 result found.', '%d results found.', wolf_get_video_results_count(), 'wolf' ), wolf_get_video_results_count() ); ?></p>
	</div>
<?php endif; ?>
<div class="video-search-inner inner wrap">
	<?php get_template_part( 'searchform', 'video' ); ?>
</div>
<?php if ( have_posts() ) : ?>
	<div class="video-inner inner wrap">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php if ( function_exists( 'wolf_videos_get_template_part' ) ) wolf_videos_get_template_part( 'content', 'video-search' ); ?>
		<?php endwhile; ?>
	</div>
	<div class="wrap"><?php wolf_pagination(); ?></div>
<?php else : ?>
	<p class="text-center"><?php _e( 'No video found.', 'wolf' ); ?></p>
<?php endif; ?>
<?php
wolf_page_after(); // after page hook
get_footer();
?>