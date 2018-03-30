<?php
/**
 * WooCommerce shop template
 */
?>

<?php get_header(); ?>
	<div id="container" class="row-inner">
		<?php if( is_product() ) : // Single product page layout ?>
		
			<?php if( ot_get_option('product_layout') == 'full-width' ) : ?>
				<div id="content" class="shop-template product-col-<?php echo ot_get_option('woo_columns', '3'); ?>">
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						<div class="entry-content clearfix">
							<?php woocommerce_content(); ?>
						</div><!-- .entry-content -->
					</article>
				</div><!-- #content -->
		
			<?php else : ?>
		
				<div id="content" class="<?php if( ot_get_option('product_layout') == 'right-sidebar' ) { echo 'float-left'; } else { echo 'float-right'; } ?> shop-template product-col-<?php echo ot_get_option('woo_columns', '3'); ?>">
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						<div class="entry-content clearfix">
							<?php woocommerce_content(); ?>
						</div><!-- .entry-content -->
					</article>
				</div><!-- #content -->

				<div id="sidebar" class="<?php if( ot_get_option('product_layout') == 'right-sidebar' ) { echo 'float-right'; } else { echo 'float-left'; } ?>">
					<?php get_sidebar('shop'); ?>
				</div>
		
			<?php endif; ?>
			
		<?php else : // Product archive page (shop) layout ?>
		
			<?php if( ot_get_option('catalog_layout') == 'full-width' ) : ?>
				<div id="content" class="shop-template product-col-<?php echo ot_get_option('woo_columns', '3'); ?>">
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						<div class="entry-content clearfix">
							<?php woocommerce_content(); ?>
						</div><!-- .entry-content -->
					</article>
				</div><!-- #content -->
		
			<?php else : ?>
		
				<div id="content" class="<?php if( ot_get_option('catalog_layout') == 'right-sidebar' ) { echo 'float-left'; } else { echo 'float-right'; } ?> shop-template product-col-<?php echo ot_get_option('woo_columns', '3'); ?>">
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						<div class="entry-content clearfix">
							<?php woocommerce_content(); ?>
						</div><!-- .entry-content -->
					</article>
				</div><!-- #content -->

				<div id="sidebar" class="<?php if( ot_get_option('catalog_layout') == 'right-sidebar' ) { echo 'float-right'; } else { echo 'float-left'; } ?>">
					<?php get_sidebar('shop'); ?>
				</div>
		
			<?php endif; ?>
		<?php endif; ?>
		
	</div><!-- #container -->		
		
<?php get_footer(); ?>