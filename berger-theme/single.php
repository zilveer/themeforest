<?php

get_header();

while ( have_posts() ){

    the_post();

    ?>

    <!-- Content -->
    <div id="content">

        <div id="content-ajax">

            <?php

            $hero_type = redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-post-hero-type' );
            if( $hero_type != 'none' ){

                get_template_part('sections/hero_section');
            }

            ?>

            <!-- Main -->
            <div id="main">

                <!-- Container -->
                <div class="container">

                    <!-- Blog Post -->
                    <div id="blog-post">

						<?php
						
						get_template_part('sections/post_sharing_section');
						
						?>
						
                        <?php

                        get_template_part( 'sections/blog_single_post_section' );

                        ?>

                    <!-- /Blog Post-->
                    </div>

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
