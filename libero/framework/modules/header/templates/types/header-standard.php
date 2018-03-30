<?php do_action('libero_mikado_before_page_header'); ?>

<header class="mkd-page-header">
    <div class="mkd-logo-area" <?php libero_mikado_inline_style($top_menu_area_background_color); ?>>
        <?php if($top_menu_area_in_grid) : ?>
        <div class="mkd-grid">
        <?php endif; ?>
        <div class="mkd-vertical-align-containers mkd-25-75">
            <div class="mkd-position-left">
                <div class="mkd-position-left-inner">
                    <?php if(!$hide_logo) {
                        libero_mikado_get_logo();
                    } ?>
                </div>
            </div>

            <div class="mkd-position-right">
                <div class="mkd-position-right-inner">
                    <?php if(is_active_sidebar('mkd-right-from-logo')) : ?>
                        <?php dynamic_sidebar('mkd-right-from-logo'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if($top_menu_area_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="mkd-menu-area" <?php libero_mikado_inline_style($bottom_menu_area_background_color); ?>>
        <?php if($menu_area_in_grid) : ?>
        <div class="mkd-grid">
        <?php endif; ?>
        <?php do_action( 'libero_mikado_after_header_menu_area_html_open' )?>
        <div class="mkd-vertical-align-containers">
            <div class="mkd-position-left">
                <div class="mkd-position-left-inner">
                    <?php libero_mikado_get_main_menu(); ?>
                </div>
            </div>
            <div class="mkd-position-right">
                <div class="mkd-position-right-inner">
                    <?php if(is_active_sidebar('mkd-right-from-main-menu')) : ?>
                        <?php dynamic_sidebar('mkd-right-from-main-menu'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if($menu_area_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>


    <?php if($show_sticky) {
        libero_mikado_get_sticky_header();
    } ?>
</header>

<?php do_action('libero_mikado_after_page_header'); ?>

