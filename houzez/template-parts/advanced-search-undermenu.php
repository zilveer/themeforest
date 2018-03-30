<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 20/01/16
 * Time: 6:31 PM
 */
global $status,
       $type,
       $state,
       $location,
       $area,
       $searched_country,
       $search_template,
       $measurement_unit_adv_search,
       $adv_search_price_slider,
       $hide_advanced,
       $keyword_field_placeholder,
       $adv_show_hide,
       $houzez_local;

$search_template = houzez_get_search_template_link();
$measurement_unit_adv_search = houzez_option('measurement_unit_adv_search');

if( $measurement_unit_adv_search == 'sqft' ) {
    $measurement_unit_adv_search = houzez_option('measurement_unit_sqft_text');
} elseif( $measurement_unit_adv_search == 'sq_meter' ) {
    $measurement_unit_adv_search = houzez_option('measurement_unit_square_meter_text');
}

$adv_search_price_slider = houzez_option('adv_search_price_slider');
$adv_show_hide = houzez_option('adv_show_hide');
$hide_advanced = false;
$keyword_field = houzez_option('keyword_field');

if( $keyword_field == 'prop_title' ) {
    $keyword_field_placeholder = $houzez_local['keyword_text'];

} else if( $keyword_field == 'prop_city_state_county' ) {
    $keyword_field_placeholder = $houzez_local['city_state_area'];

} else if( $keyword_field == 'prop_address' ) {
    $keyword_field_placeholder = $houzez_local['search_address'];

} else {
    $keyword_field_placeholder = $houzez_local['enter_location'];
}

if( isset( $_GET['status'] ) ) {
    $status = $_GET['status'];
}
if( isset( $_GET['type'] ) ) {
    $type = $_GET['type'];
}
if( isset( $_GET['location'] ) ) {
    $location = $_GET['location'];
}
if( isset( $_GET['area'] ) ) {
    $area = $_GET['area'];
}
if( isset( $_GET['state'] ) ) {
    $state = $_GET['state'];
}
if( isset( $_GET['country'] ) ) {
    $searched_country = $_GET['country'];
}

if( $adv_show_hide['status']         != 0 &&
    $adv_show_hide['type']           != 0 &&
    $adv_show_hide['beds']           != 0 &&
    $adv_show_hide['baths']          != 0 &&
    $adv_show_hide['min_area']       != 0 &&
    $adv_show_hide['max_area']       != 0 &&
    $adv_show_hide['min_price']      != 0 &&
    $adv_show_hide['max_price']      != 0 &&
    $adv_show_hide['price_slider']   != 0 &&
    $adv_show_hide['area_slider']    != 0 &&
    $adv_show_hide['other_features'] != 0  ) {

    $hide_advanced = true;
}

get_template_part( 'template-parts/advanced-search/desktop' );
get_template_part( 'template-parts/advanced-search/mobile' );
?>
