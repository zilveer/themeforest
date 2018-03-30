<div class="shop-header"></div>
<div class="shop_bar">
    <div class="row full-width-row">
        <div class="small-6 columns category_bar">
					<?php
						$args = array(
					    'hide_empty' => 1,
					    'hierarchical'	=> 1,
					    'parent' => 0
						);
						
						$product_categories = get_terms( 'product_cat', $args );
						$current_cat_id = '';
						
						$page_id = wc_get_page_id( 'shop' );
						$page_url = get_permalink( $page_id );
						$all = '<a href="'.esc_url($page_url).'" class="all">'.__('All', 'north').'</a>';
						if (is_tax( 'product_cat' )) {
							$current_cat_id = ( is_tax( 'product_cat' ) ) ? $wp_query->queried_object->term_id : '';
							
							$sub_categories = get_terms( 'product_cat',
								array(
									'parent'       	=> $current_cat_id,
									'hierarchical'	=> true,
									'hide_empty'   	=> 1
								)
							);
							$child_count = count($sub_categories);
							
							if ($child_count > 0) {
								$current_cat = get_term($current_cat_id);
								$product_categories = $sub_categories;
								$all = '<a href="'.get_term_link( $current_cat->term_id ).'" class="all active">'.$current_cat->name.'</a>';
							}
						}

						$count = count($product_categories);

						 if ( $count > 0 ){
						 	echo '<div class="select-wrapper"><select id="category-selection" name="thb-categories" class="thb-categories">';
						 		echo '<option value="'.esc_url($page_url).'" selected="selected">'.__('All', 'north').'</option>';
						 		foreach ( $product_categories as $product_category ) {
						 			$active_class = $current_cat_id === $product_category->term_id ? 'selected="selected"' : '';
						 			echo '<option value="' . get_term_link( $product_category->term_id ) . '" '.$active_class.'>' . $product_category->name . '</option>';
						 		}
						 	echo '</select></div>';
						 	echo "<ul>";
					     	echo '<li>'.$all.'</li>';
					     	foreach ( $product_categories as $product_category ) {
					     	$active_class = $current_cat_id === $product_category->term_id ? 'active' : '';
								
					       echo '<li><a href="' . get_term_link( $product_category->term_id ) . '" class="'.$active_class.'">' . $product_category->name . '</a></li>';
	
					     	}
						 	echo "</ul>";
						 }
						?>
        </div>
        <div class="small-6 columns ordering">
            <?php if ( have_posts() ) : ?>
            		<?php do_action( 'thb_before_shop_loop_result_count' ); ?>
                <?php do_action( 'thb_before_shop_loop_catalog_ordering' ); ?>
            <?php endif; ?>
        </div>
    </div>
</div>