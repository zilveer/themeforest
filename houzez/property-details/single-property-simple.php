<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 21/01/16
 * Time: 7:26 PM
 */
global $post,
       $prop_floor_plan,
       $enable_multi_units,
       $multi_units,
       $prop_video_img,
       $prop_video_url,
       $virtual_tour,
       $prop_features,
       $houzez_prop_detail,
       $prop_description;

$agent_display_option = get_post_meta( $post->ID, 'fave_agent_display_option', true );
$enableDisable_agent_forms = houzez_option('agent_forms');

$prop_detail_nav = houzez_option('prop-detail-nav');
$prop_content_layout = houzez_option('prop-content-layout');
$hide_yelp = houzez_option('houzez_yelp');

$layout = houzez_option('property_blocks');
$layout = $layout['enabled'];
if( isset( $_GET['prop_nav'] ) ) {
    $prop_detail_nav = $_GET['prop_nav'];
}
$prop_description = get_the_content();


if ($layout): foreach ($layout as $key=>$value) {

    switch($key) {

        case 'unit':
            get_template_part('property-details/multi', 'unit');
            break;

        case 'description':
            if( !empty($prop_description) ) {
                get_template_part('property-details/property', 'description');
            }
            break;

        case 'address':
            get_template_part( 'property-details/property', 'address' );
            break;

        case 'details':
            if( $houzez_prop_detail ) {
                get_template_part('property-details/property', 'details');
            }
            break;

        case 'features':
            if( !empty($prop_features) ) {
                get_template_part('property-details/property', 'features');
            }
            break;

        case 'floor_plans':
            if( $prop_floor_plan != 'disable' && !empty( $prop_floor_plan ) ) {
                get_template_part('property-details/floor', 'plans');
            };
            break;

        case 'video':
            get_template_part( 'property-details/property', 'video' );
            break;

        case 'virtual_tour':
            get_template_part( 'property-details/virtual', 'tour' );
            break;

        case 'walkscore':
            get_template_part( 'property-details/walkscore' );
            break;

        case 'stats':
            get_template_part( 'property-details/property', 'stats' );
            break;

        case 'yelp_nearby':
            if( $hide_yelp ) {
                get_template_part('property-details/yelp', 'nearby');
            }
            break;

        case 'agent_bottom':
            get_template_part( 'property-details/agent', 'bottom' );
            break;

    }

}

endif;
?>