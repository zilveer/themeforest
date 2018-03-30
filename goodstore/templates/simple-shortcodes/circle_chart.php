<?php global $jaw_data; 
jaw_template_inc_counter('chart');?>
<script>
    var data_<?php echo jaw_template_get_counter('chart');?> = new Array;
</script>

<div class="row">
    <div class="col-lg-<?php echo jaw_template_get_var('box_size'); ?>">
        <div class="circle-progressbar">
            <?php
            $chart_type = jaw_template_get_var('chart_type', 'Pie');
            ?>
            <canvas id="chart-<?php echo jaw_template_get_counter('chart'); ?>" width="<?php echo jaw_template_get_var('size', '150'); ?>" height="<?php echo jaw_template_get_var('size', '150'); ?>"></canvas>
            <ul class="chart-legend"><?php echo do_shortcode(jaw_template_get_var('content', '')); ?></ul>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function() {
        var ctx = jQuery("#chart-<?php echo jaw_template_get_counter('chart'); ?>").get(0).getContext("2d");
        new Chart(ctx).<?php echo $chart_type; ?>(data_<?php echo jaw_template_get_counter('chart');?>);
    });
</script>
