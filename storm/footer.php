<?php
/**
 * The Footer for the theme.
 *
 */
?>
            </div>
    		<!-- MAIN BODY CLOSE -->
    		
    		<!-- FOOTER OPEN -->
            <?php global $bk_option;
                if (isset($bk_option)):
                    $cr_text = $bk_option['cr-text'];
                    $custom_js = $bk_option['bk-js-code'];
                endif;?>
    		<div class="footer">
                
                <?php if (is_active_sidebar('footer_sidebar_1') 
                        || is_active_sidebar('footer_sidebar_2')
                        || is_active_sidebar('footer_sidebar_3')) { ?>
                <div class="footer-content clear-fix">
                    <div class="footer-sidebar">
                        <?php dynamic_sidebar( 'footer_sidebar_1' ); ?>
                    </div>
                    <div class="footer-sidebar">
                        <?php dynamic_sidebar( 'footer_sidebar_2' ); ?>
                    </div>
                    <div class="footer-sidebar">
                        <?php dynamic_sidebar( 'footer_sidebar_3' ); ?>
                    </div>
                </div>
                <?php } ?>
                <div class="footer-lower">
                    <div class="footer-inner">
                        <div class="bk-copyright"><?php echo $cr_text;?></div>
                    </div>
                </div>
    		
    		</div>
    		<!-- FOOTER close -->
            
        </div>
        <!-- page-wrap close -->
        
      </div>
      <!-- site-container close-->
    <?php 
        global $bk_loadbutton_string; 
        global $bk_flex_el;
        global $bk_slider_config;
        global $fixed_nav;
        global $bk_megamenu_carousel_el;
        global $bk_ticker;
        if ( is_active_widget('','','bk_masonry')) {
            wp_localize_script( 'masonry-load-post-js', 'loadbuttonstring', $bk_loadbutton_string );
        }
        if ( is_active_widget('','','bk_classic_blog')) {
            wp_localize_script( 'classic-blog-load-post', 'loadbuttonstring', $bk_loadbutton_string );
        }
        if (isset($bk_option)):
            $fixed_nav = $bk_option['bk-fixed-nav-switch'];            
        endif;
        wp_localize_script( 'customjs', 'fixed_nav', $fixed_nav );
        wp_localize_script( 'customjs', 'bk_flex_el', $bk_flex_el );
        wp_localize_script( 'customjs', 'mconfig', $bk_slider_config );  
        wp_localize_script( 'customjs', 'megamenu_carousel_el', $bk_megamenu_carousel_el );
        wp_localize_script( 'customjs', 'ticker', $bk_ticker );
    ?>
    
    <?php 
        if ($custom_js != '') {
            echo ("<script type='text/javascript'>");
            echo $custom_js;
            echo ("</script>");
        }
    ?>
    <?php wp_footer(); ?> 
</body>
</html>