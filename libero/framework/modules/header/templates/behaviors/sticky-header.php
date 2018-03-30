<?php do_action('libero_mikado_before_sticky_header'); ?>

<div class="mkd-sticky-header">
    <?php do_action( 'libero_mikado_after_sticky_menu_html_open' ); ?>
    <div class="mkd-sticky-holder" <?php  libero_mikado_inline_style($sticky_background_color_rgba);?>>
    <?php if($sticky_header_in_grid) : ?>
        <div class="mkd-grid">
            <?php endif; ?>
            <div class=" mkd-vertical-align-containers">
                <div class="mkd-position-left">
                    <div class="mkd-position-left-inner">
                        <?php if(!$hide_logo) {
                            libero_mikado_get_logo('sticky');
                        } ?>
                        <?php libero_mikado_get_sticky_menu('mkd-sticky-nav'); ?>
                    </div>
                </div>
                <div class="mkd-position-right">
                    <div class="mkd-position-right-inner">
                        <?php if(is_active_sidebar('mkd-sticky-right')) : ?>
                            <?php dynamic_sidebar('mkd-sticky-right'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if($sticky_header_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php do_action('libero_mikado_after_sticky_header'); ?>