<?php /* The sidebar containing the main widget area. */ ?>

	<?php /* Adding extra classes based on layout mode */
		$current_layout = pt_show_layout();
		if ($current_layout === 'layout-two-col-right') { $sidebar_class = 'col-xs-12 col-md-3 col-sm-4'; }
		if ($current_layout === 'layout-two-col-left') { $sidebar_class = 'col-xs-12 col-sm-4 col-md-3 col-md-pull-9 col-sm-pull-8'; }
	?>

	<?php /* Disable sidebars if layout one-col */
		if ( $current_layout != 'layout-one-col') :
	?>

	    <?php if (class_exists('Woocommerce')) : ?>

			<?php
			$vendor_shop = '';
			if ( class_exists('WCV_Vendors') ) {
				$vendor_shop = urldecode( get_query_var( 'vendor_shop' ) );
			}

			if ( is_home() ||
			   ( is_single() && !is_product() && !$vendor_shop ) ||
			   ( is_category() && !is_product_category() ) ||
			   ( is_tag() && !is_product_tag() ) ||
			   ( is_tax() && !is_product_category() && !is_product_tag() ) ||
			   ( is_archive() && !is_woocommerce() ) ||
			     is_search() && !is_woocommerce() ) : ?>

				<?php if ( is_active_sidebar( 'sidebar-blog' ) ) : ?>
					<div id="sidebar-blog" class="widget-area <?php echo esc_attr($sidebar_class); ?> sidebar" role="complementary">
						<?php dynamic_sidebar( 'sidebar-blog' ); ?>
					</div>
				<?php endif; ?>

			<?php elseif ( (is_page() && is_front_page() && !is_shop()) ||
						   (is_page() && is_page_template( 'page-templates/front-page.php' ) ) ) : ?>

				<?php if ( is_active_sidebar( 'sidebar-front' ) ) : ?>
					<div id="sidebar-front" class="widget-area <?php echo esc_attr($sidebar_class); ?> sidebar" role="complementary">
						<?php dynamic_sidebar( 'sidebar-front' ); ?>
					</div>
				<?php endif; ?>

			<?php elseif ( is_page() && !is_shop() ) : ?>

				<?php if ( is_active_sidebar( 'sidebar-pages' ) ) : ?>
					<div id="sidebar-pages" class="widget-area <?php echo esc_attr($sidebar_class); ?> sidebar" role="complementary">
						<?php dynamic_sidebar( 'sidebar-pages' ); ?>
					</div>
				<?php endif; ?>

			<?php elseif ( $vendor_shop && $vendor_shop != '' ) : ?>

				<?php if ( is_active_sidebar( 'sidebar-vendor' ) ) : ?>
					<div id="sidebar-vendor" class="widget-area <?php echo esc_attr($sidebar_class); ?> sidebar" role="complementary">
						<?php dynamic_sidebar( 'sidebar-vendor' ); ?>
					</div>
				<?php endif; ?>

			<?php elseif ( ( is_front_page() && is_shop() ) || is_shop() || is_product_category() || is_product_tag() ) : ?>

				<?php if ( is_active_sidebar( 'sidebar-shop' ) ) : ?>
					<div id="sidebar-shop" class="widget-area <?php echo esc_attr($sidebar_class); ?> sidebar" role="complementary">
						<?php dynamic_sidebar( 'sidebar-shop' ); ?>
					</div>
				<?php endif; ?>

			<?php elseif ( is_product() ) : ?>

				<?php if ( is_active_sidebar( 'sidebar-product' ) ) : ?>
					<div id="sidebar-product" class="widget-area <?php echo esc_attr($sidebar_class); ?> sidebar" role="complementary">
						<?php dynamic_sidebar( 'sidebar-product' ); ?>
					</div>
				<?php endif; ?>

			<?php endif; ?>

		<?php else : ?>

	        <?php if ( is_home() || is_single() || is_category() || is_tag() || is_tax() || is_archive()  || is_search() ) : ?>

	            <?php if ( is_active_sidebar( 'sidebar-blog' ) ) : ?>
	                <div id="sidebar-blog" class="widget-area <?php echo esc_attr($sidebar_class); ?> sidebar" role="complementary">
	                    <?php dynamic_sidebar( 'sidebar-blog' ); ?>
	                </div>
	            <?php endif; ?>

	        <?php elseif ( is_page() && is_front_page() ) : ?>

	            <?php if ( is_active_sidebar( 'sidebar-front' ) ) : ?>
	                <div id="sidebar-front" class="widget-area <?php echo esc_attr($sidebar_class); ?> sidebar" role="complementary">
	                    <?php dynamic_sidebar( 'sidebar-front' ); ?>
	                </div>
	            <?php endif; ?>

	        <?php elseif ( is_page() ) : ?>

	            <?php if ( is_active_sidebar( 'sidebar-pages' ) ) : ?>
	                <div id="sidebar-pages" class="widget-area <?php echo esc_attr($sidebar_class); ?> sidebar" role="complementary">
	                    <?php dynamic_sidebar( 'sidebar-pages' ); ?>
	                </div>
	            <?php endif; ?>

	        <?php endif; ?>

		<?php endif ?>

	<?php endif ?>
