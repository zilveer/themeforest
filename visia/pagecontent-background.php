<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php if ( defined( 'HOME_SLIDER') ) echo '<div class="slider-cover">'; ?>
<?php $parallax = empty($meta->background->parallax) ? "parallax-disabled" : ""; ?>
<section class="parallax colored <?php echo $parallax; ?> clearfix" id="<?php $content->slug(); ?>" style="background-image: url(' <?php echo $meta->background->background; ?>');">
	<div class="content dark padded background-page container">

		<div class="title grid-full">
			<h2><?php $content->title(); ?></h2>
			<span class="border"></span>

			<div class="sub-heading">			
				<?php $content->content(); ?>
			</div>
		</div>
		<div class="clearfix"></div>
		<?php if ($content->hasFeatImage()): ?>
		<div class="animated slide" data-appear-bottom-offset="100">
			<?php $content->img(960,330); ?>
		</div>	
		<?php endif; ?>
	</div>
</section>
<?php if ( defined( 'HOME_SLIDER') ) echo '</div>'; ?>
