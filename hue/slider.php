<?php
$slider_shortcode = get_post_meta(hue_mikado_get_page_id(), 'mkd_page_slider_meta', true);
$slider_shortcode = apply_filters('hue_mikado_slider_shortcode', $slider_shortcode);

if(!empty($slider_shortcode)) : ?>
	<div class="mkd-slider">
		<div class="mkd-slider-inner">
			<?php echo do_shortcode(wp_kses_post($slider_shortcode)); // XSS OK ?>
		</div>
	</div>
<?php endif; ?>