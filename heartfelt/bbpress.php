<?php
/**
 * Template used to display bbpress forums
 *
 */
get_header(); ?>

<div class="forum_wrap">

	<div class="blog_header_wrap">

		<div class="row">
			<div class="large-12 columns ">

				<div class="blog_header_content">

					<h1 class="breadcrumb_wrap">
						<a class="bbp-forum-title" href="<?php bbp_forum_permalink(); ?>">
							<?php if ( bbp_is_forum_archive() ) { 

								$forum_title = get_theme_mod( 'forum_title', customizer_library_get_default( 'forum_title' ) ); 

									echo esc_attr( $forum_title ); 

								} else { 
									
									single_post_title(); 
							}?>
						</a>
					</h1>

					<span class="breadcrumb_wrap"><?php bbp_breadcrumb(); ?></span>

				</div><!-- .blog_header_content -->

			</div><!-- .large-12 -->
		</div><!-- .row -->

	</div><!-- .blog_header_wrap -->

	<div class="row content_row">

		<div class="large-9 columns">

			<div id="primary" class="content-area">

				<main id="main" class="site-main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/content', 'forum' ); ?>

					<?php endwhile; // end of the loop. ?>

				</main><!-- #main -->
				
			</div><!-- #primary -->

		</div><!-- large-9 -->

		<div id="secondary" class="large-3 columns widget-area" role="complementary">
				
			<?php if ( ! dynamic_sidebar( 'forums' ) ) : ?>

				<aside id="search" class="widget">
					<h3 class="widget-title"><?php _e( 'No Widgets Yet', 'heartfelt' ); ?></h3>
					<p>Add widgets to the sidebar in Appearance > Widgets > Forums Sidebar</p>
				</aside>

			<?php endif; // end sidebar widget area ?>

		</div><!-- .large-3 .widget-area -->
		
	</div><!-- .row .content_row -->

</div><!-- .forum_wrap -->

<?php get_footer(); ?>