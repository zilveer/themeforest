<?php if($show_header_top) : ?>

<?php do_action('flow_elated_before_header_top'); ?>

<div class="eltd-top-bar">
    <?php if($top_bar_in_grid) : ?>
    <div class="eltd-grid">
    <?php endif; ?>
		<?php do_action( 'flow_elated_after_header_top_html_open' ); ?>
        <div class="eltd-vertical-align-containers eltd-<?php echo esc_attr($column_widths); ?>">
            <div class="eltd-position-left">
                <div class="eltd-position-left-inner">
                    <?php if(is_active_sidebar('eltd-top-bar-left')) : ?>
                        <?php dynamic_sidebar('eltd-top-bar-left'); ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php if($show_widget_center){ ?>
                <div class="eltd-position-center">
                    <div class="eltd-position-center-inner">
                        <?php if(is_active_sidebar('eltd-top-bar-center')) : ?>
                            <?php dynamic_sidebar('eltd-top-bar-center'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php } ?>
            <div class="eltd-position-right">
                <div class="eltd-position-right-inner">
                    <?php if(is_active_sidebar('eltd-top-bar-right')) : ?>
                        <?php dynamic_sidebar('eltd-top-bar-right'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php if($top_bar_in_grid) : ?>
    </div>
    <?php endif; ?>
</div>

<?php do_action('flow_elated_after_header_top'); ?>

<?php endif; ?>