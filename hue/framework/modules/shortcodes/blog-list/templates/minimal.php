<li <?php post_class('mkd-blog-list-item clearfix'); ?>>
	<div class="mkd-blog-list-item-inner">
		<div class="mkd-item-text-holder">
			<<?php echo esc_html($title_tag) ?> class="mkd-item-title">
			<a href="<?php echo esc_url(get_permalink()) ?>">
				<?php echo esc_attr(get_the_title()) ?>
			</a>
		</<?php echo esc_html($title_tag) ?>>
		<?php if($text_length != '0') {
			$excerpt = ($text_length > 0) ? substr(get_the_excerpt(), 0, intval($text_length)) : get_the_excerpt(); ?>
			<p class="mkd-excerpt"><?php echo esc_html($excerpt) ?>...</p>
		<?php } ?>
		<div class="mkd-item-date">
			<span><?php the_time(get_option('date_format')); ?></span>
		</div>
	</div>
	</div>
</li>
