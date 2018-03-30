<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
?>
<?php if ( isset( $data['slides'] ) && !empty($data['slides']) ) : ?>
    <!-- START BUSINESS SLIDER -->
    <div class="banner bussines-slider-1" id="top" data-ix="show-top-btn">
        <div class="w-slider bussines-slider" data-animation="slide" data-duration="500" data-infinite="1">
            <div class="w-slider-mask">
                <div class="arrow"></div>
                <?php foreach($data['slides'] as $slide):?>
                    <div class="w-slide">
                    <div class="w-container">
                        <div class="w-row row-slider">
                            <?php if($slide['extra']['alignment'] == 'left'):?>
                                <div class="w-col w-col-6 w-col-stack w-hidden-small w-hidden-tiny col-center">
                                    <?php if(!empty($slide['src'])):?>
                                        <div class="w-hidden-medium w-hidden-small w-hidden-tiny" data-ix="move-mascot-slide">
                                            <img src="<?php echo esc_url($slide['src']);?>" alt="">
                                        </div>
                                    <?php endif;?>
                                </div>
                                <div class="w-col w-col-6 w-col-stack">
                                    <div class="change-tp bslider-txt-wrapper">
                                        <?php if(!empty($slide['title'])):?>
                                            <h1 class="slid-bus-txt" data-ix="zom-in-out-txt-slider">
                                                <span class="white"><?php echo fw_theme_translate(esc_html($slide['title']));?></span>
                                            </h1>
                                        <?php endif;?>

                                        <?php if(!empty($slide['extra']['subtitle'])):?>
                                            <div class="slider-sub-text">
                                                <div data-ix="move-from-bottom-txt-slider"><?php echo fw_theme_translate(esc_html($slide['extra']['subtitle']));?></div>
                                            </div>
                                        <?php endif;?>

                                        <?php if(!empty($slide['desc'])):?>
                                            <div class="space" data-ix="move-from-left-txt-slider">
                                                <p class="white"><?php echo fw_theme_translate(do_shortcode($slide['desc']));?></p>
                                            </div>
                                        <?php endif;?>

                                        <?php if($slide['extra']['button1']['enable-btn'] == 'yes' || $slide['extra']['button2']['enable-btn'] == 'yes'):?>
                                            <div class="space x1">
                                                <?php if($slide['extra']['button1']['enable-btn'] == 'yes'): ?>
                                                    <?php
                                                        $button1 = $slide['extra']['button1']['yes'];
                                                        $icon = ($button1['icon_box']['icon_type'] == 'awesome') ? $button1['icon_box']['awesome']['icon'] : $button1['icon_box']['custom']['icon'];
                                                    ?>
                                                    <a target="<?php echo esc_attr( $button1['target'] ); ?>"
                                                       class="w-clearfix w-inline-block button
                                                           <?php echo esc_attr( $button1['size'] ); ?>
                                                           <?php echo esc_attr( $button1['shape'] ); ?>
                                                           <?php echo esc_attr( $button1['colors'] ); ?>
                                                           <?php echo esc_attr( $button1['class'] ); ?>"
                                                       href="<?php echo esc_url( $button1['link'] ); ?>"
                                                       data-ix="zoom-scale-button-slider" >

                                                        <?php if(!empty($icon)):?>
                                                            <div class="btn-ico">
                                                                <div class="w-embed"><i class="<?php echo esc_attr($icon);?>"></i>
                                                                </div>
                                                            </div>
                                                        <?php endif;?>

                                                        <div class="btn-txt"><?php echo fw_theme_translate( esc_attr( $button1['label'] ) ); ?></div>
                                                    </a>

                                                <?php endif;?>
                                                <?php if($slide['extra']['button2']['enable-btn'] == 'yes'): ?>
                                                    <?php
                                                        $button2 = $slide['extra']['button2']['yes'];
                                                        $icon = ($button2['icon_box']['icon_type'] == 'awesome') ? $button2['icon_box']['awesome']['icon'] : $button2['icon_box']['custom']['icon'];
                                                    ?>
                                                    <a target="<?php echo esc_attr( $button2['target'] ); ?>"
                                                       class="w-clearfix w-inline-block button
                                                           <?php echo esc_attr( $button2['size'] ); ?>
                                                           <?php echo esc_attr( $button2['shape'] ); ?>
                                                           <?php echo esc_attr( $button2['colors'] ); ?>
                                                           <?php echo esc_attr( $button2['class'] ); ?>"
                                                       href="<?php echo esc_url( $button2['link'] ); ?>"
                                                       data-ix="zoom-scale-button-slider">

                                                        <?php if(!empty($icon)):?>
                                                            <div class="btn-ico">
                                                                <div class="w-embed"><i class="<?php echo esc_attr($icon);?>"></i>
                                                                </div>
                                                            </div>
                                                        <?php endif;?>

                                                        <div class="btn-txt"><?php echo fw_theme_translate( esc_attr( $button2['label'] ) ); ?></div>
                                                    </a>

                                                <?php endif;?>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                </div>
                            <?php else:?>
                                <div class="w-col w-col-6 w-col-stack">
                                    <div  class="change-tp bslider-txt-wrapper">
                                        <?php if(!empty($slide['title'])):?>
                                            <h1 class="slid-bus-txt" data-ix="zom-in-out-txt-slider">
                                                <span class="white"><?php echo fw_theme_translate(esc_html($slide['title']));?></span>
                                            </h1>
                                        <?php endif;?>

                                        <?php if(!empty($slide['extra']['subtitle'])):?>
                                            <div class="slider-sub-text">
                                                <div data-ix="move-from-bottom-txt-slider"><?php echo fw_theme_translate(esc_html($slide['extra']['subtitle']));?></div>
                                            </div>
                                        <?php endif;?>

                                        <?php if(!empty($slide['desc'])):?>
                                            <div class="space" data-ix="move-from-left-txt-slider">
                                                <p class="white"><?php echo fw_theme_translate(do_shortcode($slide['desc']));?></p>
                                            </div>
                                        <?php endif;?>

                                        <?php if($slide['extra']['button1']['enable-btn'] == 'yes' || $slide['extra']['button2']['enable-btn'] == 'yes'):?>
                                            <div class="space x1">
                                                <?php if($slide['extra']['button1']['enable-btn'] == 'yes'): ?>
                                                    <?php
                                                        $button1 = $slide['extra']['button1']['yes'];
                                                        $icon = ($button1['icon_box']['icon_type'] == 'awesome') ? $button1['icon_box']['awesome']['icon'] : $button1['icon_box']['custom']['icon'];
                                                    ?>
                                                    <a target="<?php echo esc_attr( $button1['target'] ); ?>"
                                                       class="w-clearfix w-inline-block button
                                                           <?php echo esc_attr( $button1['size'] ); ?>
                                                           <?php echo esc_attr( $button1['shape'] ); ?>
                                                           <?php echo esc_attr( $button1['colors'] ); ?>
                                                           <?php echo esc_attr( $button1['class'] ); ?>"
                                                       href="<?php echo esc_url( $button1['link'] ); ?>"
                                                       data-ix="zoom-scale-button-slider" >

                                                        <?php if(!empty($icon)):?>
                                                            <div class="btn-ico">
                                                                <div class="w-embed"><i class="<?php echo esc_attr($icon);?>"></i>
                                                                </div>
                                                            </div>
                                                        <?php endif;?>

                                                        <div class="btn-txt"><?php echo fw_theme_translate( esc_attr( $button1['label'] ) ); ?></div>
                                                    </a>

                                                <?php endif;?>
                                                <?php if($slide['extra']['button2']['enable-btn'] == 'yes'): ?>
                                                    <?php
                                                        $button2 = $slide['extra']['button2']['yes'];
                                                        $icon = ($button2['icon_box']['icon_type'] == 'awesome') ? $button2['icon_box']['awesome']['icon'] : $button2['icon_box']['custom']['icon'];
                                                    ?>
                                                    <a target="<?php echo esc_attr( $button2['target'] ); ?>"
                                                       class="w-clearfix w-inline-block button
                                                           <?php echo esc_attr( $button2['size'] ); ?>
                                                           <?php echo esc_attr( $button2['shape'] ); ?>
                                                           <?php echo esc_attr( $button2['colors'] ); ?>
                                                           <?php echo esc_attr( $button2['class'] ); ?>"
                                                       href="<?php echo esc_url( $button2['link'] ); ?>"
                                                       data-ix="zoom-scale-button-slider">

                                                        <?php if(!empty($icon)):?>
                                                            <div class="btn-ico">
                                                                <div class="w-embed"><i class="<?php echo esc_attr($icon);?>"></i>
                                                                </div>
                                                            </div>
                                                        <?php endif;?>

                                                        <div class="btn-txt"><?php echo fw_theme_translate( esc_attr( $button2['label'] ) ); ?></div>
                                                    </a>

                                                <?php endif;?>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="w-col w-col-6 w-col-stack w-hidden-small w-hidden-tiny col-center">
                                    <?php if(!empty($slide['src'])):?>
                                        <div class="w-hidden-medium w-hidden-small w-hidden-tiny" data-ix="move-mascot-slide">
                                            <img src="<?php echo esc_url($slide['src']);?>" alt="">
                                        </div>
                                    <?php endif;?>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="w-slider-arrow-left">
                <div class="w-icon-slider-left b-arrow ba-l"></div>
            </div>
            <div class="w-slider-arrow-right">
                <div class="w-icon-slider-right b-arrow"></div>
            </div>
        </div>
    </div>
    <!-- START BUSINESS SLIDER -->
<?php endif; ?>