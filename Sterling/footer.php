</section><!-- END content-container -->
<?php
    // Retrieve values from Site Options Panel.
    global $ttso;

    $truethemes_scrolltoplink                  = $ttso->st_scrolltoplink;
    $truethemes_footer_columns                 = $ttso->st_footer_columns;
    $truethemes_footer_callout                 = $ttso->st_footer_callout;
    $truethemes_footer_callout_text            = stripslashes( $ttso->st_footer_callout_text );
    $truethemes_footer_callout_button          = stripslashes( $ttso->st_footer_callout_button );
    $truethemes_footer_callout_button_url      = $ttso->st_footer_callout_button_url;
	$truethemes_footer_callout_button_target   = $ttso->st_footer_callout_button_target;
	$truethemes_footer_callout_button_color    = $ttso->st_footer_callout_button_color;
	$truethemes_footer_callout_button_size     = $ttso->st_footer_callout_button_size;
    $truethemes_copyright                      = stripslashes( $ttso->st_footer_copyright );
    $blog_pinterest                            = $ttso->st_blog_pinterest;
    $truethemes_jslide_effect                  = $ttso->st_jslide_effect;
    $truethemes_jslide_speed                   = $ttso->st_jslide_speed;
    $truethemes_jslide_delay                   = $ttso->st_jslide_delay;
    $truethemes_jslide_randomize               = $ttso->st_jslide_randomize;
    $truethemes_jslide_pause_hover             = $ttso->st_jslide_pause_hover;
    $truethemes_jslide_nav_arrows              = $ttso->st_jslide_navarrows;
    $boxedlayout                               = $ttso->st_boxedlayout;
?>

<?php if ( 'true' == $truethemes_footer_callout ) { ?>
    <div class="footer-callout clearfix">
        <div class="center-wrap tt-relative">
            <div class="footer-callout-content">
                 <?php echo html_entity_decode( $truethemes_footer_callout_text, ENT_QUOTES ); ?>
            </div><!-- end .footer-callout-content -->
            <div class="footer-callout-button">
            
            <?php if('' == $truethemes_footer_callout_button_target) {'true' == $truethemes_footer_callout_button_target;} ?>
            
                <a href="<?php echo esc_url( $truethemes_footer_callout_button_url ); ?>" class="<?php if('' != $truethemes_footer_callout_button_size) {echo $truethemes_footer_callout_button_size; }else{echo 'large';} ?> <?php if('' != $truethemes_footer_callout_button_color) {echo $truethemes_footer_callout_button_color; }else{echo 'green';} ?> tt-button" <?php if('false' == $truethemes_footer_callout_button_target){echo 'target="_blank"';}?>><?php echo esc_attr( $truethemes_footer_callout_button ); ?></a>
            </div><!-- end .footer-callout-button -->
        </div><!-- end .center-wrap -->
    </div><!-- end .footer-callout -->
<?php } //end footer callout ?>

<footer>
    <div class="center-wrap tt-relative">
        <div class="footer-content clearfix">
            <?php add_filter( 'pre_get_posts', 'wploop_exclude' );

            if ( is_page_template( 'page-template-under-construction.php' ) ) { ?>
                <div class="construction-default-one">
                    <?php dynamic_sidebar( 'First Under Construction Column' ); ?>
                </div><!-- end .construction-default-one -->

                <div class="construction-default-two">
                    <?php dynamic_sidebar( 'Second Under Construction Column' ); ?>
                </div><!-- end .construction-default-two -->

                <div class="construction-default-three">
                    <?php dynamic_sidebar( 'Third Under Construction Column' ); ?>
                </div><!-- end .construction-default-three -->
            <?php } else if ('Default-Layout' == $truethemes_footer_columns ) { ?>
                <div class="footer-default-one">
                    <?php dynamic_sidebar( 'First Footer Column' ); ?>
                </div><!-- end .footer-default-one -->

                <div class="footer-default-two">
                    <?php dynamic_sidebar( 'Second Footer Column' ); ?>
                </div><!-- end .footer-default-two -->

                <div class="footer-default-three">
                    <?php dynamic_sidebar( 'Third Footer Column' ); ?>
                </div><!-- end .footer-default-three -->
            <?php } else {
                $footer_columns  = range( 1, $truethemes_footer_columns );
                $footer_count    = 1;
                $sidebar         = 7;

                foreach ( $footer_columns as $footer => $column ) {
                    switch ( $truethemes_footer_columns ) {
                        case 1 :
                            $class = '';
                            break;
                        case 2 :
                            $class = 'one_half';
                            break;
                        case 3 :
                            $class = 'one_third';
                            break;
                        case 4 :
                            $class = 'one_fourth';
                            break;
                        case 5 :
                            $class = 'one_fifth';
                            break;
                        case 6 :
                            $class = 'one_sixth';
                            break;
                    }
                    ?>
                    <div class="<?php echo $class; ?>">
                        <?php dynamic_sidebar( $sidebar ); ?>
                    </div>
                    <?php $footer_count++; $sidebar++;
                }
            } ?>
        </div><!-- end .footer-content -->
    </div><!-- end .center-wrap -->

