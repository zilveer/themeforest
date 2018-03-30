<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$call_to_action = $atts['call_type'];

$call_class = ($call_to_action['message_type'] == 'custom') ? '' : $call_to_action['message_type'];

//custom type colors
$bg_color = empty($call_class) ? 'style="background-color:'.$call_to_action['custom']['bg_color'].';"' : '';
$text_color = empty($call_class) ? 'style="color:'.$call_to_action['custom']['text_color'].'"' : '';
?>
<div class="call-to-action <?php echo esc_attr($call_class);?> <?php echo esc_attr($atts['class']);?>" <?php echo ($bg_color);?>>
    <div class="w-container">
        <div class="w-row">

            <?php if(!empty($atts['text'])):?>
                <div class="w-col w-col-9 w-col-stack">
                    <h4 class="m-p"><span class="white" <?php echo ($text_color); ?>><?php echo do_shortcode($atts['text']); ?></span></h4>
                </div>
            <?php endif;?>

            <?php if($atts['button']['enable-btn'] == 'yes'): $btn = $atts['button'];?>
                <div class="w-col w-col-3 w-col-stack left-aglin-column">
                    <?php
                        $icon = ($btn['yes']['icon_box']['icon_type'] == 'awesome') ? $btn['yes']['icon_box']['awesome']['icon'] : $btn['yes']['icon_box']['custom']['icon'];
                        $modal = $btn['yes']['modal'];

                        $uniq_id = rand(1,1000);
                    ?>
                    <a target="<?php echo esc_attr( $btn['yes']['target'] ); ?>"
                       class="w-clearfix w-inline-block button
                       <?php echo esc_attr( $btn['yes']['size'] ); ?>
                       <?php echo esc_attr( $btn['yes']['shape'] ); ?>
                       <?php echo esc_attr( $btn['yes']['colors'] ); ?>
                       <?php echo esc_attr( $btn['yes']['class'] ); ?>
                       <?php echo ($btn['yes']['modal']['enable-btn'] == 'yes') ? 'modal-btn-popup' : '' ;?>"
                       href="<?php echo esc_url( $btn['yes']['link'] ); ?>" <?php echo ($btn['yes']['modal']['enable-btn'] == 'yes') ? 'data-numb="'.$uniq_id.'" data-ix="open-modal-v'.$uniq_id.'"' : '' ;?>>

                        <?php if(!empty($icon)):?>
                            <div class="btn-ico">
                                <div class="w-embed"><i class="<?php echo esc_attr($icon);?>"></i>
                                </div>
                            </div>
                        <?php endif;?>

                        <div class="btn-txt"><?php echo fw_theme_translate( esc_attr( $btn['yes']['label'] ) ); ?></div>
                    </a>
                    <?php if($btn['yes']['modal']['enable-btn'] == 'yes'): ?>
                        <!-- MODAL WRAPPER -->
                        <div class="modal_<?php echo esc_attr($uniq_id);?> modal modal-btn-content" data-ix="out-click-remove-modal<?php echo esc_attr($uniq_id);?>">
                            <div class="w-container container-popup">
                                <div class="popup">
                                    <a class="w-inline-block remove-modal" href="#" data-numb="<?php echo esc_attr($uniq_id);?>" data-ix="remove-modal-<?php echo esc_attr($uniq_id); ?>">
                                        <div class="w-embed"><i class="fa fa-times"></i>
                                        </div>
                                    </a>
                                    <div class="hero-center-div">
                                        <?php echo fw_theme_translate(do_shortcode($btn['yes']['modal']['yes']['content']));?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END MODAL WRAPPER -->
                    <?php endif;?>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>