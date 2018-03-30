<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

?>
<?php if(!empty($atts['text'])):?>
    <div class="blockquote <?php echo esc_attr($atts['type']); ?> <?php echo esc_attr($atts['class']);?>">
        <div><?php echo fw_theme_translate(do_shortcode($atts['text'])); ?></div>
    </div>
<?php endif;?>