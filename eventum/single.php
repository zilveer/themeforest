<?php get_header(); 
global $themeum_options;
?>

<section id="main">

   <?php get_template_part('lib/sub-header')?>

    <div class="container">
        <div class="row">
            <div id="content" class="site-content col-md-8" role="main">

                <?php if ( have_posts() ) :  ?> 

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'post-format/content', get_post_format() ); ?>

                         <?php if ( isset($themeum_options['post-nav-en']) && $themeum_options['post-nav-en'] ) { ?>
                            <div class="clearfix post-navigation">
                                <?php previous_post_link('<span class="previous-post pull-left">%link</span>','<i class="fa fa-long-arrow-left"></i> '.esc_html__("previous article",'eventum')); ?>
                                <?php next_post_link('<span class="next-post pull-right">%link</span>',esc_html__("next article",'eventum').' <i class="fa fa-long-arrow-right"></i>'); ?>
                            </div> <!-- .post-navigation -->
                        <?php } ?>

                        <?php
                            if ( comments_open() || get_comments_number() ) {
                                if ( isset($themeum_options['blog-single-comment-en']) && $themeum_options['blog-single-comment-en'] ) {
                                   comments_template();
                                }
                            }
                        ?>
                        <?php
                            if ( is_singular( 'post' ) ){
                                $count_post = esc_attr( get_post_meta( $post->ID, '_post_views_count', true) );
                                if( $count_post == ''){
                                    $count_post = 1;
                                    add_post_meta( $post->ID, '_post_views_count', $count_post);
                                }else{
                                    $count_post = (int)$count_post + 1;
                                    update_post_meta( $post->ID, '_post_views_count', $count_post);
                                }
                            }
                        ?>
                    <?php endwhile; ?>

                    
                <?php else: ?>
                    <?php get_template_part( 'post-format/content', 'none' ); ?>
                <?php endif; ?>

                <div class="clearfix"></div>
        
            </div> <!-- #content -->


            <?php get_sidebar(); ?>
            <!-- #sidebar -->

        </div> <!-- .row -->
    </section> <!-- .container -->

<?php get_footer();