<?php $t =& peTheme(); ?>
<?php list($data) = $t->template->data(); ?>

<div data-animation="fadeInUp" class="pe-stat pe-animation-maybe">
	<?php if (!empty($data->title)): ?>
	<h5><?php echo $data->title; ?></h5>
	<?php endif; ?>

	<div class="pe-media">
		<?php if ($data->image): ?>
		<?php echo $t->image->resizedImg($data->image,460); ?>
		<?php endif; ?>
	</div>

	<div class="pe-wp-default">
		<?php echo $data->content; ?>
	</div>
</div>