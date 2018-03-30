<div class="mkd-separator-holder clearfix  <?php echo esc_attr($separator_class); ?>" <?php libero_mikado_inline_style($separator_holder_style); ?>>
	<div class="mkd-separator" <?php echo libero_mikado_get_inline_style($separator_style); ?>></div>
		<div class="mkd-separator-icon">
			<?php
				if ($custom_icon !== ''){ ?>
                    <?php echo wp_get_attachment_image($custom_icon,'full'); ?>
				<?php }
			?>
		</div>
	<div class="mkd-separator" <?php echo libero_mikado_get_inline_style($separator_style); ?>></div>
</div>
