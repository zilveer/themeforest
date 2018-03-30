<?php
/**
 * Template Name: Page: Plans and Pricing
 *
 * @package Listify
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div <?php echo apply_filters( 'listify_cover', 'page-cover', array( 'size' => 'full' ) ); ?>>
			<h1 class="page-title cover-wrapper"><?php the_title(); ?></h1>
		</div>

		<?php do_action( 'listify_page_before' ); ?>

		<div id="primary" class="container">
			<div class="content-area">

				<main id="main" class="site-main" role="main">

					<?php get_template_part( 'content', 'page' ); ?>

					<?php
						if ( 
							listify_has_integration( 'wp-job-manager-wc-paid-listings' ) ||
							listify_has_integration( 'wp-job-manager-wc-advanced-paid-listings' )
						) {
							$defaults = array(
								'before_widget' => '<aside class="listify_widget_wcpl">',
								'after_widget'  => '</aside>',
								'before_title'  => '<div class="home-widget-section-title"><h3 class="home-widget-title">',
								'after_title'   => '%s</h3></div>',
								'widget_id'     => ''
							);

							if ( listify_has_integration( 'wp-job-manager-wc-advanced-paid-listings' ) ) {
								$widget = 'Listify_Widget_JWAPL_Pricing_Table';
							} else {
								$widget = 'Listify_Widget_WCPL_Pricing_Table';
							}

							the_widget(
								$widget,
								array( 'title' => '', 'description' => '' ),
								$defaults
							);
						}
					?>

				</main>

			</div>
		</div>

	<?php endwhile; ?>

<?php get_footer(); ?>
