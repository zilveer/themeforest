<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $slidestoshow
 * @var $arrows
 * @var $dots
 * @var $centermode
 * @var $autoplay
 * @var $responsive
 * @var $animation
 * @var $effect
 * @var $delay
 * Shortcode class
 * @var $this WPBakeryShortCode_Cth_Slickslider
 */
$el_class = $slidestoshow = $arrows = $dots = $centermode = $autoplay = $responsive = $animation = $effect = $delay = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$ani_de = '';
if($animation == 'yes'){
    $el_class .= ' wow '.$effect;
    if(!empty($delay)){
        $ani_de = ' data-wow-delay="'.$delay.'"';
    }
}

$options = new stdClass;
if(!empty($slidestoshow)){
    $options->slidesToShow = (int)$slidestoshow;
    $options->slidesToScroll = (int)$slidestoshow;

}else{
    $options->slidesToShow = 6;
    $options->slidesToScroll = 6;
}
$options->infinite = true;
if($arrows == 'false'){
    $options->arrows = false;
}
if($dots == 'true'){
    $options->dots = true;
}
if($centermode == 'true'){
    $options->centerMode = true;
}
if($autoplay == 'true'){
    $options->autoplay = true;
}
if(!empty($responsive)){
    $options->responsive = array();
    $v_s = explode("|", $responsive);
    if(!empty($v_s)){
        foreach ($v_s as $vs_v) {
            $v_s_v = explode(":", $vs_v);
            $res = new stdClass;
            $res->breakpoint = (int)$v_s_v[0];
            $res->settings = new stdClass;
            if($arrows == 'false'){
                $res->settings->arrows = false;
            }
            if($dots == 'true'){
                $res->settings->dots = true;
            }
            if($centermode == 'true'){
                $res->settings->centerMode = true;
            }
            if($autoplay == 'true'){
                $res->settings->autoplay = true;
            }
            $res->settings->slidesToShow = (int)$v_s_v[1];
            $res->settings->slidesToScroll = (int)$v_s_v[1];
            $options->responsive[] = $res;
        }
    }
}


?>
<div class="slick-slider <?php echo esc_attr($el_class );?>"<?php echo esc_html($ani_de );?> data-slick='<?php echo json_encode($options);?>'>
    <?php echo wpb_js_remove_wpautop($content);?>
</div>