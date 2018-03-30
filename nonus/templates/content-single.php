<?php while (have_posts()) : the_post(); ?>
<?php $format = get_post_format();
      $format = $format ? $format : 'standard';
	  $class = $format == 'standard' ? 'blogItem post format-type-image' : 'blogItem post format-type-' . $format;
	?>
<article class="<?php echo $class; ?>">
	<?php get_template_part('templates/post_single/content-' . $format);?>
</article>
<nav class="pager">
	<?php $prev = get_previous_post();?>
	<?php $next = get_next_post();?>
	<?php if($next):?>
        <a href="<?php echo get_permalink($next->ID);?>" class="prev"><?php _e('Previous', 'ct_theme')?></a>
    <?php endif;?>
    <span class="view-all-posts"><a href="<?php echo ct_get_blog_url()?>"><?php _e('View all posts', 'ct_theme')?></a></span>
	<?php if($prev):?>
        <a href="<?php echo get_permalink($prev->ID);?>" class="next"><?php _e('Next', 'ct_theme')?></a>
    <?php endif;?>
</nav>

<?php comments_template('/templates/comments.php'); ?>

<?php endwhile; ?>