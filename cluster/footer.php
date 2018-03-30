    <?php stag_footer_before(); ?>
    <!-- END .wrapper -->
    </div>
    <?php stag_content_end(); ?>

    <?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
    <!-- BEGIN .footer -->
    <footer class="footer" role="contentinfo">
        <?php stag_footer_start(); ?>

        <div class="inside grids">
            <?php dynamic_sidebar( 'sidebar-footer' ); ?>
        </div>

        <?php stag_footer_end(); ?>
        <!-- END .footer -->
    </footer>
    <?php endif; ?>

    <footer class="copyright">
        <div class="inside grids">
            <div class="grid-4">
                <p><?php echo stripslashes( stag_get_option( 'general_footer_text' ) ); ?></p>
            </div>
            <?php if ( stag_get_option( 'footer_social_links' ) != '' ) : ?>
            <div class="grid-8">
                <?php echo do_shortcode( stripcslashes( stag_get_option( 'footer_social_links' ) ) ); ?>
            </div>
            <?php endif; ?>
        </div>
    </footer>

    <?php stag_footer_after(); ?>

    <?php stag_body_end(); ?>

    <?php wp_footer(); ?>
    </body>
</html>
