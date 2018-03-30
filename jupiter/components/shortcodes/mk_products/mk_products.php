<?php
global $product, $woocommerce_loop, $woocommerce, $mk_options, $post;
$product_rating = '';

if( ! class_exists( 'WooCommerce' ) ) {
	echo 'WooCommerce Plugin is not installed!';
	return false;
}

wp_enqueue_script( 'wc-add-to-cart-variation' );

$path = pathinfo(__FILE__) ['dirname'];

include ($path . '/config.php');

$id = Mk_Static_Files::shortcode_id();

do_action( 'woocommerce_before_single_product' );


$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
switch ($display) {
	case 'recent':
	   $args = array(
		    'post_type'             => 'product',
		    'post_status'           => 'publish',
		    'ignore_sticky_posts'   => 1,
		    'posts_per_page'        => $count,
		    'orderby'               => 'date',
		    'order'                 => 'desc',
		    'paged'                 => $paged,
		    'meta_query'            => WC()->query->get_meta_query(),
		);
		break;

	case 'featured':
		$meta_query   = WC()->query->get_meta_query();
		$meta_query[] = array(
			'key'   => '_featured',
			'value' => 'yes'
		);
		$args = array(
		    'post_type'             => 'product',
		    'post_status'           => 'publish',
		    'ignore_sticky_posts'   => 1,
		    'posts_per_page'        => $count,
		    'orderby'               => 'date',
		    'order'                 => 'desc',
		    'paged'                 => $paged,
		    'meta_query'            => $meta_query,
		);
		break;

	case 'top_rated':
		add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
	   $args = array(
		    'post_type'             => 'product',
		    'post_status'           => 'publish',
		    'ignore_sticky_posts'   => 1,
		    'posts_per_page'        => $count,
		    'orderby'               => $orderby,
		    'order'                 => $order,
		    'paged'                 => $paged,
		    'meta_query'            => WC()->query->get_meta_query(),
		);
		break;

	case 'products_on_sale':
	   $args = array(
		    'post_type'             => 'product',
		    'post_status'           => 'publish',
		    'ignore_sticky_posts'   => 1,
		    'posts_per_page'        => $count,
		    'orderby'               => $orderby,
		    'order'                 => $order,
		    'paged'                 => $paged,
		    'meta_query'            => WC()->query->get_meta_query(),
		    'post__in'					 => array_merge( array( 0 ), wc_get_product_ids_on_sale() ),
		);
		break;

	case 'best_sellings':
		$args = array(
		    'post_type'             => 'product',
		    'post_status'           => 'publish',
		    'ignore_sticky_posts'   => 1,
		    'posts_per_page'        => $count,
		    'orderby'               => 'meta_value_num',
		    'order'                 => $order,
		    'orderby'               => $orderby,
		    'paged'                 => $paged,
		    'meta_key'            	 => 'total_sales',
		    'meta_query'            => WC()->query->get_meta_query(),
		);
		break;
}

		if(!empty($category)) {
			$args['tax_query'] = array(
				array(
					'taxonomy' 		=> 'product_cat',
					'terms' 		=> array_map( 'sanitize_title', explode( ',', $category ) ),
					'field' 		=> 'slug',
				)
			);
		}

if (isset($posts) && !empty($posts)) {
    $args['post__in'] = explode(',', $posts);
}

$class[] = $layout.'-layout';
$class[] = $layout.'mk--row';
$class[] = $el_class;

?>
<div id="mk-product-loop-<?php echo $id; ?>" class="mk-product-loop grid--float <?php echo implode(' ', $class); ?>">
	<section class="products js-el mk--row" data-mk-component="Grid" data-grid-config='{"item":".product"}'>
<?php

/**
 * Product Loop
 * ==================================================================================*/
