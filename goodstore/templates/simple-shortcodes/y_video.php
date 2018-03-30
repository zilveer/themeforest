<?php global $jaw_data; ?>
<?php
$class = '';
if (jaw_template_get_var('auto_height', '1')) {
    $class = 'jaw-video';
}
?>
<div class='youtube_frame row'>
    <div class='col-lg-<?php echo jaw_template_get_var('box_size'); ?>'>
        <iframe class='youtube <?php echo $class; ?>' style='height:<?php echo jaw_template_get_var('height'); ?>px;width:<?php echo jaw_template_get_var('width'); ?>' src='<?php echo jaw_template_get_var('url'); ?>' height='<?php echo jaw_template_get_var('height'); ?>' frameborder='0'></iframe>
    </div>
</div>
