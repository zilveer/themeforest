<?php

get_header();

if ( have_posts() ){

    the_post();

    ?>

    <!-- Content -->
    <div id="content">

        <div id="content-ajax">

            <!-- Main -->
            <div id="main">

                <!-- Container -->
                <div class="container">

                    <!-- Blog -->
                    <div id="blog" class="text-align-center">

                        <?php

                        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

                        $args = array(
                            'post_type' => 'post',
                            'paged' => $paged
                        );
                        $posts_query = new WP_Query( $args );

                        // the loop
                        while( $posts_query->have_posts() ){

                            $posts_query->the_post();

                            get_template_part( 'sections/blog_post_section' );

                        }

                        ?>

                        <!-- /Blog -->
                    </div>

                    <?php

                    clapat_bg_pagination( $posts_query );

                    wp_reset_postdata();
                    ?>

                </div>
                <!-- /Container -->

            </div>
            <!--/Main -->

            <?php get_template_part("sections/scroll_top_section"); ?>

        </div>

    </div>
    <!--/Content -->

<?php

}

get_footer();

?>
