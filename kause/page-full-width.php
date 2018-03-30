<?php /* Template Name: Page Full Width*/ ?>

<?php get_header(); ?>
    
<?php 

    $cmb_hide_page_title = get_post_meta($post->ID, 'cmb_hide_page_title', true);

?>
    	
    <!-- BEGIN LOOP -->
    <?php while ( have_posts() ) : the_post(); ?>

    
        <!-- FEATURED IMAGE -->
        <?php
            // $featured_img_width = 1440;
            // $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
            // if ($post_thumbnail_src[1] < $featured_img_width) $featured_img_width = $post_thumbnail_src[1];


            if (has_post_thumbnail(get_the_ID())) { 
            ?>

                <div class="outter-wrapper feature">
                    <?php the_post_thumbnail(); ?>
                </div>

            <?php
            } else {
            ?>

                <!-- Start Outter Wrapper -->   
                <div class="outter-wrapper feature">
                    <hr>
                </div>
                <!-- End Outter Wrapper --> 
                       
            <?php       
                    
            }

        ?>
        
        <!-- start outter-wrapper -->   
        <div class="outter-wrapper">
            <!-- start main-container -->
            <div class="main-container">
                <!-- start main wrapper -->
                <div class="main wrapper clearfix">
                    <!-- start main-content -->
                    <div class="main-content">

                    	<!-- Start Post --> 
                    	<div class="clearfix">

                            <!-- THE TITLE -->  
                            <?php if ($cmb_hide_page_title != "checked") { printf('<h1>%s</h1>', esc_attr(get_the_title())); } ?>
                           
                             <!-- THE CONTENT -->
                            <?php the_content(); ?>
                            
                            <!-- WP_LINK_PAGES -->
                            <?php wp_link_pages(array('before' => '<p>' . __('Pages:','loc_canon'))); ?>
                         
                        </div>


                    </div>
                    <!-- end main-content -->
                </div>
                <!-- end main wrapper -->
            </div>
             <!-- end main-container -->
        </div>
        <!-- end outter-wrapper -->
      

    	
    <?php endwhile; ?>

<?php get_footer(); ?>