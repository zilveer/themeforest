<?php
global $mk_settings;
$title = $el_position = $el_class = '';
extract(shortcode_atts(array(
    'title' => '',
    "container_bg_color" => '#fafafa',
    "orientation" => 'horizontal',
     // horizental, vertical
    "style" => 'style1',
    'responsive' => 'true',
    'el_class' => '',
) , $atts));
$output = '';

$id = Mk_Static_Files::shortcode_id();

$output = '<ul class="mk-tabs-tabs">';
if (preg_match_all("/(.?)\[(vc_tab)\b(.*?)(?:(\/))?\]/s", $content, $matches)) {
    for ($i = 0; $i < count($matches[0]); $i++) {
        $matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
    }
    for ($i = 0; $i < count($matches[0]); $i++) {
        $icon = isset($matches[3][$i]['icon']) ? $matches[3][$i]['icon'] : '';
        $icon_color = isset($matches[3][$i]['icon_color']) ? $matches[3][$i]['icon_color'] : '';
        if ($icon == '') {
            $output.= '<li><a href="#' . $matches[3][$i]['tab_id'] . '">' . $matches[3][$i]['title'] . '</a></li>';
        } 
        else {
            if (!empty($icon)) {
                $icon = (strpos($icon, 'mk-') !== FALSE) ? ($icon) : ('mk-' . $icon);
            } 
            else {
                $icon = '';
            }
            $output.= '<li class="tab-with-icon"><a href="#' . $matches[3][$i]['tab_id'] . '"><i style="color:' . $icon_color . '" class="' . $icon . '"></i>' . $matches[3][$i]['title'] . '</a></li>';
        }
    }
}

$output.= '</ul>';
$output.= '<div class="mk-tabs-panes">';
$output.= "\n\t\t\t" . wpb_js_remove_wpautop($content);
$output.= '<div class="clearboth"></div></div>';

echo '<div id="mk-tabs-' . $id . '" class="mk-tabs ' . $orientation . '-style mobile-' . $responsive . ' ' . $style . '-tabs ' . $el_class . '">' . $output . '<div class="clearboth"></div></div>';



if ($style != 'style3') {
    Mk_Static_Files::addCSS('
        #mk-tabs-' . $id . ' .mk-tabs-tabs li.ui-state-active > a, #mk-tabs-' . $id . ' .mk-tabs-panes .inner-box{
            background-color: ' . $container_bg_color . ';
        }
    ', $id);
}
if ($style == 'style1') {
    Mk_Static_Files::addCSS('
        #mk-tabs-' . $id . ' .mk-tabs-tabs li.ui-state-active a, #mk-tabs-' . $id . ' .mk-tabs-tabs li.ui-state-active a i{
            color: ' . $mk_settings['accent-color'] . ' !important;
        }
    ', $id);
}
