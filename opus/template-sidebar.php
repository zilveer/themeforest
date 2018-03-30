<?php
/*
Template Name: Default template with sidebar
*/
?>

<?php get_header(); ?>
<!-- main content start -->
<div class="mainwrap">
	<div class=" main clearfix">
		<div class="content pagesidebar sidebarWoo">
			<div class="postcontent">
				<div class="posttext">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="usercontent"><?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?></div>
					<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
					<?php endwhile; endif; ?>
				</div>
			</div>
		</div>
		<!-- main sidebar -->
		<?php get_sidebar(); ?>
	</div>

</div>
<?php get_footer(); ?>