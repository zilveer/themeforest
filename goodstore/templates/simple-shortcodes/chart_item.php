<?php global $jaw_data; ?>
<li>
<span class="chart-legend-color" style="background: <?php echo jaw_template_get_var('color',''); ?>" ></span><?php echo jaw_template_get_var('title',''); ?>
</li>
<script>
    jQuery(document).ready(function(){
        data_<?php echo jaw_template_get_counter('chart');?>.push({
            value: <?php echo jaw_template_get_var('value',''); ?>,
            color:"<?php echo jaw_template_get_var('color',''); ?>"
        });
    });
</script>

