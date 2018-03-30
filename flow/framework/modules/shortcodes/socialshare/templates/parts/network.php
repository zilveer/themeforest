<li class="eltd-<?php echo esc_html($name) ?>-share">
	<a class="eltd-share-link" href="#" onclick="<?php print $link; ?>">
		<?php if ($custom_icon !== '') { ?>
			<img src="<?php echo esc_url($custom_icon); ?>" alt="<?php echo esc_html($name); ?>" />
		<?php } else { ?>
			<span class="eltd-social-network-icon <?php echo esc_attr($icon); ?>"></span>
		<?php } ?>
	</a>
</li>