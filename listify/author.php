<?php
/**
 * The template for displaying Author pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Listify
 */

// Only use this template if we have custom data to load.
if ( ! listify_has_integration( 'wp-job-manager' ) ) {
	return locate_template( array( 'archive.php' ), true );
}

$sidebar_args = array(
	'before_widget' => '<aside class="widget widget--author widget--author-sidebar">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title widget-title--author widget--author-sidebar %s">',
	'after_title'   => '</h3>',
);

get_header(); ?>

	<div <?php echo apply_filters( 'listify_cover', 'page-cover' ); ?>>
		<div class="author-title page-title cover-wrapper">

			<div class="author-name">
				<?php echo get_avatar( get_queried_object_id(), 150 ); ?>

				<h1><?php echo esc_attr( get_queried_object()->data->display_name ); ?></h1>
			</div>

			<p class="author-meta">
				<?php do_action( 'listify_author_meta' ); ?>
			</p>

		</div>
	</div>

	<div id="primary" class="container">
		<div class="row content-area">

			<main id="main" class="site-main col-md-8 col-sm-7 col-xs-12" role="main">

				<?php if ( ! dynamic_sidebar( 'widget-area-author-main' ) ) : ?>
					
					<?php
						the_widget(
							'Listify_Widget_Author_Biography',
							array(
								'title' => 'Biography',
								'icon' => 'ion-person'
							),
							$sidebar_args
						);

						the_widget(
							'Listify_Widget_Author_Listings',
							array(),
							wp_parse_args( 
								array( 
									'before_widget' => '<aside class="widget widget--author widget--author-main listify_widget_author_listings">' ),
								$sidebar_args
							)
						);

						the_widget(
							'Listify_Widget_Author_Bookmarks',
							array(),
							wp_parse_args( 
								array( 
									'before_widget' => '<aside class="widget widget--author widget--author-main listify_widget_author_bookmarks">' ),
								$sidebar_args
							)
						);
					?>

				<?php endif; ?>

			</main>

			<div id="secondary" class="widget-area col-md-4 col-sm-5 col-xs-12" role="complementary">

				<?php if ( ! dynamic_sidebar( 'widget-area-author-sidebar' ) ) : ?>

					<?php
						the_widget(
							'WP_Widget_Recent_Posts',
							array(
								'title' => 'Recent Posts'
							),
							$sidebar_args
						);

						the_widget(
							'Listify_Widget_Listing_Social_Profiles',
							array(
								'title' => 'Social Profiles'
							),
							$sidebar_args
						);
					?>

				<?php endif; ?>

			</div><!-- #secondary -->

		</div>
	</div>

<?php get_footer(); ?>
