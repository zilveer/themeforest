<?php $t =& peTheme(); ?>
<?php $view =& $t->view; ?>
<?php list($instances,$loop) = $t->template->data(); ?>


<div id="pe-accordion-instance-<?php echo $instances; ?>" class="accordion">
	<?php while ($item =& $loop->next()): ?>
	<div class="accordion-group">
		<div class="accordion-heading">
			<a 
				class="accordion-toggle" 
				href="#<?php echo $item->data->id ?>" 
				data-parent="#pe-accordion-instance-<?php echo $instances; ?>" 
				data-toggle="collapse"
				>
				<?php echo $item->data->title; ?>
			</a>
		</div>
		<div id="<?php echo $item->data->id ?>" class="accordion-body <?php echo $loop->count > 1 ? 'collapse' : "in" ?>">
			<div class="accordion-inner">
				<?php $view->outputModule($item->view); ?>
			</div>
		</div>
	</div>
	<?php endwhile; ?>
</div>