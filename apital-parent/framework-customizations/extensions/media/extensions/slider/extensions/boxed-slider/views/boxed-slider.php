<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
?>

<?php if ( isset( $data['slides'] ) && !empty( $data['slides'] ) ) : ?>
    <!-- START BOXED SLIDER -->
    <div class="w-section section pattern" id="top" data-ix="show-top-btn">
        <div class="w-container" data-ix="hide-rotator-on-scroll">
            <div>
                <div class="w-slider boxed-slider" data-animation="slide" data-duration="500" data-infinite="1" data-ix="show-carousel-pagination" data-nav-spacing="5">
                    <div class="w-slider-mask">
                        <?php foreach($data['slides'] as $slide):?>
                            <div class="w-slide">
                                <div class="w-row">
                                    <?php if($slide['extra']['alignment'] == 'left'):?>
                                        <div class="w-col w-col-5 col-center">
                                            <div class="change-tp-2 boxed-slider-wrapper <?php echo (esc_attr($slide['multimedia_type']) == 'video') ? 'embed-pull-left' : ''?>">

                                                <?php if(!empty($slide['extra']['title'])):?>
                                                    <h1 class="h-mi" data-ix="move-from-left-txt-slider-3"><span><?php echo fw_theme_translate(do_shortcode($slide['extra']['title']));?></span></h1>
                                                <?php endif;?>

                                                <?php if(!empty($slide['extra']['text'])):?>
                                                    <div class="slider-sub-text bx-slider" data-ix="zom-in-out-txt-slider-4">
                                                        <div><?php echo fw_theme_translate(do_shortcode($slide['extra']['text']));?></div>
                                                    </div>
                                                <?php endif;?>

                                                <?php if($slide['extra']['button']['enable-btn'] == 'yes'):?>
                                                    <div class="space x1">
                                                        <?php
                                                        $button = $slide['extra']['button']['yes'];
                                                        $icon = ($button['icon_box']['icon_type'] == 'awesome') ? $button['icon_box']['awesome']['icon'] : $button['icon_box']['custom']['icon'];
                                                        ?>
                                                        <a target="<?php echo esc_attr( $button['target'] ); ?>"
                                                           class="w-clearfix w-inline-block button
                                                           <?php echo esc_attr( $button['size'] ); ?>
                                                           <?php echo esc_attr( $button['shape'] ); ?>
                                                           <?php echo esc_attr( $button['colors'] ); ?>
                                                           <?php echo esc_attr( $button['class'] ); ?>"
                                                           href="<?php echo esc_url( $button['link'] ); ?>" data-ix="move-from-bottom-txt-slider-4">

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
                                        </div>
                                        <div class="w-col w-col-7 col-center">
                                            <?php if(!empty($slide['src'])):?>
                                                <?php if($slide['multimedia_type'] == 'video'):?>
                                                    <div id="change-tp-4" class="embed-sl embed-pull-right">
                                                        <?php
                                                            global $wp_embed;
                                                            $iframe = $wp_embed->run_shortcode( '[embed]' . trim( $slide['src'] ) . '[/embed]' );
                                                        ?>
                                                        <div class="w-embed w-video" style="padding-top: 56.27659574468085%;">
                                                            <?php echo do_shortcode($iframe);?>
                                                        </div>
                                                    </div>
                                                <?php else:?>
                                                    <div>
                                                        <img src="<?php echo esc_url($slide['src']); ?>" alt="">
                                                    </div>
                                                <?php endif;?>
                                            <?php endif;?>
                                        </div>
                                    <?php else:?>
                                        <div class="w-col w-col-7 col-center">
                                            <?php if(!empty($slide['src'])):?>
                                                <?php if($slide['multimedia_type'] == 'video'):?>
                                                    <div  id="change-tp-4" class="embed-sl">
                                                        <?php
                                                            global $wp_embed;
                                                            $iframe = $wp_embed->run_shortcode( '[embed]' . trim( $slide['src'] ) . '[/embed]' );
                                                        ?>
                                                        <div class="w-embed w-video" style="padding-top: 56.27659574468085%;">
                                                            <?php echo do_shortcode($iframe);?>
                                                        </div>
                                                    </div>
                                                <?php else:?>
                                                    <div class="change-tp-2 boxed-slider-wrapper image-pull-left">
                                                        <img src="<?php echo esc_url($slide['src']); ?>" alt="">
                                                    </div>
                                                <?php endif;?>
                                            <?php endif;?>
                                        </div>
                                        <div class="w-col w-col-5 col-center">
                                            <div>
                                                <div id="change-tp-3" class="boxed-slider-wrapper bx-right <?php echo (esc_attr($slide['multimedia_type']) == 'image') ? 'image-pull-left' : ''?>">
                                                    <?php if(!empty($slide['extra']['title'])):?>
                                                        <h1 class="h-mi" data-ix="move-from-left-txt-slider-3"><span><?php echo fw_theme_translate(do_shortcode($slide['extra']['title']));?></span></h1>
                                                    <?php endif;?>

                                                    <?php if(!empty($slide['extra']['text'])):?>
                                                        <div class="slider-sub-text bx-slider" data-ix="zom-in-out-txt-slider-4">
                                                            <div><?php echo fw_theme_translate(do_shortcode($slide['extra']['text']));?></div>
                                                        </div>
                                                    <?php endif;?>

                                                    <?php if($slide['extra']['button']['enable-btn'] == 'yes'):?>
                                                        <div class="space x1">
                                                            <?php
                                                            $button = $slide['extra']['button']['yes'];
                                                            $icon = ($button['icon_box']['icon_type'] == 'awesome') ? $button['icon_box']['awesome']['icon'] : $button['icon_box']['custom']['icon'];
                                                            ?>
                                                            <a target="<?php echo esc_attr( $button['target'] ); ?>"
                                                               class="w-clearfix w-inline-block button
                                                           <?php echo esc_attr( $button['size'] ); ?>
                                                           <?php echo esc_attr( $button['shape'] ); ?>
                                                           <?php echo esc_attr( $button['colors'] ); ?>
                                                           <?php echo esc_attr( $button['class'] ); ?>"
                                                               href="<?php echo esc_url( $button['link'] ); ?>" data-ix="move-from-bottom-txt-slider-4">

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
                                            </div>
                                        </div>
                                    <?php endif;?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="w-slider-arrow-left vertical-pagination v-p-remove-mg">
                        <div class="w-icon-slider-left carousel-arrow"></div>
                    </div>
                    <div class="w-slider-arrow-right vertical-pagination v-p-remove-mg">
                        <div class="w-icon-slider-right carousel-arrow"></div>
                    </div>
                    <div class="w-slider-nav w-slider-nav-invert w-round dots-boxed-slider"></div>
                </div>
                <div class="w-hidden-medium w-hidden-small w-hidden-tiny shadow-slider"></div>
            </div>
        </div>
    </div>
    <!-- END BOXED SLIDER -->
<?php endif; ?>