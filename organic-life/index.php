<?php get_header(); ?>

<?php global $themeum_options; ?>

<section id="main" class="container">
    <div class="row">
        <div id="content" class="site-content col-md-8" role="main">

            <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        get_template_part( 'post-format/content', get_post_format() );
                    endwhile;
                else:
                    get_template_part( 'post-format/content', 'none' );
                endif;
            ?>

           <?php themeum_pagination(); ?>

        </div> <!-- #content -->

       <?php get_sidebar(); ?>
       <!-- #sidebar -->
        
    </div> <!-- .row -->
</section> <!-- .container -->

<?php get_footer();