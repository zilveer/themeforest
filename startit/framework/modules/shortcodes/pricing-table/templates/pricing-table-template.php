<div class="qodef-price-table <?php  echo esc_attr($pricing_table_classes)?>">
	<div class="qodef-price-table-inner">
		<?php if($active == 'yes'){ ?>
			<div class="qodef-active-text">
				<span>
					<span><span><span><span><span><span><span><span><span class="qodef-active-text-inner"><?php echo esc_html($active_text) ?></span></span></span></span></span></span></span></span></span>
				</span>
			</div>
		<?php } ?>	
		<ul>
			<li class="qodef-table-title">
				<span class="qodef-title-content"><?php echo esc_html($title) ?></span>
			</li>
			<li class="qodef-table-body">
				<ul>
					<li class="qodef-table-prices">
						<div class="qodef-price-in-table">
							<span class="qodef-value"><?php echo esc_html($currency) ?></span>
							<span class="qodef-price"><?php echo esc_html($price)?></span>
							<span class="qodef-mark"><?php echo esc_html($price_period)?></span>
						</div>
					</li>
					<li class="qodef-table-content">
						<?php echo do_shortcode($content) ?>
					</li>
					<?php
					if($show_button == "yes" && $button_text !== ''){ ?>
						<li class="qodef-price-button">
							<?php echo qode_startit_get_button_html(array(
								'link' => $link,
								'text' => $button_text,
								'type' => 'solid',
								'size' => 'small'
							)); ?>
						</li>
					<?php } ?>
				</ul>
			</li>
		</ul>
	</div>
</div>
