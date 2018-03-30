<?php $t =& peTheme(); ?>
<?php list($data) = $t->template->data(); ?>

<?php if (!empty($data->title)): ?>
<h5><?php echo $data->title; ?></h5>
<?php endif; ?>
<?php if (!empty($data->features)): ?>
<div class="pe-skills">
	<?php foreach ($data->features as $skill): ?>
	<?php $p = $skill["perc"];  ?>
	<div class="pe-skill">
		<div class="pe-skill-title">
			<?php echo $skill["content"]; ?>
		</div>
		<div class="pe-skill-perc">
			<?php echo $p; ?>%
		</div>
		<div class="pe-skill-bg"></div>
		<div data-animation="pe-skill-animation" class="pe-skill-value pe-animation-maybe" style="width:<?php echo $p; ?>%;"></div>
	</div>
	<?php endforeach; ?>
</div>
<?php endif; ?>