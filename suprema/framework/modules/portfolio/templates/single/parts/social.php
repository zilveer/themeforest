<?php if(suprema_qodef_options()->getOptionValue('enable_social_share') == 'yes'
    && suprema_qodef_options()->getOptionValue('enable_social_share_on_portfolio-item') == 'yes') : ?>
    <div class="qodef-portfolio-social">
        <h6><?php echo esc_html_e('Share:', 'suprema')?></h6>
        <?php echo suprema_qodef_get_social_share_html() ?>
    </div>
<?php endif; ?>