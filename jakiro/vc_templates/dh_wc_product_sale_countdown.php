<?php
$output ='';
$atts = shortcode_atts( array(
	'columns' =>'1',
	'orderby' => 'title',
	'order'   => 'asc',
	'posts_per_page'    =>'12',
	'hide_pagination'	=>'',
	'ids'     => '',
	'skus'    => ''
), $atts );

$query_args = array(
	'post_type'           => 'product',
	'post_status'         => 'publish',
	'ignore_sticky_posts' => 1,
	'orderby'             => $atts['orderby'],
	'order'               => $atts['order'],
	'posts_per_page'      => $atts['posts_per_page'],
	'meta_query'          => WC()->query->get_meta_query()
);

if ( ! empty( $atts['skus'] ) ) {
	$query_args['meta_query'][] = array(
		'key'     => '_sku',
		'value'   => array_map( 'trim', explode( ',', $atts['skus'] ) ),
		'compare' => 'IN'
	);
}

if ( ! empty( $atts['ids'] ) ) {
	$query_args['post__in'] = array_map( 'trim', explode( ',', $atts['ids'] ) );
}
$product_ids_on_sale    		= wc_get_product_ids_on_sale();
$product_ids_on_sale[]  		= 0;
$query_args['post__in'] 		= $product_ids_on_sale;
$products                   	= new WP_Query($query_args );
$columns                     	= absint( $atts['columns'] );
ob_start();

if ( $products->have_posts() ) : 

/**
 * script
 * {{
 */
wp_enqueue_script('vendor-carouFredSel');
wp_enqueue_script('vendor-countdown');
?>

<ul class="woocommerce product-sale-countdown">
	<?php $i = 0;$c =0?>
		<?php while ( $products->have_posts() ) : $products->the_post(); global $post,$product;$c++; ?>
			<?php if($i++ % $columns == 0):?>
			<li>
			<?php endif;?>
			<div class="product-sale-countdown-item">
				<div class="product-sale-countdown-image">
					<?php 
					if ( has_post_thumbnail() ) { 
						echo '<a href="'.get_the_permalink().'">' . woocommerce_get_product_thumbnail('shop_catalog') . '</a>';
					} else {
						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );
					
					}
					?>
					<?php if ( $product->is_on_sale() ) : ?>

						<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>', $post, $product ); ?>

					<?php endif; ?>
				</div>
				<div class="product-sale-countdown-info">
					<h3><a href="<?php echo get_the_permalink()?>"><?php echo $product->get_title(); ?></a></h3>
					<div class="product-price">
						<?php echo $product->get_price_html(); ?>
					</div>
					<?php 
					if ($post->post_excerpt ) {
					?>
					
					<?php 
					$sales_price_to = get_post_meta($post->ID, '_sale_price_dates_to', true);
					if(empty($sales_price_to) || defined('DH_PREVIEW')){
						$sales_price_to = time() + ($c + 7) * 24 * 60 * 60;
					}
					$sales_price_to = date_i18n('Y/m/d', $sales_price_to);
					$html = '
					<div class="countdown-item">
						<div class="countdown-item-value">%D</div>
						<div class="countdown-item-label">'.esc_html__('d :','jakiro').'</div>
					</div>
					<div class="countdown-item">
						<div class="countdown-item-value">%H</div>
						<div class="countdown-item-label">'.esc_html__('h :','jakiro').'</div>
					</div>
					<div class="countdown-item">
						<div class="countdown-item-value">%M</div>
						<div class="countdown-item-label">'.esc_html__('m :','jakiro').'</div>
					</div>
					<div class="countdown-item">
						<div class="countdown-item-value">%S</div>
						<div class="countdown-item-label">'.esc_html__('s','jakiro').'</div>
					</div>';
					?>
					<div class="product-sale-date" data-html="<?php echo esc_attr($html)?>" data-toggle="countdown" data-end="<?php echo esc_attr($sales_price_to)?>" data-now="<?php echo strtotime("now") ?>">
						<span><?php esc_html_e('Expires:','jakiro')?></span>
						<div class="countdown-content"></div>
					</div>
					<?php
					}
					?>
					<div class="product-sale-add-to-cart">
						<?php woocommerce_template_loop_add_to_cart();?>
					</div>
					
				</div>
			</div>
			<?php if($i % $columns == 0 || $i == $products->post_count):?>
			</li>
			<?php endif;?>
		<?php endwhile; // end of the loop. ?>
</ul>
<?php endif;
$product_html = ob_get_clean();
wp_reset_postdata();
$output .='<div class="caroufredsel product-slider caroufredsel-item-no-padding" data-height="variable" data-scroll-fx="scroll" data-speed="500" data-scroll-item="1" data-visible="1" data-responsive="1" data-infinite="1" data-autoplay="0">';
$output .='<div class="caroufredsel-wrap">';
$output .= $product_html;
$output .='<a href="#" class="caroufredsel-prev"></a>';
$output .='<a href="#" class="caroufredsel-next"></a>';
$output .='</div>';
if(empty($hide_pagination)){
	$output .='<div class="caroufredsel-pagination">';
	$output .='</div>';
}
$output .='</div>';
echo $output;