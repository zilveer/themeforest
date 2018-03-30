<?php
/**
 * Shows the home splash section
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>

<?php $meta =& $t->content->meta(); ?>
<?php $home = empty($meta->home) ? new StdClass() : $meta->home; ?>
<?php $link = empty($home->link) ? false : $home->link; ?>
<?php $label = !$link || empty($home->label) ? false : $home->label; ?>
<?php $slider = empty($home->slider) ? false : $home->slider; ?>

<?php if ($slider): ?>
<?php ob_start(); ?>
<?php $t->view->output($slider); ?>
<?php $slider = ob_get_clean(); ?>
<?php endif; ?>

<?php $taglines = empty($home->taglines) ? false : $home->taglines; ?>
<?php $splash = !empty($meta->home->splash) && $slider && $meta->home->splash === "yes"; ?>

<?php if ($splash): ?>
<section 
	class="pe-main-section pe-splash-section pe-full-page pe-no-resize" id="section-splash"
	data-maxheight="<?php echo esc_attr(empty($home->maxh) ? 0 : $home->maxh); ?>"
	data-minheight="<?php echo esc_attr(empty($home->minh) ? 0 : $home->minh); ?>" 
	>
	<?php if ($taglines || !empty($home->logo)): ?>
	<div class="peCaption pe-caption-persistent" data-orig-width="940" data-orig-height="300">
		<div 
			class="peCaptionLayer"
			data-origin="center"
			data-transition="fadeIn"
			data-duration="1"
			data-delay="0"
			data-x="0" 
			data-y="<?php echo esc_attr(empty($home->offset) ? 0 : $home->offset); ?>"
			>
			<div class="wrapper">
				<?php if ($link): ?>
				<a href="<?php echo esc_url($link); ?>" <?php echo $label ? "" : 'class="no-label"'; ?>>
					<?php endif; ?>
					<?php if (!empty($home->logo)): ?>
					<?php $t->image->retina($home->logo); ?>
					<?php endif; ?>
					<?php if ($label): ?>
					<span><?php echo wp_kses_post($label); ?><i class="icon-down-open-mini"></i></span>
					<?php endif; ?>
					<?php if ($link): ?>
				</a>
				<?php endif; ?>
			</div>

			<?php if ($taglines): ?>
			<div class="pe-headlines">
				<?php foreach($taglines as $idx => $tagline): ?>
				<?php $tagline = do_shortcode($tagline["content"]); ?>
				<?php if ($idx === 0): ?>
				<div class="pe-active"><?php echo $tagline; ?></div>				
				<?php else: ?>
				<div><?php echo $tagline; ?></div>
				<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>
	<?php echo $slider; ?>
</section>
<?php endif; ?>
