<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );

	/**
	 * @var array $atts
	 */
} ?>

<?php
    $icon = ($atts['icon_box']['icon_type'] == 'awesome') ? $atts['icon_box']['awesome']['icon'] : $atts['icon_box']['custom']['icon'];
    $modal = $atts['modal'];

    $uniq_id = rand(1,1000);
?>
<a target="<?php echo esc_attr( $atts['target'] ); ?>"
   class="w-clearfix w-inline-block button
   <?php echo esc_attr( $atts['size'] ); ?>
   <?php echo esc_attr( $atts['shape'] ); ?>
   <?php echo esc_attr( $atts['colors'] ); ?>
   <?php echo esc_attr( $atts['class'] ); ?>
   <?php echo ($modal['enable-btn'] == 'yes') ? 'modal-btn-popup' : '' ;?>"
   href="<?php echo esc_url( $atts['link'] ); ?>" <?php echo ($modal['enable-btn'] == 'yes') ? 'data-numb="'.$uniq_id.'" data-ix="open-modal-v'.$uniq_id.'"' : '' ;?>>

    <?php if(!empty($icon)):?>
        <div class="btn-ico">
            <div class="w-embed"><i class="<?php echo esc_attr($icon);?>"></i>
            </div>
        </div>
    <?php endif;?>

    <div class="btn-txt"><?php echo fw_theme_translate( esc_attr( $atts['label'] ) ); ?></div>
</a>
<?php if($modal['enable-btn'] == 'yes'): ?>
    <!-- MODAL WRAPPER -->
    <div class="modal_<?php echo esc_attr($uniq_id);?> modal modal-btn-content" >
        <div class="w-container container-popup">
            <div class="popup">
                <a class="w-inline-block remove-modal" href="#" data-numb="<?php echo esc_attr($uniq_id);?>">
                    <div class="w-embed"><i class="fa fa-times"></i>
                    </div>
                </a>
                <div class="hero-center-div">
                    <?php echo fw_theme_translate(do_shortcode($modal['yes']['content']));?>
                </div>
            </div>
        </div>
        <div class="modal-overlay" data-ix="out-click-remove-modal<?php echo esc_attr($uniq_id);?>"></div>
    </div>
    <!-- END MODAL WRAPPER -->
<?php endif;?>