<?php
if (!defined('ABSPATH')) exit();

$car_bodies = array();
$car_body_list = TMM_Ext_PostType_Car::$car_options['body'];
$searching_page = get_permalink(TMM::get_option('searching_page', TMM_APP_CARDEALER_PREFIX));

foreach ($car_body_list as $k => $body_name) {
	$car_bodies[$k] = array(
		'name' => $body_name,
		'url' => add_query_arg( array('car_body'=> $k), $searching_page),
		'count' => 0,
		'icon' => file_exists(TMM_EXT_PATH . '/cardealer/images/car_body_icons/' . $k . '.svg')
						? TMM_EXT_URI . '/cardealer/images/car_body_icons/' . $k . '.svg'
						: TMM_EXT_URI . '/cardealer/images/car_body_icons/sedan.svg',
	);

	if (!empty($instance['show_count'])) {

		$args = array(
			'post_type' => TMM_Ext_PostType_Car::$slug,
			'showposts' => -1,
			'meta_query' => array(
				array(
					'key' => 'car_body',
					'value' => $body_name,
					'compare' => '='
				),
			),
		);

		if(!defined('ICL_LANGUAGE_CODE')){
			$args['meta_query'][] = array(
				'key' => '_icl_lang_duplicate_of',
				'value' => '',
				'compare' => 'NOT EXISTS'
			);
		}

		$query = new WP_Query($args);
		$car_bodies[$k]['count'] = $query->post_count;
		wp_reset_postdata();

	}
}
?>
<div class="widget widget_car_body">

    <?php if (!empty($instance['title'])) { ?>
        <h3 class="widget-title"><?php _e($instance['title'], 'cardealer'); ?></h3>
    <?php } ?>

    <ul class="car-body-list">

	    <?php foreach ($car_bodies as $k => $body) { ?>
	    <li>

		    <?php if (!empty($instance['enable_link'])) { ?>
		    <a href="<?php echo esc_url( $body['url'] ) ?>">
		    <?php } ?>

			    <img src="<?php echo esc_url( $body['icon'] ) ?>" alt="<?php echo esc_html( $body['name'] ); ?>" />

			    <?php if (!empty($instance['show_name'])) { ?>
			    <h6>
				<?php } ?>

			    <?php
			    if (!empty($instance['show_name'])) {
			        echo esc_html( $body['name'] );
			    }

			    if (!empty($instance['show_count'])) {
				    echo ' (' . (int) $body['count'] . ')';
			    }
			    ?>

				<?php if (!empty($instance['show_name'])) { ?>
			    </h6>
		        <?php } ?>

		    <?php if (!empty($instance['enable_link'])) { ?>
		    </a>
		    <?php } ?>

	    </li>
	    <?php } ?>

    </ul>

</div><!--/ .widget-->