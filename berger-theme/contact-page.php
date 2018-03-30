<?php
/*
Template name: Contact Template
*/

global $clapat_bg_theme_options; 

get_header();

while ( have_posts() ){

    the_post();

    ?>

    <!-- Content -->
    <div id="content">

        <div id="content-ajax">

            <?php get_template_part('sections/map_section'); ?>

            <!-- Main -->
            <div id="main">

                <!-- Container -->
                <div class="container">

                    <?php
                    if( redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-show-title' ) ){
                        ?>
                        <!-- Page Title -->
                        <div class="page-title text-align-center">
                            <h3><?php the_title(); ?></h3>
                            <p class="monospace title-has-line"><?php echo redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-subtitle' ); ?></p>
                        </div>
                        <!-- Page Title -->
                    <?php } ?>

                    <?php get_template_part('sections/show_contact_section'); ?>

                    <?php the_content(); ?>

                </div>

            </div>
            <!--/Main -->

            <?php get_template_part("sections/scroll_top_section"); ?>

        </div>
        <!-- /Container -->

    </div>
    <!--/Content -->

<?php

}

get_footer();

?>