<?php get_header(); 
	$postspage_id = get_option('page_for_posts'); 
?>

<div id="content" class="post-content">
<div class="container">

	<?php get_template_part('/stacks/stack', 'title'); ?>
	<?php get_template_part('/stacks/stack', 'page_blog'); ?>

</div>
</div>

<?php get_footer(); ?>