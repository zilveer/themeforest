<?php

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

$unique_id = uniqid('bsp_');
$posts_per_page = (!empty($posts_per_page)) ? $posts_per_page : -1;

$args = array(
	'post_type' => 'product',
	'post_status' => 'publish',
	'ignore_sticky_posts' => 1,
	'posts_per_page' => $posts_per_page,
	'meta_key' => 'total_sales',
	'orderby' => 'meta_value_num',
	'meta_query' => array(
		array(
			'key' => '_visibility',
			'value' => array('catalog', 'visible'),
			'compare' => 'IN'
		)
	)
);

$products = new WP_Query($args);

if ($products->have_posts()) :
	?>
	
	<div class="module best-selling-products-wrap products-slider-wrap woocommerce">
		
		<?php if ($show_title) : ?>
		<h4 class="widget-title  text-left widget-title-decoration-underline_label">
			<span><?php _e( 'The best offers', 'dfd' ); ?></span>
		</h4>
		<?php endif; ?>

		<div class="best-selling-products products-slider" id="<?php echo esc_attr($unique_id); ?>">

			<?php woocommerce_product_loop_start(); ?>

			<?php while ($products->have_posts()) : $products->the_post(); ?>

				<?php woocommerce_get_template_part('content', 'product-slider'); ?>

			<?php endwhile; ?>

			<?php woocommerce_product_loop_end(); ?>
			
			<?php echo DFD_Carousel::controls(); ?>
		</div>
		
	</div>

	<script type="text/javascript">
	(function($){
		"use strict";
		$(document).ready(function(){

			$('#<?php echo esc_js($unique_id); ?> .products').slick({
				infinite: false,
				slidesToShow: 4,
				slidesToScroll: 1,
				arrows: false,
				dots: true,
				autoplay: false,//true
				autoplaySpeed: 5000,
				responsive: [
					{
						breakpoint: 1280,
						settings: {
							slidesToShow: 3,
							infinite: true,
							arrows: false,
							dots: true
						}
					},
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 2,
							infinite: true,
							arrows: false,
							dots: true
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 1,
							arrows: false,
							dots: true
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							arrows: false,
							dots: true
						}
					}
				]
			});
		});
		$('#<?php echo esc_js($unique_id); ?> .product').on('mousedown select',(function(e){
			e.preventDefault();
		}));
	})(jQuery);
	</script>
		
<?php

endif;

wp_reset_postdata();
