<?php global $themeum_options; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (!is_single()) { ?>
    <div class="row">
        <div class="col-sm-6">
        <?php  if ( rwmb_meta('thm_gallery_images','type=image_advanced') ) { ?>
        <div class="featured-wrap">
            <div class="entry-content-gallery">
                <?php $slides = rwmb_meta('thm_gallery_images','type=image_advanced'); ?>
                <?php if(count($slides) > 0) { ?>
                <div id="blog-gallery-slider<?php echo get_the_ID(); ?>" class="carousel slide blog-gallery-slider">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <?php $slide_no = 1; ?>
                        <?php foreach( $slides as $slide ) { ?>
                        <div class="item <?php if($slide_no == 1) echo 'active'; ?>">
                            <?php $images = wp_get_attachment_image_src( esc_attr($slide['ID']), 'blog-medium' ); ?>
                            <img class="img-responsive" src="<?php echo esc_url($images[0]); ?>" alt="">
                        </div>
                        <?php $slide_no++; ?>
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
        </div> 
        <?php } ?>
        </div>
        <div class="col-sm-6">
        <span class="post-icon"><i class="fa fa-camera"></i></span>
        <?php get_template_part( 'post-format/entry-content' ); ?> 
        </div>
    </div>
    <?php } else { ?>
        <?php  if ( rwmb_meta('thm_gallery_images','type=image_advanced') ) { ?>
        <div class="featured-wrap">
            <div class="entry-content-gallery">
                <?php $slides = rwmb_meta('thm_gallery_images','type=image_advanced'); ?>
                <?php if(count($slides) > 0) { ?>
                <div id="blog-gallery-slider<?php echo get_the_ID(); ?>" class="carousel slide blog-gallery-slider">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <?php $slide_no = 1; ?>
                        <?php foreach( $slides as $slide ) { ?>
                        <div class="item <?php if($slide_no == 1) echo 'active'; ?>">
                            <?php $images = wp_get_attachment_image_src( esc_attr($slide['ID']), 'blog-medium' ); ?>
                            <img class="img-responsive" src="<?php echo esc_url($images[0]); ?>" alt="">
                        </div>
                        <?php $slide_no++; ?>
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
        </div> 
        <?php } ?>
        <?php if (!is_single()) { ?>
        <span class="post-icon"><i class="fa fa-camera"></i></span>
        <?php } ?>
        <?php get_template_part( 'post-format/entry-content' ); ?> 
       <?php } ?>
</article> <!--/#post -->