<!--BEGIN post-header -->
<div class="post-header">
	<blockquote><?php echo get_post_meta($post->ID, 'tz_quote', true); ?></blockquote>
	<span class="hanger-left"></span>
	<span class="hanger-right"></span>
<!--END post-header -->
</div>

<!--BEGIN .entry-header-->
<div class="entry-header">

<?php if( is_singular() ) : ?>
	<h1 class="entry-title"><?php edit_post_link( __('edit', 'framework'), '<span class="edit-post">[', ']</span>' ); ?></h1>
<?php else : ?>
	<h2 class="entry-title"><?php edit_post_link( __('edit', 'framework'), '<span class="edit-post">[', ']</span>' ); ?></h2>
<?php endif; ?>

<!--END entry-header -->
</div>

<!--BEGIN .entry-content -->
<div class="entry-content clearfix">
    <?php the_content(__('Read more...', 'framework')); ?>
<!--END .entry-content -->
</div>

<?php get_template_part('includes/post-meta'); ?>