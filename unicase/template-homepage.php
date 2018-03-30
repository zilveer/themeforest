<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage
 *
 * @package unicase
 */

get_header(); ?>

	<div class="<?php echo esc_attr( apply_filters( 'unicase_container_classes', 'container' ) ); ?>">
		<div class="row">
			<div id="primary" class="<?php echo esc_attr( apply_filters( 'unicase_content_area_classes', 'content-area' ) ); ?>">
				<main class="<?php echo esc_attr( apply_filters( 'unicase_site_main_classes', 'site-main' ) ); ?>">
					<?php
						/**
						 * @hooked unicase_homepage_content - 10
						 * @hooked unicase_product_categories - 20
						 * @hooked unicase_recent_products - 30
						 * @hooked unicase_featured_products - 40
						 * @hooked unicase_popular_products - 50
						 * @hooked unicase_on_sale_products - 60
						 */
						do_action( 'homepage' ); ?>
				</main>
			</div>
			<aside id="secondary" class="<?php echo esc_attr( apply_filters( 'unicase_sidebar_area_classes', 'sidebar-area widget-area' ) ); ?>">
				<?php unicase_get_sidebar(); ?>
			</aside>
		</div>
	</div>

<?php get_footer(); ?>
