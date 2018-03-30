<div class="entry-meta entry-footer">
	<span class="entry-categories"><?php _e('Posted in: ', AZ_THEME_NAME) ?> <?php the_category(', ') ?></span>
	<span class="entry-tags"><?php the_tags( __('Tagged:', AZ_THEME_NAME) . ' ', ', ', ''); ?></span>
	<span class="author"><?php _e('Author: ', AZ_THEME_NAME) ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a></span>
</div>