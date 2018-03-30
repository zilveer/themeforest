<?php global $unf_options; ?>
<p class="byline vcard post-meta">
	<time class="updated" datetime="<?php echo get_the_time(get_option('date_format')) ?>">
		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
			<?php echo get_the_time(get_option('date_format')) ?>
		</a>
	</time>

	<?php if ( $unf_options['unf_author_info'] == '1' ) { ?>
		<i class="icon icon-star first-star"></i>
		<span class="author bypostauthor">
			<?php echo bones_get_the_author_posts_link() ?>
		</span>
	<?php } ?>

	<i class="icon icon-star"></i>
	<span class="cats">
		<?php echo get_the_category_list(', '); ?>
	</span>
</p>
