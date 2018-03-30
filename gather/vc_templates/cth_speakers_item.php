<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $speakeravatar
 * @var $speakername
 * @var $speakerjob
 * @var $animation
 * @var $effect
 * @var $delay
 * Shortcode class
 * @var $this WPBakeryShortCode_Cth_Speakers_Item
 */
$el_class = $speakeravatar = $speakername = $speakerjob = $animation = $effect = $delay = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$ani_de = '';
if($animation == 'yes'){
	$el_class .= ' wow '.$effect;
	if(!empty($delay)){
		$ani_de = ' data-wow-delay="'.$delay.'"';
	}
}
?>
<div class="speaker-info <?php echo esc_attr($el_class );?>"<?php echo esc_html($ani_de );?>>
	<?php 
	if(!empty($speakeravatar)){
		echo wp_get_attachment_image( $speakeravatar, 'full', false , array('class'=>'img-responsive center-block') );
		//echo '<pre>';var_dump(wp_get_attachment_metadata($speakeravatar));die;
	}
	if(!empty($speakername)) {
		echo '<p>'.$speakername.'</p>';
	}
	if(!empty($speakerjob)) {
		echo '<span>'.$speakerjob.'</span>';
	}
	?>
	<?php echo wpb_js_remove_wpautop($content,true);?>
</div>
