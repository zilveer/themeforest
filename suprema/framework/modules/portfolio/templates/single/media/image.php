<?php if(!empty($lightbox)) : ?>
    <a title="<?php echo esc_attr($media['title']); ?>" data-rel="prettyPhoto[single_pretty_photo]" href="<?php echo esc_url($media['image_url']); ?>">
<?php endif; ?>

	<?php if ($gallery) { ?>
		<span class="qodef-portfolio-gallery-text-holder">
			<span class="qodef-portfolio-gallery-text-holder-inner">
			</span>
		</span>
	<?php } ?>

    <img src="<?php echo esc_url($media['image_url']); ?>" alt="<?php echo esc_attr($media['description']); ?>" />

<?php if(!empty($lightbox)) : ?>
    </a>
<?php endif; ?>
