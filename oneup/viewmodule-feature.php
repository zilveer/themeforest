<?php $t =& peTheme(); ?>
<?php list($data) = $t->template->data(); ?>
<?php $type = empty($data->type) ? 'image' : $data->type; ?>
<?php $layout = empty($data->layout) ? "bottom" : $data->layout; ?>
<?php $w = $layout === "bottom" ? 940 : 460; ?>
<?php $h = empty($data->height) ? null : $data->height; ?>

<?php ob_start(); ?>
<?php if (!empty($data->title)): ?>
<h5><?php echo $data->title; ?></h5>
<?php endif; ?>
<div class="pe-wp-default">
	<?php echo $data->content; ?>
</div>
<?php if (!empty($data->label)): ?>
<div class="pe-button">
	<a href="<?php echo $data->link; ?>"><?php echo $data->label; ?></a>
</div>
<?php endif; ?>
<?php $text = ob_get_clean(); ?>

<?php if ($layout != "none"): ?>
<?php ob_start(); ?>
<?php $bw = $t->media->w($w); ?>
<?php if ($type === 'image'): ?>
<?php if (!empty($data->image)): ?>
<?php echo $t->image->resizedImg($data->image,$w,$h); ?>
<?php endif; ?>
<?php elseif ($type === 'video'): ?>
<?php if (!empty($data->video)): ?>
<?php $t->video->output($data->video); ?>
<?php endif; ?>
<?php else: ?>
<?php if (!empty($data->view)): ?>
<?php $t->view->resize((object) array("id" => $data->view),$w,$h); ?>
<?php endif; ?>
<?php endif; ?>
<?php $bw->restore(); ?>
<?php $media = ob_get_clean(); ?>
<?php $layout = empty($media) ? "bottom" : $layout; ?>
<?php endif; ?>

<div class="row-fluid pe-container pe-layout-<?php echo $layout; ?>">
	<?php switch ($layout): case 'right': ?>
	<div class="span6 pe-col-content"><?php echo $text; ?></div>
	<div data-animation="fadeInRightBig" class="span6 pe-animation-maybe pe-col-media"><?php echo $media; ?></div>
	<?php break; case 'left': ?>
	<div data-animation="fadeInLeftBig" class="span6 pe-animation-maybe pe-col-media"><?php echo $media; ?></div>
	<div class="span6 pe-col-content"><?php echo $text; ?></div>
	<?php break; case 'bottom': ?>
	<div class="span12 pe-col-content"><?php echo $text; ?></div>
	<?php if ($media): ?>
	<div data-animation="fadeInUpBig" class="span12 pe-animation-maybe pe-col-media"><?php echo $media; ?></div>
	<?php endif; ?>
	<?php break; default: ?>
	<div data-animation="fadeInUpBig" class="span12 pe-animation-maybe pe-col-content"><?php echo $text; ?></div>
	<?php endswitch; ?>
</div>
