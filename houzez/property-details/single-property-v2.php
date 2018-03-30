<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 27/09/16
 * Time: 4:49 PM
 * Since v1.4.0
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

$layout = houzez_option('property_blocks');
$layout = $layout['enabled'];
if( isset( $_GET['prop_nav'] ) ) {
    $prop_detail_nav = $_GET['prop_nav'];
}
$prop_description = get_the_content();

get_template_part('property-details/v2/multi-units');
get_template_part('property-details/v2/property-description-and-details');
get_template_part('property-details/v2/features-and-additional-features');
get_template_part('property-details/v2/address');
get_template_part('property-details/v2/gallery-images');
get_template_part('property-details/v2/floor-plans');
get_template_part('property-details/v2/video');
get_template_part('property-details/v2/walkscore');
get_template_part('property-details/v2/yelp-nearby');
get_template_part('property-details/v2/agent-form');
get_template_part('property-details/v2/stats');

?>
