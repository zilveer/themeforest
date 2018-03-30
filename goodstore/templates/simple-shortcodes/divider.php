<?php global $jaw_data; 
if(jaw_template_get_var('space', '0') >= 0){
    $style = 'padding-top:'. jaw_template_get_var('space', '0').'px';
}else{
    $style = 'margin-top:'. jaw_template_get_var('space', '0').'px';
}
if(jaw_template_get_var('space_after', '0') == 0){
    $style_after = '';
}else{
    $style_after = 'margin-bottom:'. jaw_template_get_var('space_after', '0').'px';
}
?>
<div class="divider divider-<?php echo jaw_template_get_var('divider_style', 'solid'); ?>  <?php echo jaw_template_get_var('clear', 'clear-off'); ?>" style="border-bottom-style:<?php echo jaw_template_get_var('divider_style', 'solid'); ?>; border-bottom-width:<?php echo jaw_template_get_var('width', '1'); ?>px;border-bottom-color:<?php echo jaw_template_get_var('color', '#000000'); ?>;color:<?php echo jaw_template_get_var('color', '#000000'); ?>; <?php echo $style.'; '.$style_after; ?>;">
    <?php if (jaw_template_get_var('icon', '') != '' || jaw_template_get_var('divider_text', '') != '') { ?>
    <span class="divider-text"><span class="divider-center-text" style="color:<?php echo jaw_template_get_var('text_color',jaw_template_get_var('color', '#000000')); ?>"><i class="<?php echo jaw_template_get_var('icon', ''); ?>"></i><?php echo jaw_template_get_var('divider_text', ''); ?></span></span>
    <?php } ?>
    <?php if (jaw_template_get_var('divider_totop', '1') == '1') { ?>   
        <div class="to-top-<?php echo jaw_template_get_var('totop_align', 'right'); ?>"><a class="divider_to_top" href="#"><?php echo jaw_template_get_var('divider_title', ''); ?></a></div>
        <?php } ?>

</div>



