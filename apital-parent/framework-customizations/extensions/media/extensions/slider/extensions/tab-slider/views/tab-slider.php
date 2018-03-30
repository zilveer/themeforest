<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

?>

<?php if ( isset( $data['slides'] ) && !empty( $data['slides'] )  ) : ?>
    <!-- START SECTION 2 -->
    <section class="section sc-tab">
        <div class="w-container">
            <div class="w-tabs tab-slider" data-duration-in="300" data-duration-out="100">
                <div class="w-tab-content">
                    <?php $count = 0; foreach($data['slides'] as $slide): $count++; ?>
                        <div class="w-tab-pane <?php echo ($count == 1) ? 'w--tab-active' : '' ;?>" data-w-tab="Tab <?php echo esc_attr($count); ?>">
                            <div>
                                <?php if(!empty($slide['src'])):?>
                                    <img src="<?php echo esc_url($slide['src']); ?>" alt="">
                                <?php endif;?>

                                <?php $slide_type = $slide['extra']['type'];?>
                                <!--type caption-->
                                <?php if($slide_type['divider_type'] == 'caption'):?>

                                    <?php if(!empty($slide_type['caption']['text'])):?>
                                        <div class="w-hidden-small w-hidden-tiny caption-tab" data-ix="caption-tab"><?php echo fw_theme_translate(do_shortcode($slide_type['caption']['text']));?></div>
                                    <?php endif?>
                                <!--type left caption-->
                                <?php elseif($slide_type['divider_type'] == 'left-cation'):?>

                                    <div class="w-hidden-small w-hidden-tiny side-cont-tab" data-ix="side-tab">
                                        <?php if(!empty($slide_type['left-cation']['title'])):?>
                                            <div>
                                                <h4 class="h-tb">
                                                    <a class="tab-link-caption" href="<?php echo esc_url($slide_type['left-cation']['url']);?>">
                                                        <?php echo fw_theme_translate(do_shortcode($slide_type['left-cation']['title']));?>
                                                    </a>
                                                </h4>
                                            </div>
                                        <?php endif;?>

                                        <?php if(!empty($slide_type['left-cation']['desc'])):?>
                                            <div class="space">
                                                <p class="p-white"><?php echo fw_theme_translate(do_shortcode($slide_type['left-cation']['desc']));?></p>
                                            </div>
                                        <?php endif;?>

                                        <?php if($slide_type['left-cation']['button']['enable-btn'] == 'yes'):?>
                                            <div class="space">
                                                <?php
                                                    $button = $slide_type['left-cation']['button']['yes'];
                                                    $icon = ($button['icon_box']['icon_type'] == 'awesome') ? $button['icon_box']['awesome']['icon'] : $button['icon_box']['custom']['icon'];
                                                ?>
                                                <a target="<?php echo esc_attr( $button['target'] ); ?>"
                                                   class="w-clearfix w-inline-block button
                                                           <?php echo esc_attr( $button['size'] ); ?>
                                                           <?php echo esc_attr( $button['shape'] ); ?>
                                                           <?php echo esc_attr( $button['colors'] ); ?>
                                                           <?php echo esc_attr( $button['class'] ); ?>"
                                                   href="<?php echo esc_url( $button['link'] ); ?>">

                                                    <?php if(!empty($icon)):?>
                                                        <div class="btn-ico">
                                                            <div class="w-embed"><i class="<?php echo esc_attr($icon);?>"></i>
                                                            </div>
                                                        </div>
                                                    <?php endif;?>

                                                    <div class="btn-txt"><?php echo fw_theme_translate( esc_attr( $button['label'] ) ); ?></div>
                                                </a>
                                            </div>
                                        <?php endif;?>

                                    </div>
                                <!--type top caption-->
                                <?php elseif($slide_type['divider_type'] == 'top-caption'):?>

                                    <?php if(!empty($slide_type['top-caption']['text'])):?>
                                        <a class="w-hidden-small w-hidden-tiny top-line-cap-tab" href="<?php echo esc_url($slide_type['top-caption']['url']);?>"><?php echo fw_theme_translate(do_shortcode($slide_type['top-caption']['text']));?></a>
                                    <?php endif?>

                                <?php endif;?>

                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
                <div class="w-tab-menu w-clearfix">
                    <?php $cnt = 0; foreach($data['slides'] as $slide): $cnt++; ?>
                        <a class="w-tab-link <?php echo ($cnt == 1) ? 'w--current' : '' ;?> w-inline-block tab-slide" data-w-tab="Tab <?php echo esc_attr($cnt);?>">
                            <div class="w-clearfix">
                                <div class="tab-ico-number">
                                    <div><?php echo esc_html($cnt); ?></div>
                                </div>
                                <div class="tab-sl-wrapper">
                                    <h5 class="tittle-tb-slider"><?php echo fw_theme_translate(esc_html($slide['extra']['title']));?></h5>
                                    <p><?php echo fw_theme_translate(esc_html($slide['extra']['subtitle']));?></p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION 2 -->
<?php endif; ?>