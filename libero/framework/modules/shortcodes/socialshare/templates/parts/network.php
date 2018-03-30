<li class="mkd-<?php echo esc_html($name) ?>-share" <?php libero_mikado_inline_style($social_style);?>>
	<a class="mkd-share-link" href="#" onclick="<?php print $link; ?>">
		<?php if ($custom_icon !== '') { ?>
			<img src="<?php echo esc_url($custom_icon); ?>" alt="<?php echo esc_html($name); ?>" />
		<?php } else { ?>
			<span class="mkd-social-network-icon <?php echo esc_attr($icon); ?>" <?php print $icons_style;?>></span>
			<span class="mkd-social-network-text" <?php libero_mikado_inline_style($text_style);?>><?php echo esc_html($text); ?></span>
		<?php } ?>
	</a>
</li>