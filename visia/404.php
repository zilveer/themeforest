<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php get_header(); ?>

<section class="404 content padded container" id="404">

	<div class="title grid-full">
		<h2><?php _e("Page Not Found",'Pixelentity Theme/Plugin'); ?></h2>
		<span class="border"></span>
	</div>

	<div class="grid-6">
        <p></p>
        <p></p>
        <p>
			<?php _e("The page you're looking for doesn't exist.",'Pixelentity Theme/Plugin'); ?>
        </p>
	</div>
					
</section>

<?php get_footer(); ?>