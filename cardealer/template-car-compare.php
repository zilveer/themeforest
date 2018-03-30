<?php
if (!defined('ABSPATH')) exit();
/**
 * Template Name: Car Compare
 */

get_header();
wp_enqueue_script('tmm_carousel');
$car_compare_list = TMM_Ext_PostType_Car::get_compare_list();
?>

<?php if (!empty($car_compare_list)): ?>

	<?php get_template_part('content', 'header'); ?>

	<div class="compare-table clearfix">

		<div class="col features">

			<div class="heading">
				<h3 class="widget-title"><?php _e('Compare Listings', 'cardealer'); ?></h3>
			</div>

			<div class="viewport align-center">

				<a id="carou_prev" class="button orange"><?php _e('Prev', 'cardealer'); ?></a>
				<a id="carou_next" class="button orange"><?php _e('Next', 'cardealer'); ?></a>

			</div>
			<!--/ .viewport-->

			<ul class="data-feature">
				<li><?php _e('Price', 'cardealer'); ?></li>
				<li><?php _e('Condition', 'cardealer'); ?></li>
				<li><?php _e('Body Type', 'cardealer'); ?></li>
				<li><?php _e('Engine', 'cardealer'); ?></li>
				<li><?php _e('Fuel Type', 'cardealer'); ?></li>
				<li><?php _e('Gearbox', 'cardealer'); ?></li>
				<li><?php _e('Mileage', 'cardealer'); ?></li>
				<li><?php _e('Year', 'cardealer'); ?></li>
				<li><?php _e('Owners', 'cardealer'); ?></li>
				<?php if (!empty(TMM_Ext_PostType_Car::$specifications_array)): ?>

					<?php foreach (TMM_Ext_PostType_Car::$specifications_array as $specification_key => $value) : ?>
						<?php $attributes_array = TMM_Ext_PostType_Car::get_attribute_constructors($specification_key); ?>

						<?php foreach ($attributes_array as $featured_key => $featured_value): ?>
							<li><?php _e($featured_value['name'], 'cardealer'); ?></li>
						<?php endforeach; ?>

					<?php endforeach; ?>

				<?php endif; ?>
			</ul>

		</div><!--/ .col-->

		<div class="col-scroll-wrap">

            <ul class="col-scroll clearfix">

                <?php foreach ($car_compare_list as $key => $post_id): ?>

                    <li class="col" id="car_col_<?php echo $post_id ?>">

                        <?php
                        $car_data = TMM_Ext_PostType_Car::get_car_data($post_id);
                        ?>

                        <div class="heading">

                            <a href="#" class="js_remove_car_from_compare_list button orange big"
                               data-post-id="<?php echo $post_id ?>">
                                <?php _e('Remove', 'cardealer'); ?>
                            </a>

                        </div>
                        <!--/ .heading-->

                        <div class="viewport">

                            <figure>

                                <a href="<?php echo get_permalink($post_id) ?>">
                                    <img alt=""
                                         src="<?php echo tmm_get_car_cover_image($post_id, 'thumb') ?>">
                                </a>

                                <figcaption>
                                    <a href="<?php echo get_post_permalink($post_id) ?>">
	                                    <?php tmm_get_car_title($post_id, 1); ?>
                                    </a>
                                    <div>
                                    <?php
                                    if (!empty($car_data['car_carlocation'][0])) {
                                        $car_carlocation = TMM_Ext_PostType_Car::get_location_string($car_data['car_carlocation']);
                                        echo $car_carlocation;
                                    }
                                    ?>
                                    </div>
                                </figcaption>

                            </figure>

                            <?php if (TMM::get_option('show_button_details', TMM_APP_CARDEALER_PREFIX)): ?>
                                <a target="_blank" class="button orange"
                                   href="<?php echo get_post_permalink($post_id) ?>"><?php _e('Details', 'cardealer'); ?></a>
                            <?php endif; ?>

                        </div>
                        <!--/ .viewport-->

                        <ul class="data-feature">
                            <li data-feature="<?php _e('Price', 'cardealer'); ?>">
	                            <?php echo esc_html( tmm_get_car_price($post_id) ); ?>
                            </li>
                            <li data-feature="<?php _e('Condition', 'cardealer'); ?>">
	                            <?php echo esc_html( tmm_get_car_condition($post_id) ); ?>
                            </li>
                            <li data-feature="<?php _e('Body Type', 'cardealer'); ?>">
	                            <?php echo esc_html( tmm_get_car_option('body', $post_id) ); ?>
                            </li>
                            <li data-feature="<?php _e('Engine', 'cardealer'); ?>">
	                            <?php echo tmm_get_car_engine($post_id, '', true); ?>
                            </li>
                            <li data-feature="<?php _e('Fuel Type', 'cardealer'); ?>">
	                            <?php echo esc_html( tmm_get_car_option('fuel_type', $post_id) ); ?>
                            </li>
                            <li data-feature="<?php _e('Gearbox', 'cardealer'); ?>">
	                            <?php echo esc_html( tmm_get_car_option('transmission', $post_id) ); ?>
                            </li>
                            <li data-feature="<?php _e('Mileage', 'cardealer'); ?>">
	                            <?php echo esc_html( tmm_get_car_mileage($post_id) ); ?>
                            </li>
                            <li data-feature="<?php _e('Year', 'cardealer'); ?>">
	                            <?php echo esc_html( tmm_get_car_option('year', $post_id) ); ?>
                            </li>
                            <li data-feature="<?php _e('Owners', 'cardealer'); ?>">
	                            <?php echo esc_html( tmm_get_car_option('owner_number', $post_id) ); ?>
                            </li>

                            <?php if (!empty(TMM_Ext_PostType_Car::$specifications_array)) { ?>
                                <?php foreach (TMM_Ext_PostType_Car::$specifications_array as $specification_key => $value) { ?>
                                    <?php $attributes_array = TMM_Ext_PostType_Car::get_attribute_constructors($specification_key); ?>

                                    <?php foreach ($attributes_array as $featured_key => $featured_value) { ?>
                                        <li data-feature="<?php echo $featured_value['name'] ?>"><?php echo(isset($car_data['advanced'][$specification_key][$featured_key]) ? format_empty_data($car_data['advanced'][$specification_key][$featured_key]) : '-') ?></li>
                                    <?php } ?>

                                <?php } ?>
                            <?php } ?>
                        </ul>

                    </li>

                <?php endforeach; ?>

            </ul><!--/ .col-scroll-->

		</div><!--/ .col-scroll-wrap-->

	</div><!--/ .compare-table-->

<?php else: ?>

    <section class="viewport-50 padding-top-80 padding-bottom-80 clearfix">

        <?php _e('Sorry, You have added no cars to compare list!', 'cardealer'); ?>

    </section>

<?php endif; ?>

<?php

function format_empty_data($value)
{
	if ($value == 0) {
		$value = __('No', 'cardealer');
	}else if ($value == 1) {
		$value = __('Yes', 'cardealer');
	}else{
		$value = __($value, 'cardealer');
	}

	return $value;
}

?>

<?php get_footer(); ?>
