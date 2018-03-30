<?php
/**
 * Additional shortcodes for the theme.
 *
 * To create new shortcode, get for example the shortcode [sample] already written.
 * Replace it with your code for shortcode and for other shortcodes, duplicate the first
 * and continue following.
 *
 * CONVENTIONS:
 * - The name of function MUST be: yiw_sc_SHORTCODENAME_func.
 * - All html output of shortcode, must be passed by an hook: apply_filters( 'yiw_sc_SHORTCODENAME_html', $html ).
 * NB: SHORTCODENAME is the name of shortcode and must be written in lowercase.
 *
 * For example, we'll add new shortcode [sample], so:
 * - the function must be: yiw_sc_sample_func().
 * - the hooks to use will be: apply_filters( 'yiw_sc_sample_html', $html ).
 *
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
 */


/**
 * BEST SELLERS
 *
 * @description
 *    show a box with best sellers
 *
 * @example
 *   [best_sellers per_page="" columns=""]
 *
 * @attr
 *   title  - the title of the box
 *   description - the text below title
**/
function yiw_sc_best_sellers_func($atts, $content = null)
{
	global $woocommerce_loop;

	extract(shortcode_atts(array(
		'per_page' 	=> 12,
		'columns' 	=> 4
	), $atts));

    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering' );

	$args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts'	=> 1,
		'posts_per_page' => $per_page,
		'meta_key' 		=> 'total_sales',
		'orderby' 		=> 'meta_value_num'
	);

	ob_start();

	$products = new WP_Query( $args );

	$woocommerce_loop['loop'] = 0;
	$woocommerce_loop['columns'] = $columns;

	if ( $products->have_posts() ) : ?>

		<ul class="products <?php echo yiw_get_option( 'shop_products_style', 'ribbon' ); ?>">

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php function_exists('wc_get_template_part') ? wc_get_template_part( 'content', 'product' ) : woocommerce_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		</ul>

	<?php endif;

	wp_reset_query();

	$woocommerce_loop['loop'] = 0;

	return apply_filters( 'yiw_sc_yiw_best_sellers_html', ob_get_clean() );
}
add_shortcode('best_sellers', 'yiw_sc_best_sellers_func');


/**
 * ITEMS
 *
 * @description
 *    show the products
 *
 * @example
 *   [items per_page="" columns="" orderby="" order=""]
 *
 * @attr
 *   per_page  - the title of the box
 *   description - the text below title
**/
function yiw_sc_items_func($atts){
	global $woocommerce_loop;

  	if (empty($atts)) return;

	extract(shortcode_atts(array(
		'columns' 	=> 12,
		'per_page' 	=> 4,
	  	'orderby'   => 'title',
	  	'order'     => 'asc',
		'category'  => '',

		), $atts));

  	$args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'posts_per_page' => $per_page,
		'ignore_sticky_posts'	=> 1,
		'orderby' => $orderby,
		'order' => $order,

		'meta_query' => array(
			array(
				'key' 		=> '_visibility',
				'value' 	=> array('catalog', 'visible'),
				'compare' 	=> 'IN'
			)
		)
	);
	if(isset($atts['skus'])){
		$skus = explode(',', $atts['skus']);
	  	$skus = array_map('trim', $skus);
    	$args['meta_query'][] = array(
      		'key' 		=> '_sku',
      		'value' 	=> $skus,
      		'compare' 	=> 'IN'
    	);
  	}

	if(isset($atts['ids'])){
		$ids = explode(',', $atts['ids']);
	  	$ids = array_map('trim', $ids);
    	$args['post__in'] = $ids;
	}

    if(!empty( $category )) {
        $tax = 'product_cat';
        $category = array_map( 'trim', explode( ',', $category ) );
        if ( count($category) == 1 ) $category = $category[0];
        $args['tax_query'] = array(
            array(
                'taxonomy' => $tax,
                'field' => 'slug',
                'terms' => $category
            )
        );
    }

	ob_start();

	$products = new WP_Query( $args );

	$woocommerce_loop['loop'] = 0;
	$woocommerce_loop['columns'] = $columns;

	if ( $products->have_posts() ) : ?>

		<ul class="products <?php echo yiw_get_option( 'shop_products_style', 'ribbon' ); ?>">

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php function_exists('wc_get_template_part') ? wc_get_template_part( 'content', 'product' ) : woocommerce_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		</ul>

	<?php endif;

    if(function_exists('yiw_pagination'))  yiw_pagination();

	wp_reset_query();

	$woocommerce_loop['loop'] = 0;

	return ob_get_clean();
}
add_shortcode('items', 'yiw_sc_items_func');

