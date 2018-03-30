<?php
/**
 * The template for displaying woocommerce pages.
 *
 */

get_header(); ?>

<div class="row content_row">

	<div class="large-9 columns">

		<div id="primary" class="content-area">

			<main id="main" class="site-main" role="main">

				<div class="post_wrap clearfix">

					<?php woocommerce_content(); ?>

				</div><!-- .post_wrap .clearfix -->

			</main><!-- #main -->
			
		</div><!-- #primary -->

	</div><!-- large-9 -->

	<div id="secondary" class="widget-area large-3 columns" role="complementary">
			
		<?php if ( ! dynamic_sidebar( 'shop' ) ) : ?>

			<aside id="search" class="widget">
				<h3 class="widget-title"><?php _e( 'No Widgets Yet', 'heartfelt' ); ?></h3>
				<p>Add widgets to the sidebar in Appearance > Widgets > Forums Sidebar</p>
			</aside>

		<?php endif; // end sidebar widget area ?>

	</div><!-- #secondary -->

</div><!-- .row .content_row -->

<?php get_footer(); ?>
