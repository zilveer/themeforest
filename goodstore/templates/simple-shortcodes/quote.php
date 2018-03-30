<?php global $jaw_data; ?>
<div class="blockquote-container">
    <?php if (jaw_template_get_var('design_type', 'quote_icon') == 'quote_icon') { ?>
        <span class="quote_i"><i class="icon-quotes-left"></i></span>
        <?php } ?>
    <blockquote class="<?php echo jaw_template_get_var('design_type', 'quote_icon'); ?>">
        <?php echo do_shortcode(jaw_template_get_var('custom_text', '')); ?>
    </blockquote>
</div>