<?php
/**
 * Template Name: WooCommerce Page
 *
 * The template to display woocommerce pages
 * 
 * @package Toranj
 * @author owwwlab (Alireza Jahandideh & Ehsan Dalvand @owwwlab)
 */

?>


<?php get_header(); ?>

<!--Page main wrapper-->
<div id="main-content"> 
	<div class="page-wrapper regular-page">

		<div id="shop-header">
			
			<div class="container">
				<div class="custom-grid-row shop-menus">
					<!-- shop breadcrumb -->
					<div class="shop-breadcrumb">
						<!-- breadcrumbs -->
						<ol class="breadcrumb">
							<?php if(function_exists('woocommerce_breadcrumb')) woocommerce_breadcrumb(); ?>
						</ol>
						<!--/ breadcrumbs -->
					</div>	
					<!-- /shop breadcrumb -->

					<!-- Woocommerce menu -->
					<?php
						if ( is_user_logged_in() ) {
							$location='woocommerce-menu-logged-in';
						}else{
							$location='woocommerce-menu';
						}
						wp_nav_menu( array(
							'theme_location' => $location,
							'menu' => '',
							'container' => false,
							'menu_class' => false,
							'items_wrap' => '<ul id = "shop-nav" class = "%2$s">%3$s</ul>',
							'depth' => 0
						) ); 
					?>	

					<!-- /Woocommerce menu -->
				</div>
				
				<div class="custom-grid-row">
					
					<div class="left-side">
						<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

							<!-- page title -->	
							<h2 class="page-title section-title double-title">
								<?php the_title(); ?>
							</h2>
							<!--/ page title -->

						<?php endif; ?>
						<div calss="archive-description">
							<?php do_action( 'woocommerce_archive_description' ); ?>
						</div>
					</div>
					
					
					<div id="shop-cart">
						<h4 class="shop-cart-title"><span><?php _e('Shopping cart', 'toranj'); ?></span></h4>
						<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'toranj'); ?>">  
							<?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'toranj'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?>
						</a>

					</div>
				</div>
			</div>
		</div>

		<div class="container tj-shop-wrapper">

			<?php while( have_posts() ) : the_post(); ?>
				
				

				<?php the_content(); ?>

				<?php wp_link_pages(); ?>

				<?php //comments_template(); ?>
			
			<?php endwhile; ?>
			<hr/>
			<a class="back-to-top" href="#"></a>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!--/Page main wrapper-->

<?php get_footer(); ?>