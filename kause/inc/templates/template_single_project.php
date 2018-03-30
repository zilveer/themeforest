<?php 

    //GET OPTIONS
    $canon_options_post = get_option('canon_options_post'); 

    //SET DEFAULT
    if (!isset($canon_options_post['post_slider'])) { $canon_options_post['post_slider'] = "automatic"; }

    //SETTTINGS
    $cmb_gallery_style = get_post_meta($post->ID, 'cmb_gallery_style', true);
    $cmb_gallery_click = get_post_meta($post->ID, 'cmb_gallery_click', true);
    $cmb_gallery_client_name = get_post_meta($post->ID, 'cmb_gallery_client_name', true);
    $cmb_gallery_client_url = get_post_meta($post->ID, 'cmb_gallery_client_url', true);
    $cmb_media_link = get_post_meta($post->ID, 'cmb_media_link', true);
    $cmb_use_media_link = get_post_meta($post->ID, 'cmb_use_media_link', true);


                                   
    //CREATE ARRAY OF SELECTED ATTACHMENTS
    $cmb_hide_from_post_slider = get_post_meta( $post->ID, 'cmb_hide_from_post_slider', true);

    if (is_array($cmb_hide_from_post_slider)) {
        $select_array = array();   
        foreach($cmb_hide_from_post_slider as $key => $value) {
            if ($value == "checked") { $select_array[] = $key; }
        }
    } else {
        $select_array = array();   
    }

    //GET POST ATTACHMENTS
    $args = array(
        'post_type'         => 'attachment',
        'numberposts'       => -1,
        'post_status'       => null,
        'orderby'           => 'title',
        'order'             => 'ASC',
        'post_parent'       => $post->ID
    );

    // IF AUTOMATIC POST SLIDER USE SELECT ARRAY TO EXCLUDE POSTS
    if ($canon_options_post['post_slider'] == "automatic") {
        $args = array_merge($args, array(
            'post__not_in'      => $select_array,
        ));
    }

    // IF MANUAL POST SLIDER USE SELECT ARRAY TO INCLUDE POSTS
    if ($canon_options_post['post_slider'] == "manual") {
        $args = array_merge($args, array(
            'post__in'      => $select_array,
        ));
    }

    // MAKE QUERY IF POST SLIDER IS NOT SET TO OFF
    if ($canon_options_post['post_slider'] == "off") {
        $post_attachments = array();
    } else {
        $post_attachments = get_posts( $args );
    }


    //GET CMB DATA
    $cmb_single_style = get_post_meta( $post->ID, 'cmb_single_style', true);
    $cmb_feature = get_post_meta( $post->ID, 'cmb_feature', true);
    $cmb_media_link = get_post_meta( $post->ID, 'cmb_media_link', true);
    $cmb_hide_feat_img = get_post_meta( $post->ID, 'cmb_hide_feat_img', true);

    //COUNT POSTS IN SLIDER
    $posts_in_slider = 0;
    if ($cmb_hide_feat_img != "checked") {
        if (has_post_thumbnail($post->ID)) {
            $posts_in_slider++;        
        } elseif (!empty($cmb_use_media_link) && !empty($cmb_media_link)) {
            $posts_in_slider++;        
        }
            
    }
    $posts_in_slider = $posts_in_slider + count($post_attachments);

?>


    <!-- Start Outter Wrapper -->   
    <div class="outter-wrapper feature">
        <hr/>
    </div>  
    <!-- End Outter Wrapper -->     
        
        
    <!-- BEGIN LOOP -->
    <?php while ( have_posts() ) : the_post(); ?>

        <!-- start outter-wrapper -->   
        <div class="outter-wrapper">
            <!-- start main-container -->
            <div class="main-container">
                <!-- start main wrapper -->
                <div class="main wrapper clearfix">
                    <!-- start main-content -->
                    <div class="main-content">
            
            
                        <!-- Start Post --> 
                        <div id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>

                        <!-- Start Meta -->
                            <aside class="left-aside left fifth">
                                    <ul class="meta">
                                        <li><strong><?php the_title(); ?></strong></li>
                                        <?php if ($canon_options_post['show_meta_author'] == "checked") { ?> <li><?php the_author_posts_link(); ?></li> <?php } ?>
                                        <?php if ($canon_options_post['show_meta_date'] == "checked") { ?><li><?php echo mb_localize_datetime(get_the_time(get_option('date_format'))); ?></li> <?php } ?>
                                        <?php if ($canon_options_post['show_tags'] == "checked") { ?> <li><?php the_tags("",", "); ?></li> <?php } ?>
                                            
                                    </ul>   

                                    <!-- THE CONTENT -->
                                    <?php the_content(); ?>
                                    <div class="link-pages"><?php wp_link_pages(array('before' => '<p>' . __('Pages:','loc_canon'))); ?></div>

                            </aside> 

                            <div class="four-fifths right last">


                                    <?php 
                                        if ( ($posts_in_slider > 0) ) {

                                            if ($cmb_hide_feat_img != "checked") {
                                                if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
                                                    echo $cmb_media_link;
                                                } elseif ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id(get_the_ID())) ) {
                                                    echo '<div class="mosaic-block fade">';
                                                    $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                                    $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                                    printf('<a href="%s" class="mosaic-overlay fancybox-media fancybox.iframe"></a>', esc_url($cmb_media_link));
                                                    printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                                    echo '</div>';
                                                } elseif (has_post_thumbnail(get_the_ID()) && get_post(get_post_thumbnail_id(get_the_ID())) ) { 
                                                    echo '<div class="mosaic-block fade">';
                                                    $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                                    $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                                    $img_post = get_post(get_post_thumbnail_id(get_the_ID()));
                                                    printf('<a href="%s" class="mosaic-overlay fancybox" title="%s"></a>', esc_url($post_thumbnail_src[0]), esc_attr($img_post->post_title));
                                                    printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                                    echo '</div>';
                                                }
                                            }

                                            for ($i = 0; $i < count($post_attachments); $i++) {
                                                if ( ( get_post_thumbnail_id(get_the_ID()) != $post_attachments[$i]->ID || !has_post_thumbnail(get_the_ID()) ) && get_post($post_attachments[$i]->ID) ) {
                                                    echo '<div class="mosaic-block fade">';
                                                    $post_thumbnail_src = wp_get_attachment_image_src($post_attachments[$i]->ID,'full');
                                                    $img_alt = get_post_meta($post_attachments[$i]->ID, '_wp_attachment_image_alt', true);
                                                    $img_post = get_post($post_attachments[$i]->ID);
                                                    printf('<a href="%s" class="mosaic-overlay fancybox" title="%s"></a>', esc_url($post_thumbnail_src[0]), esc_attr($img_post->post_title));
                                                    printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                                    echo '</div>';
                                                }
                                            }

                                        } 
                                    ?>


                            </div>

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
    <!-- END LOOP -->

