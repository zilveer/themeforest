<?php
/*
Template Name: Blog
*/
get_header();
global $unf_options;
?>
<div id="content-wrapper" class="row clearfix">
	<div id="content" class="col-md-8 column">
		<div class="article clearfix">
			<?php // If Custom Home Blog Title
			if (!empty($unf_options['unf_blogtitle'] )) { ?>
				<h1 class="post-title"><?php echo $unf_options['unf_blogtitle']?></h1>
			<?php } ?>
			<?php get_template_part( 'loop' ); ?>
			<?php get_template_part('pagination'); ?>
		</div>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>