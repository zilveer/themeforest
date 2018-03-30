<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $avatar
 * @var $name
 * @var $job
 * @var $company
 * @var $com_web
 * @var $content
 * Shortcode class
 * @var $this WPBakeryShortCode_Cth_Testimonial
 */
$el_class = $avatar = $name = $job = $company = $com_web = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<div class="cth_testi <?php echo esc_attr($el_class );?>">
	<div class="testblock"><?php echo wpb_js_remove_wpautop($content,true); ?></div>
	<div class="clientblock">
		<?php echo wp_get_attachment_image( $avatar, 'gathertesti_thumb');?>
	    <p>
	    <?php if(!empty($name)) :?>
	    	<strong><?php echo esc_attr($name );?></strong>
	    <?php endif;?>
	    <?php if(!empty($job)) :?>
	    	<br>
	    	<?php echo esc_attr($job );?>
	    <?php endif;?>
	    <?php if(!empty($company)) :?>
	    	<a href="<?php echo !empty($com_web)? esc_url($com_web ) : '#';?>"><?php echo esc_attr($company );?></a>
	    <?php endif;?>
	    </p>
	</div>
</div>