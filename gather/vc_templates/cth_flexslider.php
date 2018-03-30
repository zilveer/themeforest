<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $el_id
 * @var $slideshow
 * @var $animation
 * @var $direction
 * @var $smoothheight
 * @var $slideshowspeed
 * @var $controlnav
 * @var $directionnav
 * @var //$sliderskin
 * Shortcode class
 * @var $this WPBakeryShortCode_Cth_Flexslider
 */
$el_class = $el_id = $slideshow = $animation = $direction = $smoothheight = $slideshowspeed = $controlnav = $directionnav = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$dataObj = new stdClass;

if($slideshow == 'true'){
	$dataObj->slideshow = true;
}else{
	$dataObj->slideshow = false;
}

$dataObj->animation = $animation;
$dataObj->direction = $direction;

if($smoothheight == 'true'){
	$dataObj->smoothHeight = true;
}else{
	$dataObj->smoothHeight = false;
}
$dataObj->slideshowSpeed = (int)$slideshowspeed;

if($controlnav == 'true'){
	$dataObj->controlNav = true;
}else{
	$dataObj->controlNav = false;
}

if($directionnav == 'true'){
	$dataObj->directionNav = true;
}else{
	$dataObj->directionNav = false;
}

$dataObj = rawurlencode(json_encode($dataObj));
?>
<div<?php if(!empty($el_id)) echo ' id="'.esc_attr($el_id).'" ';?> class="flexslider cth-flexslider <?php echo esc_attr($el_class );?>"  data-options="<?php echo esc_attr($dataObj );?>">
    <ul class="slides">
    	<?php echo wpb_js_remove_wpautop($content);?>
    </ul>
</div>
