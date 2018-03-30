<div class="mkd-elements-holder-item <?php echo esc_attr($elements_holder_item_class); ?>" <?php echo hue_mikado_get_inline_attrs($elements_holder_item_data); ?> <?php echo hue_mikado_get_inline_style($elements_holder_item_style); ?>>
	<div class="mkd-elements-holder-item-inner">
		<div class="mkd-elements-holder-item-content <?php echo esc_attr($elements_holder_item_content_class); ?>" <?php echo hue_mikado_get_inline_style($elements_holder_item_content_style); ?>>
			<?php if(count($elements_holder_item_content_responsive) > 0) { ?>
				<style type="text/css" data-type="mkd-elements-custom-padding" scoped>
                    <?php if(!empty($elements_holder_item_content_responsive['item_padding_1280_1440'])){ ?>
                    @media only screen and (min-width: 1280px) and (max-width: 1440px) {
                        .mkd-elements-holder .mkd-elements-holder-item-content.<?php echo esc_attr($elements_holder_item_content_class); ?> {
                            padding: <?php echo esc_attr($elements_holder_item_content_responsive['item_padding_1280_1440']); ?> !important;
                        }
                    }

                    <?php } ?>
                    <?php if(!empty($elements_holder_item_content_responsive['item_padding_1024_1280'])){ ?>
					@media only screen and (min-width: 1024px) and (max-width: 1280px) {
						.mkd-elements-holder .mkd-elements-holder-item-content.<?php echo esc_attr($elements_holder_item_content_class); ?> {
							padding: <?php echo esc_attr($elements_holder_item_content_responsive['item_padding_1024_1280']); ?> !important;
						}
					}

					<?php } ?>
					<?php if(!empty($elements_holder_item_content_responsive['item_padding_768_1024'])){ ?>
					@media only screen and (min-width: 768px) and (max-width: 1024px) {
						.mkd-elements-holder .mkd-elements-holder-item-content.<?php echo esc_attr($elements_holder_item_content_class); ?> {
							padding: <?php echo esc_attr($elements_holder_item_content_responsive['item_padding_768_1024']); ?> !important;
						}
					}

					<?php } ?>
					<?php if(!empty($elements_holder_item_content_responsive['item_padding_600_768'])){ ?>
					@media only screen and (min-width: 600px) and (max-width: 768px) {
						.mkd-elements-holder .mkd-elements-holder-item-content.<?php echo esc_attr($elements_holder_item_content_class); ?> {
							padding: <?php echo esc_attr($elements_holder_item_content_responsive['item_padding_600_768']); ?> !important;
						}
					}

					<?php } ?>
					<?php if(!empty($elements_holder_item_content_responsive['item_padding_480_600'])){ ?>
					@media only screen and (min-width: 480px) and (max-width: 600px) {
						.mkd-elements-holder .mkd-elements-holder-item-content.<?php echo esc_attr($elements_holder_item_content_class); ?> {
							padding: <?php echo esc_attr($elements_holder_item_content_responsive['item_padding_480_600']); ?> !important;
						}
					}

					<?php } ?>
					<?php if(!empty($elements_holder_item_content_responsive['item_padding_480'])){ ?>
					@media only screen and (max-width: 480px) {
						.mkd-elements-holder .mkd-elements-holder-item-content.<?php echo esc_attr($elements_holder_item_content_class); ?> {
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