<?php

global $wp_query;

$current_cat = 0;
$unique_id = uniqid('pcc-');

//wp_enqueue_script('jCarouselSwipe');
if (empty($atts)) {$atts = array();}
extract(shortcode_atts(array(), $atts));

if (is_tax('product_cat') && isset($wp_query->queried_object->term_id)) {
	$current_cat = $wp_query->queried_object->term_id;
}

$args = array(
	'walker' => new DFD_WC_Product_Categories_Carousel_Walker(),
	'taxonomy' => 'product_cat',
	'title_li' => '',
	'current_category' => $current_cat,
	'hierarchical' => 0,
//	'hide_empty' => 0,
);
?>
<div class="product-categories-carousel">
	<div id="<?php echo esc_attr($unique_id) ?>">
		<?php wp_list_categories($args); ?>
	</div>
</div>

<script type="text/javascript">
	(function($){
		"use strict";
		$(document).ready(function(){

			$('#<?php echo esc_js($unique_id); ?>').slick({
				infinite: true,
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
		$('#<?php echo esc_js($unique_id); ?> .cat-item').on('mousedown select',(function(e){
			e.preventDefault();
		}));
	})(jQuery);
</script>
