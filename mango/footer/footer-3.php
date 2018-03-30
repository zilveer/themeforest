<?php global $mango_settings, $post; ?>

<footer id="footer" class="mango_footer_3 footer-minimal" role="contentinfo">

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div class="footer-logo"><img src="<?php echo esc_url(mango_get_logo_url('footer_'));?>" alt="<?php bloginfo("title") ?>" class="img-responsive"></div><!-- End .footer-logo -->

                <?php  if ( has_nav_menu ( 'footer_menu' )  && mango_show_footer_menu()) {

                    wp_nav_menu (

                        array (

                            'theme_location' => 'footer_menu',

                            'menu_class' => 'footer-menu',

                            "depth" => 1,

                            'container' => false

                        ) );

                }?>

                <p class="copyright"><?php echo htmlspecialchars_decode(esc_textarea($mango_settings['mango_copyright'])) ?></p>

            </div><!-- End .col-md-12 -->

        </div><!-- End .row -->

    </div><!-- End .container -->

</footer><!-- End #footer -->