<?php if ( ! is_page_template( 'page-template-under-construction.php' ) ) { ?>
    <div class="footer-copyright clearfix">
        <div class="center-wrap clearfix">
    	    <div class="foot-copy">
    	        <p><?php echo html_entity_decode( $truethemes_copyright); ?></p>
    	    </div><!-- end .foot-copy -->

    	    <?php if ( 'true' == $truethemes_scrolltoplink ) { ?>
                <a href="#0" class="sterling-scroll-top"><i class="fa fa-chevron-up"></i></a>
            <?php } ?>

            <?php if ( has_nav_menu( 'Footer Menu' ) ) { ?>
                <ul class="footer-nav">
                    <?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'Footer Menu', 'depth' => 0 ) ); ?>
                </ul>
            <?php } ?>
        </div><!-- end .center-wrap -->
    </div><!-- end .footer-copyright -->
<?php } ?>

    <div class="shadow top"></div>
    <div class="tt-overlay"></div>
</footer>

<?php if ( 'true' == $boxedlayout ) {echo '</div><!-- end .tt-boxed-layout -->';}else{echo '</div><!-- end .tt-wide-layout -->';} ?>

<?php wp_footer(); ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            // Homepage slider setup. Issued in the footer to accept user-set variables.
            $('#slides').slides({
                preload: false,
                //preloadImage: 'http://files.truethemes.net/themes/sterling-wp/ajax-loader.gif',
                autoHeight: true,
                effect: '<?php echo $truethemes_jslide_effect; ?>',
                slideSpeed: <?php echo $truethemes_jslide_speed; ?>,
                play: <?php echo $truethemes_jslide_delay; ?>,
                randomize: <?php echo $truethemes_jslide_randomize; ?>,
                hoverPause: <?php echo $truethemes_jslide_pause_hover; ?>,
                pause: <?php echo $truethemes_jslide_delay; ?>,
                generateNextPrev: <?php echo $truethemes_jslide_nav_arrows; ?>
            });

            // Allows for custom nav buttons to remain outside of #slides container.
            $('.banner-slider .next').click(function(){
                $('#slides .next').click();
            });
            $('.banner-slider .prev').click(function(){
                $('#slides .prev').click();
            });
        });
    </script>

<?php if ( ( is_home() || is_single() || is_archive() ) && 'true' == $blog_pinterest ) { ?>
    <script type="text/javascript">
        (function(){
            window.PinIt = window.PinIt || { loaded : false };
            if ( window.PinIt.loaded ) return;
            window.PinIt.loaded = true;
            function async_load(){
                var s     = document.createElement('script');
                s.type    = 'text/javascript';
                s.async   = true;
                s.src     = 'http://assets.pinterest.com/js/pinit.js';
                var x     = document.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
            }
            if (window.attachEvent)
                window.attachEvent('onload', async_load);
            else
                window.addEventListener('load', async_load, false);
        })();
    </script>
<?php } ?>
<!--[if !IE]><!--><script>
if (/*@cc_on!@*/false) {
    document.documentElement.className+=' ie10';
}
</script><!--<![endif]-->
</body>
</html>