<?php global $jaw_data; 
$style = '';
if(jaw_template_get_var('use_bg','0') == '1'){
$style = 'style="background:url(\''.jaw_template_get_var('bg_image','').'\') 50% 0 '.jaw_template_get_var('bg_color','#000000').'; min-height:'.jaw_template_get_var('height','50').'px;padding-top:'.jaw_template_get_var('padding-top','0').'px;"';
}

?>

<div class="row">
    <div class="col-lg-<?php echo jaw_template_get_var('box_size'); ?>">
        <div <?php echo $style; ?>>
        <?php echo do_shortcode(jaw_template_get_var('custom_text')); ?>
        </div>
    </div>
</div>
