<?php global $jaw_data; ?>

<?php if (jaw_template_get_var('class') == 'active') { ?>
    <li class="active"><a data-toggle="tab" href="#tab_<?php echo jaw_template_get_counter('accordion'); ?>_<?php echo jaw_template_get_var('id'); ?>"><?php echo jaw_template_get_var('content'); ?></a></li>
<?php } else { ?>
    <li><a data-toggle="tab" href="#tab_<?php echo jaw_template_get_counter('accordion'); ?>_<?php echo jaw_template_get_var('id'); ?>"><?php echo jaw_template_get_var('content'); ?></a></li>
<?php } ?>
