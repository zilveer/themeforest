<?php $t =& peTheme(); ?>
<?php list($data) = $t->template->data(); ?>

<div class="wrap-inner">
	<div class="head">
		<h3><?php echo $data->title; ?></h3>
	</div>
	<div class="price">
		<?php echo $data->price; ?>
	</div>
	<ul>
		<?php foreach ($data->features as $feature): ?>
		<li><?php echo $feature["content"]; ?></li>
		<?php endforeach; ?>
	</ul>
	<div class="foot">
		<?php if (!empty($data->button_label)): ?>
		<a href="<?php echo $data->button_link; ?>" class="btn"><?php echo $data->button_label; ?></a>
		<?php endif; ?>
	</div>
</div>