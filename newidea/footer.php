<?php
/**
 * The Footer for our theme.
 *
 * Displays all of the <footer> section
 *
 * @package WordPress
 * @subpackage newidea
 * @since newidea 4.0
 */
global $pages_rel;
?>
<footer>
	<span></span>
	<div class="container">
        <!-- Menu -->
        <?php if(intval(newidea_get_options_key('menu-position')) != 0) : ?>
            <?php echo newidea_get_menus_nav($pages_rel); ?>
        <?php endif; ?>
        <!-- Social -->
        <?php if(newidea_get_options_key('social-enable') == "on" && intval(newidea_get_options_key('social-position')) == 1) : ?>
             <?php echo newidea_get_social(); ?>
        <?php endif; ?>
        <!-- Logo -->
        <?php if(intval(newidea_get_options_key('logo-image-position')) != 0) : ?>
             <div id="logo">
                <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"></a>
            </div><!-- end logo -->
        <?php endif; ?>
        <!-- Copyright Information -->
        <div class="site-info"><?php echo newidea_get_options_key('footer-copyright-text'); ?></div>
    </div>
</footer>
<div id="loading-bg"></div>
<div id="loading"></div>
<?php wp_footer() ?>
</body>
</html>