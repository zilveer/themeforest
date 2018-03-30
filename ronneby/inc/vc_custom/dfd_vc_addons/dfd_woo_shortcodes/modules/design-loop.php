<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
function Dfd_Woocommerce_Loop_module($atts){
	global $woocommerce, $dfd_ronneby;
	$products_style = $heading_class = $buttons_wrap_class = $buttons_color_scheme = $content_alignment = $css_rules =  '';
	
	$atts = vc_map_get_attributes( 'woocomposer_grid', $atts );
	extract( $atts );
	
	$output = '';
	$image_size = apply_filters( 'single_product_large_thumbnail_size', 'shop_single' );
	
	if($products_style == '') {
		$products_style = 'style-1';
	}
	
	$post_count = '12';
	/* $output .= do_shortcode($content); */
	if($shortcode !== ''){
		$new_shortcode = rawurldecode( base64_decode( strip_tags( $shortcode ) ) );
	}
	
	$pattern = get_shortcode_regex();
	$shortcode_str = $short_atts = '';
	preg_match_all("/".$pattern."/", $new_shortcode, $matches);
	$shortcode_str = str_replace('"','',str_replace(" ","&",trim($matches[3][0])));
	$short_atts = parse_str($shortcode_str);//explode("&",$shortcode_str);
	if(isset($matches[2][0])): $display_type = $matches[2][0]; else: $display_type = ''; endif;
	if(!isset($columns)): $columns = '4'; endif;
	if(isset($per_page)): $post_count = $per_page; endif;
	if(isset($number)): $post_count = $number; endif;
	if(!isset($order)): $order = 'asc'; endif;
	if(!isset($orderby)): $orderby = 'date'; endif;
	if(!isset($category)): $category = ''; endif;
	if(!isset($ids)): $ids = ''; endif;
	if($ids){
		$ids = explode( ',', $ids );
		$ids = array_map( 'trim', $ids );
	}
	$col = $columns;
	if($columns == "2") $columns = 6;
	elseif($columns == "3") $columns = 4;
	elseif($columns == "4") $columns = 3;
	$meta_query = '';
	if($display_type == "recent_products"){
		$meta_query = WC()->query->get_meta_query();
	}
	if($display_type == "featured_products"){
		$meta_query = array(
			array(
				'key' 		=> '_visibility',
				'value' 	  => array('catalog', 'visible'),
				'compare'	=> 'IN'
			),
			array(
				'key' 		=> '_featured',
				'value' 	  => 'yes'
			)
		);
	}
	if($display_type == "top_rated_products"){
		add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
		$meta_query = WC()->query->get_meta_query();
	}
	$args = array(
		'post_type'			=> 'product',
		'post_status'		  => 'publish',
		'ignore_sticky_posts'  => 1,
		'posts_per_page' 	   => $post_count,
		'orderby' 			  => $orderby,
		'order' 				=> $order,
		'meta_query' 		   => $meta_query
	);
	if($display_type == "sale_products"){
		$product_ids_on_sale = woocommerce_get_product_ids_on_sale();
		$meta_query = array();
		$meta_query[] = $woocommerce->query->visibility_meta_query();
	    $meta_query[] = $woocommerce->query->stock_status_meta_query();
		$args['meta_query'] = $meta_query;
		$args['post__in'] = $product_ids_on_sale;
	}
	if($display_type == "best_selling_products"){
		$args['meta_key'] = 'total_sales';
		$args['orderby'] = 'meta_value_num';
		$args['meta_query'] = array(
				array(
					'key' 		=> '_visibility',
					'value' 	=> array( 'catalog', 'visible' ),
					'compare' 	=> 'IN'
				)
			);
	}
	if($display_type == "product_category"){
		$args['tax_query'] = array(
			array(
				'taxonomy' 	 => 'product_cat',
				'terms' 		=> array( esc_attr($category)),
				'field' 		=> 'name',
				'operator' 	 => 'IN'
			)
		);
	}
	if($display_type == "product_categories"){
		$args['tax_query'] = array(
			array(
				'taxonomy' 	 => 'product_cat',
				'terms' 		=> $ids,
				'field' 		=> 'term_id',
				'operator' 	 => 'IN'
			)
		);
	}
	$test = '';
	
	if($buttons_color_scheme != '') {
			$buttons_wrap_class .= $buttons_color_scheme;
	} elseif(!isset($dfd_ronneby['dfd_woocommerce_templates_path']) || $dfd_ronneby['dfd_woocommerce_templates_path'] != '_old') {
		if(isset($dfd_ronneby['woo_products_buttons_color_scheme']) && !empty($dfd_ronneby['woo_products_buttons_color_scheme']))
			$buttons_wrap_class .= $dfd_ronneby['woo_products_buttons_color_scheme'];
	}
	
	if(vc_is_inline()){
		$test = "wcmp_vc_inline";
	}
	
	if(isset($dfd_ronneby['woo_category_content_alignment']) && !empty($dfd_ronneby['woo_category_content_alignment'])) {
		$heading_class .= ' '.str_replace('dfd-buttons','text',$dfd_ronneby['woo_category_content_alignment']);
	}
	
	$catalogue_mode = (isset($dfd_ronneby['woocommerce_catalogue_mode']) && $dfd_ronneby['woocommerce_catalogue_mode']);
	
	$column_class = 'columns mobile-two dfd-loop-shop-responsive ';
	$column_class .= dfd_num_to_string($col);
	$column_class .= ' '.$products_style;
	
	$uniq_id = uniqid('dfd-products-grid-');
	
	if(isset($mask_style) && $mask_style != '') {
		if($mask_style == 'color' && $mask_color !== ''){
			$css_rules .= '#'.esc_attr($uniq_id).'.products .product.style-2 .woo-cover a.link, #'.esc_attr($uniq_id).'.products .product.style-3 .woo-cover a.link {background:'.esc_attr($mask_color).';}';
		} elseif($mask_style == 'gradient' && $mask_gradient != '') {
			$mask_opacity = (isset($mask_opacity) && $mask_opacity != '') ? $mask_opacity : .8;
			$css_rules .= '#'.esc_attr($uniq_id).'.products .product.style-2 .woo-cover a.link, #'.esc_attr($uniq_id).'.products .product.style-3 .woo-cover a.link {background:'.esc_attr($mask_gradient).';opacity: 0;}';
			$css_rules .= '#'.esc_attr($uniq_id).'.products .product.style-2 .woo-cover a.link, #'.esc_attr($uniq_id).'.products .product.style-3 .woo-cover a.link {opacity: '.esc_attr($mask_opacity).';}';
		}
	}
	
	$output .= '<div class="woocommerce columns-'.esc_attr($columns).'">';
		$output .= '<div id="'.esc_attr($uniq_id).'" class="products row">';
		$query = new WP_Query( $args );
			ob_start();
			if($query->have_posts()):
				while ( $query->have_posts() ) : $query->the_post();
				$subtitle = get_post_meta(get_the_ID(), 'dfd_product_product_subtitle', true);
				$post = get_post(get_the_id());
				$product_desc = $post->post_excerpt;
				
				if(isset($excerpt_length) && $excerpt_length != '')
					$product_desc = wp_trim_words($product_desc, $excerpt_length, '');
					
			?>
					<div <?php post_class($column_class); ?>>
						<div class="prod-wrap <?php echo esc_attr($content_alignment) ?>">

							<?php do_action('woocommerce_before_shop_loop_item'); ?>
							<div class="woo-cover">
								<div class="prod-image-wrap woo-entry-thumb">
									<?php
									if(function_exists('woocommerce_show_product_loop_sale_flash'))
										woocommerce_show_product_loop_sale_flash();

									if(function_exists('woocommerce_template_loop_product_thumbnail'))
										woocommerce_template_loop_product_thumbnail($buttons_color_scheme, $content_alignment);
									?>
									<a href="<?php the_permalink(); ?>" class="link"></a>
								</div>
							</div>
							<?php if(!$catalogue_mode): ?>
								<div class="woo-title-wrap <?php echo esc_attr($heading_class) ?>">
									<div class="heading">
										<div class="dfd-folio-categories">
											<?php get_template_part('templates/woo', 'term'); ?>
										</div>
										<div class="box-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
										<?php if(!empty($subtitle)) : ?>
											<div class="subtitle"><?php echo $subtitle; ?></div>
										<?php endif; ?>
										<div class="woo-price-cart-wrap">
											<div class="price-wrap">
												<?php do_action('woocommerce_after_shop_loop_item_title'); ?>
											</div>
										</div>
										<div class="rating-section">
											<?php woocommerce_get_template_part('loop/rating'); ?>
										</div>
									</div>
									<?php if(strcmp($products_style , 'style-1') !== 0 && $product_desc != '') : ?>
										<div class="description">
											<?php echo $product_desc ?>
										</div>
									<?php endif; ?>
								</div>
								<?php if(strcmp($products_style , 'style-2') === 0) : ?>
									<div class="additional-price <?php echo esc_attr($buttons_wrap_class . ' ' . $content_alignment) ?>">
										<div>
											<?php do_action('woocommerce_after_shop_loop_item_title') ?>
										</div>
									</div>
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</div>
				<?php endwhile;
			endif;
			$output .= ob_get_clean();

		$output .= '</div>';
		if(!empty($css_rules)) : ?>
			<script type="text/javascript">
				(function($) {
					"use strict";
					$('head').append('<style><?php echo $css_rules; ?></style>');
				})(jQuery);
			</script>
		<?php endif;
	$output .= '</div>';
	if($display_type == "top_rated_products"){
		remove_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
	}
	wp_reset_postdata();
	return $output;
}