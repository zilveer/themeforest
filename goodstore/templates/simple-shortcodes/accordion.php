<?php global $jaw_data; ?>

<div class="row">
    <div class="col-lg-<?php echo esc_attr(jaw_template_get_var('box_size')); ?>">
        <div class="panel-group accordion">
            <?php
            echo do_shortcode(jaw_template_get_var('content'));
            ?>
        </div>
    </div>
</div>