/**
 * ADD TO CART
 *
 * @description
 *    Add a simple add to cart of a product
 *
 * @example
 *   [add_to_cart id=""]
 *
 * @attr
 *   id - the id of product
**/
function yiw_sc_add_to_cart_func($atts, $content = null) {
  	if (empty($atts)) return;

  	global $wpdb, $woocommerce, $post;

  	if ($atts['id']) :
  		$product_data = get_post( $atts['id'] );
	elseif ($atts['sku']) :
		$product_id = $wpdb->get_var($wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $atts['sku']));
		$product_data = get_post( $product_id );
	else :
		return;
	endif;

	if ($product_data->post_type!=='product') return;

	$product = function_exists( 'wc_setup_product_data' ) ? wc_setup_product_data( $product_data ) : $woocommerce->setup_product_data( $product_data );

	if (!$product->is_visible()) return;

	ob_start();

	// do not show "add to cart" button if product's price isn't announced
	if( $product->get_price() === '') return;

	switch ($product->product_type) :
		case "variable" :
			$link 	= get_permalink($post->ID);
			$label 	= apply_filters('variable_add_to_cart_text', __('Select options', 'yiw' ));
		break;
		case "grouped" :
			$link 	= get_permalink($post->ID);
			$label 	= apply_filters('grouped_add_to_cart_text', __('View options', 'yiw' ));
		break;
		case "external" :
			$link 	= get_permalink($post->ID);
			$label 	= apply_filters('external_add_to_cart_text', __('Read More', 'yiw' ));
		break;
		default :
			$link 	= esc_url( $product->add_to_cart_url() );
			$label 	= apply_filters('add_to_cart_text', yiw_get_option( 'shop_button_addtocart_label', __('Add to cart', 'yiw' )));
		break;
	endswitch;

	?><a href="<?php echo $link; ?>" class="button"><?php echo $label; ?></a><?php

    $html = ob_get_clean();

	return apply_filters( 'yiw_sc_add_to_cart_html', $html );
}
add_shortcode( 'add_to_cart', 'yiw_sc_add_to_cart_func' );

