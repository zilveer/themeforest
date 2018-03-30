    <?php
$output = $title = '';

extract(shortcode_atts(array(
	'title' => __("Section", "js_composer"),
    'icon' => '',
    'title_color' => '',
    'background_tab' => '',
    'background_content' => '',
    'title_active_color' => '',
    'item_margin_bottom' => '',
    'item_border' => '',
    'background_tab_active' => ''
), $atts));
/*custom js*/
$unique_id = uniqid().'_'.time();
$uniqid  ="accordion_".$unique_id;
/*end custom js*/
$style='style="';
if($item_margin_bottom!=''){
    $style.='margin-bottom:'.$item_margin_bottom.';';
}
if($item_border!=''){
    $style.='border:'.$item_border.';';
}
$style .= '"';
$icon = ($icon!='')?'<i class="'.$icon.'"></i>':'';
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion_section group', $this->settings['base'], $atts );
echo "\n\t\t\t" . '<div id="'.$uniqid.'" class="'.$css_class. '" '.$style.'>';
    ?>
    <style type="text/css" scoped>
        #<?php echo $uniqid;?> h3.ui-accordion-header-active a{
            <?php if($title_active_color!=''):?>
            color:<?php echo $title_active_color;?>!important;
            <?php endif;
            if($background_tab_active!=''):
            ?>
            background: <?php echo $background_tab_active;?>!important;
            <?php endif;?>
        }
    </style>
    <?php
    $output .= "\n\t\t\t\t" . '<h3  class="wpb_accordion_header ui-accordion-header"><a style="background-color:'.$background_tab.';color:'.$title_color.'" href="#'.sanitize_title($title).'">'.$icon.$title.'</a></h3>';
    $output .= "\n\t\t\t\t" . '<div style="background-color:'.$background_content.'" class="wpb_accordion_content ui-accordion-content vc_clearfix">';
        $output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t\t" . '</div>';
    $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_accordion_section') . "\n";

echo $output;