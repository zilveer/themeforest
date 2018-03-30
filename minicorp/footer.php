<?php
    global $sidebar_width, $ish_options;
?>
            <?php if ( ishyoboy_use_footer_sidebar() ){?>
                <!-- Footer part section -->
                <section class="part-footer" id="part-footer">

                    <div class="row">

                        <?php $sidebar_width = 12; // Used when displaying widgets ?>
                        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar(ishyoboy_get_footer_sidebar())) : else : ?>

                        <!-- NO WIDGETS -->

                        <?php endif; ?>

                    </div>

                </section>
                <!-- Footer part section END -->
            <?php } ?>

            <?php if ( ishyoboy_use_legals_sidebar() ){?>
                <!-- Footer legals part section -->
                <section class="part-footer-legals" id="part-footer-legals">

                    <div class="row">
                        <?php $sidebar_width = 12; // Used when displaying widgets ?>
                        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar(ishyoboy_get_legals_sidebar())) : else : ?>

                        <!-- NO WIDGETS -->

                        <?php endif; ?>
                    </div>

                </section>
                <!-- Footer legals part section END -->
            <?php } ?>



		</div>
		<!-- Wrap whole page - boxed / unboxed END -->

        <!-- Back to top link -->
        <?php
        if ( isset( $ish_options['show_back_to_top'] ) && ( '1' == $ish_options['show_back_to_top'] ) ){
            echo '<a href="#top" class="fixed-top smooth-scroll icon-up-open-1"></a>';
        }
        ?>


        <!--[if lte IE 8]><script src="<?php echo get_template_directory_uri(); ?>/assets/html/core/libs/js/ie8.js"></script><![endif]-->


        <?php if ( isset($ish_options['tracking_script']) && '' != $ish_options['tracking_script']): ?>
            <!-- TRACKING SCRIPT BEGIN -->
            <?php echo $ish_options['tracking_script']; ?>
            <!-- TRACKING SCRIPT END -->
        <?php endif; ?>

        <?php

        /*
         * Call wp footer
         */
        wp_footer();

        ?>

	</body>

</html>