<div class="qodef-elements-holder-item <?php echo esc_attr($elements_holder_item_class); ?>" <?php echo suprema_qodef_get_inline_attrs($elements_holder_item_data); ?> <?php echo suprema_qodef_get_inline_style($elements_holder_item_style); ?>>
	<?php if ($item_clickable == 'yes') { ?>
		<a class="qodef-elements-holder-item-link" target="<?php echo esc_attr($target) ?>" href="<?php echo esc_url($link) ?>"></a>
	<?php } ?>
	<div class="qodef-elements-holder-item-inner">
		<div class="qodef-elements-holder-item-content <?php echo esc_attr($elements_holder_item_content_class); ?>" <?php echo suprema_qodef_get_inline_style($elements_holder_item_content_style); ?>>
			<?php if(count($elements_holder_item_content_responsive) > 0){ ?>
			<style type="text/css" data-type="qodef-elements-custom-padding">
				<?php if($elements_holder_item_content_responsive['item_padding_1280_1600'] !== ''){ ?>
				@media only screen and (min-width: 1280px) and (max-width: 1600px) {
					.qodef-elements-holder .qodef-elements-holder-item-content.<?php echo esc_attr($elements_holder_item_content_class); ?> {
						padding: <?php echo esc_attr($elements_holder_item_content_responsive['item_padding_1280_1600']); ?> !important;
					}
				}
				<?php } ?>
				<?php if($elements_holder_item_content_responsive['item_padding_1024_1280'] !== ''){ ?>
					@media only screen and (min-width: 1024px) and (max-width: 1280px) {
						.qodef-elements-holder .qodef-elements-holder-item-content.<?php echo esc_attr($elements_holder_item_content_class); ?> {
							padding: <?php echo esc_attr($elements_holder_item_content_responsive['item_padding_1024_1280']); ?> !important;
						}
					}
				<?php } ?>
				<?php if($elements_holder_item_content_responsive['item_padding_768_1024'] !== ''){ ?>
				@media only screen and (min-width: 768px) and (max-width: 1024px) {
					.qodef-elements-holder .qodef-elements-holder-item-content.<?php echo esc_attr($elements_holder_item_content_class); ?> {
						padding: <?php echo esc_attr($elements_holder_item_content_responsive['item_padding_768_1024']); ?> !important;
					}
				}
				<?php } ?>
				<?php if($elements_holder_item_content_responsive['item_padding_600_768'] !== ''){ ?>
				@media only screen and (min-width: 600px) and (max-width: 768px) {
					.qodef-elements-holder .qodef-elements-holder-item-content.<?php echo esc_attr($elements_holder_item_content_class); ?> {
						padding: <?php echo esc_attr($elements_holder_item_content_responsive['item_padding_600_768']); ?> !important;
					}
				}
				<?php } ?>
				<?php if($elements_holder_item_content_responsive['item_padding_480_600'] !== ''){ ?>
				@media only screen and (min-width: 480px) and (max-width: 600px) {
					.qodef-elements-holder .qodef-elements-holder-item-content.<?php echo esc_attr($elements_holder_item_content_class); ?> {
						padding: <?php echo esc_attr($elements_holder_item_content_responsive['item_padding_480_600']); ?> !important;
					}
				}
				<?php } ?>
				<?php if($elements_holder_item_content_responsive['item_padding_480'] !== ''){ ?>
				@media only screen and (max-width: 480px) {
					.qodef-elements-holder .qodef-elements-holder-item-content.<?php echo esc_attr($elements_holder_item_content_class); ?> {
						padding: <?php echo esc_attr($elements_holder_item_content_responsive['item_padding_480']); ?> !important;
					}
				}
				<?php } ?>
				</style>
			<?php } ?>
			<?php echo do_shortcode($content); ?>
		</div>
	</div>
</div>