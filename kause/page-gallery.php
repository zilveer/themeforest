<?php /* Template Name: Gallery */ ?>

<?php get_header(); ?>

<?php 

    //SETTTINGS
    $cmb_gallery_style = get_post_meta($post->ID, 'cmb_gallery_style', true);
    $cmb_gallery_click = get_post_meta($post->ID, 'cmb_gallery_click', true);
    $cmb_gallery_cat = get_post_meta($post->ID, 'cmb_gallery_cat', true);
    $cmb_gallery_client_name = get_post_meta($post->ID, 'cmb_gallery_client_name', true);
    $cmb_gallery_client_url = get_post_meta($post->ID, 'cmb_gallery_client_url', true);

    $post_counter = 1;

    //BUILD EXCLUDE ARRAY
    $results_exclude_posts = get_posts(array(
        'numberposts'       => -1,
        'meta_key'          => 'cmb_hide_from_gallery',
        'meta_value'        => 'checked',
        'orderby'           => 'post_date',
        'order'             => 'DESC',
        'post_type'         => 'any',
        'suppress_filters'  => false,
    ));
    if (count($results_exclude_posts) > 0) {
        for ($i = 0; $i < count($results_exclude_posts); $i++) {  
            $exclude_array[$i] = $results_exclude_posts[$i]->ID;
        }   
    } else {
        $exclude_array = array();   
    }


    //BUILD INCLUDE STRING
    $include_string = " ";  //notice the extra space - to prevent include string from being empty which would display all categories.

    if (!empty($cmb_gallery_cat)) {
        foreach ($cmb_gallery_cat as $key => $value) {
            $include_string .=  get_category_by_slug($key)->term_id . ",";
        }
        $include_string = trim($include_string,', ');
    } 

   //BASE ARGS
    $query_args = array(
        'posts_per_page'    => -1,
        'post_type'         => 'post',
        'post_status'       => 'publish',
        'orderby'           => 'post_date',
        'order'             => 'DESC',
        'post__not_in'      => $exclude_array,
        'cat'               => $include_string,
         'suppress_filters'  => false,
  );

    //FINAL QUERY
    $temp = $wp_query;
    if (!class_exists('Tribe__Events__Main')) { $wp_query = null; }
    $wp_query = new WP_Query($query_args); 

    //var_dump($wp_query);

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
        
        
                <?php 

                    //GALLERY STYLE 1
                    if ($cmb_gallery_style == "one") {
                    ?>

                        <!-- start gallery style 1--> 
                        <div class="clearfix">
                           
                            <!-- Start Meta -->
                            <aside class="left-aside left fifth">
                                <ul class="meta">
                                    <li><strong><?php echo $post->post_title; ?></strong></li>
                                    <li><?php echo mb_localize_datetime(get_the_time(get_option('date_format'))); ?></li>
                                    <?php 
                                        if ( !empty($cmb_gallery_client_name) ) {
                                            if ( !empty($cmb_gallery_client_url) ) {
                                                printf('<li><a href="%s" target="_blank">%s</a></li>', esc_url($cmb_gallery_client_url), esc_attr($cmb_gallery_client_name) );
                                            } else {
                                                printf('<li>%s</li>', esc_attr($cmb_gallery_client_name) );
                                            }
                                        }

                                    ?>
                                </ul>

                                <?php echo do_shortcode($post->post_content); ?>

                            </aside> 

                            <!-- gallery images -->
                            <div class="four-fifths right last">
                                <!-- Start Slider -->
                                <div class="flexslider">
                                    <ul class="slides">

                                        <!-- MAIN LOOP -->
                                        <?php while ( have_posts() ) : the_post(); ?>

                                        <?php 
                                            $cmb_media_link = get_post_meta(get_the_ID(), 'cmb_media_link', true);
                                            $cmb_feature = get_post_meta(get_the_ID(), 'cmb_feature', true);
                                        ?>


                                        <?php 

                                            if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
                                                echo "<li>";
                                                echo $cmb_media_link;
                                                echo "</li>";
                                                $post_counter++;
                                            } elseif ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id(get_the_ID())) ) {
                                                $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                                $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                                if ($cmb_gallery_click == "post") {
                                                    printf("<li><a href='%s'><img src='%s' alt='%s'></a></li>", get_permalink(), esc_url($post_thumbnail_src[0]), esc_attr($img_alt)); 
                                                } else {
                                                    printf("<li><a class='fancybox-media fancybox.iframe play' href='%s'><img src='%s' alt='%s'></a></li>", esc_url($cmb_media_link), esc_url($post_thumbnail_src[0]), esc_attr($img_alt)); 
                                                }
                                                $post_counter++;
                                            } elseif ( has_post_thumbnail(get_the_ID()) && get_post(get_post_thumbnail_id(get_the_ID())) ) { 
                                                $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                                $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                                $img_post = get_post(get_post_thumbnail_id(get_the_ID()));
                                                if ($cmb_gallery_click == "post") {
                                                    printf("<li><a href='%s'><img src='%s' alt='%s'></a></li>", get_permalink(), esc_url($post_thumbnail_src[0]), esc_attr($img_alt)); 
                                                } else {
                                                    printf("<li><a href='%s' title='%s'><img src='%s' alt='%s'></a></li>", esc_url($post_thumbnail_src[0]), esc_attr($img_post->post_title), esc_url($post_thumbnail_src[0]), esc_attr($img_alt)); 
                                                }
                                                $post_counter++;
                                            }

                                        ?>

                                        <?php endwhile; ?>
                                        <!-- END LOOP -->

                                    </ul>
                                </div>
                            </div>
                        
                        </div>
                        <!-- end gallery style 1--> 

                    <?php
                    }

                    //GALLERY STYLE 2
                    if ($cmb_gallery_style == "two") {
                    ?>

                        <!-- start gallery style 2--> 
                        <div class="clearfix">

                            <!-- Start Meta -->
                            <aside class="left-aside left fifth">
                                <ul class="meta option-set filters" id="filter" data-option-key="filter">
                                    <li><strong><?php echo $post->post_title; ?></strong></li>

                                    <?php
                                        wp_list_categories(array(
                                            'show_option_all'   => __("All categories", "loc_canon"),
                                            'include'           => $include_string,
                                            'title_li'          => "",
                                            'taxonomy'          => "category"

                                        )); 
                                    ?>

                                </ul>

                                <?php echo do_shortcode($post->post_content); ?>

                            </aside>

                            <!-- Start Isotope -->
                            <div class="four-fifths right last thumb-gallery super-list variable-sizes" id="thumb-gallery">

                                <!-- MAIN LOOP -->
                                <?php while ( have_posts() ) : the_post(); ?>

                                    <?php 
                                        $cmb_media_link = get_post_meta(get_the_ID(), 'cmb_media_link', true);
                                        $cmb_feature = get_post_meta(get_the_ID(), 'cmb_feature', true);
                                       
                                        $last_class = ($post_counter%3) ? "" : " last";
                                        $item_categories = get_the_terms(get_the_ID(), 'category');
                                        if ($item_categories) foreach ($item_categories as $value) $last_class .= " cat-item-" . $value->term_id;
                                    ?>

                                    <?php 

                                            if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
                                                echo '<div class="gallery_item third'.$last_class.'">';
                                                echo $cmb_media_link;        
                                                echo '</div>';
                                                $post_counter++;
                                            } elseif ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id(get_the_ID())) ) {
                                                echo '<div class="gallery_item mosaic-block third fade element'.$last_class.'">';
                                                $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                                $post_thumbnail_src_fit = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'gallery_isotope_x2');
                                                $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                                $img_post = get_post(get_post_thumbnail_id(get_the_ID()));
                                                if ($cmb_gallery_click == "post") {
                                                    printf('<a href="%s" class="mosaic-overlay link fancybox" title="%s"></a>', get_permalink(), esc_attr($img_post->post_title));
                                                } else {
                                                    printf('<a href="%s" class="mosaic-overlay fancybox-media fancybox.iframe play"></a>', esc_attr($cmb_media_link));
                                                }
                                                printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src_fit[0]), esc_attr($img_alt));
                                                echo '</div>';
                                                $post_counter++;
                                            } elseif ( has_post_thumbnail(get_the_ID()) && get_post(get_post_thumbnail_id(get_the_ID())) ) { 
                                                echo '<div class="gallery_item mosaic-block third fade element'.$last_class.'">';
                                                $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                                $post_thumbnail_src_fit = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'gallery_isotope_x2');
                                                $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                                $img_post = get_post(get_post_thumbnail_id(get_the_ID()));
                                                if ($cmb_gallery_click == "post") {
                                                    printf('<a href="%s" class="mosaic-overlay link fancybox" title="%s"></a>', get_permalink(), esc_attr($img_post->post_title));
                                                } else {
                                                    printf('<a href="%s" class="mosaic-overlay fancybox" title="%s"></a>', esc_url($post_thumbnail_src[0]), esc_attr($img_post->post_title));
                                                }
                                                printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src_fit[0]), esc_attr($img_alt));
                                                echo '</div>';
                                                $post_counter++;
                                            }

                                    ?>

                                <?php endwhile; ?>
                                <!-- END LOOP -->

                            </div>

                        </div>                              
                        <!-- end gallery style 2--> 
                        
                    <?php
                    }

                    //GALLERY STYLE 3
                    if ($cmb_gallery_style == "three") {
                    ?>

                        <div class="clearfix">

                        <!-- Start Meta -->
                            <aside class="left-aside left fifth">
                                <ul class="meta">
                                    <li><strong><?php echo $post->post_title; ?></strong></li>
                                    <li><?php echo mb_localize_datetime(get_the_time(get_option('date_format'))); ?></li>
                                    <?php 
                                        if ( !empty($cmb_gallery_client_name) ) {
                                            if ( !empty($cmb_gallery_client_url) ) {
                                                printf('<li><a href="%s" target="_blank">%s</a></li>', esc_url($cmb_gallery_client_url), esc_attr($cmb_gallery_client_name) );
                                            } else {
                                                printf('<li>%s</li>', esc_attr($cmb_gallery_client_name) );
                                            }
                                        }

                                    ?>
                                </ul>

                                <?php echo do_shortcode($post->post_content); ?>
                                
                            </aside> 

                            <div class="four-fifths right last">

                                <!-- MAIN LOOP -->
                                <?php while ( have_posts() ) : the_post(); ?>

                                    <?php 
                                        $cmb_media_link = get_post_meta(get_the_ID(), 'cmb_media_link', true);
                                        $cmb_feature = get_post_meta(get_the_ID(), 'cmb_feature', true);
                                       
                                    ?>

                                    <?php 

                                        if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
                                            echo $cmb_media_link;        
                                            $post_counter++;
                                        } elseif ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id(get_the_ID())) ) {
                                            echo '<div class="mosaic-block fade">';
                                            $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                            $post_thumbnail_src_fit = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'gallery_isotope_x2');
                                            $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                            $img_post = get_post(get_post_thumbnail_id(get_the_ID()));
                                            if ($cmb_gallery_click == "post") {
                                                printf('<a href="%s" class="mosaic-overlay link fancybox" title="%s"></a>', get_permalink(), esc_attr($img_post->post_title));
                                            } else {
                                                printf('<a href="%s" class="mosaic-overlay fancybox-media fancybox.iframe play" rel="gallery"></a>', esc_attr($cmb_media_link));
                                            }
                                            printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                            echo '</div>';
                                            $post_counter++;
                                        } elseif ( has_post_thumbnail(get_the_ID()) && get_post(get_post_thumbnail_id(get_the_ID())) ) { 
                                            echo '<div class="mosaic-block fade">';
                                            $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                            $post_thumbnail_src_fit = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'gallery_isotope_x2');
                                            $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                            $img_post = get_post(get_post_thumbnail_id(get_the_ID()));
                                            if ($cmb_gallery_click == "post") {
                                                printf('<a href="%s" class="mosaic-overlay link fancybox" title="%s"></a>', get_permalink(), esc_attr($img_post->post_title));
                                            } else {
                                                printf('<a href="%s" class="mosaic-overlay fancybox" title="%s"></a>', esc_url($post_thumbnail_src[0]), esc_attr($img_post->post_title));
                                            }
                                            printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                            echo '</div>';
                                            $post_counter++;
                                        }

                                    ?>

                                <?php endwhile; ?>
                                <!-- END LOOP -->

                            </div>

                        </div>                              
                        <!-- end gallery style 3--> 
                        
                    <?php
                    }

                ?>

                     
                </div>
                <!-- end main-content -->
            </div>
            <!-- end main wrapper -->
        </div>
         <!-- end main-container --> 
    </div>
     <!-- end outter-wrapper -->
 
        
        


		
<?php get_footer(); ?>