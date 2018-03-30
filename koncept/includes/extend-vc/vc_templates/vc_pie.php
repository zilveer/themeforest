<?php
$title = $el_class = $value = $label_value= $units = '';
extract(shortcode_atts(array(
'title' => '',
'subtitle' => '',
'el_class' => '',
'value' => '50',
'label_value' => '',
'style' => 'regular'
), $atts));

wp_enqueue_script('vc_pie');

$el_class = $this->getExtraClass( $el_class );
$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'krown-pie '.$style.$el_class, $this->settings['base']);
$output = "\n\t".'<div class= "'.$css_class.'">
        <div class="holder">
            <span class="value" data-percent="' . $value . '">' . ( is_numeric( $label_value ) ? $label_value : $value ) . '</span>
            <span class="subtitle">' . $subtitle . '</span>
            <span class="title">' . $title . '</span>
        </div>
    </div>';

  //  $output .= "\n\t\t".'</div>'.$this->endBlockComment('.wpb_wrapper');
    //$output .= "\n\t".'</div>'.$this->endBlockComment('.wpb_pie_chart')."\n";

echo $output;