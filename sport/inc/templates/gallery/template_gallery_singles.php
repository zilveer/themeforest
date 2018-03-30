<?php get_header(); ?>

<?php 

    //SETTTINGS
    $cmb_gallery_style = get_post_meta($post->ID, 'cmb_gallery_style', true);
    $cmb_gallery_num_columns = get_post_meta($post->ID, 'cmb_gallery_num_columns', true);
    $cmb_gallery_source = get_post_meta($post->ID, 'cmb_gallery_source', true);

    // DEFAULTS
    if (empty($cmb_gallery_style)) { $cmb_gallery_style = "isotope"; };

    // HANDLE WP GALLERY SOURCE
    $consolidated_gallery_array = array();
    $cmb_gallery_source = get_post_meta( $post->ID, 'cmb_gallery_source', true);
    $gallery_array = mb_strip_wp_galleries_to_array($cmb_gallery_source);
    $consolidated_gallery_array = mb_convert_wp_galleries_array_to_consolidated_wp_gallery_array($gallery_array);

    // GET CLASSES
    $size_class = mb_get_size_class_from_num($cmb_gallery_num_columns, "third");

    // var_dump($consolidated_gallery_array);

?>

    <!-- Start Outter Wrapper -->   
    <div class="outter-wrapper feature">
        <hr/>
    </div>  
    <!-- End Outter Wrapper -->     
        
        
    <!-- start outter-wrapper -->   
    <div class="outter-wrapper">
        <!-- start main-container -->
        <div class="main-container">
            <!-- start main wrapper -->
            <div class="main wrapper clearfix">
                <!-- start main-content -->
                <div class="main-content">
        
        
                    <!-- gallery singles -->
                    <div class="clearfix">

                    <!-- Start Meta -->
                        <aside class="left-aside left fifth">
                            <ul class="meta">
                                <li><strong><?php echo $post->post_title; ?></strong></li>
                                <li><?php echo mb_localize_datetime(get_the_time(get_option('date_format'))); ?></li>
                            </ul>

                            <?php echo do_shortcode($post->post_content); ?>
                            
                        </aside> 

                        <div class="four-fifths right last">

                            <?php

                                        
                                for ($i = 0; $i < count($consolidated_gallery_array); $i++) { 

                                    $post_thumbnail_src = wp_get_attachment_image_src($consolidated_gallery_array[$i]['id'],'full');
                                    $img_alt = get_post_meta($consolidated_gallery_array[$i]['id'], '_wp_attachment_image_alt', true);
                                    $img_post = get_post($consolidated_gallery_array[$i]['id']);
                                            
                                    printf('<div class="mosaic-block fade">');
                                    printf('<a href="%s" class="mosaic-overlay fancybox" title="%s"></a>', esc_url($post_thumbnail_src[0]), esc_attr($img_post->post_excerpt));
                                    printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                    echo '</div>';

                                }

                            ?>

                        </div>

                    </div>
                    <!-- end gallery singles -->                              

                     
                </div>
                <!-- end main-content -->
            </div>
            <!-- end main wrapper -->
        </div>
         <!-- end main-container --> 
    </div>
     <!-- end outter-wrapper -->
 
        
        


		
<?php get_footer(); ?>