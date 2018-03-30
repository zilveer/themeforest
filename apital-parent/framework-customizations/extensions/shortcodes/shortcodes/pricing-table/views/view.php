<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$featured = $atts['featured'];
?>
<div class="pricing-table <?php echo esc_attr($atts['class']);?> <?php echo ($featured['enable-featured'] == 'yes') ? : 'featured-price'; ?>">
    <div class="pricing-price">
        <?php if(!empty($atts['title'])):?>
            <div class="pricing-txt"><?php echo fw_theme_translate(esc_html($atts['title']));?></div>
        <?php endif;?>

        <?php if($featured['enable-featured'] == 'yes' && !empty($featured['yes']['title'])):?>
            <div class="featured-txt"><?php echo fw_theme_translate(esc_html($featured['yes']['title']));?></div>
        <?php endif;?>

        <?php if(!empty($atts['price'])):?>
            <div class="circle-price">
                <div><?php echo fw_theme_translate(do_shortcode($atts['price']));?></div>
            </div>
        <?php endif;?>
    </div>

    <?php if(!empty($atts['list'])):?>
        <ul class="w-list-unstyled ul ul-pricing">
            <?php foreach($atts['list'] as $list):?>
                <li class="li-list li-pricing">
                    <p class="p-pricing"><?php echo fw_theme_translate(esc_html($list));?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif;?>

    <?php if($atts['button']['enable-btn'] == 'yes'): $btn = $atts['button'];?>
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
    <?php endif;?>
</div>