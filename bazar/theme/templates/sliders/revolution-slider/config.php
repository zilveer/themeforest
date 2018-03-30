<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'YIT_REVSLIDER_DIR', dirname(__FILE__) );
define( 'YIT_REVSLIDER_URL', YIT_THEME_SLIDERS_URL . '/' . $slider_type );

global $revSliderVersion;

// fix for Revolution Slider 4.6.3
function yit_revslider_slider()
{
    $operations = new RevOperations();
    $arrValues = $operations->getGeneralSettingsValues();

    $includesGlobally = UniteFunctionsRev::getVal($arrValues, "includes_globally","on");

    $isWidgetActive = is_active_widget( false, false, "rev-slider-widget", true );
    $hasShortcode = UniteFunctionsWPRev::hasShortcode("rev_slider");

    if ( yit_slider_get_setting('slider_type',yit_slider_name()) != 'revolution-slider' || $includesGlobally == "on" || $isWidgetActive || $hasShortcode ) {
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


// add the check in case you use the [button]
function yit_add_revslider_slides_buttons( $to_check ) {
    global $wpdb;
    
    if ( ! yit_if_thereis_revslider() ) return $to_check;
    
    $table = GlobalsRevSlider::$table_slides;
    $slides = $wpdb->get_col( "SELECT layers FROM $table" );
    
    return array_merge( $to_check, $slides );    
}                                       
add_filter( 'yit_sc_button_include_content', 'yit_add_revslider_slides_buttons' );

// add the table for the importer of sample data
function yit_add_revslider_db_tables( $tables ) {
    global $wpdb;                                
    
   // if ( ! yit_if_thereis_revslider() ) return $tables;

    $tables[] = str_replace( $wpdb->prefix, '', GlobalsRevSlider::$table_sliders );
    $tables[] = str_replace( $wpdb->prefix, '', GlobalsRevSlider::$table_slides );
    $tables[] = str_replace( $wpdb->prefix, '', GlobalsRevSlider::$table_static_slides );
    $tables[] = str_replace( $wpdb->prefix, '', GlobalsRevSlider::$table_settings );
    $tables[] = str_replace( $wpdb->prefix, '', GlobalsRevSlider::$table_css );
    $tables[] = str_replace( $wpdb->prefix, '', GlobalsRevSlider::$table_layer_anims );

    return $tables;    
}           
add_filter( 'yit_sample_data_tables', 'yit_add_revslider_db_tables' );

// add the layer slider in the sample data
//add_filter( 'yit_sample_data_options', create_function( '$options', '$options[] = "layerslider-slides"; return $options;' ) );

// set here if the slider is reponsive or not
$this->responsive_sliders[ $slider_type ] = true;
 
// add the slider fields for the admin
yit_add_slider_config( $slider_type, array(
	array(
        'type' => 'simple-text',
        'desc' => sprintf( __( 'Configure the slider in <a href="%s">Revolution Slider</a> page and then select below the slider to use for this slider.', 'yit' ), admin_url( 'admin.php?page=revslider' ) )
    ),
	array(
        'id' => 'slider_name', 
        'name' => __('Select the slider', 'yit'),        
        'desc' => __('Select the slider you want to show when you want to show this slider.', 'yit'),
        'type' => 'select',   
        'options' => yit_get_revolution_sliders()
    ),
	array(
        'id' => 'slider_text', 
        'name' => __('Additional text', 'yit'),        
        'desc' => __("Write here some html content to show near the slider. Leave empty if you don't want any content near the slider (this text will not shown when you put the slider inside the page content).", 'yit'),
        'type' => 'textarea-editor'
    ),
	array(
        'id' => 'slider_align', 
        'name' => __('Additional text align', 'yit'),        
        'desc' => __("Set where you want to put the html content, on right or left side of slider.", 'yit'),
        'type' => 'select',
        'options' => array(
            'left' => __( 'Left', 'yit' ),
            'right' => __( 'Right', 'yit' ),
        ),
        'std' => 'right'
    )
)); 

function yit_get_revolution_sliders() {

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