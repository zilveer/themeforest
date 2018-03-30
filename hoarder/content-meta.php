<!-- BEGIN .entry-meta-footer-->
<div class="entry-meta-footer">
    <span class="comment-count"><?php _e('Comments: ', 'zilla'); comments_popup_link( '0', '1', '%' ); ?></span>
    <span class="author"><?php _e('Posted by:', 'zilla') ?> <?php the_author_posts_link(); ?></span>
	<span class="entry-categories"><?php _e('Categories:', 'zilla') ?> <?php the_category(', ') ?></span>
    <span class="entry-tags"><?php the_tags( __('Tags:', 'zilla') . ' ', ', ', ''); ?></span>
    
    <?php if( function_exists('zilla_likes') ) {
        zilla_likes(); 
    } ?>
    
<!-- END .entry-meta-footer-->
</div>
