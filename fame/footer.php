<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $apollo13; ?>
		</div><!-- #mid -->
        <footer id="footer">
        <?php
            $columns = 0;
            for($i=1; $i <= 5; $i++){
                if( is_active_sidebar('footer-widget-area-'.$i )){
                    $columns++;
                }
            }
            //is there any widgets
//            if(0&& $columns > 0 ){
            if( $columns > 0 ){
                //class for widgets
                $_class = '';
                    if($columns === 1) $_class = ' one-col';
                elseif($columns === 2) $_class = ' two-col';
                elseif($columns === 3) $_class = ' three-col';
                elseif($columns === 4) $_class = ' four-col';
                elseif($columns === 5) $_class = ' five-col';

                echo '<div class="foot-widgets'.$_class.'">
                        <div class="foot-content clearfix">';

                for($i=1,$j=0; $i <= 5; $i++){
                    if( is_active_sidebar('footer-widget-area-'.$i )){
                        $j++;
                        echo '<div class="col col-'.$j.'">';
                        dynamic_sidebar( 'footer-widget-area-'.$i );
                        echo '</div>';
                    }
                }

                echo '</div>
                    </div>';
            }

//            if(0&& is_active_sidebar('footer-widget-area-twitter')){
            if(is_active_sidebar('footer-widget-area-twitter')){
                echo '<div class="foot-twitter"><div class="foot-content">';
                dynamic_sidebar( 'footer-widget-area-twitter' );
                echo '</div></div>';
            }

            $footer_lower_classes = ' bg-'.$apollo13->get_option( 'appearance', 'footer_lower_bg_fit' );
            ?>

            <div class="foot-items<?php echo $footer_lower_classes; ?>">
                <div class="foot-content">

                    <?php
                    //footer images
                    $fi_1 = $apollo13->get_option( 'appearance', 'footer_image_1' );
                    $fi_2 = $apollo13->get_option( 'appearance', 'footer_image_2' );
                    $fi_3 = $apollo13->get_option( 'appearance', 'footer_image_3' );
                    $img_html = '';
                    $any_img = false;
                    for($i = 1; $i < 4; $i++){
                        $temp = ${'fi_'.$i};

                        if(!empty($temp)){
                            $img_html .= '<div class="fi_'.$i.'"><img src="'.esc_url($temp).'" alt="" /></div>';
                            $any_img = true;
                        }
                    }

                    if($any_img){
                        echo '<div class="f-images clearfix">'.$img_html.'</div>';
                    }

                    echo '<div class="f-texts clearfix">';
                    //footer text
                    $ft = $apollo13->get_option( 'appearance', 'footer_text' )   ;
                    if(!empty($ft)){
                        echo '<div class="foot-text">'.nl2br($ft).'</div>';
                    }

                    //footer menu
                    echo '<div class="f-links">';
                    if ( has_nav_menu( 'footer-menu' ) ){
                        //place for 1-4 links
                        wp_nav_menu( array(
                            'container'       => false,
                            'link_before'     => '',
                            'link_after'      => '',
                            'depth'           => -1,
                            'menu_class'      => 'footer-menu',
                            'theme_location'  => 'footer-menu' )
                        );
                    }
                    echo $apollo13->get_option( 'appearance', 'footer_socials' ) === 'on'? a13_social_icons($apollo13->get_option( 'appearance', 'footer_socials_color' )) : '';
                    echo '</div>';

                    echo '</div>';
                    ?>
                </div>
                <a href="#top" id="to-top" class="to-top fa fa-chevron-up"></a>
            </div>
        </footer>
<?php
    a13_demo_switcher();
        /* Always have wp_footer() just before the closing </body>
         * tag of your theme, or you will break many plugins, which
         * generally use this hook to reference JavaScript files.
         */

        wp_footer();
?>

</body>
</html>