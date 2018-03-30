<?php if(suprema_qodef_options()->getOptionValue('portfolio_single_hide_pagination') !== 'yes') : ?>

    <?php
    $back_to_link = get_post_meta(get_the_ID(), 'portfolio_single_back_to_link', true);
    $nav_same_category = suprema_qodef_options()->getOptionValue('portfolio_single_nav_same_category') == 'yes';
    ?>

    <div class="qodef-portfolio-single-nav">
        <?php if(get_previous_post() !== '') : ?>
            <div class="qodef-portfolio-prev">
                <?php if($nav_same_category) {
                    previous_post_link('%link', '<span class="fa fa-angle-left"></span>', true, '', 'portfolio_category');
                } else {
                    previous_post_link('%link', '<span class="fa fa-angle-left"></span>');
                } ?>
            </div>
        <?php endif; ?>

        <?php if($back_to_link !== '') : ?>
            <div class="qodef-portfolio-back-btn">
                <a href="<?php echo esc_url(get_permalink($back_to_link)); ?>">
                    <span class="fa fa-th"></span>
                </a>
            </div>
        <?php endif; ?>

        <?php if(get_next_post() !== '') : ?>
            <div class="qodef-portfolio-next">
                <?php if($nav_same_category) {
                    next_post_link('%link', '<span class="fa fa-angle-right"></span>', true, '', 'portfolio_category');
                } else {
                    next_post_link('%link', '<span class="fa fa-angle-right"></span>');
                } ?>
            </div>
        <?php endif; ?>
    </div>

<?php endif; ?>