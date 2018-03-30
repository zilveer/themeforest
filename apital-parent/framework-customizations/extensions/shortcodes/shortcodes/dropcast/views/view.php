<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */
if(!empty($atts['bg_color']) && !empty($atts['textcolor']))
    $style = 'style="background-color: '.$atts['bg_color'].'; color: '.$atts['textcolor'].'"';
elseif(!empty($atts['bg_color']))
    $style = 'style="background-color: '.$atts['bg_color'].';"';
elseif(!empty($atts['textcolor']))
    $style = 'style="color: '.$atts['textcolor'].'"';
else
    $style = '';
?>
<?php if(!empty($atts['letter'])):?>
    <span class="span-like-p clearfix">
        <span class="dropcast <?php echo esc_attr($atts['type']);?> <?php echo esc_attr($atts['class']);?>" <?php echo ($style);?>>
            <?php echo do_shortcode($atts['letter']);?>
        </span>
        <?php echo fw_theme_translate(do_shortcode($atts['text']));?>
    </span>
<?php endif;?>