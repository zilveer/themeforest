<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php get_header(); ?>

<section class="content padded container blog" id="<?php $content->slug(); ?>">

	<div class="title grid-full">
		<h2><?php $content->title(); ?></h2>
		<span class="border"></span>
	</div>

	<div class="grid-6">			
		<?php $t->content->loop(); ?>
	</div>
</section>

<?php get_footer(); ?>