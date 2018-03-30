<?php
/**
 * Tabs
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * title:
 * class:
 */

function tfuse_tabs($atts, $content = null) {
    global $framedtabsheading;
    $framedtabsheading = '';
    extract(shortcode_atts(array('class' => ''), $atts));
    $uniq = rand(1,100);
    $get_tabs = do_shortcode($content);
    $k = 0;

    $out = '<div class="'.$class.'">
            <ul class="nav nav-tabs" id="myTab'.$uniq.'">';

    while (isset($framedtabsheading[$k])) {
        $out .= $framedtabsheading[$k];
        $k++;
    }

    $out .= '</ul>
    <div class="tab-content">'. $get_tabs . '</div></div>
    <script>
        jQuery("#myTab'.$uniq.' a").click(function (e) {
            e.preventDefault();
            jQuery(this).tab("show");
        })
    </script>';

    return $out;
}

$atts = array(
    'name' => __('Tabs','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 8,
    'options' => array(
        array(
            'name' => __('Class','tfuse'),
            'desc' => __('Tabs class (optional),ex: small_tabs','tfuse'),
            'id' => 'tf_shc_tabs_class',
            'value' => '',
            'divider' => TRUE,
            'type' => 'text'
        ),
        array(
            'name' => __('Title','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_tabs_title',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_0 tf_shc_addable'),
            'type' => 'text'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_tabs_content',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_1 tf_shc_addable tf_shc_addable_last'),
            'divider' => TRUE,
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('tabs', 'tfuse_tabs', $atts);

function tfuse_tab($atts, $content = null) {
    global $framedtabsheading;
    extract(shortcode_atts(array('title' => ''), $atts));
    $k = 0;
    while (isset($framedtabsheading[$k])) {
        $k++;
    }
    if($k==0) $class_active = 'active';
    else $class_active = '';
    $tab_uniq = rand(101,200);
    $framedtabsheading[] = '<li class="'.$class_active.'"><a href="#tabs_'.$tab_uniq.'_' . ($k + 1) . '">' . $title . '</a></li>';

    return '<div id="tabs_'.$tab_uniq.'_' . ($k + 1) . '" class="tab-pane '.$class_active.'">' . do_shortcode($content) . '</div>';
}

$atts = array(
    'name' => __('Tab','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 8,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title of an shortcode','tfuse'),
            'id' => 'tf_shc_tab_title',
            'value' => '',
            'type' => 'text'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter the tabs in this format:<i>[tab]Tab content[/tab]...</i>','tfuse'),
            'id' => 'tf_shc_tab_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

add_shortcode('tab', 'tfuse_tab', $atts);