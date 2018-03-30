<?php $t =& peTheme(); ?>
<?php $view =& $t->view; ?>
<?php list($instances,$loop) = $t->template->data(); ?>

<ul class="nav nav-tabs">
	<?php while ($item =& $loop->next()): ?>
	<li<?php echo $loop->count === 1 ? ' class="active"' : "" ?>>
		<a href="#<?php echo $item->data->id ?>" data-toggle="tab"><?php echo $item->data->title; ?></a>
	</li>
	<?php endwhile; ?>
</ul>

<?php $loop->rewind(); ?>

<div class="tab-content">
	<?php while ($item =& $loop->next()): ?>
	<div class="tab-pane<?php echo $loop->count === 1 ? ' active' : "" ?>" id="<?php echo $item->data->id; ?>">
		<?php $view->outputModule($item->view); ?>
	</div>
	<?php endwhile; ?>
</div>
