<?php 

if( is_single() ) {
	$swm_woo_page_layout = get_option('swm_woo_product_page_layout');
	$swm_woo_dynamic_sidebar = 'Product Single Page Sidebar';
} else {
	$swm_woo_page_layout = get_option('swm_woo_shop_page_layout');
	$swm_woo_dynamic_sidebar = 'Shop Page Sidebar';
}

get_header(); ?>		
	<div class="swm_container <?php echo $swm_woo_page_layout; ?>">
		<div class="swm_column swm_custom_two_third">		
			<?php woocommerce_content(); ?>
			<div class="clear"></div>			
		</div>

		<?php if ( $swm_woo_page_layout != 'layout-full-width' ) { ?>

			<aside class="swm_column sidebar" id="sidebar">			
				<?php dynamic_sidebar($swm_woo_dynamic_sidebar);  ?>
				<div class="clear"></div>
			</aside>

		<?php } ?>


	</div>
	<?php
get_footer();

?>




