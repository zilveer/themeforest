<?php
use \Handyman\Front as F;

$created_by               = layers_get_theme_mod('footer-copyright-text2');
$footer_copyright_text    = layers_get_theme_mod('footer-copyright-text');
$footer_show_social_icons = !layers_get_theme_mod('footer-hide-social-icons');

if($footer_show_social_icons){
    $social_fb = layers_get_theme_mod('social-fb');
    $social_tw = layers_get_theme_mod('social-tw');
    $social_yt = layers_get_theme_mod('social-yt');

    $pinterest = layers_get_theme_mod("social-pinterest");
    $glplus    = layers_get_theme_mod("social-glplus");
    $linkin    = layers_get_theme_mod("social-linkin");
    $instagram = layers_get_theme_mod("social-instagram");
    $tumblr    = layers_get_theme_mod("social-tumblr");
    $flickr    = layers_get_theme_mod("social-flickr");
    $reddit    = layers_get_theme_mod("social-reddit");
}



$tl_is_popup = \Handyman\Core\Assets::$is_popup;
?>
        <?php if(!$tl_is_popup): ?>
			<div id="back-to-top">
				<a href="#top" title="<?php _e( 'Back to top' , 'layerswp' ); ?>">
                    <i class="icon-ti-arrow-up"></i>
                </a>
			</div> <!-- back-to-top -->
        <?php endif; ?>
		</section>

        <?php if(!$tl_is_popup): ?>
            <?php do_action( 'layers_before_footer' ); ?>

            <footer id="footer" <?php layers_wrapper_class( 'footer_site', 'footer-site' ); ?>>
                <?php do_action( 'layers_before_footer_inner' ); ?>
                <div class="<?php if( 'layout-fullwidth' != F\tl_copt( 'footer-width' ) ) echo 'container'; ?> invert clearfix">
                    <?php // Do logic related to the footer widget area count
                    $footer_sidebar_count = (int) F\tl_copt( 'footer-sidebar-count' ); ?>

                    <?php if( 0 != $footer_sidebar_count ) { ?>
                        <?php do_action( 'layers_before_footer_sidebar' ); ?>
                        <div class="grid">
                            <?php // Default Sidebar count to 4
                            if( '' == $footer_sidebar_count ) $footer_sidebar_count = 4;

                            // Get the sidebar class
                            $footer_sidebar_class = floor( 12/$footer_sidebar_count ); ?>
                            <?php for( $footer = 1; $footer <= $footer_sidebar_count; $footer++ ) { ?>
                                <div class="sidebar column span-<?php echo esc_attr( $footer_sidebar_class ); ?> <?php if( $footer == $footer_sidebar_count ) echo 'last'; ?>">
                                    <?php dynamic_sidebar( LAYERS_THEME_SLUG . '-footer-' . $footer ); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <?php do_action( 'layers_after_footer_sidebar' ); ?>
                    <?php } // if 0 != sidebars ?>

                    <?php do_action( 'layers_before_footer_copyright' ); ?>
                    <div class="grid copyright">

                        <?php if( '' != layers_get_theme_mod( 'footer-copyright-text' ) ) {  ?>
                            <div class="column span-4">
                                <p class="site-text"><?php echo esc_html( F\tl_copt( 'footer-copyright-text' ) ); ?></p>
                            </div>
                        <?php } ?>

                        <div class="column span-4 text-center">
                            <?php if($footer_show_social_icons): ?>
                                <?php if($social_fb): ?>
                                <a target="_blank" title="Facebook" href="<?php echo esc_url($social_fb); ?>" class="hvr-float social-icon"><i class="icon-ti-facebook"></i></a>
                                <?php endif; ?>
                                <?php if($social_tw): ?>
                                <a target="_blank" title="Twitter" href="<?php echo esc_url($social_tw); ?>" class="hvr-float social-icon"><i class="icon-ti-twitter-alt"></i></a>
                                <?php endif; ?>
                                <?php if($social_yt): ?>
                                <a target="_blank" title="Youtube" href="<?php echo esc_url($social_yt); ?>" class="hvr-float social-icon"><i class="icon-ti-youtube"></i></a>
                                <?php endif; ?>

                                <?php if($pinterest) : ?>
                                    <a target="_blank" href="<?php echo esc_url($pinterest); ?>" title="Pinterest" class="hvr-float social-icon"><i class="icon-ti-pinterest-alt"></i></a>
                                <?php endif;?>
                                <?php if($glplus) : ?>
                                    <a target="_blank" href="<?php echo esc_url($glplus); ?>" title="Google Plus" class="hvr-float social-icon"><i class="icon-ti-google"></i></a>
                                <?php endif;?>
                                <?php if($linkin) : ?>
                                    <a target="_blank" href="<?php echo esc_url($linkin); ?>" title="LinkedIn" class="hvr-float social-icon"><i class="icon-ti-linkedin"></i></a>
                                <?php endif;?>
                                <?php if($instagram) : ?>
                                    <a target="_blank" href="<?php echo esc_url($instagram); ?>" title="Instagram" class="hvr-float social-icon"><i class="icon-ti-instagram"></i></a>
                                <?php endif;?>
                                <?php if($tumblr) : ?>
                                    <a target="_blank" href="<?php echo esc_url($tumblr); ?>" title="Tumblr" class="hvr-float social-icon"><i class="icon-ti-tumblr-alt"></i></a>
                                <?php endif;?>
                                <?php if($flickr) : ?>
                                    <a target="_blank" href="<?php echo esc_url($flickr); ?>" title="Flickr" class="hvr-float social-icon"><i class="icon-ti-flickr-alt"></i></a>
                                <?php endif;?>
                                <?php if($reddit) : ?>
                                    <a target="_blank" href="<?php echo esc_url($reddit); ?>" title="Reddit" class="hvr-float social-icon"><i class="icon-ti-reddit"></i></a>
                                <?php endif;?>
                            <?php else: ?>
                                &nbsp;
                            <?php endif; ?>
                        </div>

                        <div class="column span-4 clearfix text-right">
                            <?php if($created_by) : ?>
                                <p class="site-text copyright-2">
                                    <?php echo html_entity_decode($created_by); ?>
                                </p>
                            <?php endif;?>
                        </div>

                        <div class="footer-arrow">
                            <span>
                                <a href="#top" title="<?php _e("Back to top", TL_DOMAIN)?>">
                                    <i class="l-top-arrow"></i>
                                </a>
                            </span>
                        </div>
                    </div>
                    <?php do_action( 'layers_after_footer_copyright' ); ?>
                </div>
                <?php do_action( 'layers_after_footer_inner' ); ?>

                <?php if( false != F\tl_copt( 'show-layers-badge' ) ) { ?>
                    <?php _e( sprintf( '<a class="created-using-layers" target="_blank" tooltip="Built with Layers" href="%s"><span>Built with Layers</span></a>', 'http://www.layerswp.com' ) , 'layerswp' ); ?>
                <?php } ?>
            </footer><!-- END / FOOTER -->
            <?php do_action( 'layers_after_footer' ); ?>
        <?php endif; ?>


	</div><!-- END / MAIN SITE #wrapper -->
	<?php do_action( 'layers_after_site_wrapper' ); ?>
	<?php wp_footer(); ?>
</body>
</html>