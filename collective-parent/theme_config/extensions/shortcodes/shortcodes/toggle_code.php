<?php
/**
 * Code
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 */

class TFUSE_Code_Shortcode {

    static $add_script_for_code;

    static function init() {

        $atts = array(
            'name' => __('Code','tfuse'),
            'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
            'category' => 8,
            'options' => array(
                /* add the fllowing option in case shortcode has content */
                array(
                    'name' => __('Content','tfuse'),
                    'desc' => __('Enter shortcode content','tfuse'),
                    'id' => 'tf_shc_code_content',
                    'value' => '',
                    'type' => 'textarea'
                )
            )
        );

        tf_add_shortcode('code', array(__CLASS__, 'tfuse_code'), $atts);

        add_action('init', array(__CLASS__, 'register_script'));
        add_action('wp_footer', array(__CLASS__, 'print_script'));
        add_action('wp_enqueue_scripts', array(__CLASS__, 'print_styles'));
    }

    static function register_script() {
        $template_directory = get_template_directory_uri();

        wp_register_script('shCore', $template_directory . '/js/shCore.js', array('jquery'), '2.1.382', true);
        wp_register_script('shBrushPlain', $template_directory . '/js/shBrushPlain.js', array('jquery'), '2.1.382', true);
        wp_register_script( 'SyntaxHighlighter', $template_directory.'/js/SyntaxHighlighter.js', array('jquery'), '', true );
    }

    static function print_styles() {
        $template_directory = get_template_directory_uri();

        wp_register_style('shCore', $template_directory . '/css/shCore.css', false, '2.1.382');
        wp_enqueue_style('shCore');

        wp_register_style('shThemeDefault', $template_directory . '/css/shThemeDefault.css', false, '2.1.382');
        wp_enqueue_style('shThemeDefault');
    }

    static function print_script() {
        if (!self::$add_script_for_code)
            return;

        wp_enqueue_script('shCore');
        wp_enqueue_script('shBrushPlain');
        wp_enqueue_script( 'SyntaxHighlighter' );
    }

    static function tfuse_code($atts, $content = null) {
        self::$add_script_for_code = true;

        extract(shortcode_atts(array('brush' => 'plain'), $atts));

        return '<pre class="brush: ' . $brush . '">' . $content . '</pre>';
    }

}

TFUSE_Code_Shortcode::init();