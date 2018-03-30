<?php global $jaw_data; 
jaw_template_inc_counter('tabs');
?>
<div class="jaw-tabs <?php echo jaw_template_get_var('style'); ?>">
<?php
echo do_shortcode(jaw_template_get_var('content'));
?>
</div>