<li <?php post_class('mkd-blog-list-item clearfix'); ?>>
	<div class="mkd-blog-list-item-inner">
		<?php if(!$hide_image) : ?>
			<div class="mkd-item-image">
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
		<?php endif; ?>
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

		<div class="mkd-item-info-section">
			<?php hue_mikado_post_info(array(
				'date'     => 'yes',
				'category' => 'no',
				'author'   => 'no',
				'comments' => (hue_mikado_options()->getOptionValue('blog_single_comments') == 'yes') ? 'yes' : 'no',
				'like'     => hue_mikado_show_likes() ? 'yes' : 'no'
			)) ?>
		</div>
	</div>
	</div>
</li>