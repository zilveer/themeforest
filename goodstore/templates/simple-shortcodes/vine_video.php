<?php global $jaw_data; ?>
<div class='vine_frame row'>
    <div class='col-lg-<?php echo jaw_template_get_var('box_size'); ?>'>
        <iframe class="vine-embed" src="<?php echo jaw_template_get_var('url'); ?>/embed/simple" height="<?php echo jwUtils::get_size(jaw_template_get_var('box_size'), true) ?>" width="<?php echo jaw_template_get_var('width'); ?>" frameborder="0" ></iframe>
    </div>
</div>
