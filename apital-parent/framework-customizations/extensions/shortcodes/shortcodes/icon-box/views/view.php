<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$icon_box = $atts['icon_box'];// fw_print($icon_box);
?>
<?php if($icon_box['divider_type'] == 'type2'):?>

    <?php $icon = ($icon_box['type2']['icon_box']['icon_type'] == 'awesome') ? $icon_box['type2']['icon_box']['awesome']['icon'] : $icon_box['type2']['icon_box']['custom']['icon']; ?>
    <div class="iconbox-wrapper">
        <?php if(!empty($icon)) : ?>
            <div class="icobox-circle <?php echo esc_attr($atts['class']);?>">
                <div class="w-embed"><i class="<?php echo esc_attr($icon);?>"></i>
                </div>
            </div>
        <?php endif;?>
        <h5><?php echo fw_theme_translate(esc_html($icon_box['type2']['title'])); ?></h5>

        <?php if(!empty($icon_box['type2']['list'])):?>
            <ul class="w-list-unstyled ul-iconbox">
                <?php foreach($icon_box['type2']['list'] as $list): ?>
                    <li class="li-ibox">
                        <p><?php echo fw_theme_translate(esc_html($list)); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif;?>
    </div>

<?php elseif($icon_box['divider_type'] == 'type3'):?>

    <div class="<?php echo esc_attr($atts['class']);?>">
        <?php $icon = ($icon_box['type3']['icon_box']['icon_type'] == 'awesome') ? $icon_box['type3']['icon_box']['awesome']['icon'] : $icon_box['type3']['icon_box']['custom']['icon']; ?>
        <?php if(!empty($icon)) : ?>
            <div class="core-ico ico-minimal">
                <div class="w-embed">
                    <i class="<?php echo esc_attr($icon);?>"></i>
                </div>
            </div>
        <?php endif;?>
        <div class="core-wrapper ">
            <h5><?php echo fw_theme_translate(esc_html($icon_box['type3']['title'])); ?></h5>
            <span class="like-p"><?php echo fw_theme_translate(do_shortcode($icon_box['type3']['desc'])); ?></span>
        </div>
    </div>

<?php elseif($icon_box['divider_type'] == 'type4'):?>

    <div class="iconbox-wrapper ibox-gray-center <?php echo esc_attr($atts['class']);?>">
        <?php $icon = ($icon_box['type4']['icon_box']['icon_type'] == 'awesome') ? $icon_box['type4']['icon_box']['awesome']['icon'] : $icon_box['type4']['icon_box']['custom']['icon']; ?>
        <?php if(!empty($icon)) : ?>
            <div class="icobox-circle ibox-gray">
                <div class="w-embed">
                    <i class="<?php echo esc_attr($icon);?>"></i>
                </div>
            </div>
        <?php endif;?>
        <h5><?php echo fw_theme_translate(esc_html($icon_box['type4']['title'])); ?></h5>
        <span class="like-p"><?php echo fw_theme_translate(do_shortcode($icon_box['type4']['desc'])); ?></span>
    </div>

<?php elseif($icon_box['divider_type'] == 'type5'): ?>
    <?php $carousel = $icon_box['type5']['carousel'];?>

    <?php if(!empty($carousel)):?>
        <div class="w-slider carousel-project <?php echo esc_attr($atts['class']);?>" data-animation="slide" data-duration="500" data-infinite="1" data-ix="show-carousel-pagination" data-nav-spacing="5">
            <div class="w-slider-mask">

            <?php
                $cnt = 0; foreach($carousel as $slide):  $cnt++;
            ?>

                <?php if($cnt == 1 || ($cnt-1) % 3 == 0):?>
                    <div class="w-slide">
                        <div class="w-row">
                <?php endif;?>

                        <div class="w-col w-col-4 w-clearfix">
                            <?php $icon = ($slide['icon_box']['icon_type'] == 'awesome') ? $slide['icon_box']['awesome']['icon'] : $slide['icon_box']['custom']['icon']; ?>
                            <?php if(!empty($icon)) : ?>
                                <div class="core-ico">
                                    <div class="w-embed"><i class="<?php echo esc_attr($icon);?>"></i>
                                    </div>
                                </div>
                            <?php endif;?>
                            <div class="core-wrapper">
                                <h5><?php echo fw_theme_translate(esc_html($slide['title'])); ?></h5>
                                <span class="like-p"><?php echo fw_theme_translate(do_shortcode($slide['desc'])); ?></span>
                            </div>
                        </div>

                <?php if($cnt % 3 == 0 || $cnt == count($carousel)):?>
                        </div>
                    </div>
                <?php endif;?>

            <?php endforeach; ?>

            </div>

            <div class="w-slider-arrow-left w-hidden-medium w-hidden-small w-hidden-tiny vertical-pagination">
                <div class="w-icon-slider-left carousel-arrow"></div>
            </div>
            <div class="w-slider-arrow-right w-hidden-medium w-hidden-small w-hidden-tiny vertical-pagination">
                <div class="w-icon-slider-right carousel-arrow"></div>
            </div>
            <div class="w-slider-nav w-slider-nav-invert w-round carousel-dots"></div>
        </div>
    <?php endif;?>

<?php else: ?>

    <div class="<?php echo esc_attr($atts['class']);?>">
        <?php $icon = ($icon_box['type1']['icon_box']['icon_type'] == 'awesome') ? $icon_box['type1']['icon_box']['awesome']['icon'] : $icon_box['type1']['icon_box']['custom']['icon']; ?>
        <?php if(!empty($icon)) : ?>
            <div class="core-ico">
                <div class="w-embed">
                    <i class="<?php echo esc_attr($icon);?>"></i>
                </div>
            </div>
        <?php endif;?>
        <div class="core-wrapper">
            <h5><?php echo fw_theme_translate(esc_html($icon_box['type1']['title'])); ?></h5>
            <span class="like-p"><?php echo fw_theme_translate(do_shortcode($icon_box['type1']['desc'])); ?></span>
        </div>
    </div>

<?php endif;?>