<?php global $jaw_data; ?>

<div class="row">
    <div class="col-lg-<?php echo jaw_template_get_var('box_size'); ?>">
        <div class="panel panel-<?php echo jaw_template_get_var('message_style'); ?>">
            <?php if (strlen(jaw_template_get_var('title')) > 0) { ?>
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo do_shortcode(jaw_template_get_var('title')); ?></h3>
            </div>
            <?php } ?>
            <div class="panel-body">
                <?php echo do_shortcode(jaw_template_get_var('text_content')); ?>
            </div>
        </div>
    </div>
</div>