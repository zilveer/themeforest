<div class="mkd-section-title-holder">
	<<?php echo esc_attr($title_tag); ?> <?php hue_mikado_class_attribute($section_title_classes); ?> <?php hue_mikado_inline_style($section_title_styles); ?>>
	<?php if($type_out !== 'yes') { 
		echo esc_html($title); 
	} else if($type_out == 'yes') { ?>
		<span class="mkd-typed-wrap"<?php echo hue_mikado_get_inline_attrs($type_out_data); ?>>
			<span class="mkd-typed">
					<span class="mkd-typed-strings"><?php echo esc_html($title); ?></span>
				<?php if($title_2 != '') { ?>
					<span class="mkd-typed-strings"><?php echo esc_html($title_2); ?></span>
				<?php } if($title_3 != '') { ?>
					<span class="mkd-typed-strings"><?php echo esc_html($title_3); ?></span>
				<?php } ?>
			</span>
		</span>
	<?php } ?>
</<?php echo esc_attr($title_tag); ?>>
</div>