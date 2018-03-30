<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );

	/**
	 * @var array $atts
	 */
}
?>
<!-- START BUSINESS SLIDER -->
<div class="creative-banner bussines-slider-1 <?php echo esc_attr($atts['class']);?>" id="top" data-ix="show-top-btn" data-stellar-background-ratio="0.5">
    <div class="arrow a-dark"></div>
    <div class="w-container txt-rot-con" data-ix="hide-rotator-on-scroll">
        <div class="hero-center-div">
            <?php if(!empty($atts['subtitle'])):?>
                <div class="sub-txt-rotator" data-ix="slider-rot-from-top"><?php echo fw_theme_translate(esc_html($atts['subtitle']));?></div>
                <div class="rotator-line" data-ix="slide-rot-line"></div>
            <?php endif;?>

            <?php if(!empty($atts['text'])):?>
                <div>
                    <div class="w-slider rotator-slider" data-animation="outin" data-duration="500" data-infinite="1" data-delay="4000" data-autoplay="1">
                        <div class="w-slider-mask">
                            <?php $cnt = 0; foreach($atts['text'] as $slide):?>
                            <div class="w-slide">
                                <div class="txt-rotator-wrapper">
                                    <h1 class="sl-rot-txt" <?php echo ($cnt = 0) ? 'data-ix="big-text-rot"' : '' ;?>>
                                        <?php echo fw_theme_translate(do_shortcode($slide)); ?>
                                    </h1>
                                </div>
                            </div>
                            <?php $cnt++; endforeach;?>
                        </div>
                    </div>
                </div>
            <?php endif;?>

            <?php if($atts['button']['enable-btn'] == 'yes'):?>
                <div class="space">

                    <?php
                        $btn = $atts['button'];
                        $icon = ($btn['yes']['icon_box']['icon_type'] == 'awesome') ? $btn['yes']['icon_box']['awesome']['icon'] : $btn['yes']['icon_box']['custom']['icon'];
                    ?>
                    <a target="<?php echo esc_attr( $btn['yes']['target'] ); ?>"
                       class="w-clearfix w-inline-block button
                           <?php echo esc_attr( $btn['yes']['size'] ); ?>
                           <?php echo esc_attr( $btn['yes']['shape'] ); ?>
                           <?php echo esc_attr( $btn['yes']['colors'] ); ?>
                           <?php echo esc_attr( $btn['yes']['class'] ); ?>"
                       href="<?php echo esc_url( $btn['yes']['link'] ); ?>" data-ix="rot-btn-form-bottom">

                        <?php if(!empty($icon)):?>
                            <div class="btn-ico">
                                <div class="w-embed"><i class="<?php echo esc_attr($icon);?>"></i>
                                </div>
                            </div>
                        <?php endif;?>

                        <div class="btn-txt"><?php echo fw_theme_translate( esc_attr( $btn['yes']['label'] ) ); ?></div>
                    </a>

                </div>
            <?php endif;?>
        </div>
    </div>
</div>
<!-- END CREATIVE SLIDER -->