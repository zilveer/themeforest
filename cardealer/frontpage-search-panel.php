<?php
if ( !defined('ABSPATH') ) exit;

if ( (is_front_page() || TMM_Helper::is_front_lang_page()) && shortcode_exists('slider') && TMM::get_option('display_front_page_slider', TMM_APP_CARDEALER_PREFIX) !== '0' ) {
	$max_features_cars_count = (int) TMM::get_option('max_features_cars_count', TMM_APP_CARDEALER_PREFIX);
	if (!$max_features_cars_count) {
		$max_features_cars_count = 15;
	}

	$args = array(
		'images_count' => $max_features_cars_count,
		'show_sidebar' => (int) TMM::get_option('show_slider_as', TMM_APP_CARDEALER_PREFIX),
		'sidebar_position' => 'right',
		'slider_type' => (int) TMM::get_option('flexslider_content_to_show', TMM_APP_CARDEALER_PREFIX),
		'placeholder' => (int) TMM::get_option('flexslider_resize_image', TMM_APP_CARDEALER_PREFIX),
		'show_caption' => (int) TMM::get_option('flexslider_enable_caption', TMM_APP_CARDEALER_PREFIX),
		'crop' => (int) TMM::get_option('crop_image', TMM_APP_CARDEALER_PREFIX),
		'animation' => TMM::get_option('flexslider_slideshow_animation', TMM_APP_CARDEALER_PREFIX),
		'animation_loop' => (int) TMM::get_option('flexslider_animation_loop', TMM_APP_CARDEALER_PREFIX),
		'slideshow' => (int) TMM::get_option('flexslider_slideshow', TMM_APP_CARDEALER_PREFIX),
		'reverse' => (int) TMM::get_option('flexslider_reverse', TMM_APP_CARDEALER_PREFIX),
		'slideshow_speed' => (int) TMM::get_option('flexslider_slideshow_speed', TMM_APP_CARDEALER_PREFIX),
		'animation_speed' => (int) TMM::get_option('flexslider_animation_speed', TMM_APP_CARDEALER_PREFIX),
		'init_delay' => (int) TMM::get_option('flexslider_init_delay', TMM_APP_CARDEALER_PREFIX),
		'randomize' => (int) TMM::get_option('flexslider_randomize', TMM_APP_CARDEALER_PREFIX),
	);

	$attr = '';

	foreach ( $args as $key => $val ) {
		$attr .= $key . '="' . $val . '" ';
	}

	?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="top-panel clearfix">
					<?php echo do_shortcode('[slider ' . trim($attr) . ']'); ?>
				</div>
				<!--/ .top-panel-->
			</div>
		</div>
		<!--/ .row-->
	</div><!--/ .container-->
<?php } ?>