<?php
/**
 * The template for displaying the footer
 */
?>

<footer>
    <?php if(learn_theme_option('topfooter')) { ?>
    <div class="top-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <?php if(learn_theme_option('logo_footer')) { ?>
                    <img src="<?php echo esc_url(learn_theme_option('logo_footer')); ?>" alt="">
                    <?php }else{ ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo_footer.png" alt="">
                    <?php } ?>
                    <?php echo do_shortcode( ''.learn_theme_option('newsletter').'' ); ?>
                </div>
            </div>
        </div>
        <hr>
    </div>
    <?php } ?>

    <div class="container" id="nav-footer">
        <div class="row text-left">
            <?php get_sidebar('footer');?>
        </div><!-- End row -->
    </div>
    <?php if(learn_theme_option('copyr')) { ?><div id="copy_right"><?php echo wp_kses(learn_theme_option('copyr'), wp_kses_allowed_html('post')); ?></div><?php } ?>
</footer>

<div id="toTop"><i class="fa fa-angle-up"></i></div>

<?php wp_footer(); ?>

</body>
</html>