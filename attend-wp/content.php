<!-- Start of post class -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <!-- Start of featured image wrapper -->
    <div class="featured_image_wrapper">

        <?php if ( has_post_thumbnail() ) { ?>

        <a href="<?php the_permalink (); ?>"><?php the_post_thumbnail(''); ?></a>

        <?php } ?>
        
    </div>
    <!-- End of featured image wrapper -->

    <!-- Start of blog meta data -->
    <div class="blog_meta_data">
        
        <hr />
        
        <h1 class="blog_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        
        <!-- Start of metadate -->
        <div class="metadate">

            <a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php echo get_the_date(get_option('date_format')); ?></a>

        </div>
        <!-- End of metadate -->

        <!-- Start of metaauthor -->
        <div class="metaauthor">

            <?php the_author_posts_link(); ?>

        </div>
        <!-- End of metaauthor -->

        <!-- Start of metacats -->
        <div class="metacats">

            <?php the_category(' '); ?>

        </div>
        <!-- End of metacats -->

        <?php if ('open' == $post->comment_status) { ?>

        <!-- Start of metacomments -->
        <div class="metacomments">

            <?php
            if (get_comments_number()==1) { ?>

            <a href="<?php comments_link(); ?>"><?php comments_number( '0', '1', '%' ); ?>&nbsp;
            <?php _e( 'comment', 'cr3_attend_theme' ); ?></a>

            <?php } else { ?>

            <a href="<?php comments_link(); ?>"><?php comments_number( '0', '1', '%' ); ?>&nbsp;
            <?php _e( 'comments', 'cr3_attend_theme' ); ?></a>

            <?php } ?>

        </div>
        <!-- End of metacomments -->

        <?php } ?>

    </div>
    <!-- End of blog meta data -->

    <!-- Start of blog content -->
    <div class="blog_content">

        <?php the_content('        '); ?>

        <!-- Start of read more link -->
        <div class="read_more_link">

            <a href="<?php the_permalink(); ?>"><?php _e( 'More', 'cr3_attend_theme' ); ?></a>

        </div>
        <!-- End of read more link -->

    </div>
    <!-- End of blog content -->

</div>
<!-- End of post class -->