<?php /* Template Name: Timeline */ ?>

<?php get_header(); ?>
    	
<?php 

    //VARS
    $canon_options_post = get_option('canon_options_post'); 
    $category_slug = "";
    $default_excerpt_length = 240;
    $timeline_offset = 0;
    $load_delay = 1500;

    // GET VARS
    $cmb_timeline_cat = get_post_meta($post->ID, 'cmb_timeline_cat', true);
    $cmb_timeline_order = get_post_meta($post->ID, 'cmb_timeline_order', true);
    $cmb_timeline_link_through = get_post_meta($post->ID, 'cmb_timeline_link_through', true);
    $cmb_timeline_display_content = get_post_meta($post->ID, 'cmb_timeline_display_content', true);
    $cmb_timeline_posts_per_page = get_post_meta($post->ID, 'cmb_timeline_posts_per_page', true);    //notice if not set then query defaults to wp posts per page
    
    // FAILSAFE/DEFAULTS FOR UNSET VARS
    if (empty($cmb_timeline_order)) { $cmb_timeline_order = "DESC"; }

    // BUILD EXCLUDE STRING (DECOMMENT TO ADD EXCLUDE STRING IF NEED TO REMOVE ENTIRELY REMEMBER TO UPDATE AJAX CALL AS WELL)
    $exclude_string = "";
    // $results_exclude_posts = get_posts(array(
    //     'numberposts'       => -1,
    //     'meta_key'          => 'cmb_hide_from_archive',
    //     'meta_value'        => 'checked',
    //     'orderby'           => 'post_date',
    //     'order'             => 'DESC',
    //     'post_type'         => 'any',
    // ));
    // if (count($results_exclude_posts) > 0) {
    //     $exclude_string = "";
    //     for ($i = 0; $i < count($results_exclude_posts); $i++) {  
    //         $exclude_string .= $results_exclude_posts[$i]->ID . ",";
    //     }   
    //     $exclude_string = substr($exclude_string, 0, strlen($exclude_string)-1);
    // } 


    //basic args
    $query_args = array();
    $query_args = array_merge($query_args, array(
        'post_type'         => 'post',
        'post_status'       => array('publish','future'),
        'suppress_filters'  => false,
        'numberposts'       => $cmb_timeline_posts_per_page,
        'offset'            => $timeline_offset,
        'category_name'     => $cmb_timeline_cat,
        'orderby'           => 'post_date',
        'order'             => $cmb_timeline_order,
        'exclude'           => $exclude_string,
    ));


    //final query
    $results_query = get_posts($query_args);

    //localize script
    wp_localize_script('canon_scripts','extDataTimeline', array(
        'ajaxUrl'               => admin_url('admin-ajax.php'),
        'nonce'                 => wp_create_nonce('timeline_load_more'),
        'loadDelay'             => $load_delay,

        'postsPerPage'          => $cmb_timeline_posts_per_page,
        'category'              => $cmb_timeline_cat,
        'order'                 => $cmb_timeline_order,
        'excludeString'         => $exclude_string,
        'linkThrough'           => $cmb_timeline_link_through,
        'displayContent'        => $cmb_timeline_display_content,
        'defaultExcerptLength'  => $default_excerpt_length,
    ));        

    // var_dump($wp_query->posts);

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

                    <h1><?php echo $post->post_title; ?></h1>
                    <?php if (!empty($post->post_content)) { printf('<p class="lead">%s</p>', do_shortcode($post->post_content) ); } ?>
                            

                    <div class="timeline-container">
                    
                        <div class="vert-line"></div>

                            <ul class="timeline" data-offset="<?php echo $timeline_offset; ?>">

                                <?php 

                                    for ($i = 0; $i < count($results_query); $i++) { 

                                        $this_post = $results_query[$i];
                                    
                                        $post_format = get_post_format($this_post->ID);
                                        $cmb_excerpt = get_post_meta($this_post->ID, 'cmb_excerpt', true);
                                        $cmb_feature = get_post_meta($this_post->ID, 'cmb_feature', true);
                                        $cmb_media_link = get_post_meta($this_post->ID, 'cmb_media_link', true);
                                        $cmb_quote_is_tweet = get_post_meta($this_post->ID, 'cmb_quote_is_tweet', true);
                                        $cmb_byline = get_post_meta($this_post->ID, 'cmb_byline', true);

                                        //STANDARD POST + VIDEO POST + AUDIO POST + NO FEAT IMG POST (REMEMBER: CHANGES MUST ALSO BE MADE TO AJAX FUNCTION)
                                        if ( ($post_format === false) || ($post_format === "video") || ($post_format === "audio") ) {
                                        ?>
                                            <li id="milestone-<?php echo $timeline_offset+$i; ?>" class="milestone">
                                                <!-- featured image -->
                                                <?php 
                                                    if (empty($cmb_hide_feat_img)) {
                                                        if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
                                                            echo $cmb_media_link;
                                                        } elseif ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id($this_post->ID)) ) {
                                                            echo '<div class="mosaic-block fade">';
                                                            $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID),'full');
                                                            $img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
                                                            printf('<a href="%s" class="mosaic-overlay fancybox-media fancybox.iframe play"></a>', esc_url($cmb_media_link));
                                                            printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                                            echo '</div>';
                                                        } elseif (has_post_thumbnail($this_post->ID) && get_post(get_post_thumbnail_id($this_post->ID)) ) { 
                                                            echo '<div class="mosaic-block fade">';
                                                            $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID),'full');
                                                            $img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
                                                            $img_post = get_post(get_post_thumbnail_id($this_post->ID));
                                                            printf('<a href="%s" class="mosaic-overlay fancybox" title="%s"></a>', esc_url($post_thumbnail_src[0]), esc_attr($img_post->post_title));
                                                            printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                                            echo '</div>';
                                                        }
                                                    }

                                                ?>

                                                <div class="milestone-container">

                                                    <!-- datetime -->
                                                    <h6 class="time-date"><?php echo mb_localize_datetime(get_the_time(get_option('date_format'), $this_post->ID)); ?></h6>
                                                    
                                                    <!-- title -->
                                                    <?php 
                                                        if ($cmb_timeline_link_through == "checked") {
                                                              printf('<h3><a href="%s">%s</a></h3>', esc_url(get_permalink($this_post->ID)), esc_attr($this_post->post_title));
                                                        } else {
                                                              printf('<h3>%s</h3>',esc_attr($this_post->post_title));
                                                        }
                                                    ?>

                                                    <!-- excerpt/content -->
                                                    <?php 

                                                        if ($cmb_timeline_display_content == "checked") {
                                                            echo do_shortcode($this_post->post_content);
                                                        } else {
                                                            if (empty($cmb_excerpt)) { 
                                                                echo mb_make_excerpt($this_post->post_content, $default_excerpt_length, true); 
                                                            } else {
                                                                echo do_shortcode($cmb_excerpt);
                                                            }  
                                                        }
                                                        if ($cmb_timeline_link_through == "checked") { printf('<a class="more" href="%s">%s</a>', esc_url(get_permalink($this_post->ID)), __("more", "loc_canon")); }
                                                    ?>


                                                </div>  
                                            </li>
                                            
                                        <?php
                                        }
                                        //END STANDARD POST + VIDEO POST + AUDIO POST + NO FEAT IMG POST



                                        //QUOTE POST (REMEMBER: CHANGES MUST ALSO BE MADE TO AJAX FUNCTION)
                                        if ( ($post_format == "quote") ) {
                                        ?>
                                            <li id="milestone-<?php echo $timeline_offset+$i; ?>" class="milestone">
                                                <div class="milestone-container">
                                                    <!-- datetime -->
                                                    <h6 class="time-date"><?php echo mb_localize_datetime(get_the_time(get_option('date_format'), $this_post->ID)); ?></h6>

                                                    <!-- title -->
                                                    <?php 
                                                        if ($cmb_timeline_link_through == "checked") {
                                                              printf('<h3><a href="%s">%s</a></h3>', esc_url(get_permalink($this_post->ID)), esc_attr($this_post->post_title));
                                                        } else {
                                                              printf('<h3>%s</h3>',esc_attr($this_post->post_title));
                                                        }
                                                    ?>

                                                    <!-- excerpt/content -->
                                                    <?php 

                                                        if ($cmb_timeline_display_content == "checked") {
                                                            if(!empty($this_post->post_content)) { echo do_shortcode($this_post->post_content); }
                                                        } else {
                                                        ?>
                                                            <blockquote>
                                                                <!-- excerpt -->
                                                                <?php if (empty($cmb_excerpt)) { echo mb_make_excerpt($this_post->post_content, $default_excerpt_length, true); } else {echo do_shortcode($cmb_excerpt);} ?>
                                                                <?php if (!empty($cmb_byline)) { printf('<cite>- %s</cite>', esc_attr($cmb_byline)); } ?>
                                                            </blockquote>
                                                        <?php
                                                        }
                                                        if ($cmb_timeline_link_through == "checked") { printf('<a class="more" href="%s">%s</a>', esc_url(get_permalink($this_post->ID)), __("more", "loc_canon")); }
                                                    ?>
                                                    
                                                </div>
                                            </li>
                                        <?php
                                        }
                                        //END QUOTE POST


                                        //GALLERY POST (REMEMBER: CHANGES MUST ALSO BE MADE TO AJAX FUNCTION)
                                        if ( ($post_format == "gallery") ) {

                                            $args = array(
                                                'post_type' => 'attachment',
                                                'numberposts' => 4,
                                                'post_status' => null,
                                                'post_parent' => $this_post->ID,
                                            );

                                            $post_attachments = get_posts( $args );
                                            $gallery_class_array = array('fourth', 'fourth last-fold', 'fourth', 'fourth last');
                                            $times_to_repeat = 4;
                                            $thumb_counter = 0;

                                        ?>
                                            <li id="milestone-<?php echo $timeline_offset+$i; ?>" class="milestone">
                                                <div class="milestone-container">
                                                    
                                                    <!-- datetime -->
                                                    <h6 class="time-date"><?php echo mb_localize_datetime(get_the_time(get_option('date_format'), $this_post->ID)); ?></h6>

                                                    <!-- title -->
                                                    <?php 
                                                        if ($cmb_timeline_link_through == "checked") {
                                                              printf('<h3><a href="%s">%s</a></h3>', esc_url(get_permalink($this_post->ID)), esc_attr($this_post->post_title));
                                                        } else {
                                                              printf('<h3>%s</h3>',esc_attr($this_post->post_title));
                                                        }
                                                    ?>

                                                    <div class="clearfix gallery">
                                                        <?php 

                                                            if (has_post_thumbnail($this_post->ID) && get_post(get_post_thumbnail_id($this_post->ID)) ) { 
                                                                $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID),'timeline_gallery_thumb_x2');
                                                                $img_post = get_post(get_post_thumbnail_id($this_post->ID));
                                                                printf('<span class="%s"><img src="%s" alt="%s" /></span>', esc_attr($gallery_class_array[$thumb_counter]), esc_url($post_thumbnail_src[0]), esc_attr($img_post->post_title));
                                                                $times_to_repeat = 3;
                                                                $thumb_counter++;
                                                            }

                                                            for ($n = 0; $n < $times_to_repeat; $n++) { 
                                                                if (isset($post_attachments[$n])) {
                                                                    $attachment_src = wp_get_attachment_image_src($post_attachments[$n]->ID, 'timeline_gallery_thumb_x2');
                                                                    $img_post = get_post($post_attachments[$n]->ID);
                                                                    printf('<span class="%s"><img src="%s" alt="%s" /></span>', esc_attr($gallery_class_array[$thumb_counter]), esc_url($attachment_src[0]), esc_attr($img_post->post_title));
                                                                $thumb_counter++;
                                                                } 
                                                            }
                                                        ?>
                                                    </div>  

                                                    <!-- excerpt/content -->
                                                    <?php 

                                                        if ($cmb_timeline_display_content == "checked") {
                                                            echo do_shortcode($this_post->post_content);
                                                        } else {
                                                            if (empty($cmb_excerpt)) { 
                                                                echo mb_make_excerpt($this_post->post_content, $default_excerpt_length, true); 
                                                            } else {
                                                                echo do_shortcode($cmb_excerpt);
                                                            }  
                                                        }
                                                        if ($cmb_timeline_link_through == "checked") { printf('<a class="more" href="%s">%s</a>', esc_url(get_permalink($this_post->ID)), __("more", "loc_canon")); }
                                                    ?>
                                                </div>
                                            </li>
                                            
                                        <?php
                                        }
                                   }

                                ?>

                            </ul>

                    </div>
                    <!-- END TIMELINE CONTAINER -->
                            
                    <hr/>
                            
                    <!-- AJAX LOADER GIF -->
                    <div class="timeline_load_img"><img src="<?php echo get_template_directory_uri(); ?>/img/ajax-loader.gif" alt="ajax-loader-gif"></div>


                    <?php 

                        if ($cmb_timeline_posts_per_page == count($results_query)) {
                        ?>
                        
                            <!-- LOAD MORE BUTTON -->
                            <div class="message timeline_load_more">
                                <h4><?php _e("Load More Posts", "loc_canon"); ?></h4>
                            </div>                  
                                    
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