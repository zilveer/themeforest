<<?php echo esc_attr($title_tag)?> class="clearfix qodef-title-holder" <?php suprema_qodef_inline_style($title_style); ?>>
	<span class="qodef-accordion-mark qodef-left-mark">
		<span class="qodef-accordion-mark-icon">
			<span class="icon_plus"></span>
			<span class="icon_minus-06"></span>
		</span>
	</span>
	<span class="qodef-tab-title">
		<span class="qodef-tab-title-inner">
			<?php echo esc_attr($title)?>
		</span>
	</span>
</<?php echo esc_attr($title_tag)?>>
<div class="qodef-accordion-content">
	<div class="qodef-accordion-content-inner">
		<?php echo do_shortcode($content); ?>
	</div>
</div>