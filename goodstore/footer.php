
</div><!-- End Main row -->
<?php
$has_featured = '';
if ((jwOpt::get_option('footer_featured_show', 'off') == 'homepage' && is_front_page()) || (jwOpt::get_option('footer_featured_show', 'off') == 'allweb')) {
    ?>
    <div class="row-fullwidth">
        <div class="fullwidth-block row featured-footer-content">
            <?php
            echo jaw_get_template_part('footer-featured-area', 'footer');
            $has_featured = 'with_featured';
            ?>
        </div></div>	
<?php } ?>
<footer id="footer" class="<?php echo $has_featured; ?>" role="contentinfo">

    <div class="row-fullwidth">
        <div class="fullwidth-block row footer-content">
            <?php
            if (jwOpt::get_option('footer_style', 'footer-12') == 'footer-12') {
                echo jaw_get_template_part('footer-12', 'footer');
            } else if (jwOpt::get_option('footer_style', 'footer-3-3-3-3') == 'footer-6-6') {
                echo jaw_get_template_part('footer-6-6', 'footer');
            } else if (jwOpt::get_option('footer_style', 'footer-3-3-3-3') == 'footer-3-3-3-3') {
                echo jaw_get_template_part('footer-3-3-3-3', 'footer');
            } else if (jwOpt::get_option('footer_style', 'footer-4-4-4') == 'footer-4-4-4') {
                echo jaw_get_template_part('footer-4-4-4', 'footer');
            } else {
                echo jaw_get_template_part('footer-4-8', 'footer');
            }
            ?>            
        </div>

        <?php if (jwOpt::get_option('show_copyright', 'on') == 'on') { ?>
            <div id="copyright" class="fullwidth-block row footer-content">            
                <div class="col-lg-6">
                    <?php echo jwOpt::get_option('footer_text', ''); ?>
                </div>
                <div class="col-lg-6 copyright-menu">
                    <?php wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_class' => 'template-footer-menu')); ?>
                </div>
            </div>
        <?php } ?>

    </div>



</footer>



</div><!-- End the template box -->

</div><!-- Container End -->

<?php echo jwStyle::generate_background_banner_link(); ?>

<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
     chromium.org/developers/how-tos/chrome-frame-getting-started -->
<!--[if lt IE 7]>
        <script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
        <script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->
<?php if (jwOpt::is(jwOpt::get_option('google_analytics')) || jwOpt::is(jwOpt::get_option('custom_js'))) { ?>
    <script type="text/javascript">
    <?php echo jwOpt::get_option('custom_js'); ?>
    </script>
    <?php echo jwOpt::get_option('google_analytics'); ?>
<?php } ?>

<script type="text/javascript" charset="utf-8">
    var site_url = "<?php echo get_site_url(); ?>";
    var rtl = "<?php echo jwOpt::get_option('site_rtl', '0'); ?>";
<?php if (jwOpt::get_option('totop_show_mobile', '0') == '1') { ?>
        var wWidth = 10000;
<?php } else { ?>
        var wWidth = jQuery(window).width();
<?php } ?>

    jQuery(document).ready(function() {
        //  open pinterrest in new tab
        jQuery(".social_button").find('a').attr('target', '_blank');
        //COOKIES for modal   
<?php if (is_front_page() && jwOpt::get_option('woo_modal', '0') == '1') { ?>
            var cookie_add = '';
            <?php if( jwOpt::get_option('woo_modal_page_id', '0') != ''){ ?>
            var cookie_modal = jQuery.cookie("jaw_modal") + cookie_add;
                if (cookie_modal != <?php echo jwOpt::get_option('woo_modal_page_id', '0') ?>) {
                    jQuery.cookie("jaw_modal", <?php echo jwOpt::get_option('woo_modal_page_id', '0') ?>, {expires: 7});
                    setTimeout(function() {
                        jQuery('#jaw_modal').modal('show');
                    }, 500);
                }
            <?php } ?>
<?php } ?>

    });
    
    <?php if (jwOpt::get_option('fbcomments_appid', '') != '') { ?>
    /*facebook share (min)*/
    !function(a, b, c) {
        var d, e = a.getElementsByTagName(b)[0];
        a.getElementById(c) || (d = a.createElement(b), d.id = c, d.src = "//connect.facebook.net/<?php echo jwOpt::get_option('social_comments_language', "en_GB"); ?>/all.js", e.parentNode.insertBefore(d, e))
    }(document, "script", "facebook-jssdk");
    <?php } ?>
</script> 


<?php //SHARE JS ***************************************************************    ?>
<?php if (is_single()) { ?>
    <script type="text/javascript" charset="utf-8">
        /* twitter share (min)*/
        !function(a, b, c) {
            var d, e = a.getElementsByTagName(b)[0];
            a.getElementById(c) || (d = a.createElement(b), d.id = c, d.src = "//platform.twitter.com/widgets.js", e.parentNode.insertBefore(d, e))
        }(document, "script", "twitter-wjs");
        /*google+ share (min)*/
        window.___gcfg = {lang: "<?php echo jwOpt::get_option('social_comments_language', "en_GB"); ?>"}, function() {
            var a = document.createElement("script");
            a.type = "text/javascript", a.async = !0, a.src = "https://apis.google.com/js/plusone.js";
            var b = document.getElementsByTagName("script")[0];
            b.parentNode.insertBefore(a, b)
        }();
    </script> 
    <!-- Linkedin share -->
    <!--<script src="//platform.linkedin.com/in.js" type="text/javascript" async></script>-->
    <!--Vine share-->
    <!--<script async src="//platform.vine.co/static/scripts/embed.js" charset="utf-8"></script>-->
<?php } ?>

</div>

<?php wp_footer(); ?>
</body>
</html>