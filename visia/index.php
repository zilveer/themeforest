<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php get_header(); ?>

<section class="content padded container blog" id="<?php $content->slug(); ?>">

	<div class="title grid-full">
		<h2><?php _e('THE BLOG','Pixelentity Theme/Plugin'); ?></h2>
		<span class="border"></span>
	</div>

	<div class="grid-4">			
		<?php $t->content->loop(); ?>
	</div>
	<?php get_sidebar(); ?>
</section>

<?php get_footer(); ?>