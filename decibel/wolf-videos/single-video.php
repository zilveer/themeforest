<?php
/**
 * The single video youtube style view
 */
get_header();
wolf_page_before(); // before page hook

if ( 'youtube' == wolf_get_theme_option( 'video_type' ) || 'youtube-all' == wolf_get_theme_option( 'video_type' ) ) :
?>
<div class="inner clearfix">
	<div id="primary" class="content-area">
		<main id="content" class="site-content clearfix" role="main">

			<?php while ( have_posts() ) : the_post();

				wolf_videos_get_template_part( 'single', 'youtube-content' );

			endwhile; ?>


		</main><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar( 'video' ); ?>
</div>
<?php else : ?>
	<div id="primary" class="content-area">
		<main id="content" class="site-content clearfix" role="main">
			<?php wolf_videos_get_template_part( 'single', 'grid' ); ?>
		</main><!-- #content -->
	</div><!-- #primary -->
<?php endif; ?>
<?php
wolf_page_after(); // after page hook
get_footer();
?>