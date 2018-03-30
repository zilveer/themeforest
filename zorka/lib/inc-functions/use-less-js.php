<?php
/**
 * Add less for developer
 */
function zorka_add_less_for_dev () {
    if (defined( 'ZORKA_SCRIPT_DEBUG' ) && ZORKA_SCRIPT_DEBUG) {
        global $zorka_data;
        $primary_color = $zorka_data['primary-color'];
        $primary_color = str_replace('#','',$primary_color);

        $text_color = $zorka_data['text-color'];
        $text_color = str_replace('#','',$text_color);

        $text_bold_color = $zorka_data['text-bold-color'];
        $text_bold_color = str_replace('#','',$text_bold_color);


        echo '<link rel="stylesheet/less" type="text/css" href="'. get_template_directory_uri(). '/less.php?primary-color=' . $primary_color. '&amp;text-color=' . $text_color. '&amp;text-bold-color=' . $text_bold_color . '&amp;theme-url=' . THEME_URL.'"/>';
        echo '<script src="'. THEME_URL. 'assets/js/less-1.7.3.min.js"></script>';

        require_once ( THEME_DIR . "lib/inc-generate-less/custom-css.php" );
        $css = zorka_custom_css();
        echo '<style>' . $css . '</style>';
    }
}
add_action('wp_head','zorka_add_less_for_dev', 100);