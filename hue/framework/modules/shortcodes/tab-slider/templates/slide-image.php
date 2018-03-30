<?php if($slide_image) : ?>
    <div class="mkd-tab-slide-image" <?php hue_mikado_inline_style(array("background-image:url('".wp_get_attachment_url($slide_image)."')")) ?>>
        <?php echo wp_get_attachment_image($slide_image, 'full'); ?>
    </div>
<?php endif; ?>