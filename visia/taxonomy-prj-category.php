<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php get_header(); ?>

<section class="content padded container blog" id="project-category">
	<div class="title grid-full">
		<h2><?php printf(__("Category: %s",'Pixelentity Theme/Plugin'),single_cat_title("",false)); ?></h2>
		<span class="border"></span>
	</div>

	<div class="grid-4">			
		<?php $t->content->loop(); ?>
	</div>
	<?php get_sidebar(); ?>
</section>

<?php get_footer(); ?>