/**
 * PRODUCT SLIDER
 *
 * @description
 *    Add a product slider
 *
 * @example
 *   [product_slider cat=""]
 *
 * @attr
 *   id - the id of product
**/
function yiw_sc_product_slider_func($atts, $content = null) {

  	//if (empty($atts)) return;

	extract(shortcode_atts(array(
	  	'orderby'   => 'date',
	  	'order'     => 'desc',
	  	'cat'       => '',
	  	'category'  => '',
	  	'style'     => '',
        'items'     => -1
		), $atts));

  	global $wpdb, $woocommerce, $woocommerce_loop;

    if ( ! empty( $category ) && empty( $cat ) )
        $cat = $category;

  	if ( isset( $atts['latest'] ) && $atts['latest'] ) {
        $orderby = 'date';
        $order = 'desc';
    }

  	$args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'posts_per_page' => $items,
		'ignore_sticky_posts'	=> 1,
		'orderby' => $orderby,
		'order' => $order,
		'meta_query' => array(
			array(
				'key' 		=> '_visibility',
				'value' 	=> array('catalog', 'visible'),
				'compare' 	=> 'IN'
			)
		)
	);

	if(isset( $atts['featured']) && $atts['featured']){
    	$args['meta_query'][] = array(
      		'key' 		=> '_featured',
      		'value' 	=> 'yes'
    	);
  	}

	if(isset( $atts['best_sellers']) && $atts['best_sellers']){
    	$args['meta_key'] = 'total_sales';
    	$args['orderby'] = 'meta_value';
    	$args['order'] = 'desc';
  	}

	if(isset($atts['skus'])){
		$skus = explode(',', $atts['skus']);
	  	$skus = array_map('trim', $skus);
    	$args['meta_query'][] = array(
      		'key' 		=> '_sku',
      		'value' 	=> $skus,
      		'compare' 	=> 'IN'
    	);
  	}

	if(isset($atts['ids'])){
		$ids = explode(',', $atts['ids']);
	  	$ids = array_map('trim', $ids);
    	$args['post__in'] = $ids;
	}

    if ( ! empty( $cat ) ) {
        $tax = 'product_cat';
        $cat = array_map( 'trim', explode( ',', $cat ) );
        if ( count($cat) == 1 ) $cat = $cat[0];
        $args['tax_query'] = array(
            array(
                'taxonomy' => $tax,
                'field' => 'slug',
                'terms' => $cat
            )
        );
    }

    $woocommerce_loop['setLast'] = true;

    if ( empty( $style ) )
        $style = yiw_get_option( 'shop_products_style', 'ribbon' );

    //$style = yiw_get_option( 'shop_products_style', 'ribbon' );
    $woocommerce_loop['style'] = $style;

	$products_per_page = apply_filters( 'loop_shop_columns', 4 );

	$products = new WP_Query( $args );

	$woocommerce_loop['columns'] = $products_per_page;

    $i = 0;
    $html = '' ;
	if ( $products->have_posts() ) :
	    $html = '';

        while ( $products->have_posts() ) : $products->the_post();

		    ob_start();
            function_exists('wc_get_template_part') ? wc_get_template_part( 'content', 'product' ) : woocommerce_get_template_part( 'content', 'product' );
			$item = ob_get_clean();
	        $html .= $item;

	        $i++;
		endwhile; // end of the loop.

	endif;

	wp_reset_query();

	ob_start();
	echo '<div class="'.$style.'">';
	echo '<div class="products-slider '.$style.'"><ul class="products '.$style.'">'.$html.'</ul></div>';
	echo '<div class="for-mobile products-slider '.$style.'"><ul class="products '.$style.'">'.$html.'</ul></div>';
	echo '</div>';
    $html = ob_get_clean();

	$woocommerce_loop['loop'] = 0;
	unset( $woocommerce_loop['setLast'] );

	return apply_filters( 'yiw_sc_product_slider_html', $html );
}
add_shortcode( 'product_slider', 'yiw_sc_product_slider_func' );

/**
 * List all (or limited) product categories
 **/
