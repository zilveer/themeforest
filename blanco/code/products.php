<?php

/**
 * Related Products
 */
function get_related_products ( $product_id,$cats_search = true,$width,$height, $number = 20) {
	global $wpdb;
	// Related products are found from category and tag
	$tags_array = array(0);
	$cats_array = array(0);
	$tags = '';
	$cats = '';

	// Get tags
	$terms = wp_get_post_terms($product_id, 'product_tag');
	foreach ($terms as $term) {
		$tags_array[] = $term->term_id;
	}
	$tags = implode(',', $tags_array);

	$terms = wp_get_post_terms($product_id, 'wpsc_product_category');
	foreach ($terms as $term) {
		$cats_array[] = $term->term_id;
	}
	$cats = implode(',', $cats_array);


    if($cats_search){
        $cats_search = "
				(
					tt.taxonomy ='wpsc_product_category'
					AND tt.term_taxonomy_id = tr.term_taxonomy_id
					AND tr.object_id  = p.ID
					AND tt.term_id IN ($cats)
				)
				OR
        ";
    }else{
        $cats_search = '';
    }

	$q = "
		SELECT p.ID
		FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p
		WHERE
			p.ID != $product_id
			AND p.post_status = 'publish'
			AND p.post_type = 'wpsc-product'
			AND
			(
                $cats_search
				(
					tt.taxonomy ='product_tag'
					AND tt.term_taxonomy_id = tr.term_taxonomy_id
					AND tr.object_id  = p.ID
					AND tt.term_id IN ($tags)
				)
			)
		GROUP BY tr.object_id
		ORDER BY RAND()
		LIMIT $number;";

	$related = $wpdb->get_col($q);

	if (sizeof($related)>0) {
		$args=array(
			'post__in' => $related,
			'post__not_in' => array($product_id),
			'post_type'	=> 'wpsc-product',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' => $number,
			'orderby' => 'rand',
		);
		$related_query = new WP_Query($args);
		if ($related_query->have_posts()) :
            $_i = 0;
			while ($related_query->have_posts()) : $related_query->the_post();
                $_i++;
				$id = get_the_ID();
                $variants_exist = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE `post_parent`=$id AND `post_type`='wpsc-product'", 'ARRAY_A');

                $related_array[$_i]['id'] = get_the_ID();
                $related_array[$_i]['title'] = esc_attr(get_the_title());
                $related_array[$_i]['image'] = etheme_get_image( 0, $width, $height, false, $id );
                $related_array[$_i]['permalink'] = get_permalink();
                if($variants_exist){
                    if(wpsc_product_on_special($id)) {
                        $related_array[$_i]['normal_price'] = wpsc_product_normal_price($id);
                        $related_array[$_i]['price'] = wpsc_the_product_price($id);
                    }else{
                        $related_array[$_i]['normal_price'] = 0;
                        $related_array[$_i]['price'] = wpsc_the_product_price($id);
                    }
                }else{
                    $related_array[$_i]['normal_price'] = the_product_price($id);
                    $related_array[$_i]['price'] = the_product_price($id,true);
                }
                unset($variants_exist);
			endwhile;
		endif;
        wp_reset_postdata();
	}

	return $related_array;
}


/**
 * Also Bought Products
 */
