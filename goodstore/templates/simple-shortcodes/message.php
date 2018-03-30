<?php global $jaw_data; ?>

<div class="row">
    <div class="col-lg-<?php echo jaw_template_get_var('box_size','max'); ?>">
        <div class="panel-<?php echo jaw_template_get_var('message_style'); ?> fade in">
            <div class="panel-heading">
                <?php if (jaw_template_get_var('show_icon', '1') == '1') { ?>
                    <?php if (jaw_template_get_var('message_style') == 'primary') { ?>
                        <i class="icon-info"></i>	
                    <?php } else if (jaw_template_get_var('message_style') == 'success') { ?>
                        <i class="icon-checkmark"></i>
                    <?php } else if (jaw_template_get_var('message_style') == 'info') { ?>
                        <i class="icon-info"></i>
                    <?php } else if (jaw_template_get_var('message_style') == 'warning') { ?>
                        <i class="icon-notification"></i>
                    <?php } else if (jaw_template_get_var('message_style') == 'danger') { ?>
                        <i class="icon-warning "></i>
                    <?php } ?>  
                <?php } ?>    
                <?php if (jaw_template_get_var('show_close', '1') == '1') { ?>
                    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
                <?php } ?>

                <?php echo do_shortcode(jaw_template_get_var('message_text')); ?>

            </div>
        </div>
    </div>
</div>