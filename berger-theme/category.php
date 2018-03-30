<?php
/**
 * The template for displaying Category Search Results pages
 */

get_header();

?>

<!-- Content -->
<div id="content">

    <div id="content-ajax">

        <!-- Main -->
        <div id="main">

            <!-- Container -->
            <div class="container">

                <?php get_template_part('sections/search_section'); ?>

                <h4 class="search_results"><?php  single_cat_title(); ?></h4>

                <!-- Blog -->
                <div id="blog" class="text-align-center">

                    <?php

                    if( have_posts() ){
                        while( have_posts() ){

                            the_post();

                            get_template_part( 'sections/blog_post_section' );

                        }
                    } else{

			            echo '<h4 class="search_results">' . __('No posts found', THEME_LANGUAGE_DOMAIN ) . '</h4>';

                    }

                    ?>

                    <!-- /Blog -->
                </div>

                <?php

                clapat_bg_pagination();

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

get_footer();

?>
