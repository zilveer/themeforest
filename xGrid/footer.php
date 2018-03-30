    <?php global $bd_data; ?>
    <div class="bd-container">
    <?php
        if( bdayh_get_option('show_footer_ads') == true ){
            if($bd_data['show_footer_ads'] == true){
                if($bd_data['footer_ads_code'] != ''){
                    echo '<div class="clear"></div><div class="footer-adv">' ."\n";
                    echo stripslashes( $bd_data['footer_ads_code'] );
                    echo '</div><!-- .footer-adv/-->' ."\n";
                } else {
                    echo '<div class="clear"></div><div class="footer-adv"><a href="'.$bd_data['footer_ads_img_url'].'" title="'.$bd_data['footer_ads_img_altname'].'"><img src="'.$bd_data['footer_ads_img'].'" alt="'.$bd_data['footer_ads_img_altname'].'" /></a></div><!-- .footer-adv/-->' ."\n";
                }
            }
        }
    ?>
    </div><!-- .ads -->

        <?php
            $footer_widgets = bdayh_get_option( 'footer_widgets' );
            $footer_style   = bdayh_get_option( 'footer_style' );

            if( $footer_style == 'light' ){
                $style = ' footer-light';
            } else {
                $style = '';
            }
        ?>
        <div class="footer-inner<?php echo $style ?>">
            <?php if( $footer_widgets ){ ?>
                <footer class="footer-widgets">
                    <div class="bd-container">
                        <?php
                            if ( !dynamic_sidebar( 'footer-widget' ) ){
                                echo '<span class="nothing">'.bd_wplang( "nothing_yet" ).'</span>';
                            } // Footer Widget ?>
                    </div>
                </footer>
            <?php } ?>

            <div class="footer">
                <div class="bd-container">

                    <?php if( bdayh_get_option( 'footer_social' ) == true ){ ?>
                        <div class="footer-social-links">
                            <?php echo bd_social('yes', '', 'ttip'); ?>
                        </div><!-- footer-social-links -->
                    <?php } ?>

                    <?php if( bdayh_get_option('footer_menu' ) == true ){ ?>
                        <div class="footer-menu">
                            <?php wp_nav_menu(array('theme_location' => 'footer', 'depth' => 1, 'container' => false, 'menu_id' => 'footer-links', 'fallback_cb' => 'nav_fallback' ) ); ?>
                        </div><!-- footer-menu -->
                    <?php } ?>

                    <?php if($bd_data['footer_copyright'] == 1) { echo stripslashes( bd_footer_copy_rigths() ); } ?>
                </div>
            </div>
        </div><!-- .footer-inner -->
    </div><!-- #warp -->

    <?php
        if(array_key_exists('space_body',$bd_data)){ echo stripslashes ( $bd_data['space_body'] ) ."\n"; } echo '<div class="gotop" title="Go Top"><i class="fa fa-chevron-up"></i></div>';
        wp_footer();
    ?>
    </body>
</html>