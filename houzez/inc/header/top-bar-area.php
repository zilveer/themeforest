<?php
/**
 * Area Switcher
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 12/08/16
 * Time: 1:55 AM
 * Since 1.3.0
 */

$area_switcher_enable = houzez_option('area_switcher_enable');

/* Area Switcher for Header */
if( $area_switcher_enable != 0 ) {

    $current_area = houzez_get_current_area();
    if( $current_area == "sqft" ) {
        $current_area_menu = esc_html__( 'Square feet', 'houzez' );
    } else {
        $current_area_menu = esc_html__( 'Square Meters', 'houzez' );
    }

    echo '<li class="btn-price-lang btn-area">';
    echo '<form id="houzez-area-switcher-form" method="post" action="#" >';
    echo '<button id="houzez-selected-area" class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span>' . $current_area_menu . '</span> <i class="fa fa-sort"></i></button>';
    echo '<ul id="houzez-area-switcher-list" class="dropdown-menu" aria-labelledby="dropdown">';
        echo '<li data-area-code="sqft">'.esc_html__( 'Square feet', 'houzez' ).'</li>';
        echo '<li data-area-code="sq_meter">'.esc_html__( 'Square Meters', 'houzez' ).'</li>';
    echo '</ul>';


    echo '<input type="hidden" id="houzez-switch-to-area" name="houzez_switch_to_area" value="'. $current_area .'" />';
    echo '<input type="hidden" id="houzez_switch_area_text" value="'. $current_area_menu .'" />';
    echo '<input type="hidden" id="area_switch_security" name="nonce" value="'. wp_create_nonce('houzez_switch_area_nonce') .'"/>';

    echo '</form>';
    echo '</li>';
}
?>
