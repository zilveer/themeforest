<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage InTouch
 * @since InTouch 1.0
 */

get_header(); ?>

<?php
	global $ct_options;
	$shop_sidebar_position = $ct_options['ct_shop_sidebar_position'];
	if ( empty( $shop_sidebar_position ) ) $shop_sidebar_position = 'right';

	$ct_shop_breadcrumb = $ct_options['ct_woo_show_breadcrumb'];
?>

<!-- InTouch -->
<?php if ( $ct_shop_breadcrumb ) : ?>
<div class="entry-navigation">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="entry-breadcrumb ct-google-font">
					<?php
						$args = array(
							'separator' => '',
							'delimiter'  => __( '/ ' , 'color-theme-framework' ),
							'before' => '',
							'after' => '',
							'wrap_before' => '<div class="breadcrumb-list-woo">',
							'wrap_after' => '</div>'
							);
					?>									
					<?php woocommerce_breadcrumb( $args ); ?>
				</div><!-- .entry-breadcrumb -->
			</div><!-- .col-lg-12 -->
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- .entry-navigation -->
<?php endif; ?>	


<div id="content" class="theme-container" role="main">
	<div class="container">
		<div class="row">		

			<?php if ( $shop_sidebar_position == 'right' ) { ?>		
				<div id="primary" class="col-lg-9">
			<?php } else if ( $shop_sidebar_position == 'left' ) { ?> 
				<div id="primary" class="col-lg-9 col-lg-push-3">	
			<?php } ?>


			<?php woocommerce_content(); ?>	

			</div> <!-- /col-lg-9 -->

			<?php if ( $shop_sidebar_position == 'right' ) { ?>
				<div id="secondary" class="sidebar col-lg-3" role="complementary">
			<?php } else if ( $shop_sidebar_position == 'left' ) { ?> 
				<div id="secondary" class="sidebar col-lg-3 col-lg-pull-9" role="complementary">
			<?php } ?>
					<?php dynamic_sidebar( 'ct_woocommerce_sidebar' ); ?>
			
				</div><!-- /col-lg-3 -->

		</div> <!-- /row -->
	</div> <!-- /container -->
</div> <!-- /content -->

<?php get_footer(); ?>