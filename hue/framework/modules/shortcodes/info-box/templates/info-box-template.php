<div <?php hue_mikado_class_attribute($holder_classes); ?>>

	<div class="mkd-info-box-inner">
		<div class="mkd-ib-front-holder">
			<div class="mkd-ib-front-holder-inner">
				<div class="mkd-ib-top-holder">
					<?php if($show_icon) : ?>
						<div class="mkd-ib-icon-holder">
							<?php echo hue_mikado_icon_collections()->renderIcon($icon, $icon_pack, array(
								'icon_attributes' => array(
									'style' => $icon_styles
								)
							)); ?>
						</div>
					<?php endif; ?>

					<?php if(!empty($title)) : ?>
						<div class="mkd-ib-title-holder">
							<h3 class="mkd-ib-title"><?php echo esc_html($title); ?></h3>
						</div>
					<?php endif; ?>
				</div>

				<div class="mkd-ib-bottom-holder">
					<?php if(!empty($text)) : ?>
						<div class="mkd-ib-text-holder">
							<p><?php echo esc_html($text); ?></p>
						</div>
					<?php endif; ?>

					<?php if(is_array($button_params) && count($button_params)) : ?>
						<div class="mkd-ib-button-holder">
							<?php echo hue_mikado_get_button_html($button_params); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>

		</div>


		<div class="mkd-ib-overlay" <?php hue_mikado_inline_style($holder_styles); ?>></div>
	</div>
</div>