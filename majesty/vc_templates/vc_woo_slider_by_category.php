<?php
/**
 * Shortcode attributes
 * @var $cats
 * @var $per_page
 * @var $orderby
 * @var $order
 * @var $excerpt_length
 * @var $links_m_top
 * @var $cat_ids
 * @var $el_class
 *
 * @since Majest 1.2
 */

wp_enqueue_script('owl-carousel');
 
$output = $filter_html = $slider_html = $menu_tabs_container = $style = '';
$field = 'slug';
$get_term_by_id = false;
$atts 	= vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
if( empty( $cats ) && empty( $cat_ids ) ) {
	return;
}
if( ! empty( $links_m_top ) || $links_m_top != '15%' ) {
	$style = ' style="margin-top:'. esc_attr( $links_m_top ) .';"';
}
if( ! empty( $cat_ids ) ) {
	$get_term_by_id = true;
	$field = 'id';
	$cats = explode( ",", $cat_ids );
} elseif ( ! empty( $cats ) ) {
	$cats = explode( ",", $cats );
}
$categories_link  = array();
$categories_name  = array();
$filter_html 	 .= ' <div class="col-md-2 col-sm-3 col-xs-12 tab-menu"'. strip_tags( $style ) .'><div class="list-group">';

$i = 1;
foreach( $cats as $cat ) {
	$active = '';
	if( $i == 1 ) {
		$active = ' active';
	}
	if( $get_term_by_id ) {
		$category = get_term_by('id', $cat, 'product_cat', 'ARRAY_A');
	} else {
		$category = get_term_by('slug', $cat, 'product_cat', 'ARRAY_A');
	}
	
	$filter_html .= '<a href="#" class="list-group-item text-center'. $active .'">'. esc_attr( $category['name'] ) .'</a>';
	$categories_link[$i] = $category['term_id'];
	$categories_name[$i] = $category['name'];
	$i++;
}
$filter_html .= '</div></div>';

// Build Slider Content
$i = 1;
foreach( $cats as $cat ) {
	$active = '';
	if( $i == 1 ) {
		$active = ' active';
	}
	
	$ordering_args = WC()->query->get_catalog_ordering_args( esc_attr($orderby), esc_attr($order) );
	$meta_query    = WC()->query->get_meta_query();

	$args = array(
		'post_type'				=> 'product',
		'post_status' 			=> 'publish',
		'ignore_sticky_posts'	=> 1,
		'orderby' 				=> esc_attr($orderby),
		'order' 				=> esc_attr($order),
		'posts_per_page' 		=> $per_page,
		'meta_query' 			=> $meta_query,
		'tax_query' 			=> array(
			array(
				'taxonomy' 		=> 'product_cat',
				'terms' 		=> esc_attr( $cat ),
				'field' 		=> $field,
				'operator' 		=> 'IN'
			)
		)
	);
	
	$products = new WP_Query( $args );
	if ( ( $products ) && $products->have_posts() ) {
		$id = 'our-menu-slider-'. rand(1,9999);
		$slider_html .= '<div class="tab-content'. $active .'"><div id="'. esc_attr( $id ) .'" class="our-menu-slider">';
		
		while ( $products->have_posts() ) {
			$products->the_post();
			global $product;
			ob_start();
			global $wpdb;
		?>
				<div class="item">
					<?php echo $product->get_image('majesty-woo-slider-large', array( 'class' => 'lazyOwl' )); ?>
                        <div class="item_desc">
							<h3><?php echo esc_attr($product->get_title()); ?> <span class="price float-price"><?php echo $product->get_price_html(); ?></span></h3>
							<?php echo $product->get_rating_html(); ?>
							<?php echo sama_woocommerce_get_custom_excerpt( absint($excerpt_length) ); ?>
							<div class="form-group buttons"> 
							<?php echo  woocommerce_template_loop_add_to_cart(); // woocommerce_template_loop_add_to_cart ?>
							<a class="btn btn-gold" href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>"><i class="fa fa-link"></i></a>
							</div>
                        </div>
                </div>
		<?php
			$slider_html .= ob_get_clean();
		}
		$slider_html .= '</div><a href="'. esc_url( get_term_link($categories_link[$i], 'product_cat' ) ) .'" class="view_all btn btn-gold ">'. esc_html__('View ALL', 'theme-majesty') .' '. esc_attr( $categories_name[$i] ) .'</a></div>';
	}
	
	wp_reset_postdata();	
	$i++;
}

if( ! empty( $el_class ) ) {
	$el_class = ' '. $el_class;
}
$id = 'menu-tabs-slider-'. rand(1,9999);
$output  = '<div id="'. esc_attr($id) .'" class="menu_tabs woocommerce theme-menu-tabs-sliders'.esc_attr($el_class).'"><div class="our-menu-tab-container">';
$output	.= $filter_html;
$output .= '<div class="col-md-10 col-sm-9 col-xs-12 our-menu-tabs">';
$output .= $slider_html;
$output .= '</div>';
$output .= '</div></div>';
echo $output;