function yiw_sc_product_categories_slider_func( $atts ) {
	global $woocommerce_loop;

	extract( shortcode_atts( array (
		//'number'     => null,
		'orderby'    => 'name',
		'order'      => 'ASC',
		'columns' 	 => '4',
		'hide_empty' => 1,
		'hierarchical' => true,
		'child_of'   => 0,
		'style'      => yiw_get_option( 'shop_products_style', 'ribbon' )
		), $atts ) );

	if ( isset( $atts[ 'ids' ] ) ) {
		$ids = explode( ',', $atts[ 'ids' ] );
	  	$ids = array_map( 'trim', $ids );
	} else {
		$ids = array();
	}

    if ( isset( $atts[ 'exclude' ] ) ) {
        $exclude = explode( ',', $atts[ 'exclude' ] );
        $exclude = array_map( 'trim', $exclude );
    } else {
        $exclude = array();
    }

    $woocommerce_loop['setLast'] = true;
    $woocommerce_loop['style'] = $style;
	$hide_empty = ( $hide_empty == true || $hide_empty == 1 ) ? 1 : 0;

  	$args = array(
  		//'number'     => $number,
  		'orderby'    => $orderby,
  		'order'      => $order,
  		'hide_empty' => $hide_empty,
		'hierarchical' => ( bool ) $hierarchical,
		'child_of'   => $child_of,
		'include'    => $ids,
        'exclude'    => $exclude
	);

  	$terms = get_terms( 'product_cat', $args );

    /**
     * Filter the object array for get terms result
     *
     * @param object $terms The array that include the terms objects
     * @param array  $ids   The categories ids specified on shortcode
     */
    $terms = apply_filters( 'yit_product_categories_slider_args', $terms, $ids );

	$products_per_page = apply_filters( 'loop_shop_columns', 4 );

  	$woocommerce_loop['columns'] = $columns;

  	ob_start();

    $html = $html_mobile = '';
  	if ( $terms ) {
		$i = 0;
		foreach ( $terms as $category ) {
            if( $category->parent != 0 && ! ( bool ) $hierarchical )
                { continue; }

            $wc_get_template = function_exists('wc_get_template') ? 'wc_get_template' : 'woocommerce_get_template';

			ob_start();
            $wc_get_template( 'content-product_cat.php', array(
				'category' => $category
			) );
			$item = ob_get_clean();
	        $html .= $item;

		}

	}

	wp_reset_query();

	ob_start();
	echo '<div class="products-slider categories '.$style.'"><ul class="products '.$style.'">'.$html.'</ul></div>';
	echo '<div class="for-mobile products-slider categories '.$style.'"><ul class="products '.$style.'">'.$html.'</ul></div>';
    $html = ob_get_clean();

	$woocommerce_loop['loop'] = 0;
	unset( $woocommerce_loop['setLast'], $woocommerce_loop['style'] );

	return apply_filters( 'yiw_sc_product_categories_slider_html', $html );
}
add_shortcode( 'product_categories_slider', 'yiw_sc_product_categories_slider_func' );

/**
 * List all (or limited) product categories
 **/
function yiw_product_categories( $atts ) {
	global $woocommerce_loop;

	extract( shortcode_atts( array (
		'number'     => null,
		'orderby'    => 'name',
		'order'      => 'ASC',
		'columns' 	 => '4',
		'hide_empty' => 1
		), $atts ) );

	if ( isset( $atts[ 'ids' ] ) ) {
		$ids = explode( ',', $atts[ 'ids' ] );
	  	$ids = array_map( 'trim', $ids );
	} else {
		$ids = array();
	}

	$hide_empty = ( $hide_empty == true || $hide_empty == 1 ) ? 1 : 0;

  	$args = array(
  		'number'     => $number,
  		'orderby'    => $orderby,
  		'order'      => $order,
  		'hide_empty' => $hide_empty,
		'include'    => $ids,
	);

  	$terms = get_terms( 'product_cat', $args );

  	$woocommerce_loop['columns'] = $columns;

    $wc_get_template = function_exists('wc_get_template') ? 'wc_get_template' : 'woocommerce_get_template';

  	ob_start();

  	if ( $terms ) {

  		echo '<ul class="products">';

		foreach ( $terms as $category ) {

            $wc_get_template( 'content-product_cat.php', array(
				'category' => $category
			) );

		}

		echo '</ul>';

	}

	wp_reset_query();

	return ob_get_clean();
}
add_shortcode( 'product_categories', 'yiw_product_categories' );


/**
 * RESET WOOCOMMERCE LOOP
 *
 * @description
 *    set the loop to 0
 *
 * @example
 *   [reset_woocommerce_loop]
**/
function yiw_sc_reset_woocommerce_loop_func($atts){
	global $woocommerce_loop;

	$woocommerce_loop['loop'] = 0;
}
add_shortcode('reset_woocommerce_loop', 'yiw_sc_reset_woocommerce_loop_func');

