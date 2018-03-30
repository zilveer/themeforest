<?php 

    //GET CMB DATA
    $cmb_portfolio_client_name = get_post_meta($post->ID, 'cmb_portfolio_client_name', true);
    $cmb_portfolio_client_url = get_post_meta($post->ID, 'cmb_portfolio_client_url', true);
    $cmb_feature = get_post_meta( $post->ID, 'cmb_feature', true);
    $cmb_media_link = get_post_meta( $post->ID, 'cmb_media_link', true);
    $cmb_hide_feat_img = get_post_meta( $post->ID, 'cmb_hide_feat_img', true);
    $cmb_post_show_post_slider = get_post_meta( $post->ID, 'cmb_post_show_post_slider', true);

    // HANDLE POST SLIDER
    $consolidated_slider_array = array();
    if ($cmb_post_show_post_slider == "checked") {
        $cmb_post_slider_source = get_post_meta( $post->ID, 'cmb_post_slider_source', true);
        $post_slider_array = mb_strip_wp_galleries_to_array($cmb_post_slider_source);
        $consolidated_slider_array = mb_convert_wp_galleries_array_to_consolidated_wp_gallery_array($post_slider_array);
    }


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
                                        <?php if (!empty($cmb_portfolio_client_name)) { printf('<li><a href="%s" target="_blank">%s</a></li>', esc_url($cmb_portfolio_client_url), esc_attr($cmb_portfolio_client_name)); } ?>
                                            
                                    </ul>   

                                    <!-- THE CONTENT -->
                                    <?php the_content(); ?>
                                    <div class="link-pages"><?php wp_link_pages(array('before' => '<p>' . __('Pages:','loc_canon'))); ?></div>

                            </aside> 

                            <div class="four-fifths right last">

                                <div class="flexslider flexslider-standard">
                                    <ul class="slides">
                                        
                                                <?php

                                                    if ($cmb_post_show_post_slider != "checked") {
                                                        
                                                        if ($cmb_hide_feat_img != "checked") {
                                                            if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
                                                                echo "<li>";
                                                                echo $cmb_media_link;
                                                                echo "</li>";
                                                            } elseif ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id(get_the_ID())) ) {
                                                                $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                                                $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                                                printf("<li><a class='fancybox-media fancybox.iframe' href='%s'><img src='%s' alt='%s'></a></li>", esc_url($cmb_media_link), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                                            } elseif ( has_post_thumbnail(get_the_ID()) && get_post(get_post_thumbnail_id(get_the_ID())) ) { 
                                                                $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                                                $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                                                $img_post = get_post(get_post_thumbnail_id(get_the_ID()));
                                                                printf("<li><a title='%s' href='%s'><img src='%s' alt='%s'></a></li>", esc_attr($img_post->post_title), esc_url($post_thumbnail_src[0]), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                                            }
                                                        }
                                                            
                                                    } else {
                                                            
                                                        for ($i = 0; $i < count($consolidated_slider_array); $i++) {  

                                                            $post_thumbnail_src = wp_get_attachment_image_src($consolidated_slider_array[$i]['id'],'full');
                                                            $img_alt = get_post_meta($consolidated_slider_array[$i]['id'], '_wp_attachment_image_alt', true);
                                                            $img_post = get_post($consolidated_slider_array[$i]['id']);
                                                            printf("<li><a title='%s' href='%s'><img src='%s' alt='%s'></a></li>", esc_attr($img_post->post_excerpt), esc_url($post_thumbnail_src[0]), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                                        }
                                                    }

                                                ?>

                                        
                                    </ul>
                                </div>


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

