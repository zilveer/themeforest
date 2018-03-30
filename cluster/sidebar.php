<?php if( is_active_sidebar( 'sidebar-main' ) && stag_get_option('style_main_layout') != 'layout-1cf' ) { ?>

    <?php stag_sidebar_before(); ?>
        <!-- BEGIN #secondary -->
        <div id="secondary" class="sidebar" role="complementary">

        <?php
            stag_sidebar_start();

            /* Widgetised Area */
            dynamic_sidebar( 'sidebar-main' );

            stag_sidebar_end();
        ?>

        <!-- END #secondary -->
        </div>
        <?php stag_sidebar_after(); ?>

<?php } ?>