<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


global $revSliderVersion;

// fix for Revolution Slider 4.6.3
function yit_revslider_slider()
{
    $operations = new RevOperations();
    $arrValues = $operations->getGeneralSettingsValues();

    $includesGlobally = UniteFunctionsRev::getVal($arrValues, "includes_globally","on");

    $isWidgetActive = is_active_widget( false, false, "rev-slider-widget", true );
    $hasShortcode = UniteFunctionsWPRev::hasShortcode("rev_slider");

    if ( YIT_Layout()->slider_name===false || (YIT_Layout()->slider_name != 'none' && YIT_Slider::get_slider( YIT_Layout()->slider_name )->config->layout != 'revolution-slider') || $includesGlobally == "on" || $isWidgetActive || $hasShortcode ) {
        return;
    }

    if ( defined( 'RS_PLUGIN_URL' ) ) {
        wp_enqueue_style( 'rs-plugin-settings', RS_PLUGIN_URL . 'public/assets/css/settings.css', array(), RevSliderGlobals::SLIDER_REVISION );
    }
    else {
        wp_enqueue_style( "rs-plugin-settings", UniteBaseClassRev::$url_plugin . "rs-plugin/css/settings.css", array(), GlobalsRevSlider::SLIDER_REVISION );
    }

    $custom_css = RevOperations::getStaticCss();
    $custom_css = UniteCssParserRev::compress_css($custom_css);
    wp_add_inline_style('rs-plugin-settings', $custom_css);

    $setBase = (is_ssl()) ? "https://" : "http://";

    $url_jquery = $setBase . "ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js?app=revolution";
    wp_enqueue_script("jquery", $url_jquery);

    // put javascript to footer
    add_action('wp_footer', array($GLOBALS['productFront'], 'putJavascript'));
}

if(version_compare( preg_replace( '/-beta-([0-9]+)/', '', $revSliderVersion ), '4.6', '>=' )){
    add_action( 'wp_head', 'yit_revslider_slider' );
}


// remove description field for the slide configuration
$this->add_description_field( 'no' );

$this->add_layout_fields( array(

    /*'slider_desc' =>array(
        'type' => 'simple-text',
        'desc' => sprintf( __( 'Configure the slider in <a href="%s">Revolution Slider</a> page and then select below the slider to use for this slider.', 'yit' ), admin_url( 'admin.php?page=revslider' ) )
    ),
*/
    'slider_name' => array(

        'label' => __('Select the slider', 'yit'),
        'desc' => __('Select the slider you want to show when you want to show this slider.', 'yit'),
        'type' => 'select',
        'options' => yit_get_revolution_sliders()
    )

) );


function yit_get_revolution_sliders() {
    global $wpdb;

    if ( ! yit_if_thereis_revslider() ) {
        return array();
    }

    $tableName = GlobalsRevSlider::$table_sliders;

    $slider = new RevSlider();
    return $slider->getArrSlidersShort();

}

function yit_if_thereis_revslider() {
    global $wpdb;

    if ( ! class_exists( 'GlobalsRevSlider' ) ) return false;

    $table_sliders = GlobalsRevSlider::$table_sliders;
    $table_slides  = GlobalsRevSlider::$table_slides;

    if ( $wpdb->get_var("show tables like '$table_sliders'") == $table_sliders && $wpdb->get_var("show tables like '$table_slides'") == $table_slides ) {
        return true;
    }

    return false;
}