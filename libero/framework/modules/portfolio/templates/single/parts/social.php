<?php if(libero_mikado_options()->getOptionValue('enable_social_share') == 'yes') : ?>
    <div class="mkd-portfolio-social">
        <?php echo libero_mikado_execute_shortcode('mkd_social_share',
            array(
                'type' => 'dropdown'
            )); ?>
    </div>
<?php endif; ?>