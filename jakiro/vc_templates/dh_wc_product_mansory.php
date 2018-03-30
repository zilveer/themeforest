<?php
$output ='';
extract(shortcode_atts(array(
	'category'=>'',
	'per_page'=>'8',
	'columns'=>'4',
	'show'=>'',
	'orderby'=>'date',
	'order'=>'asc',
	'hide_all_filter'=>'',
	'hide_free'=>'',
	'show_hidden'=>'',
	'pagination'=>'infinite_scroll',
	'loadmore_text'=>esc_html__('Load More','jakiro'),
	'el_class' => ''
),$atts));
global $woocommerce_loop;
$woocommerce_loop['columns'] = $columns;


$category_arr = explode(',', $category);
$category_arr = array_filter($category_arr);

/**
 * script
 * {{
 */
wp_enqueue_script('vendor-isotope');
wp_enqueue_script('vendor-carouFredSel');
wp_enqueue_script( 'wc-add-to-cart-variation' );

$query_args = array(
	'posts_per_page' => $per_page,
	'post_status'    => 'publish',
	'post_type'      => 'product',
	'order'          => $order,
	'meta_query'     => array(),
);
if ( !empty( $show_hidden ) ) {
	$query_args['meta_query'][] = WC()->query->visibility_meta_query();
	$query_args['post_parent']  = 0;
}

if ( !empty( $hide_free ) ) {
	$query_args['meta_query'][] = array(
		'key'     => '_price',
		'value'   => 0,
		'compare' => '>',
		'type'    => 'DECIMAL',
	);
}

$query_args['meta_query'][] = WC()->query->stock_status_meta_query();
$query_args['meta_query']   = array_filter( $query_args['meta_query'] );

switch ( $show ) {
	case 'featured' :
		$query_args['meta_query'][] = array(
		'key'   => '_featured',
		'value' => 'yes'
			);
			break;
	case 'onsale' :
		$product_ids_on_sale    = wc_get_product_ids_on_sale();
		$product_ids_on_sale[]  = 0;
		$query_args['post__in'] = $product_ids_on_sale;
		break;
}
switch ( $orderby ) {
	case 'price' :
		$query_args['meta_key'] = '_price';
		$query_args['orderby']  = 'meta_value_num';
		break;
	case 'rand' :
		$query_args['orderby']  = 'rand';
		break;
	case 'sales' :
		$query_args['meta_key'] = 'total_sales';
		$query_args['orderby']  = 'meta_value_num';
		break;
	default :
		$query_args['orderby']  = 'date';
}


$itemSelector = '';
ob_start();
if(is_array($category_arr) && count($category_arr) > 0):
	?>
	<div data-itemselector="<?php echo esc_attr($itemSelector)  ?>"  data-layout="masonry" data-masonry-column="<?php echo esc_attr($columns)?>" class="woocommerce products-masonry masonry <?php echo esc_attr($el_class)?>">
		<div class="masonry-filter">
			<div class="filter-action filter-action-center">
				<ul data-filter-key="filter">
					<?php if(empty($hide_all_filter)):?>
					<li>
						<a class="selected" href="#" data-filter-value= "*"><?php echo esc_html__('All','woow') ?></a>
					</li>
					<?php endif;?>
					<?php 
					$filter_flag = false;
					?>
					<?php foreach ($category_arr as $cat):?>
						<?php if($cat):?>
							<?php $category = get_term_by('slug',$cat, 'product_cat'); ?>
							<?php if($category): ?>
							<li>
								<a <?php if(!empty($hide_all_filter) && !$filter_flag):$filter_flag=true?> data-masonry-toogle="selected" <?php endif;?> href="#" data-filter-value= ".<?php echo esc_attr($category->slug) ?>"><?php echo esc_html($category->name); ?></a>
							</li>
							<?php endif;?>
						<?php endif;?>
					<?php endforeach;?>
				</ul>
			</div>
		</div>
		<div class="products-masonry-wrap">
			<?php 
			$loop_class =' masonry-wrap';
			$post_col = 'product masonry-item ';
			$post_col .= ' col-md-'.(12/$columns).' col-sm-6';
			?>
			<ul class="products masonry-products row <?php echo esc_attr($loop_class)?>">
				<?php 
				$products_cache = array();
				foreach ($category_arr as $cat):
				$query_args['tax_query'] = array(
					array(
						'taxonomy' 		=> 'product_cat',
						'terms' 		=> array($cat),
						'field' 		=> 'slug',
					)
				);
				$products = new WP_Query($query_args);
				if($products->have_posts()):
						while ( $products->have_posts() ) :
							$products->the_post(); global $post,$product;
							if(in_array($post->ID, $products_cache))
								continue;
							$products_cache[] = $post->ID;
							$cat_class = array();
							if ( is_object_in_taxonomy( $post->post_type, 'product_cat' ) ) {
								foreach ( (array) get_the_terms($post->ID,'product_cat') as $cat ) {
									if ( empty($cat->slug ) )
										continue;
									$cat_class[] =  sanitize_html_class($cat->slug, $cat->term_id);
								}
							}
							?>
							<li class="<?php echo esc_attr($post_col)?> <?php echo implode(' ', $cat_class)?>">
								<div class="product-container">
									<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
									<figure>
										<div class="product-wrap">
											<div class="product-images">
												<a href="<?php the_permalink(); ?>">
													<?php if ( !$product->is_in_stock() ) : ?>            
										            	<span class="out_of_stock"><?php esc_html_e( 'Out of stock', 'jakiro' ); ?></span>            
													<?php endif; ?>
													<?php
														/**
														 * woocommerce_before_shop_loop_item_title hook
														 *
														 * @hooked woocommerce_show_product_loop_sale_flash - 10
														 * @hooked woocommerce_template_loop_product_thumbnail - 10
														 */
														do_action( 'woocommerce_before_shop_loop_item_title' );
													?>
												</a>
												
												<?php 
												DH_Woocommerce::instance()->template_loop_quickview();
												?>
											</div>
										</div>
										<figcaption>
											<div class="shop-loop-product-info">
												<div class="info-title">
													<h3 class="product_title"><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h3>
												</div>
												<div class="info-meta">
													<div class="info-price">
														<?php woocommerce_template_loop_price(); ?>
													</div>
													<div class="loop-add-to-cart">
														<?php woocommerce_template_loop_add_to_cart();?>
													</div>
												</div>
											</div>
										</figcaption>
									</figure>
								</div>
							</li>
							<?php
							endwhile;
						endif;
					wp_reset_postdata();
				endforeach;
				?>
			</ul>
		</div>
	</div>
	<?php
endif;
$output = ob_get_clean();
wp_reset_postdata();
echo $output;