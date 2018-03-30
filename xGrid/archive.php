<?php get_header(); ?>

    <div class="bd-container">
        <div class="bd-main">

            <div class="page-title">
                <h2>
                    <?php
                    if ( is_day() ) :
                        printf( __( 'Day: %s', 'bd' ), get_the_date() );

                    elseif ( is_month() ) :
                        printf( __( 'Month: %s', 'bd' ), get_the_date( 'F Y' ) );

                    elseif ( is_year() ) :
                        printf( __( 'Year: %s', 'bd' ), get_the_date( 'Y' ) );

                    else :
                        _e( 'Archives', 'bd' );

                    endif;
                    ?>
                </h2>
            </div>

            <div class="blog-v1">
                <?php
                $format = get_post_format();
                if( false === $format ) { $format = 'standard'; }
                get_template_part( 'loop-two', $format );
                ?>
            </div><!-- .blog-v1-->
            <?php
            echo '<div class="clear"></div>';
            bd_pagenavi($pages = '', $range = 2);
            ?>

        </div><!-- .bd-main-->

        <?php get_sidebar(); ?>
    </div><!-- .bd-container -->

<?php get_footer(); ?>