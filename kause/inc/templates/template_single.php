<?php 

    //GET OPTIONS
    $canon_options_post = get_option('canon_options_post'); 

    //SET DEFAULT
    if (!isset($canon_options_post['post_slider'])) { $canon_options_post['post_slider'] = "automatic"; }

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
    if ( ($canon_options_post['post_slider'] == "off") || ($canon_options_post['post_slider'] == "manual" && empty($select_array)) ) {
         $post_attachments = array();
    } else {
        $post_attachments = get_posts( $args );
    }

    // var_dump($canon_options_post['post_slider']);
    // var_dump($post_attachments);

    //GET CMB DATA
    $cmb_single_style = get_post_meta( $post->ID, 'cmb_single_style', true);
    $cmb_feature = get_post_meta( $post->ID, 'cmb_feature', true);
    $cmb_media_link = get_post_meta( $post->ID, 'cmb_media_link', true);
    $cmb_hide_feat_img = get_post_meta( $post->ID, 'cmb_hide_feat_img', true);

    //DEFAULT STYLE
    if (empty($cmb_single_style)) $cmb_single_style = "full";

    //COUNT POSTS IN SLIDER
    $posts_in_slider = count($post_attachments);

    //FIRST REMOVE "ATTACHED" FEATURED IMAGE FROM EQUATION
    foreach($post_attachments as $key => $value) {
        if (get_post_thumbnail_id(get_the_ID()) == $value->ID) {
            $posts_in_slider--;
        }
     }

    //THEN COUNT RELEVANT FEATURED IMAGE OR MEDIA REPLACEMENT
    if ($cmb_hide_feat_img != "checked") {
        if (has_post_thumbnail(get_the_ID())) {
            $posts_in_slider++;        
        } elseif (!empty($cmb_use_media_link) && !empty($cmb_media_link)) {
            $posts_in_slider++;        
        }
            
    }

    // FEATURE POSITION
    $feature_above_content = true;
    if ($cmb_single_style == "compact" || $cmb_single_style == "compact_sidebar") { $feature_above_content = false; }

    // HAS SIDEBAR
    $has_sidebar = false;
    if ($cmb_single_style == "full_sidebar" || $cmb_single_style == "boxed_sidebar" || $cmb_single_style == "compact_sidebar") { $has_sidebar = true; }


    // SET MAIN CONTENT CLASS
    $main_content_class = "main-content";
    if ($has_sidebar) { $main_content_class .= " three-fourths"; }


