<?php if(libero_mikado_options()->getOptionValue('portfolio_single_hide_pagination') !== 'yes') : ?>

    <?php
    $back_to_link = get_post_meta(get_the_ID(), 'portfolio_single_back_to_link', true);
    $nav_same_category = libero_mikado_options()->getOptionValue('portfolio_single_nav_same_category') == 'yes';
    ?>

    <div class="mkd-portfolio-single-nav">
        <?php if(get_previous_post() !== '') : ?>
            <div class="mkd-portfolio-prev">
                <?php if($nav_same_category) {
                    previous_post_link('%link', '<span class="fa fa-angle-left"></span>', true, '', 'portfolio_category');
                } else {
                    previous_post_link('%link', '<span class="fa fa-angle-left"></span>');
                } ?>
                <span class="mkd-prev-label"><?php esc_html_e('Previous Project', 'libero'); ?></span>
            </div>
        <?php endif; ?>

        <?php if($back_to_link !== '') : ?>
            <div class="mkd-portfolio-back-btn">
                <a href="<?php echo esc_url(get_permalink($back_to_link)); ?>">
                    <span class="ion-android-apps"></span>
                </a>
            </div>
        <?php endif; ?>

        <?php if(get_next_post() !== '') : ?>
            <div class="mkd-portfolio-next">
                <span class="mkd-prev-label"><?php esc_html_e('Next Project', 'libero'); ?></span>
                <?php if($nav_same_category) {
                    next_post_link('%link', '<span class="fa fa-angle-right"></span>', true, '', 'portfolio_category');
                } else {
                    next_post_link('%link', '<span class="fa fa-angle-right"></span>');
                } ?>
            </div>
        <?php endif; ?>
    </div>

<?php endif; ?>