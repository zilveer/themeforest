<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */


$sliderID = $this->get('slider_name');

$slider_class = '';
//$slider_class .= yit_slide_get('align') != '' ? ' align' . yit_slide_get('align') : '';

?>

<div id="<?php echo $sliderID ?>"<?php yit_slider_class($slider_class) ?>>
	<?php echo do_shortcode('[usquare id="'. $sliderID .'"]') ?>
</div>
