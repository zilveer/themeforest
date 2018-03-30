<?php
	/**
	 * Slogan shortcode template
	 *
	 * @package wpv
	 * @subpackage health-center
	 */
?>
<div class="slogan clearfix <?php echo (!empty($button_text)) ? ' has-button' : ''?>">
	<div class="slogan-content"<?php if(!empty($text_color)) echo " style=\"color:$text_color;\"";?>>
		<?php echo do_shortcode($content);?>
	</div>
	<?php if(!empty($button_text)): ?>
	<div class="button-wrp">
		<?php echo do_shortcode('[button link="'.$link.'" bgColor="accent2" icon="'.$button_icon.'" icon_color="'.$button_icon_color.'" icon_placement="'.$button_icon_placement.'"]'.$button_text.'[/button]') ?>
	</div>
	<?php endif ?>
</div>
