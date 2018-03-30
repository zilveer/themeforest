<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $from_number
 * @var $to_number
 * @var $speed
 * @var $icon_class
 * @var $content
 * Shortcode class
 * @var $this WPBakeryShortCode_Cth_Counter
 */
$el_class = $from_number = $to_number = $speed = $icon_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
//$countdown_data = trim($date).' '.trim($month) .' '.trim($year).' '. trim($time);
?>
<div class="stats-info <?php echo esc_attr($el_class );?>">
<?php if(!empty($icon_class)) :?>
    <i class="<?php echo esc_attr($icon_class );?>"></i>
<?php endif;?>
    <h2><span class="count" data-from="<?php echo esc_attr($from_number );?>" data-to="<?php echo esc_attr($to_number );?>" data-speed="<?php echo esc_attr($speed );?>"><?php echo esc_attr($to_number );?></span></h2>
    <?php echo wpb_js_remove_wpautop($content,true); ?>
</div>