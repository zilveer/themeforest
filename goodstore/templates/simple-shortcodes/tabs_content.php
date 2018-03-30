<?php global $jaw_data; ?>
<?php if (jaw_template_get_var('class') == 'active') { ?>
    <div class="tab-pane fade active in" id="tab_<?php echo jaw_template_get_counter('accordion'); ?>_<?php echo jaw_template_get_var('id'); ?>"><p><?php echo do_shortcode(jaw_template_get_var('content')); ?></p></div>
<?php } else { ?>
    <div class="tab-pane fade" id="tab_<?php echo jaw_template_get_counter('accordion'); ?>_<?php echo jaw_template_get_var('id'); ?>"><p><?php echo do_shortcode(jaw_template_get_var('content')); ?></p></div>
<?php } ?>