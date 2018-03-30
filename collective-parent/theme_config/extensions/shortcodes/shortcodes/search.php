<?php
/**
 * Search form
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 */

function tfuse_search()
{
    ob_start();
    locate_template('searchform.php', true, false);
    $buffer = ob_get_contents();
    ob_end_clean();

    return $buffer;
}

$atts = array(
    'name' => __('Search','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
    )
);

tf_add_shortcode('search', 'tfuse_search', $atts);