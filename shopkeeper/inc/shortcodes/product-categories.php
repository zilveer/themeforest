<?php
	
	if (class_exists('WooCommerce')) {

	function shopkeeper_product_categories( $atts ) {
	
			extract( shortcode_atts( array(
				'number'     => null,
				'orderby'    => 'name',
				'order'      => 'DESC',
				'hide_empty' => 1,
				'parent'     => ''
			), $atts ) );
	
			if ( isset( $atts[ 'ids' ] ) ) {
				$ids = explode( ',', $atts[ 'ids' ] );
				$ids = array_map( 'trim', $ids );
			} else {
				$ids = array();
			}
	
			$hide_empty = ( $hide_empty == true || $hide_empty == 1 ) ? 1 : 0;
	
			// get terms and workaround WP bug with parents/pad counts
			$args = array(
				'orderby'    => $orderby,
				'order'      => $order,
				'hide_empty' => $hide_empty,
				'include'    => $ids,
				'pad_counts' => true,
				'child_of'   => $parent
			);
	
			$product_categories = get_terms( 'product_cat', $args );
	
			if ( $parent !== "" ) {
				$product_categories = wp_list_filter( $product_categories, array( 'parent' => $parent ) );
			}
	
			if ( $hide_empty ) {
				foreach ( $product_categories as $key => $category ) {
					if ( $category->count == 0 ) {
						unset( $product_categories[ $key ] );
					}
				}
			}
	
			if ( $number ) {
				$product_categories = array_slice( $product_categories, 0, $number );
			}
	
			ob_start();
	
			$cat_counter = 0;
		
			$cat_number = count($product_categories);
	
			if ( $product_categories ) {
	
				foreach ( $product_categories as $category ) {
	
						   
					$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
					$image = wp_get_attachment_url( $thumbnail_id );
					$cat_class = "";
	
					$cat_counter++;                                        
	
					switch ($cat_number) {
						case 1:
							$cat_class = "one_cat_" . $cat_counter;
							break;
						case 2:
							$cat_class = "two_cat_" . $cat_counter;
							break;
						case 3:
							$cat_class = "three_cat_" . $cat_counter;
							break;
						case 4:
							$cat_class = "four_cat_" . $cat_counter;
							break;
						case 5:
							$cat_class = "five_cat_" . $cat_counter;
							break;
						default:
							if ($cat_counter < 7) {
								$cat_class = $cat_counter;
							} else {
								$cat_class = "more_than_6";
							}
					}
					
					?>
	
					<div class="category_<?php echo $cat_class; ?>">
						<div class="category_grid_box">
							<span class="category_item_bkg" style="background-image:url(<?php echo esc_url($image); ?>)"></span> 
							<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" class="category_item" >
								<span class="category_name"><?php echo esc_html($category->name); ?></span>
							</a>
						</div>
					</div>
	
					<?php
	
				}
				
				?>
							
					<div class="clearfix"></div>
							
				<?php
	
			}
	
			woocommerce_reset_loop();
	
			return '<div class="row"><div class="categories_grid">' . ob_get_clean() . '</div></div>';
	}
	
	add_shortcode("product_categories_grid", "shopkeeper_product_categories");

}