?>

    <!-- BEGIN LOOP -->
    <?php while ( have_posts() ) : the_post(); ?>


        <!-- FEATURED IMAGE -->
        <?php 
            if ( ($posts_in_slider > 0) && $feature_above_content ) {
            ?>
                <div class="outter-wrapper feature">

                    <?php if ($cmb_single_style == "boxed" || $cmb_single_style == "boxed_sidebar") { echo '<div class="wrapper feature-boxed">';} ?>

                    <div class="flexslider flexslider_single">
                        <ul class="slides">
                            <?php
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
                            ?>

                        <?php 
                            for ($i = 0; $i < count($post_attachments); $i++) {
                                if ( ( (get_post_thumbnail_id(get_the_ID()) != $post_attachments[$i]->ID) || !has_post_thumbnail(get_the_ID()) ) && get_post($post_attachments[$i]->ID) ) {
                                    $attachment_src = wp_get_attachment_image_src($post_attachments[$i]->ID, 'full');
                                    $img_alt = get_post_meta(get_post_thumbnail_id($post_attachments[$i]->ID), '_wp_attachment_image_alt', true);
                                    $img_post = get_post($post_attachments[$i]->ID);
                                    ?>  
                                        <li>
                                          <a href='<?php echo $attachment_src[0]; ?>' title='<?php echo $img_post->post_title; ?>'><img src="<?php echo $attachment_src[0]; ?>" alt="<?php echo $img_alt; ?>"></a>
                                        </li>
                                    <?php
                                }
                            }

                        ?>
                        </ul>
                    </div>

                    <?php if ($cmb_single_style == "boxed" || $cmb_single_style == "boxed_sidebar") { echo '</div>';} ?>

                </div>

            <?php    
            } else {
            ?>
                <!-- Start Outter Wrapper -->   
                <div class="outter-wrapper feature">
                    <hr/>
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
                    <div class="<?php echo $main_content_class; ?>">



                        <!-- Start Post --> 
                        <div id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>

                            <h1 class="four-fifths right last"><?php the_title(); ?></h1>
                            
                            <!-- META -->
                            <aside class="left-aside left fifth">
                                <ul class="meta">
                                    <?php if (isset($canon_options_post['show_meta_author'])) { if ($canon_options_post['show_meta_author'] == "checked") { ?> <li><?php the_author_posts_link(); ?></li> <?php } } ?>
                                    <?php if (isset($canon_options_post['show_meta_date'])) { if ($canon_options_post['show_meta_date'] == "checked") { ?><li><?php echo mb_localize_datetime(get_the_time(get_option('date_format'))); ?></li> <?php } } ?>
                                    <?php if (isset($canon_options_post['show_meta_comments'])) { if ($canon_options_post['show_meta_comments'] == "checked") { ?> <li><a href="#comments" class="comment"><?php comments_number(__("No comments", "loc_canon"), __("1 comment", "loc_canon"), "% " . __("comments", "loc_canon")); ?></a></li> <?php } } ?>
                                    <?php if (isset($canon_options_post['show_tags'])) { if ($canon_options_post['show_tags'] == "checked") { ?> <li><?php the_tags("",", "); ?></li> <?php } } ?>
                                    	
                                </ul>	
                            </aside> 

                            <div class="four-fifths right last">

                                <!-- FEATURED IMAGE -->
                                <?php 
                                    if ( ($posts_in_slider > 0) && !$feature_above_content ) {
                                    ?>
                                        <div class="compact">

                                            <div class="flexslider flexslider_single">
                                                <ul class="slides">
                                                    <?php
                                                        if ($cmb_hide_feat_img != "checked") {
                                                            if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
                                                                echo "<li>";
                                                                echo $cmb_media_link;
                                                                echo "</li>";
                                                            } elseif ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id(get_the_ID())) ) {
                                                                $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                                                $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                                                $img_post = get_post(get_post_thumbnail_id(get_the_ID()));
                                                                printf("<li><a class='fancybox-media fancybox.iframe' href='%s'><img src='%s' alt='%s'></a></li>", esc_url($cmb_media_link), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                                            } elseif ( has_post_thumbnail(get_the_ID()) && get_post(get_post_thumbnail_id(get_the_ID())) ) { 
                                                                $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                                                $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                                                $img_post = get_post(get_post_thumbnail_id(get_the_ID()));
                                                                printf("<li><a title='%s' href='%s'><img src='%s' alt='%s'></a></li>", esc_attr($img_post->post_title), esc_url($post_thumbnail_src[0]), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                                            }
                                                        }
                                                    ?>

                                                <?php 
                                                    for ($i = 0; $i < count($post_attachments); $i++) {
                                                        if ( (get_post_thumbnail_id(get_the_ID()) != $post_attachments[$i]->ID) || !has_post_thumbnail(get_the_ID() ) && get_post($post_attachments[$i]->ID) ) {
                                                            $attachment_src = wp_get_attachment_image_src($post_attachments[$i]->ID, 'full');
                                                            $img_alt = get_post_meta(get_post_thumbnail_id($post_attachments[$i]->ID), '_wp_attachment_image_alt', true);
                                                            $img_post = get_post($post_attachments[$i]->ID);
                                                            ?>  
                                                                <li>
                                                                  <a href='<?php echo $attachment_src[0]; ?>' title='<?php echo $img_post->post_title; ?>'><img src="<?php echo $attachment_src[0]; ?>" alt="<?php echo $img_alt; ?>"></a>
                                                                </li>
                                                            <?php
                                                        }
                                                    }

                                                ?>
                                                </ul>
                                            </div>

                                        </div>

                                    <?php    
                                    } 
                                ?>


                                <!-- THE CONTENT -->
                                <?php the_content(); ?>
                                <div class="link-pages"><?php wp_link_pages(array('before' => '<p>' . __('Pages:','loc_canon'))); ?></div>

                                <!-- POST PAGINATION -->    
                                <?php if ($canon_options_post['show_post_nav'] == "checked") get_template_part('inc/templates/template_post_pagination'); ?>   

                                <hr/>

                                <!-- COMMENTS --> 
                                  
                                <div class="coms"> 
                                	<?php if ($canon_options_post['show_comments'] == "checked") comments_template( '', true ); ?>
								</div>
                            </div>

                        </div>                  


                    </div>
                    <!-- end main-content -->

                    <!-- SIDEBAR -->
                    <?php if ($has_sidebar) {  get_sidebar("post"); } ?>

                </div>
                <!-- end main wrapper -->
            </div>
             <!-- end main-container -->
        </div>
        <!-- end outter-wrapper -->
    	
    <?php endwhile; ?>
    <!-- END LOOP -->
