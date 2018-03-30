<?php
/**
 * The loop for displaying one or more staff custom post type.
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php list($data) = $t->template->data(); ?>
<?php $cols = empty($data->columns) ? 1 : $data->columns; ?>
<?php $mainClass = array("span12","span6","span4","span3","span2","span2"); ?>
<?php $mainClass = $mainClass[$cols-1]; ?>
<?php $w = $cols > 1 ? 460 : 940; ?>
<?php $h = $cols > 1 ? 421 : 0; ?>

<div class="pe-block pe-container">

	<?php while ($content->looping($cols) ) : ?>
	<?php $meta = $content->meta(); ?>
	<?php $staff = empty($meta->info) ? false : $meta->info; ?>

	<?php $content->beginRow('<div class="row-fluid">'); ?>

	<div class="<?php echo $mainClass ?> pe-animation-maybe" data-animation="fadeInUp" >
		<div class="staff-item">
			<?php $content->img($w,$h); ?>
			<div class="details">
				<span class="arrow"></span>
				<div class="title-wrap">
					<h4><?php echo $content->title(); ?></h4>
					<?php if (!empty($staff->position)): ?>
					<span class="position"><?php echo $staff->position; ?></span>
					<?php endif; ?>
				</div>
				<div class="info-wrap">
					<?php $content->content(); ?>

					<?php if (!empty($staff->social)): ?>
					<div class="social-media-wrap">
						<div><?php $content->socialLinks($staff->social); ?></div>
					</div>						
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php $content->endRow(); ?>
	<?php endwhile; ?>
</div>