/**
 * RATING
 *
 * @description
 *    Print rating star of product id
 *
 * @example
 *   [rating id=""]
**/
function yiw_rating( $atts ) {
	global $woocommerce_loop;

	extract( shortcode_atts( array (
		'id'     => null,
	), $atts ) );

	global $wpdb;

	$count = $wpdb->get_var( $wpdb->prepare("
		SELECT COUNT(meta_value) FROM $wpdb->commentmeta
		LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		WHERE meta_key = 'rating'
		AND comment_post_ID = %d
		AND comment_approved = '1'
		AND meta_value > 0
	", $id ) );

	$rating = $wpdb->get_var( $wpdb->prepare("
		SELECT SUM(meta_value) FROM $wpdb->commentmeta
		LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		WHERE meta_key = 'rating'
		AND comment_post_ID = %d
		AND comment_approved = '1'
	", $id ) );

	if ( $count > 0 ) {

	$average = number_format($rating / $count, 2);

	$html = '<div class="star-rating shortcode" title="'.sprintf(__( 'Rated %s out of 5', 'yiw' ), $average).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'yiw' ).'</span></div>';

	} else {

        $html = apply_filters( 'yiw_no_rating_text_sc', __('No Rating', 'yiw') );

	}

	//wp_reset_query();

	return $html;
}
add_shortcode( 'rating', 'yiw_rating' );

/**
 * Add t cart (with variations)
 *
 * @description
 *    Print add to cart and price
 *
 * @example
 *   [yiw_add_to_cart id="" attribute_id="" show_price="yes|no" show_cart="yes|no" ]
**/
function yiw_add_to_cart( $atts ) {


	extract( shortcode_atts( array (
		'id'     => null,
		'attribute_id'  => null,
		'show_price'    => 'yes',
		'show_cart'     => 'yes',
	), $atts ) );

	global $product;

	$id = ( isset($id) ) ? (int) $id : '';
	$attribute_id = ( isset($attribute_id) ) ? (int) $attribute_id : '';
	$show_price = ( isset($show_price) && $show_price == 'yes' ) ? true : false;
	$show_cart = ( isset($show_cart) && $show_cart == 'yes' ) ? true : false;
    $label 	= apply_filters('add_to_cart_text', yiw_get_option( 'shop_button_addtocart_label', __('Add to cart', 'yiw')));

	$product = get_product( $id );
	if ( ! $product->is_purchasable() ) return '';
	?>


	<?php if ( $product->is_in_stock() ) : ?>
        <?php ob_start(); ?>
		<div class="sc_addcart">
			<?php if ($product->product_type == 'simple') : ?>
				<?php if ( $show_price ) echo '<span class="price">'.$product->get_price_html().'</span>'; ?>
				<?php if ( $show_cart ) : ?>
					<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>
					 	<button type="submit" class="single_add_to_cart_button button alt"><?php echo $label; ?></button>
					</form>
				<?php endif ?>
			<?php elseif ($product->product_type == 'variable' && $attribute_id != '') : ?>
				<?php
					$attributes = $product->get_available_variations();
					foreach ($attributes as $key){
						if ( $key['variation_id'] == $attribute_id ):
							$select = '';
							foreach ( $key['attributes'] as $key => $value ){
								$select .= '<select name="' . $key . '" style="display: none;">
							    				<option value="' . $value . '" class="active" selected="selected"></option>
							    			</select>';
							}
						endif;
					}
				?>
				<?php if ( $show_price ) :
					$variation = $product->get_child( $attribute_id );
					echo $variation->get_price_html();
				endif ?>
				<?php if ( $show_cart ) : ?>
					<form data-product_id="<?php echo $id ?>" enctype="multipart/form-data" method="post" class="variations_form cart group" action="<?php echo esc_url( $product->add_to_cart_url() ); ?>">
						<input type="hidden" value="1" name="quantity">
					    <div class="variations">
			            	<?php echo $select ?>
					    </div>
						<input type="hidden" value="<?php echo $attribute_id ?>" name="variation_id">
						<button class="single_add_to_cart_button button" type="submit">Add to cart</button>
						<input type="hidden" value="<?php echo $id ?>" name="product_id">
					</form>
				<?php endif; ?>
			<?php endif; ?>
		</div>
        <?php return ob_get_clean();?>
	<?php endif;

	return '';
}
add_shortcode( 'yiw_add_to_cart', 'yiw_add_to_cart' );

?>