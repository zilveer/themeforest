<?php 

    //GET OPTIONS
    $canon_options_post = get_option('canon_options_post'); 

    // VARS
    $default_excerpt_length = 580;


?>

                        <!-- MAIN LOOP -->
                        <?php while ( have_posts() ) : the_post(); ?>

                        <?php 

                            $post_format = get_post_format();
                            $cmb_excerpt = get_post_meta(get_the_ID(), 'cmb_excerpt', true);
                            $cmb_byline = get_post_meta(get_the_ID(), 'cmb_byline', true);
                            $cmb_feature = get_post_meta(get_the_ID(), 'cmb_feature', true);
                            $cmb_media_link = get_post_meta(get_the_ID(), 'cmb_media_link', true);
                            $cmb_quote_is_tweet = get_post_meta($post->ID, 'cmb_quote_is_tweet', true);

                        ?>

                        <?php 

                            //STANDARD POST + VIDEO POST + AUDIO POST + NO FEAT IMG POST
                            if ( ($post_format === false) || ($post_format === "video") || ($post_format === "audio") ) {

                            ?>
                                <div id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>

                                    <!-- title -->
                                    <h1 class="four-fifths right last"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

                                    <!-- meta -->
                                    <aside class="left-aside left fifth">
                                        <ul class="meta">
                                            <?php if (isset($canon_options_post['show_meta_author'])) { if ($canon_options_post['show_meta_author'] == "checked") { ?> <li><?php the_author_posts_link(); ?></li> <?php } } ?>
                                            <?php if (isset($canon_options_post['show_meta_date'])) { if ($canon_options_post['show_meta_date'] == "checked") { ?><li><?php echo mb_localize_datetime(get_the_time(get_option('date_format'))); ?></li> <?php } } ?>
                                            <?php if (isset($canon_options_post['show_meta_comments'])) { if ($canon_options_post['show_meta_comments'] == "checked") { ?> <li><a href="<?php the_permalink(); ?>#comments" class="comment"><?php comments_number(__("No comments", "loc_canon"), __("1 comment", "loc_canon"), "% " . __("comments", "loc_canon")); ?></a></li> <?php } } ?>
                                            <?php if (isset($canon_options_post['show_tags'])) { if ($canon_options_post['show_tags'] == "checked") { ?> <li><?php the_tags("",", "); ?></li> <?php } } ?>
                                        </ul> 
                                    </aside> 

                                    <div class="four-fifths right last">

                                        <!-- featured image -->
                                        <?php 
                                            if (empty($cmb_hide_feat_img)) {
                                                if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
                                                    echo $cmb_media_link;
                                                } elseif ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id(get_the_ID())) ) {
                                                    echo '<div class="mosaic-block fade">';
                                                    $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                                    $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                                    printf('<a href="%s" class="mosaic-overlay fancybox-media fancybox.iframe play"></a>', esc_url($cmb_media_link));
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

                                        ?>

                                        <!-- excerpt -->
                                        <?php if (empty($cmb_excerpt)) { echo mb_make_excerpt(get_the_content(), $default_excerpt_length, true); } else {echo do_shortcode($cmb_excerpt);} ?>

                                        <!-- read more -->
                                        <p><a href="<?php the_permalink(); ?>" class="btn"><?php _e('Read More', 'loc_canon'); ?></a></p>

                                    </div>

                                </div>  

                                <hr/>
                            <?php    
                            }
                            // END STANDARD POST


                            //QUOTE POST
                            if ( ($post_format == "quote") ) {

                            ?>
                                <div id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>

                                    <!-- meta -->
                                    <aside class="left-aside left fifth">
                                        <ul class="meta">
                                            <?php if (isset($canon_options_post['show_meta_author'])) { if ($canon_options_post['show_meta_author'] == "checked") { ?> <li><?php the_author_posts_link(); ?></li> <?php } } ?>
                                            <?php if (isset($canon_options_post['show_meta_date'])) { if ($canon_options_post['show_meta_date'] == "checked") { ?><li><?php echo mb_localize_datetime(get_the_time(get_option('date_format'))); ?></li> <?php } } ?>
                                            <?php if (isset($canon_options_post['show_meta_comments'])) { if ($canon_options_post['show_meta_comments'] == "checked") { ?> <li><?php comments_number(__("No comments", "loc_canon"), __("1 comment", "loc_canon"), "% " . __("comments", "loc_canon")); ?></li> <?php } } ?>
                                            <?php if (isset($canon_options_post['show_tags'])) { if ($canon_options_post['show_tags'] == "checked") { ?> <li><?php the_tags("",", "); ?></li> <?php } } ?>
                                        </ul> 
                                    </aside> 

                                    <div class="four-fifths right last">
                                        <blockquote class="<?php if ($cmb_quote_is_tweet == "checked") { echo "post-type-tweet";} else { echo "post-type-quote";} ?>">
                                            <?php if (empty($cmb_excerpt)) { echo mb_make_excerpt(get_the_content(), $default_excerpt_length, true); } else {echo $cmb_excerpt;} ?>
                                            <?php if (!empty($cmb_byline)) { printf('<cite>- %s</cite>', esc_attr($cmb_byline)); } ?>
                                        </blockquote>       
                                    </div>

                                </div>

                                <hr/>

                            <?php    
                            }
                            // END QUOTE POST


                            //GALLERY POST
                            if ( ($post_format == "gallery") ) {

                                $args = array(
                                    'post_type' => 'attachment',
                                    'numberposts' => -1,
                                    'post_status' => null,
                                    'post_parent' => get_the_ID()
                                );

                                $post_attachments = get_posts( $args );

                            ?>
                                <div id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>

                                    <!-- title -->
                                    <h1 class="four-fifths right last"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

                                    <!-- meta -->
                                    <aside class="left-aside left fifth">
                                        <ul class="meta">
                                            <?php if (isset($canon_options_post['show_meta_author'])) { if ($canon_options_post['show_meta_author'] == "checked") { ?> <li><?php the_author_posts_link(); ?></li> <?php } } ?>
                                            <?php if (isset($canon_options_post['show_meta_date'])) { if ($canon_options_post['show_meta_date'] == "checked") { ?><li><?php echo mb_localize_datetime(get_the_time(get_option('date_format'))); ?></li> <?php } } ?>
                                            <?php if (isset($canon_options_post['show_meta_comments'])) { if ($canon_options_post['show_meta_comments'] == "checked") { ?> <li><a href="<?php the_permalink(); ?>#comments" class="comment"><?php comments_number(__("No comments", "loc_canon"), __("1 comment", "loc_canon"), "% " . __("comments", "loc_canon")); ?></a></li> <?php } } ?>
                                            <?php if (isset($canon_options_post['show_tags'])) { if ($canon_options_post['show_tags'] == "checked") { ?> <li><?php the_tags("",", "); ?></li> <?php } } ?>
                                        </ul> 
                                    </aside> 

                                    <div class="four-fifths right last">

                                        <!-- featured image -->
                                        <div class="flexslider flexslider_blog">
                                            <ul class="slides">

                                                <?php
                                                    if (empty($cmb_hide_feat_img)) {
                                                        if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
                                                            echo "<li>";
                                                            echo $cmb_media_link;
                                                            echo "</li>";
                                                        } elseif ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id(get_the_ID())) ) {
                                                            $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                                            $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                                            $img_post = get_post(get_post_thumbnail_id(get_the_ID()));
                                                            $featured_img_width = 741;
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

                                        <!-- excerpt -->
                                        <?php if (empty($cmb_excerpt)) { echo mb_make_excerpt(get_the_content(), $default_excerpt_length, true); } else {echo do_shortcode($cmb_excerpt);} ?>

                                        <!-- read more -->
                                        <p><a href="<?php the_permalink(); ?>" class="btn"><?php _e('Read More', 'loc_canon'); ?></a></p>

                                    </div>

                                </div>  

                                <hr/>
                            <?php    
                            }
                            // END GALLERY POST



                        

                        ?>

                        
                        <?php endwhile; ?>
                        <!-- END LOOP -->

                        <!-- PAGINATION -->
                        <?php get_template_part("inc/templates/template_paginate_links"); ?>
