<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 27/09/16
 * Time: 4:52 PM
 */
global $post_meta_data;

$prop_id = get_post_meta( get_the_ID(), 'fave_property_id', true );
$prop_price = get_post_meta( get_the_ID(), 'fave_property_price', true );
$prop_size = get_post_meta( get_the_ID(), 'fave_property_size', true );
$prop_land = get_post_meta( get_the_ID(), 'fave_property_land', true );
$prop_land_postfix = get_post_meta( get_the_ID(), 'fave_property_postfix', true );
$bedrooms = get_post_meta( get_the_ID(), 'fave_property_bedrooms', true );
$bathrooms = get_post_meta( get_the_ID(), 'fave_property_bathrooms', true );
$year_built = get_post_meta( get_the_ID(), 'fave_property_year', true );
$garage = get_post_meta( get_the_ID(), 'fave_property_garage', true );
$garage_size = get_post_meta( get_the_ID(), 'fave_property_garage_size', true );
$additional_features_enable = get_post_meta( get_the_ID(), 'fave_additional_features_enable', true );
$additional_features = get_post_meta( get_the_ID(), 'additional_features', true );
$prop_details = false;

$icon_prop_id = houzez_option('icon_prop_id', false, 'url' );
$icon_bedrooms = houzez_option('icon_bedrooms', false, 'url' );
$icon_rooms = houzez_option('icon_rooms', false, 'url' );
$icon_bathrooms = houzez_option('icon_bathrooms', false, 'url' );
$icon_prop_size = houzez_option('icon_prop_size', false, 'url' );
$icon_prop_land = houzez_option('icon_prop_land', false, 'url' );
$icon_garage_size = houzez_option('icon_garage_size', false, 'url' );
$icon_garage = houzez_option('icon_garage', false, 'url' );
$icon_year = houzez_option('icon_year', false, 'url' );

if( !empty( $prop_id ) ||
    !empty( $prop_price ) ||
    !empty( $prop_size ) ||
    !empty( $bedrooms ) ||
    !empty( $bathrooms ) ||
    !empty( $year_built ) ||
    !empty( $garage )
) {
    $prop_details = true;
}

$hide_detail_prop_fields = houzez_option('hide_detail_prop_fields');
?>
<div class="property-description detail-block">
    <div class="detail-title">
        <h2 class="title-left"><?php esc_html_e( 'Description', 'houzez' ); ?></h2>
    </div>
    <?php the_content(); ?>

    <?php
    if( $prop_details ) { ?>
    <h3 class="detail-sub-title"><span><?php esc_html_e( 'Detail', 'houzez' ); ?></span></h3>
    <ul class="detail-amenities-list">
        <?php if( !empty( $prop_id ) && $hide_detail_prop_fields['prop_id'] != 1 ) { ?>
        <li class="media">
            <?php if( !empty($icon_prop_id) ) { ?>
            <div class="media-left media-middle"><img src="<?php echo esc_url($icon_prop_id); ?>" width="37" height="50" alt="Icon"></div>
            <?php } ?>
            <div class="media-body"> <?php esc_html_e( 'Property ID', 'houzez' ); ?><br> <?php echo esc_attr( $prop_id ); ?> </div>
        </li>
        <?php } ?>

        <?php if( !empty( $bedrooms ) && $hide_detail_prop_fields['bedrooms'] != 1 ) { ?>
        <li class="media">
            <?php if( !empty($icon_bedrooms) ) { ?>
                <div class="media-left media-middle"><img src="<?php echo esc_url($icon_bedrooms); ?>" width="50" height="30" alt="Icon"></div>
            <?php } ?>
            <div class="media-body">  <?php echo esc_attr( $bedrooms ); ?> <br> <?php esc_html_e( 'Bedrooms', 'houzez' ); ?>  </div>
        </li>
        <?php } ?>

        <?php if( !empty( $bathrooms ) && $hide_detail_prop_fields['bathrooms'] != 1 ) { ?>
        <li class="media">
            <?php if( !empty($icon_bathrooms) ) { ?>
                <div class="media-left media-middle"><img src="<?php echo esc_url($icon_bathrooms); ?>" width="50" height="34" alt="Icon"></div>
            <?php } ?>
            <div class="media-body"> <?php echo esc_attr( $bathrooms ); ?> <br> <?php esc_html_e( 'Bathrooms', 'houzez' ); ?> </div>
        </li>
        <?php } ?>

        <?php if( !empty( $prop_size ) && $hide_detail_prop_fields['area_size'] != 1 ) { ?>
        <li class="media">
            <?php if( !empty($icon_prop_size) ) { ?>
                <div class="media-left media-middle"><img src="<?php echo esc_url($icon_prop_size); ?>" width="50" height="46" alt="Icon"></div>
            <?php } ?>
            <div class="media-body"> <?php esc_html_e( 'Property Size', 'houzez' ); ?><br> <?php echo houzez_property_size( 'after' ); ?> </div>
        </li>
        <?php } ?>

        <?php if( !empty( $prop_land ) && $hide_detail_prop_fields['land_area'] != 1 ) { ?>
            <li class="media">
                <?php if( !empty($icon_prop_land) ) { ?>
                    <div class="media-left media-middle"><img src="<?php echo esc_url($icon_prop_land); ?>" width="50" height="46" alt="Icon"></div>
                <?php } ?>
                <div class="media-body"> <?php esc_html_e( 'Land Size', 'houzez' ); ?><br> <?php echo houzez_property_land_area( 'after' ); ?> </div>
            </li>
        <?php } ?>

        <?php if( !empty( $garage ) && $hide_detail_prop_fields['garages'] != 1 ) { ?>
        <li class="media">
            <?php if( !empty($icon_garage_size) ) { ?>
                <div class="media-left media-middle"><img src="<?php echo esc_url($icon_garage_size); ?>" width="48" height="48" alt="Icon"></div>
            <?php } ?>
            <div class="media-body"> <?php esc_html_e( 'Garage Size', 'houzez' ); ?><br> <?php echo esc_attr( $garage_size ); ?> </div>
        </li>
        <li class="media">
            <?php if( !empty($icon_garage) ) { ?>
                <div class="media-left media-middle"><img src="<?php echo esc_url($icon_garage); ?>" width="50" height="34" alt="Icon"></div>
            <?php } ?>
            <div class="media-body"> <?php echo esc_attr( $garage ); ?> <br><?php esc_html_e( 'Garage', 'houzez' ); ?> </div>
        </li>
        <?php } ?>

        <?php if( !empty( $year_built ) && $hide_detail_prop_fields['year_built'] != 1 ) { ?>
        <li class="media">
            <?php if( !empty($icon_year) ) { ?>
                <div class="media-left media-middle"><img src="<?php echo esc_url($icon_year); ?>" width="50" height="50" alt="Icon"></div>
            <?php } ?>
            <div class="media-body"> <?php esc_html_e( 'Year Built', 'houzez' ); ?><br> <?php echo esc_attr( $year_built ); ?> </div>
        </li>
        <?php } ?>
    </ul>
    <?php } ?>

    <?php if( $hide_detail_prop_fields['updated_date'] != 1 ) { ?>
        <p class="update-text"><?php esc_html_e( 'Updated on', 'houzez' ); ?> <?php the_modified_time('F j, Y'); ?> <?php esc_html_e( 'at', 'houzez' ); ?> <?php the_modified_time('g:i a'); ?> </p>
    <?php } ?>
</div>
