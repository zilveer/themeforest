<?php get_header(); ?>
<div class="content-outer-wrapper">
	<div class="content-wrapper container main ">
	<?php 
		// Check and get Sidebar Class
		if( is_product() ){
			$sidebar = get_option(THEME_SHORT_NAME.'_woo_single_product_sidebar', 'single-prod-no-sidebar');
			$sidebar = str_replace('single-prod-', '', $sidebar);
			
			$left_sidebar = get_option(THEME_SHORT_NAME.'_woo_single_product_left_sidebar');
			$right_sidebar = get_option(THEME_SHORT_NAME.'_woo_single_product_right_sidebar');
		}else{
			$sidebar = get_option(THEME_SHORT_NAME.'_woo_all_product_sidebar', 'all-prod-no-sidebar');
			$sidebar = str_replace('all-prod-', '', $sidebar);
			
			$left_sidebar = get_option(THEME_SHORT_NAME.'_woo_all_product_left_sidebar');
			$right_sidebar = get_option(THEME_SHORT_NAME.'_woo_all_product_right_sidebar');		
		}		
		$sidebar_array = gdl_get_sidebar_size( $sidebar );
	?>		
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="page-wrapper single-page <?php echo $sidebar_array['sidebar_class']; ?>">
		<?php
			echo '<div class="row gdl-page-row-wrapper">';
			echo '<div class="gdl-page-left mb0 ' . $sidebar_array['page_left_class'] . '">';
			
			echo '<div class="row">';
			echo '<div class="gdl-page-item mb0 ' . $sidebar_array['page_item_class'] . '">';

			echo '<div class="woo-breadcrumbs-wrapper">';
			woocommerce_breadcrumb();
			echo '</div>';
			
			echo '<div class="woo-commerce-content-wrapper">';
			woocommerce_content();
			echo "</div>"; // woo commerce content wrpaper
			
			echo "</div>"; // end of gdl-page-item
			
			wp_reset_query();
			
			get_sidebar('left');	
			echo '<div class="clear"></div>';			
			echo "</div>"; // row
			echo "</div>"; // gdl-page-left

			get_sidebar('right');
			echo '<div class="clear"></div>';
			echo "</div>"; // row
		?>
		<div class="clear"></div>
	</div> <!-- page wrapper -->
	</div> <!-- post class -->
	</div> <!-- content wrapper -->
</div> <!-- content outer wrapper -->
<?php get_footer(); ?>