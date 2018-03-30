<<?php echo esc_attr($title_tag)?> class="clearfix mkd-title-holder">
	<span class="mkd-accordion-mark mkd-left-mark">
		<span class="mkd-accordion-mark-icon">
			<i class="icon-arrow-down-circle"></i>
		</span>
	</span>
	<span class="mkd-tab-title" <?php libero_mikado_inline_style($title_style);?>>
		<span class="mkd-tab-title-inner">
			<?php echo esc_attr($title)?>
		</span>
	</span>
</<?php echo esc_attr($title_tag)?>><div class="mkd-accordion-content">
	<div class="mkd-accordion-content-inner" <?php libero_mikado_inline_style($content_style);?>>
		<?php echo libero_mikado_remove_wpautop($content)?>
	</div>
</div>
