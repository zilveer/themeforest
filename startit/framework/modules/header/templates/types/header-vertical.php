<?php do_action('qode_startit_before_page_header'); ?>
<aside class="qodef-vertical-menu-area">
    <div class="qodef-vertical-menu-area-inner">
        <div class="qodef-vertical-area-background" <?php qode_startit_inline_style(array($vertical_header_background_color,$vertical_header_opacity,$vertical_background_image)); ?>></div>
        <?php if(!$hide_logo) {
            qode_startit_get_logo();
        } ?>
        <?php qode_startit_get_vertical_main_menu(); ?>
        <div class="qodef-vertical-area-widget-holder">
            <?php if(is_active_sidebar('qodef-vertical-area')) : ?>
                <?php dynamic_sidebar('qodef-vertical-area'); ?>
            <?php endif; ?>
        </div>
    </div>
</aside>

<?php do_action('qode_startit_after_page_header'); ?>