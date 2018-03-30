<?php $t =& peTheme(); ?>
<?php list($data) = $t->template->data(); ?>

<div class="action">
	<div class="pe-container">
		<!--action bar-->
		<section class="row-fluid">
			<div class="span12">
				<?php echo $data->content; ?>
			</div>
		</section>
		<!--end action bar-->
	</div><!--end container-->
</div><!--end wide wrapper-->