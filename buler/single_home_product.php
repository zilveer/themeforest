<?php

	ob_start();

	define('AWP_AJAXED', true);

	define('AWP_ID', $id);



    $root = dirname(dirname(dirname(dirname(__FILE__))));

      if (file_exists($root.'/wp-load.php')) {

          // WP 2.6

          require_once($root.'/wp-load.php');




      } else {

          // Before 2.6

          require_once($root.'/wp-config.php');


				



      }





	ob_end_clean();

	global $wpdb;

	$pc = new WP_Query(array('p' => $_POST['id'],'post_type'=>'product')); 
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_loop_add_to_cart', 30 );

	?>
	

<div class="mainwrap">
	<div class="main clearfix portsingle home">
	
	<?php if ($pc -> have_posts()) : while ($pc ->have_posts()) : $pc ->the_post(); ?>
	<?php global $product; ?>
	<?php  $postmeta = get_post_custom($post->ID); ?>
		<div class="content fullwidth"" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		
			<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div  class="leftContentSP">
				<?php
					/**
					 * woocommerce_show_product_images hook
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					do_action( 'woocommerce_before_single_product_summary' );
				?>
				</div>
					
				<div class="rightContentSP">
					<?php
						/**
						 * woocommerce_single_product_summary hook
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 */
						do_action( 'woocommerce_single_product_summary' );
						

					?>
					<div class="recentCart"><?php // woocommerce_template_loop_add_to_cart(  $product ); ?></div>
				</div>


			<div class="read-more"><a href="<?php echo get_permalink(get_the_id()) ?>"><?php echo pmc_translation('translation_morelinkport','Read more about this...') ?> <?php the_title() ?></a></div>
			</div><!-- #product-<?php the_ID(); ?> -->

			<?php do_action( 'woocommerce_after_single_product' ); ?>
				
	
	<?php comments_template(); ?>
					
	<?php endwhile; endif;?>

	</div>

</div>
	
<script type="text/javascript" charset="utf-8">
 jQuery(document).ready(function(){
    jQuery("a[rel^='lightbox']").prettyPhoto({theme:'light_rounded',overlay_gallery: false,show_title: false});
  });
</script>