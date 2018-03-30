<?php if($fullwidth) : ?>
<div class="mkd-full-width">
    <div class="mkd-full-width-inner">
<?php else: ?>
<div class="mkd-container">
    <div class="mkd-container-inner clearfix">
<?php endif; ?>
        <div <?php libero_mikado_class_attribute($holder_class); ?>>
            <?php if(post_password_required()) {
                echo get_the_password_form();
            } else {
                //load proper portfolio template
                libero_mikado_get_module_template_part('templates/single/single', 'portfolio', $portfolio_template);

                //load portfolio navigation
                libero_mikado_get_module_template_part('templates/single/parts/navigation', 'portfolio');

                //get portfolio custom fields section
                libero_mikado_get_module_template_part('templates/single/parts/related-portfolios', 'portfolio');

                //load portfolio comments
                libero_mikado_get_module_template_part('templates/single/parts/comments', 'portfolio');

            } ?>
        </div>
    </div>
</div>