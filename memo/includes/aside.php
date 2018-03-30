<!--BEGIN .entry-header-->
<div class="entry-header">
	<h2 class="entry-title"><?php edit_post_link( __('edit', 'framework'), '<span class="edit-post">[', ']</span>' ); ?></h2>
<!--END entry-header -->
</div>

<!--BEGIN .entry-content -->
<div class="entry-content clearfix">
	<?php the_content(__('Read more...', 'framework')); ?>
<!--END .entry-content -->
</div>

<?php get_template_part('includes/post-meta'); ?>