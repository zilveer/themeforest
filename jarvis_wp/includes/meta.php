<span class="meta-author"><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" title="<?php _e('View all posts by', 'rocknrolla'); ?> <?php the_author(); ?>">
<?php _e('Written by ', 'rocknrolla'); the_author(); ?>
</a></span>
<span>/</span>
<span class="meta-category">
<?php _e('Posted in ', 'rocknrolla'); the_category(', '); ?>
</span> 