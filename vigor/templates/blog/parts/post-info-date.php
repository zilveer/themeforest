<div class="date">
	<?php if(!edgt_post_has_title()) { ?>
		<a href="<?php the_permalink() ?>">
	<?php } ?>

	<span class="date_text"><?php _e('Posted on','edgt'); ?></span>
	<?php the_time(get_option('date_format')); ?>

	<?php if(!edgt_post_has_title()) { ?>
		</a>
	<?php } ?>
</div>