<?php
/**
 * Counter shortcode template
 */
?>
<div <?php hue_mikado_class_attribute($counter_classes); ?> <?php echo hue_mikado_get_inline_style($counter_holder_styles); ?>>
	<?php if($icon != ''): ?>
		<div class="mkd-counter-icon"><?php echo hue_mikado_icon_collections()->renderIcon($icon, $icon_pack); ?></div>
	<?php endif; ?>
	<span class="mkd-counter <?php echo esc_attr($type) ?>" <?php echo hue_mikado_get_inline_style($counter_styles); ?>>
		<?php echo esc_attr($digit); ?>
	</span>
	<<?php echo esc_html($title_tag); ?> class="mkd-counter-title">
	<?php echo esc_attr($title); ?>
</<?php echo esc_html($title_tag);; ?>>
<?php if($text != "") { ?>
	<p class="mkd-counter-text"><?php echo esc_html($text); ?></p>
<?php } ?>

</div>