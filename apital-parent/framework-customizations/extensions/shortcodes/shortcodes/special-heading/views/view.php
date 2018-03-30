<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */

if ( empty( $atts['title'] ) ) {
	return;
}

$special_heading = $atts['special_heading_type'];

$style = !empty($atts['color']) ? 'style="color: '.$atts['color'].' "' : '';
?>
<?php if($special_heading['heading_type'] == '2'):?>
    <div class="tittle-line <?php echo esc_attr($atts['class']);?>">
        <<?php echo esc_attr($atts['heading']);?> <?php echo ($style);?>>
            <?php echo fw_theme_translate(do_shortcode($atts['title'])); ?>
        </<?php echo esc_attr($atts['heading']);?>>
        <div class="divider-1 small">
            <div class="divider-small"></div>
        </div>
    </div>
<?php elseif($special_heading['heading_type'] == '3'):?>
    <div class="tittle-wrapper">
        <<?php echo esc_attr($atts['heading']);?> class="<?php echo esc_attr($atts['class']);?>" <?php echo ($style);?>>
            <?php echo fw_theme_translate(do_shortcode($atts['title'])); ?>
        </<?php echo esc_attr($atts['heading']);?>>

        <?php if(!empty($special_heading['3']['subtitle'])):?>
            <div class="sub-tittle"><?php echo fw_theme_translate(do_shortcode($special_heading['3']['subtitle'])); ?></div>
        <?php endif;?>

        <?php if($special_heading['3']['button']['enable-btn'] == 'yes'): $uniq_id = rand(1,1000);?>
            <?php $button = $special_heading['3']['button']['yes'];?>
            <div class="space x1">
                <?php $icon = ($button['icon_box']['icon_type'] == 'awesome') ? $button['icon_box']['awesome']['icon'] : $button['icon_box']['custom']['icon']; ?>
                <a target="<?php echo esc_attr( $button['target'] ); ?>"
                   class="w-clearfix w-inline-block button
                   <?php echo esc_attr( $button['size'] ); ?>
                   <?php echo esc_attr( $button['shape'] ); ?>
                   <?php echo esc_attr( $button['colors'] ); ?>
                   <?php echo esc_attr( $button['class'] ); ?>
                   <?php echo ($button['modal']['enable-btn'] == 'yes') ? 'modal-btn-popup' : '' ;?>"
                   href="<?php echo esc_url( $button['link'] ); ?>" <?php echo ($button['modal']['enable-btn'] == 'yes') ? 'data-numb="'.$uniq_id.'" data-ix="open-modal-v'.$uniq_id.'"' : '' ;?>>

                    <?php if(!empty($icon)):?>
                        <div class="btn-ico">
                            <div class="w-embed"><i class="<?php echo esc_attr($icon);?>"></i>
                            </div>
                        </div>
                    <?php endif;?>

                    <div class="btn-txt"><?php echo fw_theme_translate( esc_attr( $button['label'] ) ); ?></div>
                </a>
                <?php if($button['modal']['enable-btn'] == 'yes'): ?>
                    <!-- MODAL WRAPPER -->
                    <div class="modal_<?php echo esc_attr($uniq_id);?> modal modal-btn-content" data-ix="out-click-remove-modal<?php echo esc_attr($uniq_id);?>">
                        <div class="w-container container-popup">
                            <div class="popup">
                                <a class="w-inline-block remove-modal" href="#" data-numb="<?php echo esc_attr($uniq_id);?>" data-ix="remove-modal-<?php echo esc_attr($uniq_id); ?>">
                                    <div class="w-embed"><i class="fa fa-times"></i>
                                    </div>
                                </a>
                                <div class="hero-center-div">
                                    <?php echo fw_theme_translate(do_shortcode($button['modal']['yes']['content']));?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL WRAPPER -->
                <?php endif;?>
            </div>
        <?php endif; ?>
    </div>
<?php else:?>
    <<?php echo esc_attr($atts['heading']);?> class="<?php echo esc_attr($atts['class']);?>" <?php echo ($style);?>>
        <?php echo fw_theme_translate(do_shortcode($atts['title'])); ?>
    </<?php echo esc_attr($atts['heading']);?>>
<?php endif;?>