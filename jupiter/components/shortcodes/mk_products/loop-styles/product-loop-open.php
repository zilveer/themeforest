<article <?php echo post_class('item mk--col '. $view_params['product_col'].get_viewport_animation_class($view_params['animation']) ); ?>  >
	<div class="mk-product-holder">
		<div class="product-loop-thumb">
			<?php echo $view_params['out_of_stock_badge']; ?>
			<?php echo $view_params['sale_of_stock_badge']; ?>
			<a href="<?php echo $view_params['product_link']; ?>" title="<?php echo $view_params['thumb_title']; ?>" class="product-link">
				<img src="<?php echo $view_params['thumb_image']['dummy']; ?>" <?php echo $view_params['thumb_image']['data-set']; ?> class="product-loop-image" alt="<?php echo $view_params['thumb_title']; ?>" title="<?php echo $view_params['thumb_title']; ?>" itemprop="image">
				<span class="product-loading-icon added-cart"></span>
				<?php if(!empty($view_params['thumb_hover_image'])) { ?>
					<img src="<?php echo $view_params['thumb_hover_image']['dummy']; ?>" <?php echo $view_params['thumb_hover_image']['data-set']; ?> alt="<?php echo esc_attr($view_params['thumb_title']); ?>" class="product-hover-image" title="<?php echo esc_attr($view_params['thumb_title']); ?>" > 
				<?php } ?>
			</a>
			
			<div class="mk-love-holder">
				<?php echo Mk_Love_Post::send_love('mk-icon-thumbs-up'); ?>
			</div>
			
			<?php if($view_params['show_quickview'] == 'true') : ?>
			<div class="quick-view-container">
				<a data-id="<?php the_ID(); ?>" data-action="mk_woocommerce_quick_view" href="#" class="quick-view-button js-ajax-modal">
					<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-search-3',16); ?><span><?php _e("Quick view", "mk_framework"); ?></span>
				</a>
			</div>
			<?php endif; ?>
		</div>
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
		<div class="mk-shop-item-detail">
			<h3 class="product-title">
				<a href="<?php echo $view_params['product_link']; ?>" title="<?php echo $view_params['thumb_title']; ?>">
					<?php the_title(); ?>
				</a>
			</h3>
			<?php if($view_params['show_category'] == 'true') : ?>
			<span class="product-categories">
				<?php echo $view_params['category_name']; ?>
			</span>
			<?php endif; ?>

			<?php if($view_params['show_rating'] == 'true') : ?>
				<span class="product-item-rating">
					<?php echo $view_params['product_rating']; ?>
				</span>
			<?php endif; ?>

			<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
			<div class="product-item-desc">
				<?php echo $view_params['item_desc']; ?>
			</div>
		</div>
	</div>
</article>