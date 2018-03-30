<?php global $jaw_data; ?>
<?php
$class = '';
if (jaw_template_get_var('auto_height', '1')) {
    $class = 'jaw-video';
}
?>
<div class='vimeo_frame'>
    <div class='col-lg-<?php echo jaw_template_get_var('box_size'); ?>'>
        <iframe class='vimeo <?php echo $class; ?>' style='height:<?php echo jaw_template_get_var('height'); ?>px;width:<?php echo jaw_template_get_var('width'); ?>' src='<?php echo jaw_template_get_var('url'); ?>' width='$width' height='$height' frameborder='0'></iframe>
    </div>
</div>
