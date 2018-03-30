<?php

/**
 * Template Name: Right Sidebar
 */

get_header();

?>
               
<section id="main_content">

    <div class="container">

        <?php learn_breadcrumbs(); ?>

        <div class="row">

            <div class="col-md-8">           
                <?php while (have_posts()) : the_post()?>

                    <?php the_post_thumbnail() ?>
                    
                    <?php the_content(); ?>
                    
                    <?php
                        wp_link_pages( array(
                            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'learn' ) . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                            'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'learn' ) . ' </span>%',
                            'separator'   => '<span class="screen-reader-text">, </span>',
                        ) );
                    ?>
                    
                    <?php

                     if ( comments_open() || get_comments_number() ) :
                      comments_template();
                     endif;
                    ?>
                    
                <?php endwhile; ?>

            </div>

            <aside class="col-md-4">
                <?php get_sidebar();?>
            </aside>

        </div>

    </div>

</section>


<!-- content close -->
<?php get_footer(); ?>