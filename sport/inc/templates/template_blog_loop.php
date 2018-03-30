<?php 

    //GET OPTIONS
    $canon_options_post = get_option('canon_options_post'); 

    // VARS
    $archive_excerpt_length = (!empty($canon_options_post['archive_excerpt_length'])) ? $canon_options_post['archive_excerpt_length'] : 325;


?>

                        <!-- MAIN LOOP -->
                        <?php while ( have_posts() ) : the_post(); ?>

                        <?php 

                            $post_format = get_post_format();
                            $cmb_excerpt = get_post_meta(get_the_ID(), 'cmb_excerpt', true);
                            $cmb_byline = get_post_meta(get_the_ID(), 'cmb_byline', true);
                            $cmb_feature = get_post_meta(get_the_ID(), 'cmb_feature', true);
                            $cmb_media_link = get_post_meta(get_the_ID(), 'cmb_media_link', true);
                            $cmb_quote_is_tweet = get_post_meta(get_the_ID(), 'cmb_quote_is_tweet', true);
                            $has_feature = mb_has_feature(get_the_ID());

                        ?>

                        <?php 

                            //STANDARD POST + VIDEO POST + AUDIO POST + NO FEAT IMG POST
                            if ( ($post_format === false) || ($post_format === "video") || ($post_format === "audio") ) {

                            ?>
                                <div id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>
									
                                     <!-- featured image -->
                                    <?php 
                                        if ($has_feature) {

                                            echo '<div class="third feat-image-post">';

                                            if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
                                                echo $cmb_media_link;
                                            } else {
                                                $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                                $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                                $img_post = get_post(get_post_thumbnail_id(get_the_ID()));

                                                if ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id(get_the_ID())) ) {
                                                    echo '<div class="mosaic-block fade">';
                                                    printf('<a href="%s" class="mosaic-overlay fancybox-media fancybox.iframe play"></a>', esc_url($cmb_media_link));
                                                    printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                                    echo '</div>';
                                                } elseif (has_post_thumbnail(get_the_ID()) && get_post(get_post_thumbnail_id(get_the_ID())) ) { 
                                                    echo '<div class="mosaic-block fade">';
                                                    printf('<a href="%s" class="mosaic-overlay link" title="%s"></a>', esc_url(get_permalink(get_the_ID())), esc_attr($img_post->post_title));
                                                    printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                                    echo '</div>';
                                                }
                                            }

                                            echo '</div>';
                                        }

                                    ?>

									
									<div class="blogroll-post <?php if ($has_feature) { echo "two-thirds last"; } else { echo "full"; } ?>">

										<!-- title -->
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										
										<!-- excerpt -->
										<?php if (empty($cmb_excerpt)) { echo mb_make_excerpt(get_the_content(), $archive_excerpt_length, true); } else {echo do_shortcode($cmb_excerpt);} ?>
										
                                        <!-- read more -->
										<a href="<?php the_permalink(); ?>" class="more"><?php _e('More', 'loc_canon'); ?></a>

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

                                    <blockquote class="<?php if ($cmb_quote_is_tweet == "checked") { echo "post-type-tweet";} else { echo "post-type-quote";} ?>">
                                        <?php if (empty($cmb_excerpt)) { echo mb_make_excerpt(get_the_content(), $archive_excerpt_length, true); } else {echo do_shortcode($cmb_excerpt);} ?>
                                        <?php if (!empty($cmb_byline)) { printf('<cite>- %s</cite>', esc_attr($cmb_byline)); } ?>
                                    </blockquote> 
                                    
                                </div>

                                <hr/>

                            <?php    
                            }
                            // END QUOTE POST


                            //GALLERY POST
                            if ( ($post_format == "gallery") ) {

                                // HANDLE POST SLIDER
                                $consolidated_slider_array = array();

                                $cmb_post_slider_source = get_post_meta( get_the_ID(), 'cmb_post_slider_source', true);
                                $post_slider_array = mb_strip_wp_galleries_to_array($cmb_post_slider_source);
                                $consolidated_slider_array = mb_convert_wp_galleries_array_to_consolidated_wp_gallery_array($post_slider_array);

                            ?>
                                <div id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>
									
									
                                    <!-- FEATURED MEDIA -->
                                    <?php
                                        

                                        if (empty($consolidated_slider_array)) {
                                            
                                            if ($has_feature) {

                                                echo '<div class="third feat-image-post">';

                                                // FEATURED IMAGE
                                                if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
                                                    echo $cmb_media_link;
                                                } else {
                                                    $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                                    $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                                    $img_post = get_post(get_post_thumbnail_id(get_the_ID()));

                                                    if ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id(get_the_ID())) ) {

                                                        echo '<div class="mosaic-block fade">';
                                                        printf('<a href="%s" class="mosaic-overlay fancybox-media fancybox.iframe play"></a>', esc_url($cmb_media_link));
                                                        printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                                        echo "</div>";
                                                    
                                                    } elseif (has_post_thumbnail(get_the_ID()) && get_post(get_post_thumbnail_id(get_the_ID())) ) { 

                                                        echo '<div class="mosaic-block fade">';
                                                        printf('<a href="%s" class="mosaic-overlay link" title="%s"></a>', esc_url(get_permalink(get_the_ID())), esc_attr($img_post->post_title));
                                                        printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                                        echo "</div>";
                                                    }
                                                }

                                                echo "</div>";

                                            }
                                                
                                        } else {
                                                
                                            echo '<div class="third feat-image-post">';
                                            echo '<div class="flexslider flexslider-standard"><ul class="slides">';
                                            for ($i = 0; $i < count($consolidated_slider_array); $i++) {  

                                                $post_thumbnail_src = wp_get_attachment_image_src($consolidated_slider_array[$i]['id'],'full');
                                                $img_alt = get_post_meta($consolidated_slider_array[$i]['id'], '_wp_attachment_image_alt', true);
                                                $img_post = get_post($consolidated_slider_array[$i]['id']);

                                                printf("<li><a title='%s' href='%s'><img src='%s' alt='%s'></a></li>", esc_attr($img_post->post_excerpt), esc_url(get_the_permalink()), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                            }
                                            echo '</ul></div>';
                                            echo '</div>';
                                            
                                        }


                                    ?>
									
									<div class="blogroll-post two-thirds last">

										<!-- title -->
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										
										<!-- excerpt -->
										<?php if (empty($cmb_excerpt)) { echo mb_make_excerpt(get_the_content(), $archive_excerpt_length, true); } else {echo do_shortcode($cmb_excerpt);} ?>
										
										 <!-- read more -->
										 <a href="<?php the_permalink(); ?>" class="more"><?php _e('More', 'loc_canon'); ?></a>
										
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
