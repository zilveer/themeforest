<?php

extract( shortcode_atts( array(
			"tablet_color" => 'black',
			"images" => '',
			"animation_speed" => 700,
			"slideshow_speed" => 7000,
			"pause_on_hover" => "false",
			"el_class" => '',
			'animation' => '',
		), $atts ) );

if ( $images == '' ) return null;

require_once THEME_INCLUDES . "/image-cropping.php";

$animation_css = '';
if ( $animation != '' ) {
	$animation_css = ' mk-animate-element ' . $animation . ' ';
}

$output = '';
$images = explode( ',', $images );
$i = -1;


?>


<div data-animation="fade"
    data-easing="swing"
    data-direction="horizontal"
    data-smoothHeight="false"
    data-slideshowSpeed="<?php echo $slideshow_speed; ?>"
    data-animationSpeed="<?php echo $animation_speed; ?>"
    data-pauseOnHover="<?php echo $pause_on_hover; ?>"
    data-controlNav="false"
    data-directionNav="true"
    data-isCarousel="false"
    style="max-height:740px;max-width:501px;"
    class="mk-tablet-slideshow mk-script-call <?php echo $animation_css; ?> mk-flexslider <?php echo $el_class; ?>">
    <img style="display:none" class="mk-tablet-image" src="<?php echo THEME_IMAGES; ?>/tablet-<?php echo $tablet_color; ?>.png" alt="slide image" />
    <div class="slideshow-container">
        <ul class="mk-flex-slides" style="max-width:100%px;max-height:100%;">

            <?php
            foreach ( $images as $attach_id ) {
            $i++;
            $image_src_array = wp_get_attachment_image_src( $attach_id, 'full', true );
            $image_src       = bfi_thumb($image_src_array[0], array(
                'width' => 435,
                'height' => 585,
                'crop' => true
            ));
            ?>
            <li>
                <img alt="slide image" src="<?php echo mk_thumbnail_image_gen($image_src, 435, 585); ?>" />
            </li>
            <?php } ?>
        </ul>
    </div>
</div>