$query = new WP_Query( $args );
if($query->have_posts()):
    while ( $query->have_posts() ) : $query->the_post();
		global $product;

        $product_id 		= get_the_ID();
        $uid 				= uniqid();
        $woocommerce_cat 	= $mk_options['woocommerce_catalog'];
        $grid_width 		= $mk_options['grid_width'];
        $content_width 		= $mk_options['content_width'];
        $height 			= $mk_options['woo_loop_img_height'];
        $product_type 		= $product->product_type;
        $hover_image_src 	= '';

        // thumbnail
        switch ($columns) {
		case 4:
			$column_class = 'mk--col--3-12';
			$image_width = round($grid_width/4) - 28;
		break;
		case 3:
			$column_class = 'mk--col--4-12';
			$image_width = round($grid_width/3) - 33;
		break;
		case 2:
			$column_class = 'mk--col--1-2';
			$image_width = round($grid_width/2) - 38;
		break;

		default:
			$column_class = 'mk--col--1-2';
			$image_width = round($grid_width/2) - 38;
		break;
	}

    if ( has_post_thumbnail() ) {

		$featured_image_src = Mk_Image_Resize::resize_by_id_adaptive( get_post_thumbnail_id(), $image_size, $image_width, $height, $crop = false, $dummy = true);

		$product_gallery = get_post_meta( $post->ID, '_product_image_gallery', true );

		if ( !empty( $product_gallery ) ) {
			$gallery = explode( ',', $product_gallery );
			$hover_image_id  = $gallery[0];
			$hover_image_src = Mk_Image_Resize::resize_by_id_adaptive($hover_image_id, $image_size, $image_width, $height, $crop = false, $dummy = true);
		}
	}

	//  product rating
	if($mk_options['woocommerce_catalog'] == 'false') {
		if($product->get_rating_html()) {
			$product_rating = $product->get_rating_html();
		}
	}


	// check product stock, add cart a tag url, add cart a tag label and add icon class
	if ( ! $product->is_in_stock() ) {
		$link  			= apply_filters( 'out_of_stock_add_to_cart_url', esc_url( get_permalink( $product->id ) ) );
		$label  			= apply_filters( 'out_of_stock_add_to_cart_text', __( 'READ MORE', 'mk_framework' ) );
		$icon_class 		= 'mk-moon-search-3';
		$out_of_stock_badge = '<span class="mk-out-stock"><span>'.__( 'Out of Stock', 'mk_framework' ).'</span></span>';
	}else {
		$out_of_stock_badge = '';
		switch ( $product->product_type ) {
			case "variable" :
				$link  		= apply_filters( 'variable_add_to_cart_url', esc_url( get_permalink( $product->id ) ) );
				$label  		= apply_filters( 'variable_add_to_cart_text', __( 'Select Options', 'mk_framework' ) );
				$icon_class 	= 'mk-icon-plus';
				break;
			case "grouped" :
				$link  		= apply_filters( 'grouped_add_to_cart_url', esc_url( get_permalink( $product->id ) ) );
				$label  		= apply_filters( 'grouped_add_to_cart_text', __( 'View Options', 'mk_framework' ) );
				$icon_class 	= 'mk-moon-search-3';
				break;
			case "external" :
				$link 	 	= apply_filters( 'external_add_to_cart_url', esc_url( get_permalink( $product->id ) ) );
				$label  		= apply_filters( 'external_add_to_cart_text', __( 'Read More', 'mk_framework' ) );
				$icon_class 	= 'mk-moon-search-3';
				break;
			default :
				$link  		= apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
				$label  		= apply_filters( 'add_to_cart_text', __( 'Add to Cart', 'mk_framework' ) );
				$icon_class 	= 'mk-moon-cart-plus';
				break;
			}
	}

	// check product on sale
	if( $product->is_on_sale() ) {
		$sale_badge = apply_filters('woocommerce_sale_flash', '<span class="mk-onsale"><span>'.__( 'Sale', 'mk_framework' ).'</span></span>', $post, $product);
	}else {
		$sale_badge = '';
	}
	if($mk_options['woocommerce_loop_show_desc'] == 'true') {
		$item_desc = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
	}else {
		$item_desc = '';
	}

	$shortcodeViewAtts = array(
		'product_id' 				=> $product_id,
		'product_type'				=> $product_type,
		'product_col' 				=> $column_class,
		'thumb_image' 				=> $featured_image_src,
		'thumb_title' 				=> get_the_title(),
		'thumb_hover_image' 		=> $hover_image_src,
		'product_rating' 			=> $product_rating,
		'show_quickview'			=> $show_quickview,
		'show_category'			=> $show_category,
		'show_rating'				=> $show_rating,
		'product_link' 			=> esc_url( get_permalink() ),
		'product_add_link' 		=> $link,
		'product_add_label' 		=> $label,
		'product_add_icon' 		=> $icon_class,
		'out_of_stock_badge' 	=> $out_of_stock_badge,
		'sale_of_stock_badge' 	=> $sale_badge,
		'item_desc'					=> $item_desc,
		'category_name'			=> $product->get_categories(', '),
		'animation'					=> $animation,
	);


        echo mk_get_shortcode_view( 'mk_products',  'loop-styles/product-loop-' . $layout,  true,  $shortcodeViewAtts );

        $shortcodeViewAtts = array();

    endwhile;
    wp_reset_postdata();
