<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );

	/**
	 * @var array $atts
	 */
}
?>
<?php if(!empty($atts['slide'])):?>
    <div class="w-slider carousel-project <?php echo esc_attr($atts['class']);?>" data-animation="slide" data-duration="500" data-infinite="1" data-nav-spacing="5">
        <div class="w-slider-mask">
            <?php foreach($atts['slide'] as $slide):?>
                <div class="w-slide">
                    <img src="<?php echo esc_url($slide['url']);?>" alt="">
                </div>
            <?php endforeach;?>
        </div>
        <div class="w-slider-arrow-left ver-remove-spc">
            <div class="w-icon-slider-left carousel-arrow"></div>
        </div>
        <div class="w-slider-arrow-right ver-remove-spc">
            <div class="w-icon-slider-right carousel-arrow"></div>
        </div>
        <div class="w-slider-nav w-slider-nav-invert w-round carousel-dots"></div>
    </div>
<?php endif;?>