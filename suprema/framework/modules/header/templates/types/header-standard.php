<?php do_action('suprema_qodef_before_page_header'); ?>

<header class="qodef-page-header">
    <?php if($show_fixed_wrapper) : ?>
        <div class="qodef-fixed-wrapper">
    <?php endif; ?>
    <div class="qodef-menu-area" <?php suprema_qodef_inline_style($menu_area_background_color); ?>>
        <?php if($menu_area_in_grid) : ?>
            <div class="qodef-grid">
        <?php endif; ?>
			<?php do_action( 'suprema_qodef_after_header_menu_area_html_open' )?>
            <div class="qodef-vertical-align-containers">
                <div class="qodef-position-left">
                    <div class="qodef-position-left-inner">
                        <?php if(!$hide_logo) {
                            suprema_qodef_get_logo();
                        } ?>
                    </div>
                </div>
                <div class="qodef-position-right">
                    <div class="qodef-position-right-inner">
                        <?php suprema_qodef_get_main_menu(); ?>
                        <?php if(is_active_sidebar('qodef-right-from-main-menu')) : ?>
                            <?php dynamic_sidebar('qodef-right-from-main-menu'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php if($menu_area_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
    <?php if($show_fixed_wrapper) : ?>
        </div>
    <?php endif; ?>
    <?php if($show_sticky) {
        suprema_qodef_get_sticky_header();
    } ?>
</header>

<?php do_action('suprema_qodef_after_page_header'); ?>

