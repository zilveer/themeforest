<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); ?>
<?php 
    if ( function_exists( 'get_option_tree') ) {
       	$theme_options = get_option('option_tree');  
    } 
	$header_style = get_option_tree('header_style',$theme_options);
          if ( $header_style == "header_style_1" || $header_style == ""): 
            $headertype = "header-1";
          elseif ( $header_style == "header_style_2"): 
            $headertype = "header-2";
          elseif ( $header_style == "header_style_3" ):
            $headertype = "header-4";
          elseif ( $header_style == "header_style_4" ):
            $headertype = "header-3";
          elseif ( $header_style == "header_style_5" ):
            $headertype = "header-5";
          elseif ( $header_style == "header_style_6" ):
            $headertype = "shopheader";
          elseif ( $header_style == "header_style_7" ):
            $headertype = "header-7";
          elseif ( $header_style == "header_style_8" ):
            $headertype = "header-6";
          endif;     
    $animy2 = $animy3 = ''; 
    $animy = get_option_tree('enable_load_animation', $theme_options);
    if ( $animy == 'Yes' ) {
      
      $animy2 = ' fadein scaleInv anim_2';
      $animy3 = ' fadein scaleInv anim_3'; 
    }
?>
<section class="mukam-waypoint" data-animate-down="mukam-header-small <?php echo $headertype; ?>" data-animate-up="mukam-header-large <?php echo $headertype; ?>">
	<div class="caption-out <?php echo $animy2;?>">
    <div class="container">
      <div class="row">
        <div class="col-md-9 caption">
          <h3><?php woocommerce_page_title(); ?></h3>
          <p><?php echo get_post_meta($post->ID, 'caption', true); ?></p>
        </div>
        <div class="col-md-3 breadcrumb">
        <?php woocommerce_breadcrumb(); ?>
        </div>
      </div>
    </div>
    </div>
<?php if ( $animy == 'Yes') {
  ?><div class="<?php echo $animy3;?>">
  <?php } ?>    
    <div class="bg-color grey featured-products">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-md-8 featured-products">


	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		
	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<div class="featuredproduct-title">
			<h3><?php woocommerce_page_title(); ?></h3>
			<div class="double-divider"></div>
			<div class="clearfix"></div>
		</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>
			<div class="orderproduct">
			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>
			</div>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>
				
				<?php while ( have_posts() ) : the_post(); ?>

					<?php woocommerce_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>
				

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		
	?>
	</div>
	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action('woocommerce_sidebar');
	?>
			</div>
		</div>
	</div>
<?php if ( $animy == 'Yes') {
?></div>
<?php } ?>	
</section>

<?php get_footer('shop'); ?>