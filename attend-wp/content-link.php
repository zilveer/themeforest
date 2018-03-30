<!-- Start of post class -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <!-- Start of blog meta data -->
    <div class="blog_meta_data">
        
        <hr />
                
        <!-- Start of metadate -->
        <div class="metadate">

            <a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php echo get_the_date(get_option('date_format')); ?></a>

        </div>
        <!-- End of metadate -->

    </div>
    <!-- End of blog meta data -->

    <!-- Start of blog content -->
    <div class="blog_content">
        
        <h1 class="link_title"><?php the_title(); ?></h1>

            <!-- Start of linkpostcontent -->
            <div class="linkpostcontent">
                
                <?php the_content('        '); ?>
                
            </div>
            <!-- End of linkpostcontent -->

    </div>
    <!-- End of blog content -->

</div>
<!-- End of post class -->