function etheme_products_also_bought ( $product_id,$width,$height, $number = 20) {
	global $wpdb;
	 $q = "
        SELECT `" . $wpdb->posts . "`.ID
        FROM `" . WPSC_TABLE_ALSO_BOUGHT . "`, `" . $wpdb->posts . "`
        WHERE
                `selected_product`='" . $product_id . "'
            AND `" . WPSC_TABLE_ALSO_BOUGHT . "`.`associated_product` = `" . $wpdb->posts . "`.`id`
            AND `" . $wpdb->posts . "`.`post_status` IN('publish','protected')
        ORDER BY `" . WPSC_TABLE_ALSO_BOUGHT . "`.`quantity`
        DESC
        LIMIT $number";


	$cross = $wpdb->get_col($q);
    global $cross_array;
	if (sizeof($cross)>0) {
		$args=array(
			'post__in' => $cross,
			'post__not_in' => array($product_id),
			'post_type'	=> 'wpsc-product',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' => $number,
			'orderby' => 'rand',
		);
		$cross_query = new WP_Query($args);
		if ($cross_query->have_posts()) :
            $_i = 0;
			while ($cross_query->have_posts()) : $cross_query->the_post();
                $_i++;
				$id = get_the_ID();

                $cross_array[$_i]['id'] = get_the_ID();
                $cross_array[$_i]['title'] = esc_attr(get_the_title());
                $cross_array[$_i]['image'] = etheme_get_image( 0, $width, $height, false, $id );
                $cross_array[$_i]['permalink'] = get_permalink();
                $cross_array[$_i]['normal_price'] = the_product_price($id);
                $cross_array[$_i]['price'] = the_product_price($id,true);

			endwhile;
		endif;
        wp_reset_postdata();
	}

	return $cross_array;
}

/**
 * Show product labels
 */

function etheme_product_labels( $product_id = '' ) {
    echo etheme_get_product_labels($product_id);
}
function etheme_get_product_labels( $product_id = '' ) {
	global $post, $wpdb;
    $count_labels = 0;
    $output = '';
    if ( etheme_get_option('sale_icon') ) :
        if(etheme_product_on_special($product_id)) : $count_labels++;
                $output .= '<span class="label-icon sale-label">'.__( 'Sale!', ETHEME_DOMAIN ).'</span>';

        endif;
    endif;

    if ( etheme_get_option('new_icon') ) : $count_labels++;
        if(etheme_product_is_new($product_id)) :
						if($count_labels >= 1) $second_label = 'second_label';
								$output .= '<span class="label-icon new-label '.$second_label.'">'.__( 'New!', ETHEME_DOMAIN ).'</span>';
        endif;
    endif;
    return $output;
}

/**
 * Is product New
 */
function etheme_product_is_new( $product_id = '' ) {
	global $post, $wpdb;
    $key = '_etheme_new_label';
	if(!$product_id) $product_id = $post->ID;
	if(!$product_id) return false;
    $_etheme_new_label = get_post_meta($product_id, $key);
        return $_etheme_new_label;
    if($_etheme_new_label[0] == 1) {
        return true;
    }
    return false;
}
/**
 * Is product on special
 */
