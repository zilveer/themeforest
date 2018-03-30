<?php do_action('hue_mikado_before_page_header'); ?>

<header class="mkd-page-header">
    <?php if($show_fixed_wrapper) : ?>
        <div class="mkd-fixed-wrapper">
    <?php endif; ?>
    <?php do_action('hue_mikado_after_header_area_html_open'); ?>
    <div class="mkd-menu-area">
		<?php do_action( 'hue_mikado_after_header_menu_area_html_open' )?>
        <?php if($menu_area_in_grid) : ?>
            <div class="mkd-grid">
        <?php endif; ?>
        <div class="mkd-vertical-align-containers">
            <div class="mkd-position-left">
                <div class="mkd-position-left-inner">
                    <?php hue_mikado_get_divided_left_main_menu(); ?>
                </div>
            </div>
            <div class="mkd-position-center">
                <div class="mkd-position-center-inner">
                    <?php if(!$hide_logo) {
                        hue_mikado_get_logo('divided');
                    } ?>
                </div>
            </div>
            <div class="mkd-position-right">
                <div class="mkd-position-right-inner">
                    <?php hue_mikado_get_divided_right_main_menu(); ?>
                </div>
            </div>
        </div>
        <?php if($menu_area_in_grid) : ?>
            </div>
        <?php endif; ?>
    </div>
    <?php if($show_fixed_wrapper) { ?>
        <?php do_action('hue_mikado_end_of_page_header_html'); ?>
        </div>
    <?php } else {
        do_action('hue_mikado_end_of_page_header_html');
    } ?>
    <?php if($show_sticky) {
        hue_mikado_get_sticky_header('divided');
    } ?>
</header>

<?php do_action('hue_mikado_after_page_header'); ?>