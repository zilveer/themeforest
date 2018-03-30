<?php
$slider_shortcode = get_post_meta(hashmag_mikado_get_page_id(), "mkdf_page_slider_meta", true);
$slider_shortcode = apply_filters('hashmag_mikado_slider_shortcode', $slider_shortcode);

if (!empty($slider_shortcode)) { ?>
	<div class="mkdf-slider">
		<div class="mkdf-slider-inner">
			<?php echo do_shortcode(wp_kses_post($slider_shortcode)); // XSS OK ?>
		</div>
	</div>
<?php } ?>