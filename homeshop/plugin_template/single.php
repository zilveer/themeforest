<?php get_header(); ?>
<?php
get_header( 'shop' ); ?>
	<?php
		//do_action( 'woocommerce_before_main_content' );
	 if( get_option('sense_sidebar_cat') == 'left' ) { ?>
	<section class="main-content col-lg-9 col-md-9 col-sm-9 col-lg-push-3 col-md-push-3 col-sm-push-3">
	<?php }
	if( get_option('sense_sidebar_cat') == 'right' ) { ?>
	<section class="main-content col-lg-9 col-md-9 col-sm-9">
	<?php } ?>
	
	    <div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">	
		<?php
		if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<div class="carousel-heading">
				<h4><?php woocommerce_page_title(); ?></h4>
			</div>
			
		<?php endif; ?>
		</div>
		</div>	
		<!-- end row -->
		
		
		
		
		<?php do_action( 'woocommerce_archive_description' ); ?>
		
		<div class="row">
		
		<?php 
			global $post;

			$matched_products = get_posts(
				array(
					'post_type' 	=> 'flash_sale',
					'numberposts' 	=> -1,
					'post_status' 	=> 'publish',
					'fields' 		=> 'ids',
					'post__in'		=>array($post->ID),
					'no_found_rows' => true,
				)
			);
			//echo $matched_products[0];
			$arr="";
			$arr= get_post_meta($matched_products[0],'pw_array',true);			
			$query_args = array(
				'post_status'    => 'publish', 
				'post_type'      => 'product', 
				'post__in'       => $arr, 
				'order'=>'data',
				'orderby'=>'DESC',					
				);

			// Add meta_query to query args
			$query_args['meta_query'] = array();

			// Create a new query
			$products = new WP_Query($query_args);
			if ( $products->have_posts() ) :
				woocommerce_product_loop_start();
				while ( $products->have_posts() ) :
					$products->the_post();
					woocommerce_get_template_part( 'content', 'product' );
				endwhile; // end of the loop. 
				woocommerce_product_loop_end(); 
			endif;
				
			do_action( 'woocommerce_before_shop_loop' );
			?>


	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		//do_action( 'woocommerce_after_main_content' );
	?>
</div>
</section>


<!-- Sidebar -->
	<?php if( get_option('sense_sidebar_cat') == 'left' ) { ?>
	
	<aside class="sidebar col-lg-3 col-md-3 col-sm-3  col-lg-pull-9 col-md-pull-9 col-sm-pull-9">
	<?php } 
	if( get_option('sense_sidebar_cat') == 'right' ) { ?>
	<aside class="sidebar right-sidebar col-lg-3 col-md-3 col-sm-3">
	<?php } ?>
	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action( 'woocommerce_sidebar' );
		
		
	?>
	<?php dynamic_sidebar( 'Shop Category Sidebar' ); ?>
	
	
	</aside>
	<!-- /Sidebar -->


<?php get_footer( 'shop' ); ?>
 <script type='text/javascript'>
	/* <![CDATA[  */     
	jQuery(document).ready(function() 
	{
		jQuery("body").addClass("woocommerce woocommerce-page");
	}); 
/* ]]> */
</script> 
<?php get_footer(); ?>

