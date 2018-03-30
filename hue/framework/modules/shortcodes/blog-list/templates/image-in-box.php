<li <?php post_class('mkd-blog-list-item clearfix'); ?>>
	<div class="mkd-blog-list-item-inner">
		<div class="mkd-item-image clearfix">
			<a href="<?php echo esc_url(get_permalink()) ?>">
				<?php if($use_custom_image_size) : ?>
					<?php echo hue_mikado_generate_thumbnail(
						get_post_thumbnail_id(get_the_ID()),
						null,
						$custom_image_dimensions[0],
						$custom_image_dimensions[1]
					); ?>
				<?php else: ?>
					<?php the_post_thumbnail($thumb_image_size); ?>
				<?php endif; ?>
			</a>
		</div>
		<div class="mkd-item-text-holder">
			<<?php echo esc_html($title_tag) ?> class="mkd-item-title">
			<a href="<?php echo esc_url(get_permalink()) ?>">
				<?php echo esc_attr(get_the_title()) ?>
			</a>
		</<?php echo esc_html($title_tag) ?>>

		<?php if($text_length != '0') {
			$excerpt = ($text_length > 0) ? substr(get_the_excerpt(), 0, intval($text_length)) : get_the_excerpt(); ?>
			<p class="mkd-excerpt"><?php echo esc_html($excerpt) ?></p>
		<?php } ?>
		<div class="mkd-item-date">
			<span><?php the_time(get_option('date_format')); ?></span>
		</div>
	</div>
	</div>
</li>
