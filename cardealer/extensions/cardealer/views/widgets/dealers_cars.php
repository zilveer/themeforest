<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php
global $wpdb;
$users = array();
//*** get users
if ($instance['user_number'] <= 0) {
	$instance['user_number'] = 5;
}
//***

if ($instance['packet'] !== 0) {
	//*** get users with packet $instance['packet']
	$args = array(
		'role' => $instance['packet'],
		'orderby' => 'registered',
		'order' => 'ASC',
		'number' => (int) $instance['user_number'],
	);
	$u = get_users($args);
	if (!empty($u)) {
		foreach ($u as $value) {
			$users[] = $value->ID;
		}
	}
} else {
	$u = $wpdb->get_results("SELECT ID FROM $wpdb->users ORDER BY user_registered DESC LIMIT " . (int) $instance['user_number'], ARRAY_N);
	if (!empty($u)) {
		foreach ($u as $value) {
			$users[] = $value[0];
		}
	}
}

$meta_query_array = array();
if(!defined('ICL_LANGUAGE_CODE')){
	$meta_query_array[] = array(
		'key' => '_icl_lang_duplicate_of',
		'value' => '',
		'compare' => 'NOT EXISTS'
	);
}

$posts = array();
if (!empty($users)) {
	foreach ($users as $user_id) {
		$args = array(
			'post_type' => TMM_Ext_PostType_Car::$slug,
			'author' => $user_id,
			'meta_query' => $meta_query_array,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'suppress_filters' => false,
			'posts_per_page' => ceil($instance['user_number'] / count($users))
		);
		$posts[] = get_posts($args);
	}
}

if($instance['order'] == 'random'){
	shuffle($posts);
}
?>


<div class="widget widget_dealers_cars">
    

	<?php if ($instance['title'] != '') { ?>
		<h3 class="widget-title"><?php _e($instance['title'], 'cardealer'); ?></h3>
	<?php } ?>

    <ul class="clearfix">

		<?php if (!empty($posts)): ?>
			<?php foreach ($posts as $post) : ?>
				<?php
				if (empty($post)) {
					continue;
				}

				$post = $post[0];

				$car_data = TMM_Ext_PostType_Car::get_car_data($post->ID);

				$user_id    = get_post_field( 'post_author', $post->ID );
				$car_photos = TMM_Ext_PostType_Car::get_post_photos( $post->ID, $user_id, 'thumb' );
				$icon_class = '';
				if ( ! empty( $car_photos ) && count( $car_photos ) > 1 ) {
					$icon_class .= ' picture';
				}
				if ( isset( $car_data['cars_videos'][0] ) && ! empty( $car_data['cars_videos'][0] ) ) {
					$icon_class .= ' video';
				}
				?>
				<li>

					<a href="<?php echo get_permalink($post->ID); ?>" class="thumb single-image<?php echo $icon_class; ?>">

						<img alt="" src="<?php echo tmm_get_car_cover_image($post->ID, 'single_thumb_widget') ?>">

						<?php if ( $car_data['car_is_featured'] ): ?>
							<span class="ribbon-wrapper">
	                            <span class="ribbon"><?php _e( 'Featured', 'cardealer' ); ?></span>
	                        </span>
						<?php endif; ?>

						<?php if ( $car_data['car_is_sold'] ): ?>
							<span class="sold-ribbon-wrapper">
	                            <span class="sold_ribbon"><?php _e( 'Sold', 'cardealer' ); ?></span>
	                        </span>
						<?php endif; ?>

					</a>

					<div class="table-entry">

						<h4>
							<a href="<?php echo get_permalink($post->ID); ?>">
								<?php tmm_get_car_title($post->ID, 1); ?>
							</a>
						</h4>

						<p class="specs">
							<?php
							if(!empty($car_data['car_engine_size'])){
								echo $car_data['car_engine_size'] . TMM::get_option('engine_capacity_unit', TMM_APP_CARDEALER_PREFIX) . ' ';
								if(!empty($car_data['car_mileage'])){
									echo ', ';
								}
							}
							if(!empty($car_data['car_mileage'])){
								echo $car_data['car_mileage'] . TMM::get_option('distance_unit', TMM_APP_CARDEALER_PREFIX);
							}
							?>
						</p>

						<span class="price">
							<?php echo esc_html( tmm_get_car_price($post->ID) ); ?>
						</span>

					</div><!--/ .table-entry-->

				</li>

			<?php endforeach; ?>
		<?php endif; ?>

    </ul>

</div><!--/ .widget-->

