<?php
/**
 * Interactive image shortcode template
 */
?>
<div class="mkd-interactive-image <?php echo esc_attr($classes)?>">
	<?php if($params['link'] != '') { ?> 
		<a href="<?php echo esc_url($params['link'])?>"></a>
	<?php } ?>
    <?php echo wp_get_attachment_image($image,'full'); ?>
	<?php if($params['add_checkmark'] == 'yes') { ?>
		<div class="tick" <?php libero_mikado_inline_style($checkmark_position); ?>></div>
	<?php } ?>
</div>
