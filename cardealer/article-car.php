<?php
if (!defined('ABSPATH')) exit();

global $post_id;
global $featured_cars_autoslide;
global $recent_cars_show_currency_converter;
global $recent_cars_show_details_button;
global $is_user_cars_page;
global $hide_cars_options;
global $hide_cars_compare;
global $thumbnail_size;

$user_id    = get_post_field( 'post_author', $post_id );
$post_url   = post_type_exists(TMM_Ext_PostType_Car::$slug) ? get_post_permalink( $post_id ) : '';
$car_data   = TMM_Ext_PostType_Car::get_car_data($post_id);
$car_photos = TMM_Ext_PostType_Car::get_post_photos( $post_id, $user_id, 'thumb' );
$car_cover_img = tmm_get_car_cover_image( $post_id, 'thumb' );
$post_status = get_post_status($post_id);
$unapproved = get_post_meta($post_id, 'unapproved', 1);

$icon_class = '';
if ( ! empty( $car_photos ) && count( $car_photos ) > 1 ) {
    $icon_class .= ' picture';
}
if ( isset( $car_data['cars_videos'][0] ) && ! empty( $car_data['cars_videos'][0] ) ) {
    $icon_class .= ' video';
}

$article_class = 'item car-entry';

if (empty($thumbnail_size)) {
	$thumbnail_size = 'large';
}

if ($thumbnail_size == 'small') {
	$article_class .= ' col-md-2';
} else if ($thumbnail_size == 'large') {
	$article_class .= ' col-md-4';
} else {
	$article_class .= ' col-md-3';
}

if ($car_data['car_is_featured']) {
	$article_class .= ' featured_car';
}

/* for Car Listing page and Recent Cars shortcode */
$is_autoslide_active = isset($featured_cars_autoslide) ? $featured_cars_autoslide : false;
$show_currency_converter = isset( $recent_cars_show_currency_converter ) ? $recent_cars_show_currency_converter : (bool) TMM::get_option('show_currency_converter', TMM_APP_CARDEALER_PREFIX);
$show_details_button = isset( $recent_cars_show_details_button ) ? $recent_cars_show_details_button : (bool) TMM::get_option('show_button_details', TMM_APP_CARDEALER_PREFIX);

/* for User Cars page */
$is_user_cars_page = isset( $is_user_cars_page ) ? $is_user_cars_page : false;

if($is_user_cars_page){
    $can_set_car_feature = true;
    if (!current_user_can('manage_options')) {
        $can_set_car_feature = TMM_Cardealer_User::get_user_free_features_count($user_id);
    }

    $feature_checkbox_disabled = false;
    if (!current_user_can('delete_posts')) {
        if (!$can_set_car_feature) {
            //$feature_checkbox_disabled = true;
        }
        if ((int) $car_data['car_is_featured']) {
            $feature_checkbox_disabled = true;
        }
    }

    if ((int) $car_data['car_is_sold'] === 1){
        $icon_class .= ' car_is_sold';
    }
    if ((int) $car_data['car_is_featured'] === 1){
        $icon_class .= ' car_is_featured';
    }
	if ($post_status == 'draft'){
		$article_class .= ' status-draft';
    }
}else{
    $car_compare_list = TMM_Ext_PostType_Car::get_compare_list();
    $car_watch_list = TMM_Ext_PostType_Car::get_watch_list();
}

$images_urls = array();
$images_urls[0] = $car_cover_img;

foreach ( $car_photos as $source_url ) {
    if ( $source_url !== '' && $source_url !== $car_cover_img ) {
        $images_urls[] = $source_url;
    }
}

$car_engine = tmm_get_car_engine($post_id, '-', true, ' ');
$car_fuel_type = tmm_get_car_option('fuel_type', $post_id);

if($car_engine !== '-' && $car_fuel_type){
	$car_engine .= ', ' . $car_fuel_type;
}

?>

