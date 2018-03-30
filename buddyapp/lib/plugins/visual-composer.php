<?php

vc_set_as_theme( true );


add_action('vc_before_init', 'buddy_vc_manipulate_shortcodes');


function buddy_vc_manipulate_shortcodes() {

    $el_class = array(
        "type" => "textfield",
        "holder" => 'div',
        'class' => 'hide hidden',
        "heading" => esc_html__("Extra class name", "js_composer"),
        "param_name" => "el_class",
        "value" => "",
        "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.","js_composer")
    );

    /* Block Grid */
    vc_map(
        array(
            'base'            => 'kleo_dashboard',
            'name'            => esc_html__( 'Dashboard Item', 'buddyapp' ),
            'weight'          => 6,
            'class'           => '',
            'icon'            => 'block-grid',
            'category'        => "Content",
            'description'     => esc_html__( 'Nice dashboard layout item', 'buddyapp' ),
            'content_element' => true,
            "as_parent" => array('except' => 'kleo_dashboard'),
            'js_view'         => 'VcColumnView',
            'params'          => array(
                array(
                    'param_name'  => 'title',
                    'heading'     => esc_html__( 'Title', 'buddyapp' ),
                    'description' => esc_html__( 'Dashboard title', 'buddyapp' ),
                    'type'        => 'textfield',
                    'holder'      => "div",
                    'class' => 'hide hidden',
                ),
                array(
                    "type" => "dropdown",
                    "class" => "hide hidden",
                    "holder" => 'div',
                    "heading" => esc_html__("Title bottom stroke", "buddyapp"),
                    "param_name" => "title_stroke",
                    "value" => array(
                        "Yes" => "yes",
                        "No" => "no",
                    ),
                    "dependency" => array(
                        "element" => "title",
                        "not_empty" => true
                    ),
                    "description" => ""
                ),

                $el_class,

            )
        )
    );

    vc_map(
        array(
            "name" => esc_html__("Chat", "buddyapp"),
            "base" => "wise-chat",
            "class" => "",
            "weight" => "6",
            "category" => esc_html__('Content', "js_composer"),
            "icon" => "wise-chat",
            "params" => array(
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_html__("Chanel Name", "buddyapp"),
                    "param_name" => "channel",
                    "value" => "",
                    "description" => esc_html__("Channel name from plugin", "buddyapp")
                ),

            ),
            "description" => esc_html__("Show chat window", "buddyapp")
        )
    );

    $row_attributes = array(
        'type' => 'checkbox',
        'heading' => "Enable masonry columns",
        'param_name' => 'sq_enable_masonry',
        'value' => array( esc_html__( 'Yes', 'js_composer' ) => 'yes' ),
        'description' => esc_html__( "This will transform the columns in masonry layout", "buddyapp" )
    );
    vc_add_param( 'vc_row', $row_attributes );

}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Kleo_Dashboard extends WPBakeryShortCodesContainer {
    }
}


/* HELPERS */

if ( ! function_exists( 'vc_shortcode_custom_css_has_property' ) ) {
    /**
     * @param $subject
     * @param $property
     * @param bool|false $strict
     *
     * @since 4.9
     * @return bool
     */
    function vc_shortcode_custom_css_has_property($subject, $property, $strict = false)
    {
        $styles = array();
        $pattern = '/\{([^\}]*?)\}/i';
        preg_match($pattern, $subject, $styles);
        if (array_key_exists(1, $styles)) {
            $styles = explode(';', $styles[1]);
        }
        $new_styles = array();
        foreach ($styles as $val) {
            $val = explode(':', $val);
            if (is_array($property)) {
                foreach ($property as $prop) {
                    $pos = strpos($val[0], $prop);
                    $full = ($strict) ? ($pos === 0 && strlen($val[0]) === strlen($prop)) : true;
                    if ($pos !== false && $full) {
                        $new_styles[] = $val;
                    }
                }
            } else {
                $pos = strpos($val[0], $property);
                $full = ($strict) ? ($pos === 0 && strlen($val[0]) === strlen($property)) : true;
                if ($pos !== false && $full) {
                    $new_styles[] = $val;
                }
            }
        }

        return !empty($new_styles);
    }
}



/* Disable VC auto-update */
function kleo_vc_disable_update() {
    if (function_exists('vc_license') && function_exists('vc_updater') && ! vc_license()->isActivated()) {

        remove_filter( 'upgrader_pre_download', array( vc_updater(), 'preUpgradeFilter' ), 10, 4 );
        remove_filter( 'pre_set_site_transient_update_plugins', array(
            vc_updater()->updateManager(),
            'check_update'
        ) );

    }
}
add_action( 'admin_init', 'kleo_vc_disable_update', 9 );



/* Remove shortcodes from Visual composer showing in activity */
add_filter( 'bp_get_activity_content_body','sq_bp_activity_filter', 1 );
function sq_bp_activity_filter( $content ) {
    $content = preg_replace("/\[(.*?)(?:(\/))?\](?:(.+?)\[\/\2\])?/s",'', $content);
    return $content;
}