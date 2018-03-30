<?php
/*
Template Name: Default template with sidebar
*/
?>

<?php get_header(); ?>
<!-- top bar with breadcrumb -->
<div class = "outerpagewrap">
	<div class="pagewrap">
		<div class="pagecontent">
			<div class="pagecontentContent">
				<p><?php echo pmc_breadcrumb(); ?></p>
			</div>
		</div>

	</div>
</div>   
<!-- main content start -->
<div class="mainwrap">
	<div class=" main clearfix">
		<div class="content pagesidebar sidebarWoo">
			<div class="postcontent">
				<div class="posttext">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<h1><?php the_title() ?></h1>
					<div class="usercontent"><?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?></div>
					<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
					<?php endwhile; endif; ?>
				</div>
			</div>
		</div>
		<!-- main sidebar -->
		<?php get_sidebar(); ?>
	</div>
	<!-- bottom quote -->
	<div class="infotextwrap">
		<div class="infotext">
			<div class="infotext-title">
				<h2><?php echo pmc_translation('quote_big','CHECK OUR LATEST WORDPRESS THEME THAT IMPLEMENTS PAGE BUILDER') ?></h2>
				<div class="infotext-title-small"><?php echo pmc_translation('quote_small','- learn how to build Wordpress Themes with ease with a premium Page Builder which allows you to add new Pages in seconds.') ?></div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>