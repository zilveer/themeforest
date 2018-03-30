<div class="mkd-image-gallery">
	<div class="mkd-image-gallery-grid <?php echo esc_html($columns); ?><?php echo esc_attr($space); ?> <?php echo esc_html($gallery_classes); ?>">
		<?php foreach($images as $image) { ?>
			<div class="mkd-gallery-image">
				<div class="mkd-image-gallery-holder">
					<?php if($pretty_photo) { ?>
						<a href="<?php echo esc_url($image['url']) ?>" data-rel="prettyPhoto[single_pretty_photo]" title="<?php echo esc_attr($image['title']); ?>">
						<div class="mkd-icon-holder"><?php echo hue_mikado_icon_collections()->renderIcon('fa-plus', 'font_awesome'); ?></div>
					<?php } ?>
						<?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
						<span class="mkd-image-gallery-hover"></span>
					<?php if($pretty_photo) { ?>
						</a>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>