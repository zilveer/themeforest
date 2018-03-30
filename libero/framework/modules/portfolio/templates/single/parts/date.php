<?php if(libero_mikado_options()->getOptionValue('portfolio_single_hide_date') !== 'yes') : ?>

    <div class="mkd-portfolio-info-item mkd-portfolio-date">
        <h6 class="mkd-info-title"><?php esc_html_e('Date:', 'libero'); ?></h6>

        <p><?php the_time(get_option('date_format')); ?></p>
    </div>

<?php endif; ?>