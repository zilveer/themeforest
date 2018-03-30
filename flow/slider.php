<?php
$slider_shortcode = get_post_meta(flow_elated_get_page_id(), 'eltd_page_slider_meta', true);
if (!empty($slider_shortcode)) { ?>
	<div class="eltd-slider">
		<div class="eltd-slider-inner">
			<?php echo do_shortcode(wp_kses_post($slider_shortcode)); // XSS OK ?>
		</div>
	</div>
<?php } ?>