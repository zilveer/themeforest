<div <?php hue_mikado_class_attribute($pricing_table_classes) ?>>
	<div class="mkd-price-table-inner <?php echo esc_attr($active_pricing_table_classes) ?>">
	<div class="mkd-price-table-bgrnd-overlay <?php echo esc_attr($active_pricing_table_classes) ?>"></div>
		<?php if(!empty($label)) : ?>
			<div class="mkd-pt-label-holder">
				<div class="mkd-pt-label-inner">
					<div class="mkd-pt-label-content">
						<span><?php echo esc_html($label); ?></span>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<ul>
			<li class="mkd-table-title">
				<h2 <?php hue_mikado_inline_style($title_styles); ?> class="mkd-title-content"><?php echo esc_html($title) ?></h2>
			</li>
			<li class="mkd-table-prices">
				<div class="mkd-price-in-table">
					<?php if(!empty($price)) : ?>
						<h3 class="mkd-price">
							<?php echo esc_html($currency.$price); ?>
						</h3>
					<?php endif; ?>
				</div>
				<?php if(!empty($price_period)) : ?>
					<div class="mkd-pt-price-period">
						<span class="mkd-pt-price-period-content"><?php echo esc_html($price_period) ?></span>
					</div>
				<?php endif; ?>
			</li>
			<li class="mkd-table-content">
				<?php echo do_shortcode(preg_replace('#^<\/p>|<p>$#', '', $content)); ?>
			</li>
			<?php
			if(is_array($button_params) && count($button_params)) { ?>
				<li class="mkd-price-button">
					<?php echo hue_mikado_get_button_html($button_params); ?>
				</li>
			<?php } ?>
		</ul>
	</div>
</div>
