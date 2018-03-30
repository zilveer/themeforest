<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $slideimg
 * Shortcode class
 * @var $this WPBakeryShortCode_Cth_Flexslider_Item
 */
$el_class = $slideimg = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<li class="item <?php echo esc_attr($el_class );?>">
	<div class="slide-item">
	    <?php //echo rawurldecode( base64_decode( strip_tags( $content ) ) );?>
	    <?php echo wpb_js_remove_wpautop($content,true);?>
	    <?php if(!empty($slideimg)) :?>
	    <div class="slide-img">
	    	<?php echo wp_get_attachment_image( $slideimg, 'full', false , array('class'=>'img-responsive') );?>
	    </div>
		<?php endif;?>
	</div>
</li>
