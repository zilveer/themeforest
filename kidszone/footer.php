		<?php global $dt_allowed_html_tags; ?>
        <footer id="footer">
            <?php if(dt_theme_option('general', 'show-footer')): ?>
                <div class="footer-widgets">
                    <div class="container"><?php dt_theme_show_footer_widgetarea(dt_theme_option('general','footer-columns')); ?></div>
                </div>                
            <?php endif; ?>
    
            <div class="footer-info">
                <div class="container">
                    <?php if(dt_theme_option('general','show-copyrighttext') == "on"): ?>
                        <p class="copyright"><?php echo wp_kses(stripslashes(dt_theme_option('general','copyright-text')), $dt_allowed_html_tags); ?></p>
                    <?php endif; ?>    
                    <?php wp_nav_menu( array('theme_location' => 'secondary-menu', 'container'  => false, 'menu_id' => 'footer-menu', 'menu_class' => 'footer-links', 'fallback_cb' => 'dt_theme_footer_navigation')); ?>
                </div>
            </div>
        </footer>
    </div>
</div>
<?php do_action('load_footer_styles_scripts'); ?>
<?php if(dt_theme_option('integration', 'enable-body-code') != '') echo '<script type="text/javascript">'.wp_kses(stripslashes(dt_theme_option('integration', 'body-code')), $dt_allowed_html_tags).'</script>';
wp_footer(); ?>
</body>
</html>