<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$message_type = $atts['message_type'];

$icon = ($atts['icon_box']['icon_type'] == 'awesome') ? $atts['icon_box']['awesome']['icon'] : $atts['icon_box']['custom']['icon'];
?>
<div class="<?php echo !empty($icon) ? 'w-clearfix' : '' ; ?> alert-message <?php echo esc_attr($message_type);?> <?php echo esc_attr($atts['class']);?>">
    <?php if(!empty($icon)): ?>
        <div class="remove-alert">
            <div class="w-embed"><i class="<?php echo esc_attr($icon);?>"></i>
            </div>
        </div>
    <?php endif;?>
    <div><?php echo do_shortcode($atts['message']);?></div>
</div>