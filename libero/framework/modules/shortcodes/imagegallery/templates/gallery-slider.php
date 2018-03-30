<div class="mkd-image-gallery">
	<div class="mkd-image-gallery-slider" <?php echo libero_mikado_get_inline_attrs($slider_data); ?>>
		<?php foreach ($images as $image) {
			if ($pretty_photo) { ?>
				<a href="<?php echo esc_url($image['url'])?>" data-rel="prettyPhoto[single_pretty_photo]" title="<?php echo esc_attr($image['title']); ?>">
			<?php } ?>
				<img src="<?php echo esc_url($image['url'])?>" alt="<?php echo esc_attr($image['title']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>">
			<?php if ($pretty_photo) { ?>
				</a>
			<?php }
		} ?>
	</div>
</div>