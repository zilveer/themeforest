<?php global $themeum_options; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
        <header class="entry-header">
        <?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
        <div class="featured-image">
            <?php if (is_page_template('blog-masonry-col3.php')) {
                the_post_thumbnail('sm-blog-thumb', array('class' => 'img-responsive'));
            }
            elseif (is_page_template('blog-full-width.php')) {
                the_post_thumbnail('blog-full', array('class' => 'img-responsive'));
            }
             else {
                the_post_thumbnail('blog-thumb', array('class' => 'img-responsive'));
            }?>
        </div>
        <?php } ?>
        </header>
    <?php } //.entry-thumbnail ?>

    <div class="entry-post-content">
        <?php get_template_part( 'post-format/entry-content' ); ?> 
        <div class="entry-summary">
            <?php if ( is_single() ) {
                the_content();
            }else {
                 if (is_page_template('blog-masonry-col3.php')) {
                    echo '<p>'.the_excerpt_max_charlength(150).'</p>';
                     echo '<p><a class="btn btn-style" href="'.get_permalink().'">'. __( 'Continue Reading', 'themeum' ) .'</a></p>';
                }
                else {
                    the_excerpt();
                }
            }
            wp_link_pages( array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'themeum' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) );

            ?>
        </div> <!-- //.entry-summary -->
        <?php
         if (isset($themeum_options['blog-social']) && $themeum_options['blog-social'] ){
            if(is_single()) {
                get_template_part( 'post-format/social-buttons' );
            }
        }?>
    </div>

</article> <!--/#post-->