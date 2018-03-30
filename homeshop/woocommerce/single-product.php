<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );



$sidebar_position_mobile = get_option('sense_settings_sidebar_mobile');


$sidebar_id = get_meta_option('custom_sidebar');
$sidebar_position = get_meta_option('sidebar_position_meta_box');

 ?>



	<?php 
	if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
				$main_term = $terms[0];
			}
	?>






	<?php
		do_action( 'woocommerce_before_main_content' );
	?>

	
	
	<?php 
	if( $sidebar_position != 'full' && $sidebar_position_mobile == 'top') {
		if( $sidebar_position == 'left' ) { ?>
		<aside class="sidebar col-lg-3 col-md-3 col-sm-3">
		<?php } if( $sidebar_position == 'right' ) { ?>
		<aside class="sidebar right-sidebar col-lg-3 col-md-3 col-sm-3">
		<?php } ?>
		
		<?php mm_sidebar('blog',$sidebar_id);?>
		</aside>
	<?php } ?>
	
	
	
	
	
	
	
	<!-- Main Content -->
	<?php if( $sidebar_position == 'left' ) { ?>
	<section class="main-content s-left col-lg-9 col-md-9 col-sm-9">
	<?php }
	if( $sidebar_position == 'right' ) { ?>
	<section class="main-content col-lg-9 col-md-9 col-sm-9">
	<?php }
	if( $sidebar_position == 'full' ) { ?>
	<section class="main-content col-lg-12 col-md-12 col-sm-12">
	<?php }  ?>
	
	
	
		<div id="product-single">
	
	
		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

		
		</div>
	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	
	
	<?php if( get_option('sense_show_related') && get_option('sense_show_related') != 'hide' ) { ?> 
	<!-- New Collection -->
	<div class="products-row row" >
		
		<?php	//woocommerce_output_related_products(); 

		global $product, $woocommerce_loop;
		$posts_per_page1 = '-1';
		$related = $product->get_related( 20 );

		if ( sizeof( $related ) != 0 ) {

			$args = apply_filters( 'woocommerce_related_products_args', array(
				'post_type'				=> 'product',
				'ignore_sticky_posts'	=> 1,
				'no_found_rows' 		=> 1,
				'posts_per_page' 		=> $posts_per_page1,
				'orderby' 				=> 'date',
				'post__in' 				=> $related,
				'post__not_in'			=> array( $product->id )
			) );

			$products = new WP_Query( $args );

			//$woocommerce_loop['columns'] = $columns;

			if ( $products->have_posts() ) {
			?>
			
				<!-- Carousel Heading -->
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="carousel-heading">
						<h4><?php _e( 'Related Products', 'homeshop'); ?></h4>
						
						<?php 
						if( count($products->posts) > 3 ) {
						?>
						<div class="carousel-arrows">
							<i class="icons icon-left-dir"></i>
							<i class="icons icon-right-dir"></i>
						</div>
						<?php 
						}
						?>
						
						
					</div>
				</div>
				<!-- /Carousel Heading -->
				
				<!-- Carousel -->
				
				<div class="carousel owl-carousel-wrap col-lg-12 col-md-12 col-sm-12">
					
						<?php 
						if( $sidebar_position == 'full' ) { 
						echo '<div class="owl-carousel" data-max-items="4">';
						 } else { 
						echo '<div class="owl-carousel" data-max-items="3">';
						 } 

							 while ( $products->have_posts() ) : 
							   $products->the_post(); 
								wc_get_template_part( 'content', 'product-related' ); 

							 endwhile; 
						echo '</div>';
						?>

				</div>
				
				<!-- End Carousel -->
				
			<?php 
			}
			wp_reset_postdata(); 
			
		}
			?>
		
		
		
		
		
		
		
		
	</div>
	<!-- /New Collection -->
<?php } ?> 
	
	
	

	<?php 
	$prev_title = __( 'Prev Product', 'homeshop');
	$next_title = __( 'Next Product', 'homeshop');
	
	
	?>
				
				
	 
	<!-- Product Buttons -->
	<div class="row button-row">
		
		
		
		<div class="col-lg-5 col-md-5 col-sm-5 bt-back">
		<?php 
	    if ( wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {	?> 
			
			<a class="button grey regular" href="<?php echo esc_url(get_term_link( $main_term->slug, 'product_cat' )); ?>"><i class="icons icon-reply"></i> <?php echo __( 'BACK TO', 'homeshop' ); ?>: <?php echo $main_term->name; ?></a>
		
	 <?php } ?> 	
		</div>
   
		
		
		
		<div class="col-lg-7 col-md-7 col-sm-7 align-right bt-pagination">
		
			<?php  
				if(get_adjacent_post() !='' && get_adjacent_post(0,'',0) != '') {
					previous_post_link( '%link', '<i class="icons icon-left-dir"></i> '. $prev_title .'' ); 
					next_post_link( '%link', ''. $next_title .' <i class="icons icon-right-dir"></i>' ); 
				} else {
				previous_post_link( '%link', '<i class="icons icon-left-dir"></i> '. $prev_title .'' ); 
				next_post_link( '%link', ''. $next_title .' <i class="icons icon-right-dir"></i>' ); 
				}	
			?> 
				
		</div>
	
	</div>
	<!-- /Product Buttons -->
	
	
	
	<!-- Recently Viewed Products -->
	<?php if( get_option('sense_show_recently') && get_option('sense_show_recently') != 'hide' ) { ?> 
	<div class="products-row row">
	
		<?php 
		if( $sidebar_position == 'full' ) {
		//echo rc_woocommerce_recently_viewed_products('10', '4'); 
		//echo do_shortcode('[yith_similar_products posts_per_page="4"  ]');
		} else {
		//echo rc_woocommerce_recently_viewed_products('10', '3'); 
		//echo do_shortcode('[yith_similar_products]');
		}
		?>

	</div>
	<?php } ?> 
	<!-- /Recently Viewed Products -->
	
	
	
	</section>
	<!-- /Main Content -->
			

			
	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action( 'woocommerce_sidebar' );
	?>

	<?php 
	if( $sidebar_position != 'full'  && $sidebar_position_mobile != 'top' ) {
		if( $sidebar_position == 'left' ) { ?>
		<aside class="sidebar col-lg-3 col-md-3 col-sm-3">
		<?php } if( $sidebar_position == 'right' ) { ?>
		<aside class="sidebar right-sidebar col-lg-3 col-md-3 col-sm-3">
		<?php } ?>
		
		<?php mm_sidebar('blog',$sidebar_id);?>
		</aside>
	<?php } ?>
	
	
	
	
	
	
	
<?php get_footer( 'shop' ); ?>