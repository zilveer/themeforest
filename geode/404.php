<?php
/**
 * @package WordPress
 * @subpackage Geode
 * @since Geode 1.0
*/

get_header(); ?>

<?php get_template_part( 'title', '' ); ?>
<div class="site-content cf site-main side-template archive-list">
	<div id="primary" class="alignleft" data-delay="0">
		<div id="content" role="main">
			<div class="row">
				<div class="row-inside">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'geode' ); ?></p>
				</div><!-- .row-inside -->
			</div><!-- .row -->
		</div><!-- #content -->
	</div><!-- #primary -->

<?php geode_sidebar('right'); ?>
</div><!-- .site-content -->

<?php get_footer(); ?>