<div class="dtbaker_banner" id="dtbaker_banner_<?php echo esc_attr($sc_atts->id);?>">
	<span class="title"><?php echo esc_html($sc_atts->title);?></span>
	<span class="content"><?php echo esc_html($innercontent);?></span>
	<?php if($sc_atts->linkhref): ?>
	<a href="<?php echo esc_attr($sc_atts->linkhref);?>" class="link dtbaker_button_light">
	<?php endif; ?>
		<?php echo $sc_atts->link;?>
	<?php if($sc_atts->linkhref): ?>
	</a>
	<?php endif; ?>
</div>