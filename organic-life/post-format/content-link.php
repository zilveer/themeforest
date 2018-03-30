<?php global $themeum_options; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">

        <div class="format-no-image">
        
            <div class="entry-link">
                <h4><?php echo rwmb_meta( 'thm_link' ); ?></h4>
            </div>
        </div>

    </header><!--/.entry-header -->

    <div class="entry-post-content">
        <?php get_template_part( 'post-format/entry-content' ); ?>         
        <h2 class="entry-title blog-entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
            <?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
            <sup class="featured-post"><?php _e( 'Sticky', 'themeum' ) ?></sup>
            <?php } ?>
        </h2> <!-- //.entry-title -->

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

</article> <!--/#post -->