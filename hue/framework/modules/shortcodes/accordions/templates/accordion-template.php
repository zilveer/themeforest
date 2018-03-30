<h6 class="clearfix mkd-title-holder <?php echo esc_attr($dark_type) ?>">
<span class="mkd-accordion-mark mkd-left-mark">
		<span class="mkd-accordion-mark-icon">
			<span class="icon_plus"></span>
			<span class="icon_minus-06"></span>
		</span>
</span>
<span class="mkd-tab-title">
		<span class="mkd-tab-title-inner">
			<?php if($params['icon']) : ?>
				<span class="mkd-icon-accordion-holder">
				 <?php echo hue_mikado_icon_collections()->renderIcon($icon, $icon_pack); ?>
			 </span>
			<?php endif; ?>
			<?php if($params['number']) : ?>
				<span class="mkd-accordion-number" <?php hue_mikado_inline_style($color_number)?>><?php echo esc_attr($number) ?></span>
			<?php endif; ?>
			<?php echo esc_attr($title) ?>
		</span>
</span>
</h6>
<div class="mkd-accordion-content <?php echo esc_attr($dark_type) ?>">
	<div class="mkd-accordion-content-inner">
		<?php echo do_shortcode($content) ?>

		<?php if(is_array($link_params) && count($link_params)) : ?>
			<a class="mkd-arrow-link" target="<?php echo esc_attr($link_params['link_target']); ?>" href="<?php echo esc_url($link_params['link']); ?>">
				<span class="mkd-al-icon">
					<span class="icon-arrow-right-circle"></span>
				</span>
				<span class="mkd-al-text"><?php echo esc_html($link_params['link_text']); ?></span>
			</a>
		<?php endif; ?>
	</div>
</div>
