<?php if($show_header_top) : ?>

<?php do_action('suprema_qodef_before_header_top'); ?>

<div class="qodef-top-bar">
    <?php if($top_bar_in_grid) : ?>
    <div class="qodef-grid">
    <?php endif; ?>
		<?php do_action( 'suprema_qodef_after_header_top_html_open' ); ?>
        <div class="qodef-vertical-align-containers qodef-<?php echo esc_attr($column_widths); ?>">
            <div class="qodef-position-left">
                <div class="qodef-position-left-inner">
                    <?php if(is_active_sidebar('qodef-top-bar-left')) : ?>
                        <?php dynamic_sidebar('qodef-top-bar-left'); ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php if($show_widget_center){ ?>
                <div class="qodef-position-center">
                    <div class="qodef-position-center-inner">
                        <?php if(is_active_sidebar('qodef-top-bar-center')) : ?>
                            <?php dynamic_sidebar('qodef-top-bar-center'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php } ?>
            <div class="qodef-position-right">
                <div class="qodef-position-right-inner">
                    <?php if(is_active_sidebar('qodef-top-bar-right')) : ?>
                        <?php dynamic_sidebar('qodef-top-bar-right'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php if($top_bar_in_grid) : ?>
    </div>
    <?php endif; ?>
</div>

<?php do_action('suprema_qodef_after_header_top'); ?>

<?php endif; ?>