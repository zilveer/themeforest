<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>


<?php if ( defined( 'HOME_SLIDER') ) echo '<div class="slider-cover">'; ?>
<section class="content padded container blog" id="<?php $content->slug(); ?>">

	<div class="title grid-full">
		<h2><?php $content->title(); ?></h2>
		<span class="border"></span>
	</div>
	<div class="clearfix"></div>

	<div class="grid-4">
		<?php $content->blog($meta->blog,false); ?>
	</div>
	<?php get_sidebar(); ?>
</section>
<?php if ( defined( 'HOME_SLIDER') ) echo '</div>'; ?>