<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby; ?>
<section id="footer">

    <div class="row">
        <div class="four columns">
            <?php dynamic_sidebar('sidebar-footer-col1');?>
			
			<div class="soc-icons">

                <?php crum_social_networks(false); ?>

            </div>
        </div>
        <div class="four columns">
            <?php dynamic_sidebar('sidebar-footer-col2');?>
        </div>
        <div class="four columns">

            <?php dynamic_sidebar('sidebar-footer-col3');?>
        </div>
    </div>

</section>

<section id="sub-footer">
    <div class="row">
        <div class="six mobile-two columns copyr">
            <?php if (isset($dfd_ronneby['logo_footer']['url']) && $dfd_ronneby['logo_footer']['url']): ?>
				<img src="<?php echo esc_url($dfd_ronneby['logo_footer']['url']); ?>" alt="logo" class="foot-logo" />
			<?php endif; ?>

            <?php 
			if(isset($dfd_ronneby['copyright_footer'])) {
				echo $dfd_ronneby['copyright_footer'];
			}
			?>

        </div>
        <div class="six mobile-two columns">

            <?php wp_nav_menu(array('theme_location' => 'footer_menu', 'container' => 'nav', 'fallback_cb' => 'false', 'menu_class' => 'footer-menu', 'walker' => new crum_clean_walker())); ?>

        </div>
    </div>
</section>

<?php
if(isset($dfd_ronneby['custom_js'])) {
	echo $dfd_ronneby['custom_js'];
}

if( ($_SERVER['SERVER_NAME'] ==  "theme.crumina.net")){
	require_once locate_template('inc/custom_style/custom_style.php'); //Custom style Panel
}

wp_footer();?>
</body>
</html>