endif;

?>
</section>
</div>

<?php if ($pagination != 'false') { ?>
	<nav class="mk-woocommerce-pagination">
		<?php
			echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
				'base'         => esc_url( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', htmlspecialchars_decode( get_pagenum_link( 999999999 ) ) ) ) ),
				'format'       => '',
				'current'      => max( 1, get_query_var( 'paged' ) ),
				'total'        => $query->max_num_pages,
				'prev_text'    => Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-icon-angle-left'),
				'next_text'    => Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-icon-angle-right'),
				'type'         => 'list',
				'end_size'     => 3,
				'mid_size'     => 3
			) ) );
		?>
	</nav>

<?php 
}

/**
 * Custom CSS Output
 * ==================================================================================*/
if(!empty($color_product_title)) {	
	Mk_Static_Files::addCSS('
		#mk-product-loop-'.$id.' .product-title,
		#mk-product-loop-'.$id.' .product-title a,
		#mk-product-loop-'.$id.' .mk-love-holder a .mk-love-count {
			color: '.$color_product_title.';
		}
		#mk-product-loop-'.$id.' .mk-love-holder svg {
			fill: '.$color_product_title.';
		}
	', $id);
}

if(!empty($color_product_category)) {	
	Mk_Static_Files::addCSS('
		#mk-product-loop-'.$id.' .product-categories a {
			color: '.$color_product_category.';
		}
	', $id);
}

if(!empty($color_product_rating)) {	
	Mk_Static_Files::addCSS('
		#mk-product-loop-'.$id.' .product-item-rating .star-rating span:before {
			color: '.$color_product_rating.' !important;
		}
	', $id);
}

if(!empty($color_product_price)) {	
	Mk_Static_Files::addCSS('
		#mk-product-loop-'.$id.' .mk-price .amount {
			color: '.$color_product_price.';
		}
	', $id);
}

if(!empty($color_product_price_orginal)) {	
	Mk_Static_Files::addCSS('
		#mk-product-loop-'.$id.' .mk-price del .amount {
			color: '.$color_product_price_orginal.';
		}
	', $id);
}

if(!empty($color_product_price_sale)) {	
	Mk_Static_Files::addCSS('
		#mk-product-loop-'.$id.' .mk-price ins .amount {
			color: '.$color_product_price_sale.';
		}
	', $id);
}

if($color_product_border != '') {
	Mk_Static_Files::addCSS('
		#mk-product-loop-'.$id.' .products .mk-product-holder .product-link{
			border: 1px solid '.$color_product_border.';
		}
	', $id);
}

if( $layout == 'open' ) {
	Mk_Static_Files::addCSS('
		.product-quick-view {
			max-width: '.$mk_options['grid_width'].'px;
		}
	', $id);
}
