<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 08/01/16
 * Time: 4:23 PM
 */
global $post_meta_data;

$prop_id = get_post_meta( get_the_ID(), 'fave_property_id', true );
$prop_price = get_post_meta( get_the_ID(), 'fave_property_price', true );
$prop_size = get_post_meta( get_the_ID(), 'fave_property_size', true );
$land_area = get_post_meta( get_the_ID(), 'fave_property_land', true );
$bedrooms = get_post_meta( get_the_ID(), 'fave_property_bedrooms', true );
$bathrooms = get_post_meta( get_the_ID(), 'fave_property_bathrooms', true );
$year_built = get_post_meta( get_the_ID(), 'fave_property_year', true );
$garage = get_post_meta( get_the_ID(), 'fave_property_garage', true );
$garage_size = get_post_meta( get_the_ID(), 'fave_property_garage_size', true );
$additional_features_enable = get_post_meta( get_the_ID(), 'fave_additional_features_enable', true );
$additional_features = get_post_meta( get_the_ID(), 'additional_features', true );
$prop_details = false;

if( !empty( $prop_id ) ||
    !empty( $prop_price ) ||
    !empty( $prop_size ) ||
    !empty( $land_area ) ||
    !empty( $bedrooms ) ||
    !empty( $bathrooms ) ||
    !empty( $year_built ) ||
    !empty( $garage )
) {
    $prop_details = true;
}

$hide_detail_prop_fields = houzez_option('hide_detail_prop_fields');

if( $prop_details ) {
?>
<div id="detail" class="detail-list detail-block">
    <div class="detail-title">
        <h2 class="title-left"><?php esc_html_e( 'Detail', 'houzez' ); ?></h2>

        <?php if( $hide_detail_prop_fields['updated_date'] != 1 ) { ?>
        <div class="title-right">
            <p><?php esc_html_e( 'Updated on', 'houzez' ); ?> <?php the_modified_time('F j, Y'); ?> <?php esc_html_e( 'at', 'houzez' ); ?> <?php the_modified_time('g:i a'); ?> </p>
        </div>
        <?php } ?>

    </div>
    <div class="alert alert-info">
        <ul class="list-three-col">
            <?php
            if( !empty( $prop_id ) && $hide_detail_prop_fields['prop_id'] != 1 ) {
                echo '<li><strong>'.esc_html__( 'Property ID:', 'houzez').'</strong> '.esc_attr( $prop_id ).'</li>';
            }
            if( !empty( $prop_price ) && $hide_detail_prop_fields['sale_rent_price'] != 1 ) {
                echo '<li><strong>'.esc_html__( 'Price:', 'houzez'). '</strong> '.houzez_listing_price().'</li>';
            }
            if( !empty( $prop_size ) && $hide_detail_prop_fields['area_size'] != 1 ) {
                echo '<li><strong>'.esc_html__( 'Property Size:', 'houzez'). '</strong> '.houzez_property_size( 'after' ).'</li>';
            }
            if( !empty( $land_area ) && $hide_detail_prop_fields['land_area'] != 1 ) {
                echo '<li><strong>'.esc_html__( 'Land Area:', 'houzez'). '</strong> '.houzez_property_land_area( 'after' ).'</li>';
            }
            if( !empty( $bedrooms ) && $hide_detail_prop_fields['bedrooms'] != 1 ) {
                echo '<li><strong>'.esc_html__( 'Bedrooms:', 'houzez').'</strong> '.esc_attr( $bedrooms ).'</li>';
            }
            if( !empty( $bathrooms ) && $hide_detail_prop_fields['bathrooms'] != 1 ) {
                echo '<li><strong>'.esc_html__( 'Bathrooms:', 'houzez').'</strong> '.esc_attr( $bathrooms ).'</li>';
            }
            if( !empty( $garage ) && $hide_detail_prop_fields['garages'] != 1 ) {
                echo '<li><strong>'.esc_html__( 'Garage:', 'houzez').'</strong> '.esc_attr( $garage ).'</li>';
            }
            if( !empty( $garage_size ) && $hide_detail_prop_fields['garages'] != 1 ) {
                echo '<li><strong>'.esc_html__( 'Garage Size:', 'houzez').'</strong> '.esc_attr( $garage_size ).'</li>';
            }
            if( !empty( $year_built ) && $hide_detail_prop_fields['year_built'] != 1 ) {
                echo '<li><strong>'.esc_html__( 'Year Built:', 'houzez').'</strong> '.esc_attr( $year_built ).'</li>';
            }
            ?>
        </ul>
    </div>

    <?php if( $additional_features_enable != 'disable' && !empty( $additional_features ) && $hide_detail_prop_fields['additional_details'] != 1 ) { ?>
        <div class="detail-title-inner">
            <h4 class="title-inner"><?php esc_html_e( 'Additional details', 'houzez' ); ?></h4>
        </div>
        <ul class="list-three-col">
            <?php
            foreach( $additional_features as $ad_del ):
                echo '<li><strong>'.esc_attr( $ad_del['fave_additional_feature_title'] ).':</strong> '.esc_attr( $ad_del['fave_additional_feature_value'] ).'</li>';
            endforeach;
            ?>
        </ul>
    <?php } ?>
</div>
<?php } ?>