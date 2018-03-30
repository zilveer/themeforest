<?php global $jaw_data; ?>
<?php jaw_template_inc_counter('accordion');?>
<div class="panel-acc panel-default">
    <div class="panel-heading"><h4 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo jaw_template_get_counter('accordion'); ?>"><?php echo jaw_template_get_var('title'); ?></a></h4></div>
    <div id="collapse<?php echo jaw_template_get_counter('accordion'); ?>" class="panel-collapse <?php echo jaw_template_get_var('class'); ?>"><div class="panel-body"><?php echo jaw_template_get_var('content'); ?></div></div>
</div>

