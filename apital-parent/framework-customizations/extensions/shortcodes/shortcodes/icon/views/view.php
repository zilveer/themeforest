<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */

$icon = ($atts['icon_box']['icon_type'] == 'awesome') ? $atts['icon_box']['awesome']['icon'] : $atts['icon_box']['custom']['icon'];
?>

<?php if(!empty($icon)):?>
    <div class="anim-wrapper">
        <div class="animation-ico <?php echo esc_attr($atts['class']);?>" data-wow-delay="1s">
            <div class="w-embed"><i class="<?php echo esc_attr($icon);?>"></i>
            </div>
        </div>
    </div>
<?php endif;?>