<?php $count = jaw_template_get_var('count', '0');?>
<?php if ($count % jaw_template_get_var('items_in_slide', '1') == 0) {
    jaw_template_set_var('konec', 'false');
?>
<div class="item <?php echo jaw_template_get_var('first'); ?>">
    <div class="carousel-caption row">
    <?php
    $first = '';
    ?>  
        <div class="col-lg-<?php echo jaw_template_get_var('one_width', '12'); ?>">
            <?php
            echo do_shortcode(jaw_template_get_var('content',''));
            ?> 
        </div>
<?php } else { ?>
        <div class="col-lg-<?php echo jaw_template_get_var('one_width', '12'); ?>">
                <?php
                echo do_shortcode(jaw_template_get_var('content',''));
                ?>
        </div>
<?php } ?>
    <?php 
    $count++; 
    jaw_template_set_var('count', $count);
    ?>      
        
    <?php if ($count % jaw_template_get_var('items_in_slide', '1') == 0) { ?>
    </div>
</div>
<?php jaw_template_set_var('konec', 'true');?>
<?php } ?> 
<?php jaw_template_set_var('first', ''); ?>