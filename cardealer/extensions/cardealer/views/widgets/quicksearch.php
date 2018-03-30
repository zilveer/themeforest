<?php
if (!defined('ABSPATH')) die('No direct access allowed');

$args = array(
	'show_location0' => isset($instance['show_location0']) ? $instance['show_location0'] : false,
	'show_location1' => isset($instance['show_location1']) ? $instance['show_location1'] : false,
	'show_location2' => isset($instance['show_location2']) ? $instance['show_location2'] : false,
	'selected_location0' => isset($instance['selected_location0']) ? $instance['selected_location0'] : 0,
	'selected_location1' => isset($instance['selected_location1']) ? $instance['selected_location1'] : 0,
	'show_condition' => isset($instance['show_search_state_cars']) ? $instance['show_search_state_cars'] : false,
	'show_makes' => isset($instance['show_producers_and_models']) ? $instance['show_producers_and_models'] : false,
	'show_price_range' => isset($instance['show_min_max_price']) ? $instance['show_min_max_price'] : false,
	'show_year_range' => isset($instance['show_years']) ? $instance['show_years'] : false,
	'show_mileage' => isset($instance['show_mileage']) ? $instance['show_mileage'] : false,
	'show_fuel_type' => isset($instance['show_fuel_type']) ? $instance['show_fuel_type'] : false,
	'show_transmission' => isset($instance['show_transmission']) ? $instance['show_transmission'] : false,
	'show_body_type' => isset($instance['show_body_type']) ? $instance['show_body_type'] : false,
	'show_doors_count' => isset($instance['show_doors_count']) ? $instance['show_doors_count'] : false,
	'show_colors' => isset($instance['show_colors']) ? $instance['show_colors'] : false,
	'show_advanced_options' => isset($instance['show_advanced_options']) ? $instance['show_advanced_options'] : false,
);

$attr = '';

foreach ( $args as $key => $val ) {
	$attr .= $key . '="' . $val . '" ';
}

?>

<div class="widget search-panel">

	<div class="boxed-widget">

		<?php if ($instance['title']) { ?>

			<div class="widget-head">
				<h3 class="widget-title"><?php _e($instance['title'], 'cardealer'); ?></h3>
			</div><!--/ .widget-head-->

		<?php } ?>

		<div class="boxed-entry clearfix">

		<?php echo do_shortcode('[quicksearch ' . trim($attr) . ']'); ?>

		</div>

	</div><!--/ .boxed-widget-->

</div><!--/ .search-panel-->


