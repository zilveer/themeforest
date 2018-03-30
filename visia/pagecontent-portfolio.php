<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $project =& $t->project; ?>

<?php $meta =& $content->meta(); ?>
<?php if ( defined( 'HOME_SLIDER') ) echo '<div class="slider-cover">'; ?>
<section class="portfolio clearfix" id="<?php $content->slug(); ?>">

	<div class="content container">
		<div class="title grid-full">
			<h2><?php $content->title(); ?></h2>
			<span class="border"></span>

			<?php if (get_the_content()): ?>
			<div class="sub-heading">			
				<?php $content->content(); ?>
			</div>
			<?php endif; ?>

		</div>
		<div class="clearfix"></div>

	<?php if (!post_password_required()): ?>
	<?php $t->project->portfolio($content->meta()->portfolio,false) ?>
	<?php else: ?>
	</div>
	<?php get_template_part("password"); ?>
	<?php endif; ?>
	
</section>
<?php if ( defined( 'HOME_SLIDER') ) echo '</div>'; ?>