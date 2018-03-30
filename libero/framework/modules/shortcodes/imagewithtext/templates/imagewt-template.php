<div class="mkd-imagewt">
	<div class="mkd-imagewt-image-holder" <?php libero_mikado_inline_style($image_holder_style);?>>
        <?php echo wp_get_attachment_image($image,'full'); ?>
	</div>
	<div class="mkd-imagewt-content-holder" <?php libero_mikado_inline_style($content_styles); ?>>
		<div class="mkd-imagewt-title-holder">
			<?php if ($title !== ''){?>
				<<?php echo esc_attr($title_tag); ?> <?php libero_mikado_inline_style($title_styles); ?> class="mkd-imagewt-title"><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
			<?php } ?>
			<?php if ($subtitle !== ''){ ?>
				<h5 class="mkd-imagewt-subtitle"><?php echo esc_html($subtitle);?></h5>
			<?php } ?>
		</div>
		<div class="mkd-imagewt-text-holder">
			<p <?php libero_mikado_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
		</div>
		<?php
			if (is_array($button_params) && count($button_params)){
				echo libero_mikado_execute_shortcode('mkd_button',$button_params);
			}
		?>
	</div>
</div>