<article id="post-<?php echo $post_id; ?>" class="<?php echo $article_class; ?>">

    <div class="image-post">

        <?php
        if ( $car_data['car_is_featured'] && $is_autoslide_active ) {
            ?>

            <div class="image-post-slider-listing image-post-slider-cars-listing<?php echo $icon_class; ?>">

                <ul>

                    <?php
                    foreach ( $images_urls as $image_url ) {
                        ?>

                        <li>
                            <a data-fancybox-group="lightbox" href="<?php echo $post_url; ?>">
                                <img src="<?php echo $image_url; ?>" alt="" />
                            </a>
                        </li>

                        <?php
                    }
                    ?>

                </ul>

                <a data-fancybox-group="lightbox" href="<?php echo $post_url; ?>">
                    <span class="ribbon-wrapper">
                        <span class="ribbon"><?php _e( 'Featured', 'cardealer' ); ?></span>
                    </span>

                    <?php if ( $car_data['car_is_sold'] ): ?>
                        <span class="sold-ribbon-wrapper">
                            <span class="sold_ribbon"><?php _e( 'Sold', 'cardealer' ); ?></span>
                        </span>
                    <?php endif; ?>

                </a>

            </div><!--/ .image-post-slider-->

            <?php
        } else {
            ?>

            <a href="<?php echo $post_url; ?>" class="single-image<?php echo $icon_class; ?>">

                <img src="<?php echo $car_cover_img; ?>" alt="">

                <?php
                if ($is_user_cars_page) {
                    ?>

                    <span class="ribbon-wrapper" <?php if ($car_data['car_is_featured'] != 1){ ?>style="display: none;"<?php } ?>><span class="ribbon"><?php _e('Featured', 'cardealer'); ?></span></span>
                    <span class="sold-ribbon-wrapper" <?php if ($car_data['car_is_sold'] != 1){ ?>style="display: none;"<?php } ?>><span class="sold_ribbon"><?php _e('Sold', 'cardealer'); ?></span></span>

                <?php
                }else{
                ?>

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

                <?php
                }
                ?>

            </a>

        <?php
        }
        ?>

    </div><!--/ .image-post-->

    <div class="detailed">

        <h6 class="title-item">

            <a href="<?php echo $post_url; ?>">
                <?php
                tmm_get_car_title($post_id, 1);

                if ($unapproved) {
	                echo ' - ';
	                _e('Your add is awaiting moderation.', 'cardealer');
                }
                ?>
            </a>

        </h6>

        <div class="price">

            <span <?php if ($show_currency_converter) { ?>class="convert"<?php } ?> data-convert="<?php echo esc_attr( tmm_get_car_price($post_id, false, 1) ); ?>">
                <?php echo esc_html( tmm_get_car_price($post_id) ); ?>
            </span>

        </div>

        <div class="clear"></div>

	    <?php if ( empty($hide_cars_options) ) { ?>
        <ul class="list-entry">

            <?php
            if(!empty($car_data['car_carlocation'])){
                $car_location = TMM_Ext_PostType_Car::get_location_string($car_data['car_carlocation']);
            }else{
                $car_location = '-';
            }
            ?>

            <li>
                <b><?php _e('Location', 'cardealer'); ?>:</b><span>&nbsp;<?php echo $car_location; ?></span>
            </li>

            <li>
                <b><?php _e('Engine', 'cardealer'); ?>:</b><span>&nbsp;<?php echo $car_engine; ?></span>
            </li>

            <li>
                <b><?php _e('Mileage', 'cardealer'); ?>:</b><span>&nbsp; <?php echo esc_html( tmm_get_car_mileage($post_id, '-') ); ?></span>
            </li>

            <li>
                <b><?php _e('Condition', 'cardealer'); ?>:</b><span>&nbsp;<?php echo esc_html( tmm_get_car_condition($post_id, '-') ); ?></span>
            </li>

        </ul><!--/ .list-entry-->
	    <?php } ?>

        <?php
        if ($is_user_cars_page) {
            ?>

	        <?php if (!$unapproved) { ?>

            <div class="compare">
                <input class="js_sold_user_car" id="car_is_sold_<?php echo $post_id ?>" type="checkbox"
                       data-post-id="<?php echo $post_id ?>" <?php echo((int)$car_data['car_is_sold'] ? 'checked' : '') ?>
                       value="<?php echo (int)$car_data['car_is_sold'] ?>"/>
	            <label for="car_is_sold_<?php echo $post_id ?>">
                    <?php _e('Sold', 'cardealer'); ?>
                </label>
                <input class="js_draft_user_car" id="draft_<?php echo $post_id ?>" type="checkbox"
                      data-post-id="<?php echo $post_id ?>" <?php echo($post_status == 'draft' ? 'checked' : '') ?>
                          value="<?php echo($post_status == 'draft' ? 1 : 0) ?>"/>
	            <label for="draft_<?php echo $post_id ?>">
                    <?php _e('Draft', 'cardealer'); ?>
                </label>
                <input class="js_feature_user_car" id="feature_<?php echo $post_id ?>" type="checkbox"
                        data-post-id="<?php echo $post_id ?>"
                        data-can-set-featured="<?php echo (int) $can_set_car_feature; ?>" <?php echo($feature_checkbox_disabled ? 'disabled' : '') ?> <?php echo((int)$car_data['car_is_featured'] ? 'checked' : '') ?>
                            value="<?php echo (int)$car_data['car_is_featured'] ?>"/>
	            <label for="feature_<?php echo $post_id ?>">
                    <?php _e('Featured', 'cardealer'); ?>
                </label>

            </div><!--/ .compare-->

		    <?php } ?>

            <footer class="detailed-foot">
                <?php
                $edit_page = TMM_Helper::get_permalink_by_lang( TMM::get_option('edit_page', TMM_APP_CARDEALER_PREFIX), array('car_id' => $post_id) );
                ?>
                <a href="<?php echo $edit_page; ?>" class="button orange"><?php _e('Edit', 'cardealer'); ?></a>
                <a href="#" class="button orange js_delete_user_car" data-post-id="<?php echo $post_id; ?>"><?php _e('Delete', 'cardealer'); ?></a>
                <a href="<?php echo $post_url; ?>" class="button orange"><?php _e('View car', 'cardealer'); ?></a>
            </footer>

            <?php
        }else{
            ?>

            <?php if ( $show_details_button ){ ?>

                <a href="<?php echo $post_url; ?>" class="button orange"><?php _e( 'Details', 'cardealer' ); ?></a>

            <?php } ?>

	        <?php if ( empty($hide_cars_compare) ){ ?>

            <div class="compare">

                <input id="for_compare_<?php echo $post_id ?>"
                           type="checkbox" <?php echo( in_array( $post_id, $car_compare_list ) ? 'checked' : '' ); ?>
                           class="js_car_compare"
                           data-post-id="<?php echo $post_id ?>">
	            <label for="for_compare_<?php echo $post_id ?>">
		            <?php _e( 'Compare', 'cardealer' ); ?>
                </label>

                <input id="for_watch_<?php echo $post_id ?>"
                           type="checkbox" <?php echo( in_array( $post_id, $car_watch_list ) ? 'checked' : '' ); ?>
                           class="js_car_watch_list"
                           data-post-id="<?php echo $post_id ?>">
	            <label for="for_watch_<?php echo $post_id ?>">
		            <?php _e( 'Watch list', 'cardealer' ); ?>
                </label>

            </div>

	        <?php } ?>

            <?php
        }
        ?>

    </div><!--/ .detailed-->

</article>
