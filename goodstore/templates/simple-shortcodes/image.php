<?php global $jaw_data; ?>
<?php
$id = rand(0, 9999);
$class = '';
?>

<?php
if (jaw_template_get_var('hover_url', '') != '') {
    $class = 'with-hover';
}
?>
<div class="row">

    <div class="col-lg-<?php echo jaw_template_get_var('box_size') . ' ' . $class; ?> builder-img">
        <?php if (jaw_template_get_var('link', '') != '' && jaw_template_get_var('lightbox', '0') == '0') { ?>
            <a href="<?php echo jaw_template_get_var('link', ''); ?>"  target="<?php echo jaw_template_get_var('target'); ?>">
            <?php } else if (jaw_template_get_var('lightbox', '0') == '1') { ?>
                <a href="<?php echo jaw_template_get_var('url'); ?>" rel="prettyPhoto[<?php echo $id; ?>]" title="<?php echo jaw_template_get_var('alt'); ?>">
                <?php } ?>
                <span id="image-<?php echo $id; ?>"  >   
                    <?php $img_size = jaw_template_get_var('url-size', array('height' => '100%', 'width' => '100%')); ?>
                    <?php if (jaw_template_get_var('url') != '') { ?>
                        <img class="builder-image lazy" src="<?php echo jaw_template_get_var('url'); ?>"  alt="<?php echo jaw_template_get_var('alt'); ?>" title="<?php echo jaw_template_get_var('caption'); ?>" height="<?php echo $img_size['height']; ?>" width="<?php echo $img_size['width']; ?>"/>  
                    <?php } ?>
                </span>
                <?php if (jaw_template_get_var('lightbox', '0') == '1') { ?>
                </a>
            <?php } ?>
            <?php if (jaw_template_get_var('hover_url', '') != '') { ?>
                <?php if (jaw_template_get_var('lightbox', '0') == '1') { ?>
                    <a href="<?php echo jaw_template_get_var('hover_url'); ?>" rel="prettyPhoto[<?php echo $id; ?>]" title="<?php echo jaw_template_get_var('hover_caption'); ?>">
                    <?php } ?>
                    <?php $img_size = jaw_template_get_var('hover_url-size', array('height' => '100%', 'width' => '100%')); ?>
                    <?php if (jaw_template_get_var('hover_url') != '') { ?>
                        <img class="builder-hover_image lazy" src="<?php echo jaw_template_get_var('hover_url'); ?>"  alt="<?php echo jaw_template_get_var('hover_caption'); ?>" title="<?php echo jaw_template_get_var('hover_caption'); ?>" height="<?php echo $img_size['height']; ?>" width="<?php echo $img_size['width']; ?>"/>  
                    <?php } ?>                    
                    <?php if (jaw_template_get_var('lightbox', '0') == '1') { ?>
                    </a>
                <?php } ?>
            <?php } ?>
            <?php if (jaw_template_get_var('link', '') != '' && jaw_template_get_var('lightbox', '0') == '0') { ?>
            </a>
        <?php } ?>
    </div>
</div>
