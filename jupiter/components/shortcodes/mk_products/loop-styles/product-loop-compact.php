
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
			<div class="product-item-footer">
				<span class="product-item-rating">
					<?php echo $view_params['product_rating']; ?>
				</span>

				<?php 
					global $product;

					switch ( $product->product_type ) {
						case "variable" :
							$icon_class = 'mk-icon-plus';
							break;
						case "grouped" :
							$icon_class = 'mk-moon-search-3';
							break;
						case "external" :
							$icon_class = 'mk-moon-search-3';
							break;
						default :
							$icon_class = 'mk-moon-cart-plus';
							break;
					}

					if(!$product->is_purchasable() || !$product->is_in_stock()) {
						$icon_class = 'mk-moon-search-3';
					}

					$button_class = implode( ' ', array(
										'product_loop_button',
										'product_type_' . $product->product_type,
										$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
										$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : ''
								) );


					echo apply_filters( 'woocommerce_loop_add_to_cart_link',
						sprintf( '<a rel="nofollow" href="%s" data-quantity="1" data-product_id="%s" data-product_sku="%s" class="%s">%s%s</a>',
							esc_url( $product->add_to_cart_url() ),
							esc_attr( $product->id ),
							esc_attr( $product->get_sku() ),
							esc_attr( $button_class),
							Mk_SVG_Icons::get_svg_icon_by_class_name(false,$icon_class,16),
							esc_html( $product->add_to_cart_text() )
						),
					$product );
				?>

			</div>
		</div>
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
		<div class="mk-shop-item-detail">
			<div class="mk-love-holder">
				<?php echo Mk_Love_Post::send_love(); ?>
			</div>
			<h3 class="product-title">
				<a href="<?php echo $view_params['product_link']; ?>" title="<?php echo $view_params['thumb_title']; ?>">
					<?php the_title(); ?>
				</a>
			</h3>
			<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
			<div class="product-item-desc">
				<?php echo $view_params['item_desc']; ?>
			</div>
		</div>
	</div>
</article>
