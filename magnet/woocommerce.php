<?php 
/*
Template Name: WooCommerce
*/ 
?>
<?php 
global $wp_query;
global $woocommerce;

get_option('woocommerce_shop_page_id'); 
$id = get_option('woocommerce_shop_page_id');
$shop= get_page($id);

$sidebar = get_post_meta($id, "qode_show-sidebar", true);  
?>
	<?php get_header(); ?>

		<?php if(!get_post_meta($id, "qode_show-page-title", true)) { ?>
			<div class="container">
				<div class="container_inner clearfix">
					<div class="title">
						<h1>
						<?php
							if(is_shop() || is_product_category()){
								echo $shop->post_title;
							}else{
								the_title();  
							}					
						?>
						</h1>
						<?php if(get_post_meta($id, "qode_page-subtitle", true)) { ?><span><?php echo get_post_meta($id, "qode_page-subtitle", true) ?></span><?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>
		
		<?php if($qode_options_magnet['show_back_button'] == "yes") { ?>
			<a id='back_to_top' href='#'>
				<span class='back_to_top_inner'>
					<span>&nbsp;</span>
				</span>
			</a>
		<?php } ?>

		<?php
		$revslider = get_post_meta($id, "qode_revolution-slider", true);
		if (!empty($revslider)){
			echo do_shortcode($revslider);
		}
		?>
		<div class="container">
			<div class="container_inner clearfix">
				<?php if(!is_singular('product')) { ?>
					<?php if(($sidebar == "default")||($sidebar == "")) : ?>
						<?php woocommerce_content(); ?>	
					<?php elseif($sidebar == "1" || $sidebar == "2"): ?>		
						
						<?php if($sidebar == "1") : ?>	
							<?php global $woocommerce_loop;
								  $woocommerce_loop['columns'] = 2;
						    ?>
							<div class="two_columns_66_33 clearfix">
								<div class="column1">
						<?php elseif($sidebar == "2") : ?>	
							<?php global $woocommerce_loop;
							  	  $woocommerce_loop['columns'] = 3;
					    	?>	
							<div class="two_columns_75_25 clearfix">
								<div class="column1">
						<?php endif; ?>
								<div class="column_inner">
									<?php woocommerce_content(); ?>	
								</div>
										
								</div>
								<div class="column2"><?php get_sidebar();?></div>
							</div>
						<?php elseif($sidebar == "3" || $sidebar == "4"): ?>
							<?php if($sidebar == "3") : ?>	
								<?php global $woocommerce_loop;
								  	  $woocommerce_loop['columns'] = 2;
						    	?>
								<div class="two_columns_33_66 clearfix">
									<div class="column1"><?php get_sidebar();?></div>
									<div class="column2">
							<?php elseif($sidebar == "4") : ?>
								<?php global $woocommerce_loop;
								  	  $woocommerce_loop['columns'] = 3;
						    	?>	
								<div class="two_columns_25_75 clearfix">
									<div class="column1"><?php get_sidebar();?></div>
									<div class="column2">
							<?php endif; ?>
									
								<div class="column_inner">
								<?php woocommerce_content(); ?>	
								</div>			
									</div>
									
								</div>
						<?php endif; ?>
					<?php } else {
						woocommerce_content(); 
					}?>
			</div>
		</div>
	<?php get_footer(); ?>