<div class="qodef-image-gallery">
	<div class="qodef-image-gallery-grid <?php echo esc_html($columns); ?> <?php echo esc_html($gallery_classes); ?>" >
		<?php foreach ($images as $image) { ?>
			<div class="qodef-gallery-image">
				<?php if ($pretty_photo) { ?>
				<a href="<?php echo esc_url($image['url'])?>" data-rel="prettyPhoto[single_pretty_photo]" title="<?php echo esc_attr($image['title']); ?>">
					<?php } ?>
					<img src="<?php echo esc_url($image['url'])?>" alt="<?php echo esc_attr($image['title']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>">
					<?php if ($pretty_photo) { ?>
				</a>
			<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>