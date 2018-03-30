<?php global $themeum_options; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">

        <div class="entry-content-gallery">
            <?php $slides = rwmb_meta('thm_gallery_images','type=image_advanced'); ?>
            <?php if(count($slides) > 0) { ?>
            <div id="blog-gallery-slider<?php echo get_the_ID(); ?>" class="carousel slide blog-gallery-slider">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php $slide_no = 1; ?>
                    <?php foreach( $slides as $slide ) { ?>
                    <div class="item <?php if($slide_no == 1) echo 'active'; ?>">
                        <?php $images = wp_get_attachment_image_src( $slide['ID'], 'blog-full' ); ?>
                        <img class="img-responsive" src="<?php echo $images[0]; ?>" alt="">
                    </div>
                    <?php $slide_no++ ?>
                    <?php } ?>
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right carousel-control" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
            <?php } ?>
        </div><!--/.entry-content-gallery-->
    </header> <!--/.entry-header -->

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