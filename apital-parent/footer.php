<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content.
 */
?>

<!-- START FOOTER -->
<footer class="footer">
    <div class="bottom-footer">
        <div class="w-container">
            <div class="w-row">
                <div class="w-col w-col-6 w-clearfix">
                    <div class="copyright">
                        <div><?php echo defined('FW') ? fw_theme_translate(fw_get_db_settings_option('copyright')) : ''; ?></div>
                    </div>
                </div>
                <div class="w-col w-col-6">
                    <?php if(defined('FW')):?>
                        <?php $socials = fw_get_db_settings_option('footer-socials');?>

                        <?php if(!empty($socials)):?>
                            <div class="top-right-wrapper">
                                <?php foreach($socials as $social):?>
                                    <?php if(!empty($social['icon'])):?>
                                        <a class="w-inline-block social-ico footer-soc" target="_blank" href="<?php echo esc_url($social['url']);?>">
                                            <i class="<?php echo esc_attr($social['icon']);?>"></i>
                                        </a>
                                    <?php endif;?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
    <?php if(defined('FW')):?>
        <?php $footer_widgets = fw_get_db_settings_option('enable-footer-widgets');?>
            <?php if($footer_widgets == 'yes'):?>
                <div class="w-container">
                <div class="w-row">
                    <?php for($i = 1; $i <= 4; $i++): $footer_sidebar = 'footer-'.$i; ?>
                            <?php dynamic_sidebar($footer_sidebar); ?>
                    <?php endfor; ?>
                </div>
            </div>
            <?php endif;?>
    <?php endif;?>
</footer>
<?php wp_footer(); ?>
</body>
</html>