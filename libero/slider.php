<?php
$slider_shortcode = get_post_meta($id, "mkd_page_slider_meta", true);
if (!empty($slider_shortcode)) { ?>
	<div class="mkd-slider">
		<div class="mkd-slider-inner">
			<?php echo do_shortcode(wp_kses_post($slider_shortcode)); // XSS OK ?>
		</div>
	</div>
<?php } ?>