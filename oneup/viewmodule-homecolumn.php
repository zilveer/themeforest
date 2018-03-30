<?php $t =& peTheme(); ?>
<?php list($data) = $t->template->data(); ?>

<div class="process-icon"><span><i class="<?php echo $data->icon ?>"></i></span></div>
<h4><?php echo $data->title; ?></h4>
<?php echo $data->content; ?>
<?php if (!empty($data->label) && !empty($data->url)): ?>
<a href="<?php echo $data->url ?>" class="read-more"><?php echo $data->label; ?></a>
<?php endif; ?>
