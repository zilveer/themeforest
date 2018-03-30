<?php get_header(); ?>
	<div class="gdlr-content">

		<?php 
				global $gdlr_sidebar, $theme_option;
				$woo_page = (is_product())? 'single': 'all';
				
				$gdlr_sidebar = array(
					'type'=>$theme_option[$woo_page . '-products-sidebar'],
					'left-sidebar'=>$theme_option[$woo_page . '-products-sidebar-left'], 
					'right-sidebar'=>$theme_option[$woo_page . '-products-sidebar-right']
				); 
				$gdlr_sidebar = gdlr_get_sidebar_class($gdlr_sidebar);
		?>
		<div class="with-sidebar-wrapper">
			<div class="with-sidebar-container container">
				<div class="with-sidebar-left <?php echo $gdlr_sidebar['outer']; ?> columns">
					<div class="with-sidebar-content <?php echo $gdlr_sidebar['center']; ?> columns gdlr-item-start-content">
						<div class="gdlr-item woocommerce-content-item">
							<div class="woocommerce-breadcrumbs">
							<?php woocommerce_breadcrumb(); ?>
							</div>
				
							<div class="woocommerce-content">
							<?php woocommerce_content(); ?>
							</div>				
						</div>				
					</div>
					<?php get_sidebar('left'); ?>
					<div class="clear"></div>
				</div>
				<?php get_sidebar('right'); ?>
				<div class="clear"></div>
			</div>				
		</div>				
	</div><!-- gdlr-content -->
<?php get_footer(); ?>