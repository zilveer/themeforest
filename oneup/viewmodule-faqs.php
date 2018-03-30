<?php $t =& peTheme(); ?>
<?php $view =& $t->view; ?>
<?php list($instances,$loop) = $t->template->data(); ?>


<?php while ($item =& $loop->next()): ?>
<div class="faq">
	<div class="faq-heading">
		<div
			data-target="#<?php echo $item->data->id ?>" 
			data-toggle="collapse"
			>
			<span class="accent"><?php echo $loop->count; ?>.</span><?php echo $item->data->title; ?>
		</div>
	</div>
	<div id="<?php echo $item->data->id ?>" class="faq-body <?php echo $item->data->closed != "no" ? 'collapse' : "in" ?>">
		<div class="faq-inner">
			<?php $view->outputModule($item->view); ?>
		</div>
	</div>
</div>
<?php endwhile; ?>
