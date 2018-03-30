<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $slideimg
 * @var $content
 * Shortcode class
 * @var $this WPBakeryShortCode_Cth_Slickslider_Item
 */
$el_class = $slideimg = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<div class="horizontal-space <?php echo esc_attr($el_class );?>">
	<?php 
	if(!empty($slideimg)){
		echo wp_get_attachment_image( $slideimg, 'full', false , array('class'=>'img-responsive center-block') );
	}?>
	<?php echo wpb_js_remove_wpautop($content,true);?>
</div>