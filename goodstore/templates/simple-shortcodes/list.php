<?php global $jaw_data; ?>
<?php if (jaw_template_get_var('title', '') != '') { ?>
    <h5><?php echo jaw_template_get_var('title'); ?></h5>
<?php } ?>
<ul class="jaw_list <?php echo jaw_template_get_var('type', 'bullet'); ?>">
    <?php echo do_shortcode(jaw_template_get_var('content')); ?>
</ul>

