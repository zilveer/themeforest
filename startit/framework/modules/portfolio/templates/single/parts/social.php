<?php if(qode_startit_options()->getOptionValue('enable_social_share') == 'yes' && qode_startit_options()->getOptionValue('enable_social_share_on_portfolio-item') == 'yes') : ?>
    <div class="qodef-portfolio-social">
        <span class="qodef-share"><?php esc_html_e('Share', 'startit'); ?></span><?php echo qode_startit_get_social_share_html() ?>
    </div>
<?php endif; ?>