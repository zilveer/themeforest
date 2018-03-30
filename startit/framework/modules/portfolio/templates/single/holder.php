<?php if($fullwidth) : ?>
<div class="qodef-full-width">
    <div class="qodef-full-width-inner">
<?php else: ?>
<div class="qodef-container">
    <div class="qodef-container-inner clearfix">
<?php endif; ?>
        <div <?php qode_startit_class_attribute($holder_class); ?>>
            <?php if(post_password_required()) {
                echo get_the_password_form();
            } else {
                //load proper portfolio template
                qode_startit_get_module_template_part('templates/single/single', 'portfolio', $portfolio_template);

                //load portfolio navigation
                qode_startit_get_module_template_part('templates/single/parts/navigation', 'portfolio');

                //load portfolio comments
                qode_startit_get_module_template_part('templates/single/parts/comments', 'portfolio');

            } ?>
        </div>
    </div>
</div>