function etheme_product_on_special( $product_id = '' ) {
	global $post, $wpdb;
	if(!$product_id) $product_id = $post->ID;
	if(!$product_id) return false;
	$variations = $wpdb->get_results( "SELECT ID,post_title FROM {$wpdb->posts} WHERE post_parent = '{$product_id}' AND post_type = 'wpsc-product' ORDER BY ID ASC" );
	if ( $variations ) {
		$special_price_min = etheme_get_variation_info( $product_id, 'special_price_min' );
		if ( $special_price_min > 0 )
			return true;
		else
			return false;
	}
	else {
		$price =  get_post_meta( $product_id, '_wpsc_price', true );
		$special_price = get_post_meta( $product_id, '_wpsc_special_price', true );
		if ( ($special_price > 0) && (($price - $special_price) > 0) )
			return true;
		else
			return false;
	}
}
function etheme_get_variation_info( $product_id = '', $info ) {
	global $wpdb, $post;
	if(!$product_id) $product_id = $post->ID;
	if(!$product_id) return;
	if($info=='price_min') {
		$sql = $wpdb->prepare( "
			SELECT pm.meta_value
			FROM {$wpdb->posts} AS p
			INNER JOIN {$wpdb->postmeta} AS pm ON pm.post_id = p.id AND pm.meta_key = '_wpsc_price' AND pm.meta_value != '0' AND pm.meta_value != ''
			INNER JOIN {$wpdb->postmeta} AS pm2 ON pm2.post_id = p.id AND pm2.meta_key = '_wpsc_stock' AND pm2.meta_value != '0'
			WHERE
				p.post_type = 'wpsc-product'
				AND
				p.post_parent = %d
			ORDER BY CAST(pm.meta_value AS DECIMAL(10, 2)) ASC
			LIMIT 1
		", $product_id );
		$price = (float) $wpdb->get_var( $sql );
		return $price;
	}
	elseif($info=='price_max') {
		$sql = $wpdb->prepare( "
			SELECT pm.meta_value
			FROM {$wpdb->posts} AS p
			INNER JOIN {$wpdb->postmeta} AS pm ON pm.post_id = p.id AND pm.meta_key = '_wpsc_price' AND pm.meta_value != '0' AND pm.meta_value != ''
			INNER JOIN {$wpdb->postmeta} AS pm2 ON pm2.post_id = p.id AND pm2.meta_key = '_wpsc_stock' AND pm2.meta_value != '0'
			WHERE
				p.post_type = 'wpsc-product'
				AND
				p.post_parent = %d
			ORDER BY CAST(pm.meta_value AS DECIMAL(10, 2)) DESC
			LIMIT 1
		", $product_id );
		$price = (float) $wpdb->get_var( $sql );
		return $price;
	}
	elseif($info=='special_price_zero') {
		$sql = $wpdb->prepare("
			SELECT pm.meta_value
			FROM {$wpdb->posts} AS p
			INNER JOIN {$wpdb->postmeta} AS pm ON pm.post_id = p.id AND pm.meta_key = '_wpsc_special_price'
			INNER JOIN {$wpdb->postmeta} AS pm2 ON pm2.post_id = p.id AND pm2.meta_key = '_wpsc_stock' AND pm2.meta_value != '0'
			WHERE
				p.post_type = 'wpsc-product'
				AND
				p.post_parent = %d
			ORDER BY CAST(pm.meta_value AS DECIMAL(10, 2)) ASC
			LIMIT 1
		", $product_id);
		$special_price = (float) $wpdb->get_var( $sql );
		return $special_price;
	}
	elseif($info=='special_price_min') {
		$sql = $wpdb->prepare("
			SELECT pm.meta_value
			FROM {$wpdb->posts} AS p
			INNER JOIN {$wpdb->postmeta} AS pm ON pm.post_id = p.id AND pm.meta_key = '_wpsc_special_price' AND pm.meta_value != '0' AND pm.meta_value != ''
			INNER JOIN {$wpdb->postmeta} AS pm2 ON pm2.post_id = p.id AND pm2.meta_key = '_wpsc_stock' AND pm2.meta_value != '0'
			WHERE
				p.post_type = 'wpsc-product'
				AND
				p.post_parent = %d
			ORDER BY CAST(pm.meta_value AS DECIMAL(10, 2)) ASC
			LIMIT 1
		", $product_id);
		$special_price = (float) $wpdb->get_var( $sql );
		return $special_price;
	}
	elseif($info=='special_price_max') {
		$sql = $wpdb->prepare("
			SELECT pm.meta_value
			FROM {$wpdb->posts} AS p
			INNER JOIN {$wpdb->postmeta} AS pm ON pm.post_id = p.id AND pm.meta_key = '_wpsc_special_price' AND pm.meta_value != '0' AND pm.meta_value != ''
			INNER JOIN {$wpdb->postmeta} AS pm2 ON pm2.post_id = p.id AND pm2.meta_key = '_wpsc_stock' AND pm2.meta_value != '0'
			WHERE
				p.post_type = 'wpsc-product'
				AND
				p.post_parent = %d
			ORDER BY CAST(pm.meta_value AS DECIMAL(10, 2)) DESC
			LIMIT 1
		", $product_id);
		$special_price = (float) $wpdb->get_var( $sql );
		return $special_price;
	}
}
/**
 * Product Price
 */
function the_product_price($id, $special_price = false) {
	if ($special_price) {
	   if(get_post_meta($id, '_wpsc_special_price', true) == 0){
	       return wpsc_currency_display(get_post_meta($id, '_wpsc_price', true));
	   }
		return wpsc_currency_display(get_post_meta($id, '_wpsc_special_price', true));
	} else {
		return wpsc_currency_display(get_post_meta($id, '_wpsc_price', true));
	}
}

global $etheme_productspage_id, $etheme_shoppingcart_id, $etheme_transactionresults_id, $etheme_userlog_id;
$etheme_productspage_id = etheme_shortcode2id('[productspage]');
$etheme_shoppingcart_id = etheme_shortcode2id('[shoppingcart]');
$etheme_transactionresults_id = etheme_shortcode2id('[transactionresults]');
$etheme_userlog_id = etheme_shortcode2id('[userlog]');

remove_action('template_redirect', 'wpsc_all_products_on_page');
add_action('template_redirect', 'etheme_all_products_on_page');

function etheme_all_products_on_page(){
	global $wp_query;
	global $etheme_productspage_id, $etheme_shoppingcart_id, $etheme_transactionresults_id, $etheme_userlog_id;
	$product_category = get_query_var( 'wpsc_product_category' );
	$product_tag = get_query_var ('product_tag' );
	$id = $wp_query->get_queried_object_id();
	if( get_query_var( 'post_type' ) == 'wpsc-product' || $product_category || $product_tag || ( $id && $id == $etheme_productspage_id )){
		$templates = array();
		if ( $product_category && ! is_single() ) {
			array_push( $templates, "taxonomy-wpsc_product_category-{$product_category}.php", 'taxonomy-wpsc_product_category.php' );
		}
		if ( $product_tag && ! is_single() ) {
			array_push( $templates, "taxonomy-product_tag-{$product_tag}.php", 'taxonomy-product_tag.php' );
		}
		array_push( $templates, 'products.php', 'page.php', 'index.php' );
		if ( is_single() )
			array_unshift( $templates, 'single-wpsc-product.php' );
		// print_r($templates);
		$template = locate_template( $templates );
		// print_r($template);
		if ( !empty( $template ) && is_readable( $template ) ) {
			include_once( $template );
			exit;
		}
	}
	elseif ( ( $id && $id == $etheme_shoppingcart_id ) || ( $id && $id == $etheme_transactionresults_id ) || ( $id && $id == $etheme_userlog_id ) ) {
		$template = locate_template( array( 'checkout.php' ) );
		if ( !empty( $template ) && is_readable( $template ) ) {
			include_once( $template );
			exit;
		}


	}
}

/**
 * Create product slider getting query
 */

function etheme_create_slider($args,$title = false,$image_width = 220,$image_height = 220,$crop = false){
    $box_id = rand(1000,10000);
	$multislides = new WP_Query( $args );
	$_i=0; ?>
	
	<?php if ( $multislides->have_posts() ) : ?>
		
        <div class="product-slider">

			<?php if ( !empty($title)) : ?>
				<h4 class="slider-title"><?php echo $title; ?></h4>
			<?php endif; ?>

            <div class="clear"></div>

            <div class="carousel">
            	<div class="slider">

	        		<?php while ($multislides->have_posts()) : $multislides->the_post(); ?>

	        			
						<div class="slide product-slide">

							<?php $_i++;

		                    if(etheme_is_woo_exist()) {
		                        global $product;
		                        if (!$product->is_visible()) continue;
		                            woocommerce_get_template_part( 'content', 'product' );
		                    } ?>

		                    <?php if (etheme_is_ec_exist()) :

		                    	global $wpdb,$wpsc_variations;
		                    	$product_id = get_the_ID();
		                    	$post_image = etheme_get_image( null, $image_width, $image_height, $crop, $product_id );
		            			$normal_price = wpsc_product_normal_price();
								$sale_price = wpsc_the_product_price(); ?>

		                    		<a class="product-image" href="<?php echo wpsc_the_product_permalink(); ?>">
		                    			<div class="img-wrapper">
		                    				<img src="<?php echo $post_image; ?>" alt="<?php echo $product_id; ?>">
		                    			</div>
		                    		</a>

		                    		<span class="product-name">
		                    			<a href="<?php echo wpsc_the_product_permalink(); ?>"><?php echo wpsc_the_product_title(); ?></a>
		                    		</span>

									<div class="price sale">

		                    			<?php if( $normal_price != $sale_price ): ?>
											<p class="oldprice-p pricedisplay">
												<span class="oldprice"><?php echo $normal_price; ?></span>
											</p>
		                    			<?php endif; ?>
		                    			
		                     
		                                <p class="pricedisplay">
		                                	<span class="currentprice pricedisplay"><?php echo $sale_price; ?></span>
		                                </p>

		                            </div><!-- price sale -->

									<?php
										
										$return = false;
										$wpsc_variations = new wpsc_variations( $product_id );

										if ( $return ){
											ob_start();
										}
											
									?>
											<div class='wpsc-add-to-cart-button'>
												<form class='wpsc-add-to-cart-button-form' id='product_<?php echo esc_attr( $product_id ) ?>' action='' method='post'>
													<?php do_action( 'wpsc_add_to_cart_button_form_begin', $product_id ); ?>
														<?php if (wpsc_have_variation_groups()): ?>
															<a href="<?php echo wpsc_the_product_permalink(); ?>" class="button"><span><?php _e('Read More', ETHEME_DOMAIN); ?></span></a>
														<?php else: ?>
															<input type='hidden' name='wpsc_ajax_action' value='add_to_cart' />
															<input type='hidden' name='product_id' value='<?php echo $product_id; ?>' />
															<input type='submit' id='product_<?php echo $product_id; ?>_submit_button' class='wpsc_buy_button' name='Buy' value='<?php echo __( 'Add To Cart', 'wp-e-commerce' ); ?>'  />
														<?php endif; ?>
													<?php do_action( 'wpsc_add_to_cart_button_form_end', $product_id ); ?>
												</form>
											</div>
									<?php

										if ( $return ) {
											return ob_get_clean();
											
										}

									?>

		                    <?php endif;?>

						</div><!-- slide -->

	        		<?php endwhile;?>

                </div><!-- slider -->
            </div><!-- carousel -->

            <?php if ($_i>1): ?>
            	<div class="prev arrow<?php echo $box_id; ?>" style="cursor: pointer; ">&nbsp;</div>
				<div class="next arrow<?php echo $box_id; ?>" style="cursor: pointer; ">&nbsp;</div>
			<?php endif; ?>
			
        </div><!-- product-slider -->
    <?php endif; ?>
	
	<?php if ($_i>1): ?>

        <script type="text/javascript">
            jQuery(".arrow<?php echo $box_id; ?>.prev").addClass("disabled");
            jQuery(".carousel").iosSlider({
                desktopClickDrag: true,
                snapToChildren: true,
                infiniteSlider: false,
                navNextSelector: ".arrow<?php echo $box_id; ?>.next",
                navPrevSelector: ".arrow<?php echo $box_id; ?>.prev",
                lastSlideOffset: 3,
                onFirstSlideComplete: function(){
                    jQuery(".arrow<?php echo $box_id; ?>.prev").addClass("disabled");
                },
                onLastSlideComplete: function(){
                    jQuery(".arrow<?php echo $box_id; ?>.next").addClass("disabled");
                },
                onSlideChange: function(){
                    jQuery(".arrow<?php echo $box_id; ?>.next").removeClass("disabled");
                    jQuery(".arrow<?php echo $box_id; ?>.prev").removeClass("disabled");
                }
            });
        </script>

    <?php endif; ?>
    <?php wp_reset_query();
}


/**
 * Custom pagination
 */

function etheme_pagination($totalpages = '', $per_page = '', $current_page = '', $page_link = '') {
	global $wp_query;
	$num_paged_links = 4; //amount of links to show on either side of current page

    $showFirstPageLink = false;
    $showLastPageLink = false;

	$additional_links = '';

	//additional links, items per page and products order
	if( get_option('permalink_structure') != '' ){
		$additional_links_separator = '?';
	}else{
		$additional_links_separator = '&';
	}
	if( !empty( $_GET['items_per_page'] ) ){
			$additional_links = $additional_links_separator . 'items_per_page=' . $_GET['items_per_page'];
			$additional_links_separator = '&';
	}
	if( !empty( $_GET['product_order'] ) )
		$additional_links .= $additional_links_separator . 'product_order=' . $_GET['product_order'];

	$additional_links = apply_filters('wpsc_pagination_additional_links', $additional_links);
	//end of additional links

	if(empty($totalpages)){
			$totalpages = $wp_query->max_num_pages;
	}
	if(empty($per_page))
		$per_page = (int)get_option('wpsc_products_per_page');

	$current_page = absint( get_query_var('paged') );
	if($current_page == 0)
		$current_page = 1;

	if(empty($page_link))
		$page_link = wpsc_a_page_url();

	//if there is no pagination
	if(!get_option('permalink_structure')) {
		$category = '?';
		if(isset($wp_query->query_vars['wpsc_product_category']))
			$category = '?wpsc_product_category='.$wp_query->query_vars['wpsc_product_category'];
		if(isset($wp_query->query_vars['wpsc_product_category']) && is_string($wp_query->query_vars['wpsc_product_category'])){

			$page_link = get_option('blogurl').$category.'&amp;paged';
		}else{
			$page_link = get_option('product_list_url').$category.'&amp;paged';
		}

		$separator = '=';
	}else{
		if ( isset( $wp_query->query_vars['wpsc_product_category'] ) ) {
			$category_id = get_term_by( 'slug', $wp_query->query_vars['wpsc_product_category'], 'wpsc_product_category' );
			$page_link = trailingslashit( get_term_link( $category_id, 'wpsc_product_category' ) );
		} else {
			$page_link = trailingslashit( get_option( 'product_list_url' ) );
		}
		$separator = '';
	}

	// If there's only one page, return now and don't bother
	if($totalpages == 1)
		return;
	// Pagination Prefix
	$output = __('Pages: ','wpsc');

	if(get_option('permalink_structure')){
		// Should we show the FIRST PAGE link?
		if($current_page > 1 && $showFirstPageLink)
			$output .= "<a href=\"". esc_url( $page_link . $additional_links ) . "\" title=\"" . __('First Page', 'wpsc') . "\">" . __('&laquo; First', 'wpsc') . "</a>";

		// Should we show the PREVIOUS PAGE link?
		if($current_page > 1) {
			$previous_page = $current_page - 1;
			if( $previous_page == 1 )
				$output .= " <a class='prev_page' href=\"". esc_url( $page_link . $additional_links ) . "\" title=\"" . __('Previous Page', 'wpsc') . "\">" . __('&lt; Previous', 'wpsc') . "</a>";
			else
				$output .= " <a class='prev_page' href=\"". esc_url( $page_link .$separator. $previous_page . $additional_links ) . "\" title=\"" . __('Previous Page', 'wpsc') . "\">" . __('&lt; Previous', 'wpsc') . "</a>";
		}
		$i =$current_page - $num_paged_links;
		$count = 1;
		if($i <= 0) $i =1;
		while($i < $current_page){
			if($count <= $num_paged_links){
				if($count == 1)
					$output .= " <a href=\"". esc_url( $page_link . $additional_links ) . "\" title=\"" . sprintf( __('Page %s', 'wpsc'), $i ) . " \">".$i."</a>";
				else
					$output .= " <a href=\"". esc_url( $page_link .$separator. $i . $additional_links ) . "\" title=\"" . sprintf( __('Page %s', 'wpsc'), $i ) . " \">".$i."</a>";
			}
			$i++;
			$count++;
		}
		// Current Page Number
		if($current_page > 0)
			$output .= "<span class='current'>$current_page</span>";

		//Links after Current Page
		$i = $current_page + $num_paged_links;
		$count = 1;

		if($current_page < $totalpages){
			while(($i) > $current_page){

				if($count < $num_paged_links && ($count+$current_page) <= $totalpages){
						$output .= " <a href=\"". esc_url( $page_link .$separator. ($count+$current_page) .$additional_links ) . "\" title=\"" . sprintf( __('Page %s', 'wpsc'), ($count+$current_page) ) . "\">".($count+$current_page)."</a>";
				$i++;
				}else{
				break;
				}
				$count ++;
			}
		}

		if($current_page < $totalpages) {
			$next_page = $current_page + 1;
			$output .= "<a href=\"". esc_url( $page_link  .$separator. $next_page . $additional_links ) . "\" title=\"" . __('Next Page', 'wpsc') . "\">" . __('Next &gt;', 'wpsc') . "</a>";
		}
		// Should we show the LAST PAGE link?
		if($current_page < $totalpages) {
			$output .= "<a href=\"". esc_url( $page_link  .$separator. $totalpages . $additional_links ) . "\" title=\"" . __('Last Page', 'wpsc') . "\">" . __('Last &raquo;', 'wpsc') . "</a>";
		}
	} else {
		// Should we show the FIRST PAGE link?
		if($current_page > 1 && $showFirstPageLink)
			$output .= "<a href=\"". esc_url( remove_query_arg('paged' ) ) . "\" title=\"" . __('First Page', 'wpsc') . "\">" . __('&laquo; First', 'wpsc') . "</a>";

		// Should we show the PREVIOUS PAGE link?
		if($current_page > 1) {
			$previous_page = $current_page - 1;
			if( $previous_page == 1 )
				$output .= " <a class='prev_page' href=\"". esc_url(remove_query_arg( 'paged' ) ). $additional_links . "\" title=\"" . __('Previous Page', 'wpsc') . "\">" . __('&lt; Previous', 'wpsc') . "</a>";
			else
				$output .= " <a class='prev_page' href=\"". esc_url(add_query_arg( 'paged', ($current_page - 1) )) . $additional_links . "\" title=\"" . __('Previous Page', 'wpsc') . "\">" . __('&lt; Previous', 'wpsc') . "</a>";
		}
		$i =$current_page - $num_paged_links;
		$count = 1;
		if($i <= 0) $i =1;
		while($i < $current_page){
			if($count <= $num_paged_links){
				if($i == 1)
					$output .= " <a href=\"". esc_url(remove_query_arg('paged' )) . "\" title=\"" . sprintf( __('Page %s', 'wpsc'), $i ) . " \">".$i."</a>";
				else
					$output .= " <a href=\"". esc_url(add_query_arg('paged', $i )) . "\" title=\"" . sprintf( __('Page %s', 'wpsc'), $i ) . " \">".$i."</a>";
			}
			$i++;
			$count++;
		}
		// Current Page Number
		if($current_page > 0)
			$output .= "<span class='current'>$current_page</span>";

		//Links after Current Page
		$i = $current_page + $num_paged_links;
		$count = 1;

		if($current_page < $totalpages){
			while(($i) > $current_page){

				if($count < $num_paged_links && ($count+$current_page) <= $totalpages){
						$output .= " <a href=\"". esc_url(add_query_arg( 'paged', ($count+$current_page) )) . "\" title=\"" . sprintf( __('Page %s', 'wpsc'), ($count+$current_page) ) . "\">".($count+$current_page)."</a>";
				$i++;
				}else{
				break;
				}
				$count ++;
			}
		}

		if($current_page < $totalpages) {
			$next_page = $current_page + 1;
			$output .= "<a class='next_page' href=\"". esc_url(add_query_arg( 'paged', $next_page )) . "\" title=\"" . __('Next Page', 'wpsc') . "\">" . __('Next &gt;', 'wpsc') . "</a>";
		}
		// Should we show the LAST PAGE link?
		if($current_page < $totalpages && $showLastPageLink) {
			$output .= "<a href=\"". esc_url(add_query_arg( 'paged', $totalpages )) . "\" title=\"" . __('Last Page', 'wpsc') . "\">" . __('Last &raquo;', 'wpsc') . "</a>";
		}
	}
	// Return the output.
	echo $output;
}

if ( ! function_exists( 'etheme_search_pagination' )):
/**
 *
 * Function that constract navigation for e-commerce search page.
 * 
 */

function etheme_search_pagination() {
	global $wp_query;

	$max = $wp_query->max_num_pages;
	
	if ($max > 1) {
		if (!$current = get_query_var('paged')) $current = 1;

		echo "Pages: ";

		if ($current != 1) {
			echo "<a href=\"". esc_url(add_query_arg( 'paged', 1 )) . "\" >" . __('&laquo; First', 'wpsc') . "</a>";
		}

		if( $current > 1 ) {
			echo "<a href=\"". esc_url(add_query_arg( 'paged', $current - 1 )) . "\" title=\"" . __('First Page', 'wpsc') . "\">" . __('&lt; Previous', 'wpsc') . "</a>";
		}

		$i=2;
		$count =0;
		while ( $current > 1 && $count != 2 ) {

			$count++;

			$page = $current - $i;

			$i--;

			$paging = "<a href=\"". esc_url(add_query_arg( 'paged', $page )) . "\" >" . $page . "</a>";
			if ($page <= 0) {
				$paging = '';
			}
			
			echo $paging;
		}

		$paging = '<span class="current" >' . $current . '</span>';
		echo $paging;


		$i=0;
		$count =0;
		while ( $i != $max - $current && $count != 2 ) {
			$i++;
			$count++;
			$page = $current + $i;
			$paging = "<a href=\"". esc_url(add_query_arg( 'paged', $page )) . "\" >" . $page . "</a>";

			echo $paging;
		}

		if( $current > 0 && $current != $max ) {
			echo "<a href=\"". esc_url(add_query_arg( 'paged', $current + 1 )) . "\" title=\"" . __('First Page', 'wpsc') . "\">" . __('Next &gt', 'wpsc') . "</a>";
		}

		if ($max != $current) {
			echo "<a href=\"". esc_url(add_query_arg( 'paged', $max )) . "\" >" . __('Last &raquo;', 'wpsc') . "</a>";
		}
	}
}
endif;

function etheme_get_categories_menu(){
    ?>
        <div class="block cats">
            <div class="block-head">
                <?php _e('Categories', ETHEME_DOMAIN);?>
            </div>
            <div class="block-content">
            	<?php $instance_categories = get_terms( 'wpsc_product_category', 'hide_empty=0&parent=0');
                foreach($instance_categories as $categories){
                    $term_id = $categories->term_id;
                    $term_name = $categories->name;
                    ?>
                    <div class='categories-group <?php if($term_id == wpsc_category_id()) echo 'current-parent opened' ; ?>' id='sidebar_categorisation_group_<?php echo $term_id; ?>'>
                        <h5 class='wpsc_category_title'><a href="<?php echo get_term_link( $categories, 'wpsc_product_category' ); ?>"><?php echo $term_name; ?></a><span class="btn-show"></span></h5>
                            <?php $subcat_args = array( 'taxonomy' => 'wpsc_product_category',
                            'title_li' => '', 'show_count' => 0, 'hide_empty' => 0, 'echo' => false,
                            'show_option_none' => '', 'child_of' => $term_id ); ?>
                            <?php if(get_option('show_category_count') == 1) $subcat_args['show_count'] = 1; ?>
                            <?php $subcategories = wp_list_categories( $subcat_args ); ?>
                            <?php if ( $subcategories ) { ?>
                            <ul class='wpsc_categories wpsc_top_level_categories'><?php echo $subcategories ?></ul>
                            <?php } ?>
                        <div class='clear_category_group'></div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <script type="text/javascript">
                <?php if(!etheme_get_option('cats_accordion')): ?>
                    var nav_accordion = false;
                <?php else: ?>
                    var nav_accordion = true;
                <?php endif ;?>
            </script>
        </div>
    <?php
}
