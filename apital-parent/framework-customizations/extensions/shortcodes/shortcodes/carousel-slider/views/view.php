<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );

	/**
	 * @var array $atts
	 */
}
?>
<?php if(!empty($atts['slide'])):?>
    <div class="w-slider carousel-project <?php echo esc_attr($atts['class']);?>" data-animation="slide" data-duration="500" data-infinite="1" data-delay="4000" data-autoplay="1" data-nav-spacing="5">
        <div class="w-slider-mask">
            <?php
                $cnt = 0; foreach($atts['slide'] as $slide):  $cnt++;
             ?>

                <?php if($cnt == 1 || ($cnt-1) % 5 == 0):?>
                    <div class="w-slide w-clearfix">
                <?php endif;?>

                        <div class="logo-wrapper"><img src="<?php echo esc_url($slide['url']);?>" alt=""></div>

                <?php if($cnt % 5 == 0 || $cnt == count($atts['slide'])):?>
                    </div>
                <?php endif;?>

            <?php endforeach; ?>
        </div>
        <div class="w-slider-nav w-slider-nav-invert w-round carousel-dots"></div>
    </div>
<?php endif;?>