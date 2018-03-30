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
		$has_breadcrumb = true;
		$has_page_title = ( apply_filters( 'woocommerce_show_page_title', true ) );
		if( $has_breadcrumb || $has_page_title ){
			global $smof_data;
			$style = '';
			if( isset($smof_data['wd_bg_breadcrumbs']) && $smof_data['wd_bg_breadcrumbs'] != '' )
				$style = 'style="background: url('.$smof_data['wd_bg_breadcrumbs'].')"';
			echo '<div class="breadcrumb-title-wrapper"><div class="breadcrumb-title" '.$style.'>';
				if( $has_page_title )
					echo '<h1 class="heading-title page-title">'.woocommerce_page_title(false).'</h1>';
				if( $has_breadcrumb )
					wd_show_breadcrumbs();
			echo '</div></div>';
		}
		do_action('wd_before_main_content'); 
	?>	
	
	<div id="container" class="page-template default-template">
		<div id="content" class="container" role="main">
			<div id="main">	
				
				<?php
					global $smof_data;
					
					
					if( isset($smof_data) ){
						$_layout_config = explode("-",$smof_data['wd_prod_cat_layout']);
					}else{
						$_layout_config = array(0,1,0);
					}
					$_left_sidebar = (int)$_layout_config[0];
					$_right_sidebar = (int)$_layout_config[2];
					$_main_class = ( $_left_sidebar + $_right_sidebar ) == 2 ? "col-sm-12" : ( ( $_left_sidebar + $_right_sidebar ) == 1 ? "col-sm-18" : "col-sm-24" );					
				?>
				
				<?php if( $_left_sidebar ): ?>
							<div id="left-sidebar" class="col-sm-6 hidden-xs">
								<div class="left-sidebar-content">
								<?php
									if ( is_active_sidebar( $smof_data['wd_prod_cat_left_sidebar'] ) ) : ?>
										<ul class="xoxo">
											<?php dynamic_sidebar( $smof_data['wd_prod_cat_left_sidebar'] ); ?>
										</ul>
								<?php endif; ?>
								</div>
							</div><!-- end left sidebar -->
				<?php endif;?>	

				<div id="main_content" class="<?php echo $_main_class?>">
									
						<?php
							/**
							 * woocommerce_before_main_content hook
							 *
							 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
							 * @hooked woocommerce_breadcrumb - 20
							 */
							do_action('woocommerce_before_main_content');
						?>
							
							<?php
								if( isset($smof_data['wd_prod_cat_custom_content']) && strlen($smof_data['wd_prod_cat_custom_content']) > 0 ){
									echo "<div class='cat_custom_content'>";
									echo do_shortcode (stripslashes(htmlspecialchars_decode( base64_decode($smof_data['wd_prod_cat_custom_content']) )) );
									echo "</div>";
								}
							?>
						
							
							

							<?php do_action( 'woocommerce_archive_description' ); ?>
						
							<?php 
								global $woocommerce_loop;
								$_old_woocommerce_loop = $woocommerce_loop;
							?>
						
							<ul class="archive-product-subcategories">	
								<?php ob_start();	?>
								<?php $show_sub_cat = woocommerce_product_subcategories(); ?>
								<?php echo $product_subcategories_html = ob_get_clean();?>
							</ul>
							<?php 
								$woocommerce_loop = $_old_woocommerce_loop;
								if( absint($smof_data['wd_prod_cat_column']) > 0 ){
									$woocommerce_loop['columns'] = absint($smof_data['wd_prod_cat_column']);
								}
							?>
							
							<?php if ( have_posts() ) : ?>
								<div class="archive-product-before-loop">
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
								
									<?php while ( have_posts() ) : the_post(); ?>

										<?php wc_get_template_part( 'content', 'product' ); ?>

									<?php endwhile; // end of the loop. ?>

								<?php woocommerce_product_loop_end(); ?>
								<div class="archive-product-after-loop">
								<?php
									/**
									 * woocommerce_after_shop_loop hook
									 *
									 * @hooked woocommerce_pagination - 10
									 */
									do_action( 'woocommerce_after_shop_loop' );
								?>
								</div>
							<?php elseif ( ! $show_sub_cat ) : ?>

								<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

							<?php endif; ?>

						<?php
							/**
							 * woocommerce_after_main_content hook
							 *
							 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
							 */
							do_action('woocommerce_after_main_content');
						?>

				</div>	
	
				<?php if( $_right_sidebar  ): ?>
							<div id="right-sidebar" class="col-sm-6">
								<div class="right-sidebar-content">
								<?php
									/*if ( is_active_sidebar( 'special-category-widget-area' ) ) : ?>
										<ul class="xoxo special-category-widget-area">
											<?php dynamic_sidebar( 'special-category-widget-area' ); ?>
										</ul>
								<?php endif;*/ ?>
								<?php
									if ( is_active_sidebar( $smof_data['wd_prod_cat_right_sidebar'] ) ) : ?>
										<ul class="xoxo">
											<?php dynamic_sidebar( $smof_data['wd_prod_cat_right_sidebar'] ); ?>
										</ul>
								<?php endif; ?>
								</div>
							</div><!-- end right sidebar -->
				<?php endif;?>	
				
			</div>
		</div>
	</div>
	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action('woocommerce_sidebar');
	?>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			var prod_cat_column =  <?php echo $smof_data['wd_prod_cat_column']; ?>;
			var span_class = "col-sm-"+(24/prod_cat_column);
			jQuery(".archive-product-subcategories li.product-category").addClass(span_class);
			jQuery(".archive-product-subcategories li.product-category").removeClass('first').removeClass('last');
			jQuery(".archive-product-subcategories li.product-category").each(function(index, ele){
				if(index%prod_cat_column==0)
					jQuery(this).addClass("first");
				if(index%prod_cat_column== (prod_cat_column-1))
					jQuery(this).addClass("last");	
			});
		});
	</script>
<?php get_footer('shop'); ?>

	