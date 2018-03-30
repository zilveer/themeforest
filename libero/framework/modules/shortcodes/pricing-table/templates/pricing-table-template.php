<div class="mkd-price-table <?php echo esc_attr($pricing_table_classes)?>">
	<div class="mkd-price-table-inner">
		<?php if($active == 'yes'){ ?>
			<div class="mkd-active-text">
				<span class="mkd-active-text-inner">
					<?php echo esc_attr($active_text) ?>
				</span>
			</div>
		<?php } ?>	
		<ul>
			<li class="mkd-table-title">
				<h6 class="mkd-title-content"><?php echo esc_html($title) ?></h6>
			</li>
			<li class="mkd-table-prices">
				<div class="mkd-price-in-table">
					<sup class="mkd-value"><?php echo esc_attr($currency) ?></sup>
					<span class="mkd-price"><?php echo esc_attr($price)?></span>
					<span class="mkd-mark">/<?php echo esc_attr($price_period)?></span>
				</div>	
			</li>	
			<li class="mkd-table-content">
				<?php echo libero_mikado_remove_wpautop($content,true)?>
			</li>
			<?php 
			if($show_button == "yes" && $button_text !== ''){ ?>
				<li class="mkd-price-button">
					<?php echo libero_mikado_get_button_html($button_params); ?>
				</li>				
			<?php } ?>
		</ul>
	</div>
</div>
