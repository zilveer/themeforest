<?php

    /*
    *
    *	Swift Page Builder - Post Format Output Functions
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	sf_get_post_media()
    *	sf_get_post_format_image_src()
    *	sf_image_post()
    *	sf_video_post()
    *	sf_gallery_post()
    *	sf_gallery_stacked_post()
    *	sf_audio_post()
    *	sf_sh_video_post()
    *	sf_link_post()
    *	sf_chat_post()
    *	sf_get_post_item()
    *	sf_post_thumbnail()
    *	sf_post_item_link()
    *	sf_get_masonry_post()
    *	sf_get_mini_post()
    *	sf_get_timeline_post()
    *	sf_get_standard_post()
    *	sf_build_post_object()
    *	sf_get_post_details()
    *	sf_get_recent_post_item()
    *	sf_get_search_item()
    *	sf_get_campaign_item()
    *
    */


    /* MAIN GET MEDIA FUNCTION
    ================================================== */
    if ( ! function_exists( 'sf_get_post_media' ) ) {
        function sf_get_post_media( $postID, $media_width, $media_height, $video_height, $use_thumb_content ) {

            $format     = get_post_format( $postID );
            $post_media = "";

            if ( $format == "image" ) {
                $post_media = sf_image_post( $postID, $media_width, $media_height, $use_thumb_content );
            } else if ( $format == "video" ) {
                $post_media = sf_video_post( $postID, $media_width, $video_height, $use_thumb_content );
            } else if ( $format == "gallery" ) {
                $post_media = sf_gallery_post( $postID, $use_thumb_content );
            } else if ( $format == "audio" ) {
                $post_media = sf_audio_post( $postID );
            } else if ( $format == "link" ) {
                $post_media = sf_link_post( $postID );
            } else if ( $format == "chat" ) {
                $post_media = sf_chat_post( $postID );
            }

            return $post_media;

        }
    }


    /* GET IMAGE MEDIA
    ================================================== */
    if ( ! function_exists( 'sf_get_post_format_image_src' ) ) {
        function sf_get_post_format_image_src( $post_id ) {
            $format_meta = get_post_format_meta( $post_id );
            $match       = array();
            if ( $format_meta['image'] != "" ) {
                preg_match( '/<img.*?src="([^"]+)"/s', $format_meta['image'], $match );

                return $match[1];
            }
        }
    }
	
    if ( ! function_exists( 'sf_image_post' ) ) {
        function sf_image_post( $postID, $media_width, $media_height, $use_thumb_content, $return_url = false ) {

            $image = $media_image_url = $image_id = "";

            if ( $use_thumb_content ) {
                $media_image = rwmb_meta( 'sf_thumbnail_image', 'type=image&size=full', $postID );
            } else {
                $media_image = rwmb_meta( 'sf_detail_image', 'type=image&size=full', $postID );
            }

            foreach ( $media_image as $detail_image ) {
                $image_id        = $detail_image['ID'];
                $media_image_url = $detail_image['url'];
                break;
            }

            if ( ! $media_image ) {
                $media_image     = get_post_thumbnail_id();
                $image_id        = $media_image;
                $media_image_url = wp_get_attachment_url( $media_image, 'full' );
            }

            $detail_image = sf_aq_resize( $media_image_url, $media_width, $media_height, true, false );
                        
            $image_meta 		= sf_get_attachment_meta( $image_id );
            $image_caption = $image_alt = $image_title = $caption_html = "";
            if ( isset($image_meta) ) {
            	$image_caption 		= esc_attr( $image_meta['caption'] );
            	$image_title 		= esc_attr( $image_meta['title'] );
            	$image_alt 			= esc_attr( $image_meta['alt'] );
            }
            
            if ( $detail_image ) {
                $image = '<img src="' . $detail_image[0] . '" width="' . $detail_image[1] . '" height="' . $detail_image[2] . '" alt="' . $image_alt . '" />';
            }

            if ( $return_url && $detail_image ) {
                return $detail_image[0];
            } else {
                return $image;
            }

        }
    }


    /* GET VIDEO MEDIA
    ================================================== */
    if ( ! function_exists( 'sf_video_post' ) ) {
        function sf_video_post( $postID, $media_width, $video_height, $use_thumb_content ) {

            $video = $media_video = "";

            if ( $use_thumb_content ) {
                $media_video = sf_get_post_meta( $postID, 'sf_thumbnail_video_url', true );
            } else {
                $media_video = sf_get_post_meta( $postID, 'sf_detail_video_url', true );
            }

            $video = sf_video_embed( $media_video, $media_width, $video_height );

            return $video;
        }
    }


    /* GET GALLERY MEDIA
    ================================================== */
    if ( ! function_exists( 'sf_gallery_post' ) ) {
        function sf_gallery_post( $postID, $use_thumb_content ) {

            $gallery = '<div class="flexslider item-slider">' . "\n";
            $gallery .= '<ul class="slides">' . "\n";

            if ( $use_thumb_content ) {
                $media_gallery = rwmb_meta( 'sf_thumbnail_gallery', 'type=image&size=full-width-image-gallery', $postID );
            } else {
                $media_gallery = rwmb_meta( 'sf_detail_gallery', 'type=image&size=full-width-image-gallery', $postID );
            }

            foreach ( $media_gallery as $image ) {
                $gallery .= "<li><img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' /></li>";
            }

            $gallery .= '</ul>' . "\n";
            $gallery .= '</div>' . "\n";

            return $gallery;
        }
    }


    /* GET STACKED GALLERY MEDIA
    ================================================== */
    if ( ! function_exists( 'sf_gallery_stacked_post' ) ) {
        function sf_gallery_stacked_post( $postID, $use_thumb_content ) {

            $media_gallery = rwmb_meta( 'sf_detail_gallery', 'type=image&size=full-width-image-gallery', $postID );

            $gallery_stacked = '' . "\n";

            foreach ( $media_gallery as $image ) {
                $gallery_stacked .= "<img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' />";
            }

            return $gallery_stacked;
        }
    }


    /* GET AUDIO MEDIA
    ================================================== */
    if ( ! function_exists( 'sf_audio_post' ) ) {
        function sf_audio_post( $postID, $use_thumb_content ) {
            $media_audio = "";
            if ( $use_thumb_content ) {
                $media_audio = sf_get_post_meta( $postID, 'sf_thumbnail_audio_url', true );
            } else {
                $media_audio = sf_get_post_meta( $postID, 'sf_detail_audio_url', true );
            }

            $audio = do_shortcode( '[audio src="' . $media_audio . '"]' );

            return $audio;
        }
    }


    /* GET SELF HOSTED VIDEO MEDIA
    ================================================== */
    if ( ! function_exists( 'sf_sh_video_post' ) ) {
        function sf_sh_video_post( $postID, $video_width = null, $video_height = null, $use_thumb_content = false ) {
            $media_mp4 = $media_ogg = $media_webm = "";
            $poster    = wp_get_attachment_image_src( get_post_thumbnail_id( $postID ), 'large', true );
            if ( isset( $poster ) & $poster != "" ) {
                $poster = 'poster="' . $poster[0] . '"';
            }

            if ( $use_thumb_content ) {
                $media_mp4  = sf_get_post_meta( $postID, 'sf_thumbnail_video_mp4', true );
                $media_ogg  = sf_get_post_meta( $postID, 'sf_thumbnail_video_ogg', true );
                $media_webm = sf_get_post_meta( $postID, 'sf_thumbnail_video_webm', true );
            } else {
                $media_mp4  = sf_get_post_meta( $postID, 'sf_detail_video_mp4', true );
                $media_ogg  = sf_get_post_meta( $postID, 'sf_detail_video_ogg', true );
                $media_webm = sf_get_post_meta( $postID, 'sf_detail_video_webm', true );
            }

            $video = '<div class="video-thumb">';
            $video .= '<video preload="auto" width="' . $video_width . '" height="' . $video_height . '" ' . $poster . ' controls>';
            if ( $media_webm != "" ) {
                $video .= '<source src="' . $media_webm . '" type="video/webm">';
            }
            if ( $media_mp4 != "" ) {
                $video .= '<source src="' . $media_mp4 . '" type="video/mp4">';
            }
            if ( $media_ogg != "" ) {
                $video .= '<source src="' . $media_ogg . '" type="video/ogv">';
            }
            $video .= '</video>';
            $video .= '</div>';

            return $video;
        }
    }


    /* GET LINK MEDIA
    ================================================== */
    if ( ! function_exists( 'sf_link_post' ) ) {
        function sf_link_post( $postID ) {

            $link = "";
            $link_icon = apply_filters( 'sf_link_icon', '<i class="ss-link"></i>' );

            if ( function_exists( 'get_the_post_format_url' ) ) {
                $link = get_the_post_format_url();
                $link = '<a href="' . esc_url( $link ) . '" target="_blank" class="link-post-link">'. $link_icon . $link . '</a>';
            }

            return $link;
        }
    }


    /* GET CHAT MEDIA
    ================================================== */
    if ( ! function_exists( 'sf_chat_post' ) ) {
        function sf_chat_post( $postID ) {

            $chat = "";

            if ( function_exists( 'get_the_post_format_chat' ) ) {

                $chat    = '<dl class="chat">';
                $stanzas = get_the_post_format_chat();

                foreach ( $stanzas as $stanza ) {
                    foreach ( $stanza as $row ) {
                        $time = '';
                        if ( ! empty( $row['time'] ) ) {
                            $time = sprintf( '<time class="chat-timestamp">%s</time>', esc_html( $row['time'] ) );
                        }

                        $chat .= sprintf(
                            '<dt class="chat-author chat-author-%1$s vcard">%2$s <cite class="fn">%3$s</cite>: </dt>
								<dd class="chat-text">%4$s</dd>
							',
                            esc_attr( sanitize_title_with_dashes( $row['author'] ) ), // Slug.
                            $time,
                            esc_html( $row['author'] ),
                            $row['message']
                        );
                    }
                }

                $chat .= '</dl><!-- .chat -->';

            }

            return $chat;
        }
    }

    /* GET POST ITEM
    ================================================== */
    if ( ! function_exists( 'sf_get_post_item' ) ) {
        function sf_get_post_item( $postID, $blog_type, $show_title = "yes", $show_excerpt = "yes", $show_details = "yes", $excerpt_length = "20", $content_output = "excerpt", $show_read_more = "yes", $fullwidth = "no" ) {

            $post_item = $image_id = "";

            global $sf_options, $sf_sidebar_config;

            $single_author = $sf_options['single_author'];
            $remove_dates  = $sf_options['remove_dates'];
            $post_links_match_thumb = false;
            if ( isset( $sf_options['post_links_match_thumb'] ) ) {
            	$post_links_match_thumb = $sf_options['post_links_match_thumb'];	
            }

            $post_format = get_post_format( $postID );
            if ( $post_format == "" ) {
                $post_format = 'standard';
            }

            if ( $blog_type == "masonry" ) {
                $content_output = "excerpt";
            }

            $comments_icon 	 = apply_filters( 'sf_comments_icon', '<i class="ss-chat"></i>' );
			$link_icon		 = apply_filters( 'sf_link_icon', '<i class="ss-link"></i>' );
			$sticky_icon   	 = apply_filters( 'sf_sticky_icon', '<i class="ss-bookmark"></i>' );

            $post_type       = get_post_type( $postID );
            $post_title      = get_the_title();
            $post_author     = get_the_author();
            $post_date       = get_the_date();
            $post_date_str   = get_the_date('Y-m-d');
            $post_categories = get_the_category_list( ', ' );
            $post_comments   = get_comments_number();
            $post_permalink  = get_permalink();
            $custom_excerpt  = sf_get_post_meta( $postID, 'sf_custom_excerpt', true );
            $post_excerpt    = '';
            if ( $content_output == "excerpt" ) {
                if ( $custom_excerpt != '' ) {
                    $post_excerpt = sf_custom_excerpt( $custom_excerpt, $excerpt_length );
                } else {
                    if ( $post_format == "quote" ) {
                        $post_excerpt = sf_get_the_content_with_formatting();
                    } else {
                        $post_excerpt = sf_excerpt( $excerpt_length );
                    }
                }
            } else {
                $post_excerpt = sf_get_the_content_with_formatting();
            }
            if ( $post_format == "chat" ) {
                $post_excerpt = sf_content( 40 );
            } else if ( $post_format == "audio" ) {
                $post_excerpt = do_shortcode( get_the_content() );
            } else if ( $post_format == "video" ) {
                $content      = get_the_content();
                $content      = apply_filters( 'the_content', $content );
                $post_excerpt = $content;
            } else if ( $post_format == "link" ) {
                $content      = get_the_content();
                $content      = apply_filters( 'the_content', $content );
                $post_excerpt = $content;
            }
            $post_permalink_config = 'href="' . $post_permalink . '" class="link-to-post"';
            if ( $post_links_match_thumb ) {
            	$link_config = sf_post_item_link();
            	$post_permalink_config = $link_config['config'];
            }
            $thumb_type         = sf_get_post_meta( $postID, 'sf_thumbnail_type', true );
            $download_button    = sf_get_post_meta( $postID, 'sf_download_button', true );
            $download_file      = sf_get_post_meta( $postID, 'sf_download_file', true );
            $download_text      = apply_filters( 'sf_post_download_text', __( "Download", "swiftframework" ) );
            $download_shortcode = sf_get_post_meta( $postID, 'sf_download_shortcode', true );

            // BOLD STYLING
            if ( $blog_type == "bold" ) {

                $post_item .= '<div class="bold-item-wrap">';

                if ( $show_title == "yes" && $post_format != "quote" && $post_format != "link" ) {
                    $post_item .= '<h1 itemprop="name headline"><a ' . $post_permalink_config . '>' . $post_title . '</a></h1>';
                } else if ( $post_format == "quote" ) {
                    $post_item .= '<div class="quote-excerpt" itemprop="name headline"><a ' . $post_permalink_config . '>' . $post_excerpt . '</a></div>';
                } else if ( $post_format == "link" ) {
                    $post_item .= '<h3 itemprop="name headline"><a ' . $post_permalink_config . '>' . $post_title . '</a></h3>';
                }

                if ( $show_excerpt == "yes" && $post_format != "quote" ) {
                    $post_item .= '<div class="excerpt" itemprop="description">' . $post_excerpt . '</div>';
                }

                if ( $show_details == "yes" ) {
                    if ( $single_author && !$remove_dates ) {
                        $post_item .= '<div class="blog-item-details">' . sprintf( __( '<span>In %1$s</span> <time class="date" datetime="%2$s">%3$s</time>', 'swiftframework' ), $post_categories, $post_date_str, $post_date ) . '</div>';
                    } else if ( ! $remove_dates ) {
                        $post_item .= '<div class="blog-item-details">' . sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> <span>in %3$s</span> <time class="date" datetime="%4$s">%5$s</time>', 'swiftframework' ), $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) ), $post_categories, $post_date_str, $post_date ) . '</div>';
                    } else if ( ! $single_author ) {
                        $post_item .= '<div class="blog-item-details">' . sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> <span>in %3$s</span>', 'swiftframework' ), $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) ), $post_categories ) . '</div>';
                    }
                }

                $post_item .= '</div>';

            } else if ( $blog_type == "masonry" ) {

				$post_item = sf_get_masonry_post( $postID, $thumb_type, $fullwidth, $show_title, $show_excerpt, $show_details, $show_read_more, $content_output, $excerpt_length );

            // MINI STYLING
            } else if ( $blog_type == "mini" ) {
				
                $post_item = sf_get_mini_post( $postID, $thumb_type, $fullwidth, $show_title, $show_excerpt, $show_details, $show_read_more, $content_output, $excerpt_length );
			
			// TIMELINE STYLING
			} else if ( $blog_type == "timeline" ) {
				
			    $post_item = sf_get_timeline_post( $postID, $thumb_type, $fullwidth, $show_title, $show_excerpt, $show_details, $show_read_more, $content_output, $excerpt_length );
			
            // STANDARD STYLING
            } else {

            	$post_item = sf_get_standard_post( $postID, $thumb_type, $fullwidth, $show_title, $show_excerpt, $show_details, $show_read_more, $content_output, $excerpt_length );
          
            }

            return $post_item;
        }
    }


    /* POST THUMBNAIL
    ================================================== */
    if ( ! function_exists( 'sf_post_thumbnail' ) ) {
        function sf_post_thumbnail( $blog_type = "", $fullwidth = "no" ) {

            global $post, $sf_sidebar_config;

            $thumb_width = $thumb_height = $video_height = $gallery_size = $item_figure = '';

            if ( $blog_type == "mini" ) {
                if ( $sf_sidebar_config == "no-sidebars" ) {
                    $thumb_width  = 446;
                    $thumb_height = null;
                    $video_height = 335;
                } else {
                    $thumb_width  = 370;
                    $thumb_height = null;
                    $video_height = 260;
                }
                $gallery_size = 'thumb-image';
            } else if ( $blog_type == "masonry" ) {
                if ( $sf_sidebar_config == "both-sidebars" || $fullwidth == "yes" ) {
                    $item_class = "col-sm-3";
                } else {
                    $item_class = "col-sm-4";
                }
                $thumb_width  = 480;
                $thumb_height = null;
                $video_height = 360;
                $gallery_size = 'thumb-image';
            } else {
                $thumb_width  = 970;
                $thumb_height = null;
                $video_height = 728;
                $gallery_size = 'blog-image';
            }


            $thumb_type               = sf_get_post_meta( $post->ID, 'sf_thumbnail_type', true );
            $thumb_image              = rwmb_meta( 'sf_thumbnail_image', 'type=image&size=full' );
            $thumb_video              = sf_get_post_meta( $post->ID, 'sf_thumbnail_video_url', true );
            $thumb_gallery            = rwmb_meta( 'sf_thumbnail_gallery', 'type=image&size=' . $gallery_size );
            $thumb_link_type          = sf_get_post_meta( $post->ID, 'sf_thumbnail_link_type', true );
            $thumb_link_url           = sf_get_post_meta( $post->ID, 'sf_thumbnail_link_url', true );
            $thumb_lightbox_thumb     = rwmb_meta( 'sf_thumbnail_image', 'type=image&size=large' );
            $thumb_lightbox_image     = rwmb_meta( 'sf_thumbnail_link_image', 'type=image&size=large' );
            $thumb_lightbox_video_url = sf_get_post_meta( $post->ID, 'sf_thumbnail_link_video_url', true );
            $thumb_lightbox_video_url = sf_get_embed_src( $thumb_lightbox_video_url );
            $image_id                 = 0;
            $item_link                = sf_post_item_link();

            foreach ( $thumb_image as $detail_image ) {
                $image_id      = $detail_image['ID'];
                $thumb_img_url = $detail_image['url'];
                break;
            }

            if ( ! $thumb_image ) {
                $thumb_image   = get_post_thumbnail_id();
                $image_id      = $thumb_image;
                $thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
            }

            if ( $thumb_type == "" ) {
            	$thumb_type = "none";
            }

            $item_figure .= '<figure class="animated-overlay overlay-style thumb-media-' . $thumb_type . '">';
            
            $item_figure .= apply_filters( 'sf_before_blog_item_thumb' , '' );

            if ( $thumb_type == "video" ) {

                $video = sf_video_embed( $thumb_video, $thumb_width, $video_height );

                $item_figure .= $video;

            } else if ( $thumb_type == "audio" ) {

                $image        = sf_aq_resize( $thumb_img_url, $thumb_width, $thumb_height, true, false );
                $thumbnail_id = get_post_thumbnail_id( $post->ID );
                $image_alt    = sf_get_post_meta( $image_id, '_wp_attachment_image_alt', true );

                if ( $image ) {
                    $item_figure .= '<img m src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . $image_alt . '" />';
                }

                $item_figure .= sf_audio_post( $post->ID, true );

            } else if ( $thumb_type == "sh-video" ) {

                $item_figure .= sf_sh_video_post( $post->ID, $thumb_width, $video_height, true );

            } else if ( $thumb_type == "slider" ) {

                $item_figure .= '<div class="flexslider thumb-slider"><ul class="slides">';

                foreach ( $thumb_gallery as $image ) {
                    $item_figure .= "<li><a " . $item_link['config'] . "><img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' /></a></li>";
                }

                $item_figure .= '</ul></div>';

            } else {

                $thumb_img_url = apply_filters( 'sf_post_thumb_image_url', $thumb_img_url );

                if ( $thumb_type == "image" && $thumb_img_url == "" ) {
                    $thumb_img_url = "default";
                }

                $image        = sf_aq_resize( $thumb_img_url, $thumb_width, $thumb_height, true, false );
                $thumbnail_id = get_post_thumbnail_id( $post->ID );
                $image_alt    = sf_get_post_meta( $image_id, '_wp_attachment_image_alt', true );

                if ( $thumb_img_url != "" ) {
                    if ( $image ) {
                        $item_figure .= '<div class="img-wrap"><img src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . $image_alt . '" /></div>';
                    }
                    $item_figure .= '<a ' . $item_link['config'] . '></a>';
                    $item_figure .= '<div class="figcaption-wrap"></div>';
                    $item_figure .= '<figcaption><div class="thumb-info thumb-info-alt">';
                    if ( $item_link['svg_icon'] != "" ) {
                    	$item_figure .= $item_link['svg_icon'];
                    } else { 
                    	$item_figure .= '<i class="' . $item_link['icon'] . '"></i>';
                    }
                    $item_figure .= '</div></figcaption>';
                }
            }

            $item_figure .= '</figure>';

            return $item_figure;
        }
    }


    /* POST LINK CONFIG
    ================================================== */
    if ( ! function_exists( 'sf_post_item_link' ) ) {
        function sf_post_item_link() {

            $link_config = $item_icon = $item_svg_icon = $thumb_img_url = "";

            global $post;

            $thumb_image              = rwmb_meta( 'sf_thumbnail_image', 'type=image&size=full' );
            $thumb_link_type          = sf_get_post_meta( $post->ID, 'sf_thumbnail_link_type', true );
            $thumb_link_url           = sf_get_post_meta( $post->ID, 'sf_thumbnail_link_url', true );
            $thumb_lightbox_image     = rwmb_meta( 'sf_thumbnail_link_image', 'type=image&size=large' );
            $thumb_lightbox_video_url = sf_get_post_meta( $post->ID, 'sf_thumbnail_link_video_url', true );
            $thumb_lightbox_video_url = sf_get_embed_src( $thumb_lightbox_video_url );

            $permalink = get_permalink();

            foreach ( $thumb_image as $detail_image ) {
                $thumb_img_url = $detail_image['url'];
                break;
            }

            if ( ! $thumb_image ) {
                $thumb_image   = get_post_thumbnail_id();
                $thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
            }


            if ( $thumb_link_type == "link_to_url" ) {
                $link_config = 'href="' . $thumb_link_url . '" class="link-to-url"';
                $item_icon   = apply_filters( 'sf_post_link_icon', "ss-link" );
                $item_svg_icon   = apply_filters( 'sf_post_link_svg_icon', "" );
            } else if ( $thumb_link_type == "link_to_url_nw" ) {
                $link_config = 'href="' . $thumb_link_url . '" class="link-to-url" target="_blank"';
                $item_icon   = apply_filters( 'sf_post_link_icon', "ss-link" );
                $item_svg_icon   = apply_filters( 'sf_post_link_svg_icon', "" );
            } else if ( $thumb_link_type == "lightbox_thumb" ) {
            	$lightbox_id = rand();
                if ( $thumb_img_url != "" ) {
                    $link_config = 'href="' . $thumb_img_url . '" class="lightbox" data-rel="ilightbox['.$lightbox_id.']"';
                }
                $item_icon   = apply_filters( 'sf_post_lightbox_icon', "ss-view" );
                $item_svg_icon   = apply_filters( 'sf_post_lightbox_svg_icon', "" );
            } else if ( $thumb_link_type == "lightbox_image" ) {
                $lightbox_image_url = '';
                foreach ( $thumb_lightbox_image as $image ) {
                    $lightbox_image_url = $image['full_url'];
                }
                $lightbox_id = rand();
                if ( $lightbox_image_url != "" ) {
                    $link_config = 'href="' . $lightbox_image_url . '" class="lightbox" data-rel="ilightbox['.$lightbox_id.']"';
                }
                $item_icon   = apply_filters( 'sf_post_lightbox_icon', "ss-view" );
                $item_svg_icon   = apply_filters( 'sf_post_lightbox_svg_icon', "" );
            } else if ( $thumb_link_type == "lightbox_video" ) {
                $link_config = 'data-video="' . $thumb_lightbox_video_url . '" href="#" class="fw-video-link"';
                $item_icon   = apply_filters( 'sf_post_video_icon', "ss-video" );
                $item_svg_icon   = apply_filters( 'sf_post_video_svg_icon', "" );
            } else {
                $link_config = 'href="' . $permalink . '" class="link-to-post"';
                $item_icon   = apply_filters( 'sf_post_standard_icon', "ss-navigateright" );
                $item_svg_icon   = apply_filters( 'sf_post_standard_svg_icon', "" );
            }

            $item_link = array(
                "icon"   => $item_icon,
                "svg_icon"   => $item_svg_icon,
                "config" => $link_config
            );

            return $item_link;
        }
    }

   
    /* GET MASONRY POST
    ================================================== */
    if ( ! function_exists( 'sf_get_masonry_post' ) ) {
        function sf_get_masonry_post( $postID, $thumb_type, $fullwidth, $show_title, $show_excerpt, $show_details, $show_read_more, $content_output, $excerpt_length ) {
			
			global $sf_options;
			
			// Get Post Object
			$post_object = sf_build_post_object( $postID , $content_output, $excerpt_length );
			
			// Link config			
            $post_links_match_thumb = false;
            if ( isset( $sf_options['post_links_match_thumb'] ) ) {
            	$post_links_match_thumb = $sf_options['post_links_match_thumb'];	
            }
            $post_permalink_config = 'href="' . $post_object['permalink'] . '" class="link-to-post"';
            if ( $post_links_match_thumb ) {
            	$link_config = sf_post_item_link();
            	$post_permalink_config = $link_config['config'];
            }
            
            // Variable setup
            $post_item = "";
            $comments_icon 	 = apply_filters( 'sf_comments_icon', '<i class="ss-chat"></i>' );
            $link_icon		 = apply_filters( 'sf_link_icon', '<i class="ss-link"></i>' );
            $sticky_icon   	 = apply_filters( 'sf_sticky_icon', '<i class="ss-bookmark"></i>' );
            						
			// THUMBNAIL MEDIA TYPE SETUP
			$post_item .= apply_filters( 'sf_before_masonry_post_thumb' , '');
			
			$item_figure = "";
			if ( $thumb_type != "none" ) {
			    $item_figure .= sf_post_thumbnail( "masonry", $fullwidth );
			}
            if ( $item_figure != "" ) {
                $post_item .= $item_figure;
            }

			// Open output
            $post_item .= '<div class="details-wrap">';
            $post_item .= '<a ' . $post_permalink_config . '></a>';
			
			// Title
            if ( $post_object['type'] == "post" ) {
                if ( $post_object['format'] == "standard" ) {
                    $post_item .= '<h6>' . __( "Article", "swiftframework" ) . '</h6>';
                } else {
                    $post_item .= '<h6>' . $post_object['format'] . '</h6>';
                }
            } else {
                $post_item .= '<h6>' . $post_object['type'] . '</h6>';
            }
            if ( $show_title == "yes" && $post_object['format'] != "quote" && $post_object['format'] != "link" ) {
                $post_item .= '<h2 itemprop="name headline">' . $post_object['title'] . '</h2>';
            } else if ( $post_object['format'] == "quote" ) {
                $post_item .= '<div class="quote-excerpt" itemprop="name headline">' . $post_object['excerpt'] . '</div>';
            } else if ( $post_object['format'] == "link" ) {
                $post_item .= '<h3 itemprop="name headline">' . $post_object['title'] . '</h3>';
            }
			
			// Excerpt
            if ( $show_excerpt == "yes" && $post_object['format'] != "quote" ) {
                $post_item .= '<div class="excerpt" itemprop="description">' . $post_object['excerpt'] . '</div>';
            }
            
			// Details
            if ( $show_details == "yes" ) {
                $post_item .= sf_get_post_details($postID);
                $post_item .= '<div class="comments-likes">';
                if ( comments_open() ) {
                    $post_item .= '<div class="comments-wrapper"><a href="' . $post_object['permalink'] . '#comment-area">'.$comments_icon.'<span>' . $post_object['comments'] . '</span></a></div>';
                }

                if ( function_exists( 'lip_love_it_link' ) ) {
                    $post_item .= lip_love_it_link( $postID, false );
                }
                $post_item .= '</div>';

            }

			// Close output
            $post_item .= '</div>';
			               
			// Return 
        	return $post_item;
        }
    }
    
    
    /* GET MINI POST
    ================================================== */
    if ( ! function_exists( 'sf_get_mini_post' ) ) {
        function sf_get_mini_post( $postID, $thumb_type, $fullwidth, $show_title, $show_excerpt, $show_details, $show_read_more, $content_output, $excerpt_length ) {
			
			global $sf_options;
			$single_author = $sf_options['single_author'];
			$remove_dates  = $sf_options['remove_dates'];
			
			// Get Post Object
			$post_object = sf_build_post_object( $postID , $content_output, $excerpt_length );
			
			// Link config			
            $post_links_match_thumb = false;
            if ( isset( $sf_options['post_links_match_thumb'] ) ) {
            	$post_links_match_thumb = $sf_options['post_links_match_thumb'];	
            }
            $post_permalink_config = 'href="' . $post_object['permalink'] . '" class="link-to-post"';
            if ( $post_links_match_thumb ) {
            	$link_config = sf_post_item_link();
            	$post_permalink_config = $link_config['config'];
            }
            
            // Variable setup
            $post_item = "";
           	$comments_icon 	 = apply_filters( 'sf_comments_icon', '<i class="ss-chat"></i>' );
           	$link_icon		 = apply_filters( 'sf_link_icon', '<i class="ss-link"></i>' );
           	$sticky_icon   	 = apply_filters( 'sf_sticky_icon', '<i class="ss-bookmark"></i>' );
			
			// THUMBNAIL MEDIA TYPE SETUP
			$item_figure = "";
			if ( $thumb_type != "none" ) {
			    $item_figure .= sf_post_thumbnail( "mini", $fullwidth );
			}
			
			// DETAILS SETUP
			$item_details = "";
			if ( $single_author && ! $remove_dates ) {
			    $item_details .= '<div class="blog-item-details">' . sprintf( __( 'In %1$s on <time datetime="%2$s">%3$s</time>', 'swiftframework' ), $post_object['categories'], $post_object['date_str'], $post_object['date'] ) . '</div>';
			} else if ( ! $remove_dates ) {
			    $item_details .= '<div class="blog-item-details">' . sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> in %3$s on <time datetime="%4$s">%5$s</time>', 'swiftframework' ), $post_object['author'], get_author_posts_url( get_the_author_meta( 'ID' ) ), $post_object['categories'], $post_object['date_str'], $post_object['date'] ) . '</div>';
			} else if ( ! $single_author ) {
			    $item_details .= '<div class="blog-item-details">' . sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> in %3$s', 'swiftframework' ), $post_object['author'], get_author_posts_url( get_the_author_meta( 'ID' ) ), $post_object['categories'] ) . '</div>';
			}
			
			$mini_details = "";
			if ( $single_author && ! $remove_dates ) {
			    $mini_details .= '<div class="mini-item-details">' . sprintf( __( 'in %1$s / <time datetime="%2$s">%3$s</time> / %4$s comments', 'swiftframework' ),  $post_object['categories'], $post_object['date_str'], $post_object['date'], $post_object['comments'] ) . '</div>';
			} else if ( ! $remove_dates ) {
			    $mini_details .= '<div class="mini-item-details">' . sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> in %3$s / <time datetime="%4$s">%5$s</time> / %6$s comments', 'swiftframework' ), $post_object['author'], get_author_posts_url( get_the_author_meta( 'ID' ) ), $post_object['categories'], $post_object['date_str'], $post_object['date'], $post_object['comments'] ) . '</div>';
			} else if ( ! $single_author ) {
			    $mini_details .= '<div class="mini-item-details">' . sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> / %3$s / %4$s comments', 'swiftframework' ), $post_object['author'], get_author_posts_url( get_the_author_meta( 'ID' ) ), $post_object['categories'], $post_object['comments'] ) . '</div>';
			}
			
			// Open output
            $post_item .= '<div class="mini-blog-item-wrap clearfix">';
            
            if ( $post_object['format'] == "quote" || $post_object['format'] == "link" ) {

                $post_item .= '<div class="mini-alt-wrap">';

            } else {

                $post_item .= $item_figure;

            }

            $post_item .= '<div class="blog-details-wrap clearfix">';

            if ( $show_title == "yes" && $post_object['format'] != "quote" && $post_object['format'] != "link" ) {
                $post_item .= '<h3 itemprop="name headline"><a ' . $post_permalink_config . '>' . $post_object['title'] . '</a></h3>';
            }

            if ( $show_details == "yes" && $post_object['format'] != "quote" && $post_object['format'] != "link" ) {

				if ( sf_theme_opts_name() == "sf_atelier_options" ) {
                	$post_item .= $mini_details;
				} else {
					$post_item .= $item_details;
				}
            }
            if ( $show_excerpt == "yes" ) {
                if ( $post_object['format'] == "quote" ) {
                    $post_item .= '<div class="quote-excerpt heading-font" itemprop="description">' . $post_object['excerpt'] . '</div>';
                } else if ( $post_object['format'] == "link" ) {
                    $post_item .= '<div class="link-excerpt heading-font" itemprop="description">' . $link_icon . $post_object['excerpt'] . '</div>';
                } else {
                    $post_item .= '<div class="excerpt" itemprop="description">' . $post_object['excerpt'] . '</div>';
                }
            }

            if ( is_sticky() ) {
                $post_item .= '<div class="sticky-post-icon">'.$sticky_icon.'</div>';
            }

            if ( $show_read_more == "yes" ) {
                if ( $post_object['download_button'] ) {
                    if ( $post_object['download_shortcode'] != "" ) {
                        $post_item .= do_shortcode( $post_object['download_shortcode'] );
                    } else {
                        $post_item .= '<a href="' . wp_get_attachment_url( $post_object['download_file'] ) . '" class="download-button read-more-button">' . $post_object['download_text'] . '</a>';
                    }
                }
                $post_item .= '<a class="read-more-button" href="' . $post_object['permalink'] . '">' . __( "Read more", "swiftframework" ) . '</a>';
            }

			// Details
            if ( $show_details == "yes" ) {
            	if ( sf_theme_opts_name() != "sf_atelier_options" ) {
                	$post_item .= sf_get_post_details($postID);
                }
                $post_item .= '<div class="comments-likes">';
                if ( comments_open() ) {
                    $post_item .= '<div class="comments-wrapper"><a href="' . $post_object['permalink'] . '#comment-area">'.$comments_icon.'<span>' . $post_object['comments'] . '</span></a></div>';
                }

                if ( function_exists( 'lip_love_it_link' ) ) {
                    $post_item .= lip_love_it_link( $postID, false );
                }
                $post_item .= '</div>';

            }

            $post_item .= '</div>';

            if ( $post_object['format'] == "quote" || $post_object['format'] == "link" ) {

                $post_item .= '</div>';

            }
				
			// Close output
            $post_item .= '</div>';
       	               
			// Return 
        	return $post_item;
        }
    }
    
    
    /* GET TIMELINE POST
    ================================================== */
    if ( ! function_exists( 'sf_get_timeline_post' ) ) {
        function sf_get_timeline_post( $postID, $thumb_type, $fullwidth, $show_title, $show_excerpt, $show_details, $show_read_more, $content_output, $excerpt_length ) {
			
			global $sf_options;
			$single_author = $sf_options['single_author'];
			$remove_dates  = $sf_options['remove_dates'];
			
			// Get Post Object
			$post_object = sf_build_post_object( $postID , $content_output, $excerpt_length );
			
			// Link config			
            $post_links_match_thumb = false;
            if ( isset( $sf_options['post_links_match_thumb'] ) ) {
            	$post_links_match_thumb = $sf_options['post_links_match_thumb'];	
            }
            $post_permalink_config = 'href="' . $post_object['permalink'] . '" class="link-to-post"';
            if ( $post_links_match_thumb ) {
            	$link_config = sf_post_item_link();
            	$post_permalink_config = $link_config['config'];
            }
            
            // Variable setup
            $post_item = "";
           	$comments_icon 	 = apply_filters( 'sf_comments_icon', '<i class="ss-chat"></i>' );
           	$link_icon		 = apply_filters( 'sf_link_icon', '<i class="ss-link"></i>' );
           	$sticky_icon   	 = apply_filters( 'sf_sticky_icon', '<i class="ss-bookmark"></i>' );
			
			// THUMBNAIL MEDIA TYPE SETUP
			$item_figure = "";
			if ( $thumb_type != "none" ) {
			    $item_figure .= sf_post_thumbnail( "timeline", $fullwidth );
			}
			
			// DETAILS SETUP
			$item_details = "";
			if ( $single_author && ! $remove_dates ) {
			    $item_details .= '<div class="blog-item-details">' . sprintf( __( 'In %1$s on <time datetime="%2$s">%3$s</time>', 'swiftframework' ), $post_object['categories'], $post_object['date_str'], $post_object['date'] ) . '</div>';
			} else if ( ! $remove_dates ) {
			    $item_details .= '<div class="blog-item-details">' . sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> in %3$s on <time datetime="%4$s">%5$s</time>', 'swiftframework' ), $post_object['author'], get_author_posts_url( get_the_author_meta( 'ID' ) ), $post_object['categories'], $post_object['date_str'], $post_object['date'] ) . '</div>';
			} else if ( ! $single_author ) {
			    $item_details .= '<div class="blog-item-details">' . sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> in %3$s', 'swiftframework' ), $post_object['author'], get_author_posts_url( get_the_author_meta( 'ID' ) ), $post_object['categories'] ) . '</div>';
			}
			

			// Open output            
            if ( $show_details == "yes" ) {
                $post_item .= '<span class="standard-post-date" itemprop="datePublished">' . $post_object['date'] . '</span>';
            }

            $post_item .= $item_figure;

            if ( $item_figure == "" ) {
                $post_item .= '<div class="standard-post-content no-thumb clearfix">'; // open standard-post-content
            } else {
                $post_item .= '<div class="standard-post-content clearfix">'; // open standard-post-content
            }

            if ( $show_title == "yes" && $post_object['format'] != "link" && $post_object['format'] != "quote" ) {
                $post_item .= '<h1 itemprop="name headline"><a ' . $post_permalink_config . '>' . $post_object['title'] . '</a></h1>';
            }

            if ($show_details == "yes" && $post_object['format'] != "quote" && $post_object['format'] != "link" ) {
            	if ( sf_theme_opts_name() == "sf_atelier_options" ) {
            		if ( ! $single_author ) {
            		    $post_item .= '<div class="blog-item-details">' . sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> in %3$s', 'swiftframework' ), $post_object['author'], get_author_posts_url( get_the_author_meta( 'ID' ) ), $post_object['categories'] ) . '</div>';
            		}

            	} else {
                	$post_item .= $item_details;
            	}
            }

            if ( $show_excerpt == "yes" ) {
                $post_item .= '<div class="excerpt" itemprop="description">' . $post_object['excerpt'] . '</div>';
            } else if ( $post_object['format'] == "quote" ) {
                $post_item .= '<div class="quote-excerpt heading-font" itemprop="description">' . $post_object['excerpt'] . '</div>';
            } else if ( $post_object['format'] == "link" ) {
                $post_item .= '<div class="link-excerpt heading-font" itemprop="description">' . $link_icon . $post_object['excerpt'] . '</div>';
            }

            if ( is_sticky() ) {
                $post_item .= '<div class="sticky-post-icon">'.$sticky_icon.'</div>';
            }


            if ( $post_object['download_button'] ) {
                if ( $post_object['download_shortcode'] != "" ) {
                    $post_item .= do_shortcode( $post_object['download_shortcode'] );
                } else {
                    $post_item .= '<a href="' . wp_get_attachment_url( $post_object['download_file'] ) . '" class="download-button read-more-button">' . $post_object['download_text'] . '</a>';
                }
            }

            if ( $show_read_more == "yes" && $post_object['format'] != "quote" && $post_object['format'] != "link" ) {
                $post_item .= '<a class="read-more-button" href="' . $post_object['permalink'] . '">' . __( "Read more", "swiftframework" ) . '</a>';
            }

            if ( $show_details == "yes" ) {

                $post_item .= '<div class="comments-likes">';

                if ( $post_object['format'] == "quote" || $post_object['format'] == "link" ) {
                    $post_item .= $item_details;
                }

                if ( comments_open() ) {
                    $post_item .= '<div class="comments-wrapper"><a href="' . $post_object['permalink'] . '#comment-area">'.$comments_icon.'<span>' . $post_object['comments'] . '</span></a></div>';
                }

                if ( function_exists( 'lip_love_it_link' ) ) {
                    $post_item .= lip_love_it_link( get_the_ID(), false );
                }

                $post_item .= '</div>';
            }

            $post_item .= '</div>'; // close standard-post-content
       	               
			// Return 
        	return $post_item;
        }
    }
    
    
    /* GET STANDARD POST
    ================================================== */
    if ( ! function_exists( 'sf_get_standard_post' ) ) {
        function sf_get_standard_post( $postID, $thumb_type, $fullwidth, $show_title, $show_excerpt, $show_details, $show_read_more, $content_output, $excerpt_length ) {
			
			global $sf_options;
			$single_author = $sf_options['single_author'];
			$remove_dates  = $sf_options['remove_dates'];
			
			// Get Post Object
			$post_object = sf_build_post_object( $postID , $content_output, $excerpt_length );
			
			// Link config			
            $post_links_match_thumb = false;
            if ( isset( $sf_options['post_links_match_thumb'] ) ) {
            	$post_links_match_thumb = $sf_options['post_links_match_thumb'];	
            }
            $post_permalink_config = 'href="' . $post_object['permalink'] . '" class="link-to-post"';
            if ( $post_links_match_thumb ) {
            	$link_config = sf_post_item_link();
            	$post_permalink_config = $link_config['config'];
            }
            
            // Variable setup
            $post_item = "";
           	$comments_icon 	 = apply_filters( 'sf_comments_icon', '<i class="ss-chat"></i>' );
           	$link_icon		 = apply_filters( 'sf_link_icon', '<i class="ss-link"></i>' );
           	$sticky_icon   	 = apply_filters( 'sf_sticky_icon', '<i class="ss-bookmark"></i>' );
			
			// THUMBNAIL MEDIA TYPE SETUP
			$item_figure = "";
			if ( $thumb_type != "none" ) {
			    $item_figure .= sf_post_thumbnail( "timeline", $fullwidth );
			}
			
			// DETAILS SETUP
			$item_details = "";
			if ( $single_author && ! $remove_dates ) {
			    $item_details .= '<div class="blog-item-details">' . sprintf( __( 'In %1$s on <time datetime="%2$s">%3$s</time>', 'swiftframework' ), $post_object['categories'], $post_object['date_str'], $post_object['date'] ) . '</div>';
			} else if ( ! $remove_dates ) {
			    $item_details .= '<div class="blog-item-details">' . sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> in %3$s on <time datetime="%4$s">%5$s</time>', 'swiftframework' ), $post_object['author'], get_author_posts_url( get_the_author_meta( 'ID' ) ), $post_object['categories'], $post_object['date_str'], $post_object['date'] ) . '</div>';
			} else if ( ! $single_author ) {
			    $item_details .= '<div class="blog-item-details">' . sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> in %3$s', 'swiftframework' ), $post_object['author'], get_author_posts_url( get_the_author_meta( 'ID' ) ), $post_object['categories'] ) . '</div>';
			}
			

			// Open output            
            if ( sf_theme_opts_name() == "sf_atelier_options" && $show_details == "yes" ) {
	    		$post_item .= '<div class="side-details">';
	    		if ( !$remove_dates ) {
	    			$post_date_month = get_the_date('M');
	    			$post_date_day = get_the_date('d');
	    			$post_date_year = get_the_date('Y');
	    			$post_item .= '<div class="side-post-date narrow-date-block" itemprop="datePublished"><span class="month">'.$post_date_month.'</span><span class="day">'.$post_date_day.'</span><span class="year">'.$post_date_year.'</span></div>';
	    		}
	    		if ( comments_open() ) {
	    		    $post_item .= '<div class="comments-wrapper narrow-date-block"><a href="' . $post_object['permalink'] . '#comment-area">
	    		    <svg version="1.1" class="comments-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	    		    	 width="30px" height="30px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
	    		    <path fill="none" class="stroke" stroke="#252525" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="
	    		    	M13.958,24H2.021C1.458,24,1,23.541,1,22.975V2.025C1,1.459,1.458,1,2.021,1h25.957C28.542,1,29,1.459,29,2.025v20.949
	    		    	C29,23.541,28.542,24,27.979,24H21v5L13.958,24z"/>
	    		    </svg>
	    		    <span>' . $post_object['comments'] . '</span></a></div>';
	    		}
	
	    		if ( function_exists( 'lip_love_it_link' ) ) {
	    		    $post_item .= lip_love_it_link( get_the_ID(), false, '', 'narrow-date-block' );
	    		}
	
	    		$post_item .= '</div>';
	
	    		$post_item .= '<div class="post-content-wrap">';
	    	}
	
	        $post_item .= $item_figure;
	
	        if ( $item_figure == "" ) {
	            $post_item .= '<div class="standard-post-content no-thumb clearfix">'; // open standard-post-content
	        } else {
	            $post_item .= '<div class="standard-post-content clearfix">'; // open standard-post-content
	        }
	
	        if ( $show_title == "yes" && $post_object['format'] != "link" && $post_object['format'] != "quote" ) {
	            $post_item .= '<h1 itemprop="name headline"><a ' . $post_permalink_config . '>' . $post_object['title'] . '</a></h1>';
	        }
	
	        if ($show_details == "yes" && $post_object['format'] != "quote" && $post_object['format'] != "link" ) {
	        	if ( sf_theme_opts_name() == "sf_atelier_options" ) {
	        		if ( ! $single_author ) {
	        		    $post_item .= '<div class="blog-item-details">' . sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> in %3$s', 'swiftframework' ), $post_object['author'], get_author_posts_url( get_the_author_meta( 'ID' ) ), $post_object['categories'] ) . '</div>';
	        		}
	
	        	} else {
	            	$post_item .= $item_details;
	        	}
	        }
	
	        if ( $show_excerpt == "yes" ) {
	            $post_item .= '<div class="excerpt" itemprop="description">' . $post_object['excerpt'] . '</div>';
	        } else if ( $post_object['format'] == "quote" ) {
	            $post_item .= '<div class="quote-excerpt heading-font" itemprop="description">' . $post_object['excerpt'] . '</div>';
	        } else if ( $post_object['format'] == "link" ) {
	            $post_item .= '<div class="link-excerpt heading-font" itemprop="description">' . $link_icon . $post_object['excerpt'] . '</div>';
	        }
	
	        if ( is_sticky() ) {
	            $post_item .= '<div class="sticky-post-icon">'.$sticky_icon.'</div>';
	        }
	
	
	        if ( $post_object['download_button'] ) {
	            if ( $post_object['download_shortcode'] != "" ) {
	                $post_item .= do_shortcode( $post_object['download_shortcode'] );
	            } else {
	                $post_item .= '<a href="' . wp_get_attachment_url( $post_object['download_file'] ) . '" class="download-button read-more-button">' . $post_object['download_text'] . '</a>';
	            }
	        }
	
	        if ( $show_read_more == "yes" && $post_object['format'] != "quote" && $post_object['format'] != "link" ) {
	            $post_item .= '<a class="read-more-button" href="' . $post_object['permalink'] . '">' . __( "Read more", "swiftframework" ) . '</a>';
	        }
	
	        if ( $show_details == "yes" ) {
	
	            $post_item .= '<div class="comments-likes">';
	
	            if ( $post_object['format'] == "quote" || $post_object['format'] == "link" ) {
	                $post_item .= $item_details;
	            }
	
	            if ( comments_open() ) {
	                $post_item .= '<div class="comments-wrapper"><a href="' . $post_object['permalink'] . '#comment-area">'.$comments_icon.'<span>' . $post_object['comments'] . '</span></a></div>';
	            }
	
	            if ( function_exists( 'lip_love_it_link' ) ) {
	                $post_item .= lip_love_it_link( get_the_ID(), false );
	            }
	
	            $post_item .= '</div>';
	        }
	
	        $post_item .= '</div>'; // close standard-post-content
	
			if ( sf_theme_opts_name() == "sf_atelier_options" && $show_details == "yes" ) {
				$post_item .= '</div>'; // close post-content-wrap
			}
            
       	               
			// Return 
        	return $post_item;
        }
    }
        
    
    /* BUILD POST OBJ ARRAY
    ================================================== */
    if ( ! function_exists( 'sf_build_post_object' ) ) {
        function sf_build_post_object( $postID, $content_output, $excerpt_length ) {
						
			// Post Format
			$post_format = get_post_format( $postID );
			
			// Excerpt config
			$custom_excerpt  = sf_get_post_meta( $postID, 'sf_custom_excerpt', true );
			$post_excerpt    = '';
			if ( $content_output == "excerpt" ) {
			    if ( $custom_excerpt != '' ) {
			        $post_excerpt = sf_custom_excerpt( $custom_excerpt, $excerpt_length );
			    } else {
			        if ( $post_format == "quote" ) {
			            $post_excerpt = sf_get_the_content_with_formatting();
			        } else {
			            $post_excerpt = sf_excerpt( $excerpt_length );
			        }
			    }
			} else {
			    $post_excerpt = sf_get_the_content_with_formatting();
			}
			if ( $post_format == "chat" ) {
			    $post_excerpt = sf_content( 40 );
			} else if ( $post_format == "audio" ) {
			    $post_excerpt = do_shortcode( get_the_content() );
			} else if ( $post_format == "video" ) {
			    $content      = get_the_content();
			    $content      = apply_filters( 'the_content', $content );
			    $post_excerpt = $content;
			} else if ( $post_format == "link" ) {
			    $content      = get_the_content();
			    $content      = apply_filters( 'the_content', $content );
			    $post_excerpt = $content;
			}
			
			// Post Object
			$post_object = array(
				'format' 				=> $post_format,
				'type' 					=> get_post_type( $postID ),
				'title'					=> get_the_title(),
				'author'				=> get_the_author(),
				'date'					=> get_the_date(),
				'date_str'				=> get_the_date('Y-m-d'),
				'categories'			=> $post_categories = get_the_category_list( ', ' ),
				'comments'   			=> get_comments_number(),
				'permalink'  			=> get_permalink(),
				'excerpt' 				=> $post_excerpt,
				'thumb_type'			=> sf_get_post_meta( $postID, 'sf_thumbnail_type', true ),
				'download_button'   	=> sf_get_post_meta( $postID, 'sf_download_button', true ),
				'download_file'     	=> sf_get_post_meta( $postID, 'sf_download_file', true ),
				'download_text'     	=> apply_filters( 'sf_post_download_text', __( "Download", "swiftframework" ) ),
				'download_shortcode' 	=> sf_get_post_meta( $postID, 'sf_download_shortcode', true ),
			);
			
			// Apply filters
			$post_object = apply_filters( 'sf_blog_post_object', $post_object ); 
			
			// Return post object
        	return $post_object;
        }
    }
        

    /* GET DETAILS
    ================================================== */
    if ( ! function_exists( 'sf_get_post_details' ) ) {
        function sf_get_post_details( $postID ) {

        	global $sf_options;
        	$single_author = $sf_options['single_author'];
        	$remove_dates  = $sf_options['remove_dates'];

        	$post_author    = get_the_author_link();
        	$post_date      = get_the_date();
        	$post_date_str  = get_the_date('Y-m-d');
        	$post_details = "";

        	if ( $single_author && ! $remove_dates ) {
        	    $post_details .= '<div class="blog-item-details"><time class="post-date" datetime="' . $post_date_str . '">' . sprintf( __( '%1$s', 'swiftframework' ), $post_date ) . '</time></div>';
        	} else if ( ! $remove_dates ) {
        	    $post_details .= '<div class="post-item-details"><time class="post-date" datetime="' . $post_date_str . '">' . $post_date . '</time><span class="author"> ' . sprintf( __( 'by <a href="%2$s" rel="author" itemprop="author">%1$s</a>', 'swiftframework' ), $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '</span></div>';
        	} else if ( ! $single_author ) {
        	    $post_details .= '<div class="post-item-details"><span class="author">' . sprintf( __( 'By <a href="%2$s" rel="author" itemprop="author">%1$s</a>', 'swiftframework' ), $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '</span></div>';
        	}

        	return $post_details;
        }
    }
    
    
    /* GET RECENT POST ITEM
    ================================================== */
    if ( ! function_exists( 'sf_get_recent_post_item' ) ) {
        function sf_get_recent_post_item( $post, $display_type = "bold", $excerpt_length = 20, $item_class = "" ) {

            $recent_post   = $recent_post_figure = $link_config = $item_icon = "";
            $thumb_type    = sf_get_post_meta( $post->ID, 'sf_thumbnail_type', true );
            $thumb_image   = rwmb_meta( 'sf_thumbnail_image', 'type=image&size=full' );
            $thumb_video   = sf_get_post_meta( $post->ID, 'sf_thumbnail_video_url', true );
            $thumb_gallery = rwmb_meta( 'sf_thumbnail_gallery', 'type=image&size=thumb-image' );
			
            foreach ( $thumb_image as $detail_image ) {
                $thumb_img_url = $detail_image['url'];
                break;
            }

            if ( ! $thumb_image ) {
                $thumb_image   = get_post_thumbnail_id();
                $thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
            }

            // POST META
            global $sf_options;
            $single_author = $sf_options['single_author'];
            $remove_dates  = $sf_options['remove_dates'];
            $post_links_match_thumb = false;
            if ( isset( $sf_options['post_links_match_thumb'] ) ) {
            	$post_links_match_thumb = $sf_options['post_links_match_thumb'];	
            }
            
            if ( $display_type == "list" ) {
            	//$excerpt_length = 8;
            }

            $post_author    = get_the_author_link();
            $post_date      = get_the_date();
            $post_date_str  = get_the_date('Y-m-d');
            $item_title     = get_the_title();
            $post_permalink = get_permalink();
            $post_comments  = get_comments_number();
            $custom_excerpt = sf_get_post_meta( $post->ID, 'sf_custom_excerpt', true );
            $post_excerpt   = '';
            $post_categories = '';
            if ( $custom_excerpt != '' ) {
                $post_excerpt = sf_custom_excerpt( $custom_excerpt, $excerpt_length );
            } else {
                $post_excerpt = sf_excerpt( $excerpt_length );
            }
            $post_permalink_config = 'href="' . $post_permalink . '" class="link-to-post"';
            if ( $post_links_match_thumb ) {
            	$link_config = sf_post_item_link();
            	$post_permalink_config = $link_config['config'];
            }
            if ( function_exists('sf_get_custom_post_cat_list') ) {
            	$post_categories = sf_get_custom_post_cat_list( $post->ID );
			}
			
            $thumb_width = apply_filters('sf_recent_post_item_thumb_width', 720);
            $thumb_height = apply_filters('sf_recent_post_item_thumb_height', 540);
			
			if ( $display_type == "standard-row" ) {
				$thumb_width = apply_filters('sf_recent_post_item_thumb_width', 400);
				$thumb_height = apply_filters('sf_recent_post_item_thumb_height', 300);
			}
			
			if ( $display_type == "showcase" ) {
				$thumb_width = apply_filters('sf_recent_post_item_showcase_thumb_width', 600);
				$thumb_height = apply_filters('sf_recent_post_item_showcase_thumb_height', 450);
			}
			
            // MEDIA CONFIG
            $thumb_link_type          = sf_get_post_meta( $post->ID, 'sf_thumbnail_link_type', true );
            $thumb_link_url           = sf_get_post_meta( $post->ID, 'sf_thumbnail_link_url', true );
            $thumb_lightbox_thumb     = rwmb_meta( 'sf_thumbnail_image', 'type=image&size=large' );
            $thumb_lightbox_image     = rwmb_meta( 'sf_thumbnail_link_image', 'type=image&size=large' );
            $thumb_lightbox_video_url = sf_get_post_meta( $post->ID, 'sf_thumbnail_link_video_url', true );
            $thumb_lightbox_video_url = sf_get_embed_src( $thumb_lightbox_video_url );
            $thumb_lightbox_img_url   = wp_get_attachment_url( $thumb_lightbox_image, 'full' );


            // LINK CONFIG
            $item_link                = sf_post_item_link();

            if ( $thumb_type == "none" ) {
                $recent_post .= '<div class="recent-post no-thumb ' . $item_class . ' clearfix">';
            } else {
                $recent_post .= '<div class="recent-post has-thumb ' . $item_class . ' clearfix">';
            }

			$recent_post_figure .= '<div class="figure-wrap">';

            $recent_post_figure .= apply_filters( 'sf_before_recent_post_thumb' , '');

            $recent_post_figure .= '<figure class="animated-overlay overlay-alt">';

            if ( $thumb_type == "video" ) {

                $video = sf_video_embed( $thumb_video, 400, 225 );
                $recent_post_figure .= '<div class="video-thumb">' . $video . '</div>';

            } else if ( $thumb_type == "slider" ) {

                $recent_post_figure .= '<div class="flexslider thumb-slider"><ul class="slides">';

                foreach ( $thumb_gallery as $image ) {
                    $alt = $image['alt'];
                    if ( ! $alt ) {
                        $alt = $image['title'];
                    }
                    $recent_post_figure .= "<li><a " . $item_link['config'] . "><img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$alt}' /></a></li>";
                }

                $recent_post_figure .= '</ul></div>';

            } else {

                if ( $thumb_img_url == "" && $thumb_type != "none" ) {
                    $thumb_img_url = "default";
                }

                $image = sf_aq_resize( $thumb_img_url, $thumb_width, $thumb_height, true, false );

                if ( $image ) {
                	
                	if ( $post_categories != "" && $display_type != "standard-row" ) {
                		$recent_post_figure .= '<div class="post-cats">'.$post_categories.'</div>';
                	}
                	
                    $recent_post_figure .= '<div class="img-wrap"><img src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . $item_title . '" /></div>';
                    $recent_post_figure .= '<a ' . $item_link['config'] . '></a>';
                    $recent_post_figure .= '<div class="figcaption-wrap"></div>';
                    
                    if ( $display_type == "showcase" ) {
                    	$recent_post_figure .= '<figcaption><div class="thumb-info">';
                	    $recent_post_figure .= '<h5><span class="post-date updated">' . $post_date . '</span></h5>';
                	    $recent_post_figure .= '<h4>' . $item_title . '</h4>';
                	    $recent_post_figure .= '</div></figcaption>';
                    } else {
		                $recent_post_figure .= '<figcaption><div class="thumb-info thumb-info-alt">';
		                if ( $item_link['svg_icon'] != "" ) {
		                	$recent_post_figure .= $item_link['svg_icon'];
		                } else { 
		                	$recent_post_figure .= '<i class="' . $item_link['icon'] . '"></i>';
		                }
		                $recent_post_figure .= '</div></figcaption>';
                	}
                }
            }

            $recent_post_figure .= '</figure>';

            $recent_post_figure .= '</div>';

            if ( $display_type == "bold" ) {

                $recent_post .= $recent_post_figure;
                $recent_post .= '<div class="details-wrap">';
                if ( $thumb_type == "none" ) {
                    $recent_post .= '<h2><a ' . $post_permalink_config . '>' . $item_title . '</a></h2>';
                } else {
                    $recent_post .= '<h3><a ' . $post_permalink_config . '>' . $item_title . '</a></h3>';
                }
                $recent_post .= sf_get_post_details($post->ID, true);
                $recent_post .= '</div>';

            } else if ( $display_type == "list" ) {
            
            	if ( $thumb_img_url == "" && $thumb_type != "none" ) {
                    $thumb_img_url = "default";
                }

                $image = sf_aq_resize( $thumb_img_url, 70, 70, true, false );
				
                $recent_post .= '<a class="list-post-link" href="' . $post_permalink . '"></a>';
                if ( $image ) {
                    $recent_post .= '<figure class="animated-overlay">';
                    $recent_post .= '<img itemprop="image" src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . $item_title . '" />';
                    $recent_post .= '<a ' . $item_link['config'] . '></a>';
                    $recent_post .= '<div class="figcaption-wrap"></div>';
                    $recent_post .= '<figcaption><div class="thumb-info thumb-info-alt">';
                    if ( $item_link['svg_icon'] != "" ) {
                    	$recent_post .= $item_link['svg_icon'];
                    } else { 
                    	$recent_post .= '<i class="' . $item_link['icon'] . '"></i>';
                    }
                    $recent_post .= '</div></figcaption>';
                    $recent_post .= '</figure>';
                }
                $recent_post .= '<div class="details-wrap">';
                $recent_post .= '<h4>' . $item_title . '</h4>';
				$recent_post .= '<div class="post-item-details">';				
				if ( sf_theme_supports('alt-recent-post-list') ) {
					$recent_post .= '<div class="excerpt">' . $post_excerpt . '</div>';
					$recent_post .= sf_get_post_details($post->ID, true);
				} else {
                	$recent_post .= '<span class="post-date updated">' . $post_date . '</span>';
                }
                $recent_post .= '</div>';
                $recent_post .= '</div>';

            } else if ( $display_type == "bright" ) {

                $recent_post .= '<div class="details-wrap">';
                $recent_post .= '<div class="author-avatar">' . get_avatar( get_the_author_meta( 'ID' ), '140' ) . '</div>';
                $recent_post .= '<h6 class="post-item-author"><span class="author">' . sprintf( '<a href="%2$s" rel="author" itemprop="author">%1$s</a>', $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '</span></h6>';
                $recent_post .= '<h2><a ' . $post_permalink_config . '>' . $item_title . '</a></h2>';
                $recent_post .= '<div class="post-item-details">';
                $recent_post .= '<span class="post-date updated">' . $post_date . '</span>';
                $recent_post .= '</div>';
                $recent_post .= '</div>';

			} else if ( $display_type == "bold" ) {

                $recent_post .= $recent_post_figure;
                $recent_post .= '<div class="details-wrap">';
                if ( $thumb_type == "none" ) {
                    $recent_post .= '<h2><a ' . $post_permalink_config . '>' . $item_title . '</a></h2>';
                } else {
                    $recent_post .= '<h3><a ' . $post_permalink_config . '>' . $item_title . '</a></h3>';
                }
                $recent_post = sf_get_post_details($post->ID, true);
                $recent_post .= '</div>';
			
			} else if ( $display_type == "showcase" ) {
			
                $recent_post .= $recent_post_figure;
                            
            } else {

                $recent_post .= $recent_post_figure;
                $recent_post .= '<div class="details-wrap">';
                if ( $post_categories != "" && $display_type == "standard-row" ) {
                	$recent_post .= '<div class="post-cats">'.$post_categories.'</div>';
                }
                $recent_post .= '<h5><a ' . $post_permalink_config . '>' . $item_title . '</a></h5>';
                $recent_post .= sf_get_post_details($post->ID, true);
                if ( $excerpt_length != "0" && $excerpt_length != "" ) {
                    $recent_post .= '<div class="excerpt">' . $post_excerpt . '</div>';
                }

                if ( sf_theme_opts_name() == "sf_atelier_options" && $display_type == "standard-row" ) {
                	$recent_post .= '<a class="read-more-button" href="' . get_permalink() . '">' . __( "Read more", "swiftframework" ) . '</a>';
                }

                $recent_post .= '</div>';

            }

            $recent_post .= '</div>';

            return $recent_post;
        }
    }


    /* GET SEARCH ITEM
    ================================================== */
    if ( ! function_exists( 'sf_get_search_item' ) ) {
        function sf_get_search_item( $postID ) {

            $search_item = $thumb_img_url = $post_excerpt = $img_icon = "";

            $post_format = get_post_format( $postID );
            if ( $post_format == "" ) {
                $post_format = 'standard';
            }
            $post_type = get_post_type( $postID );

            if ( $post_type == "post" ) {
                if ( $post_format == "quote" || $post_format == "status" ) {
                    $img_icon = "ss-quote";
                } else if ( $post_format == "image" ) {
                    $img_icon = "ss-picture";
                } else if ( $post_format == "chat" ) {
                    $img_icon = "ss-chat";
                } else if ( $post_format == "audio" ) {
                    $img_icon = "ss-music";
                } else if ( $post_format == "video" ) {
                    $img_icon = "ss-video";
                } else if ( $post_format == "link" ) {
                    $img_icon = "ss-link";
                } else {
                    $img_icon = "ss-pen";
                }
            } else if ( $post_type == "product" ) {
                $img_icon = "ss-cart";
            } else if ( $post_type == "portfolio" ) {
                $img_icon = "ss-picture";
            } else if ( $post_type == "team" ) {
                $img_icon = "ss-user";
            } else if ( $post_type == "galleries" ) {
                $img_icon = "ss-picture";
            } else {
                $img_icon = "ss-file";
            }

            $post_title     = get_the_title();
            $post_date      = get_the_date();
            $post_permalink = get_permalink();
            $custom_excerpt = sf_get_post_meta( $postID, 'sf_custom_excerpt', true );
            $post_excerpt   = strip_shortcodes( get_the_excerpt() );

            $thumb_image = rwmb_meta( 'sf_thumbnail_image', 'type=image&size=thumbnail' );

            foreach ( $thumb_image as $detail_image ) {
                $thumb_img_url = $detail_image['url'];
                break;
            }

            if ( ! $thumb_image ) {
                $thumb_image   = get_post_thumbnail_id();
                $thumb_img_url = wp_get_attachment_url( $thumb_image, 'thumbnail' );
            }

            $image       = sf_aq_resize( $thumb_img_url, 70, 70, true, false );
            $image_title = sf_featured_img_title();

            if ( $image ) {
                $search_item .= '<div class="search-item-img"><a href="' . $post_permalink . '"><img src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . $image_title . '" /></a></div>';
            } else {
                $search_item .= '<div class="search-item-img"><a href="' . $post_permalink . '" class="img-holder"><i class="' . $img_icon . '"></i></a></div>';
            }

            if ( $post_excerpt == "<p></p>" ) {
                $search_item .= '<div class="search-item-content no-excerpt">';
                $search_item .= '<h3><a href="' . $post_permalink . '">' . $post_title . '</a></h3>';
                $search_item .= '<time>' . $post_date . '</time>';
                $search_item .= '</div>';
            } else {
                $search_item .= '<div class="search-item-content">';
                $search_item .= '<h3><a href="' . $post_permalink . '">' . $post_title . '</a></h3>';
                $search_item .= '<time>' . $post_date . '</time>';
                $search_item .= '<div class="excerpt">' . $post_excerpt . '</div>';
                $search_item .= '</div>';
            }

            return $search_item;

        }
    }


    /* GET CAMPAIGN ITEM
    ================================================== */
    if ( ! function_exists( 'sf_get_campaign_item' ) ) {
        function sf_get_campaign_item( $item_class ) {
            global $post, $sf_has_progress_bar;
            $sf_has_progress_bar = true;

            $campaign_item = "";

            if ( class_exists( 'ATCF_Campaigns' ) ) {
                $campaign        = new ATCF_Campaign( $post->ID );
                $post_title      = get_the_title();
                $post_author     = get_the_author_link();
                $post_date       = get_the_date();
                $post_date_str   = get_the_date('Y-m-d');
                $post_categories = get_the_category_list( ', ' );
                $post_comments   = get_comments_number();
                $post_permalink  = get_permalink();
                $post_excerpt    = sf_excerpt( 20 );
                $percent         = $campaign->percent_completed();
                $percent_num     = str_replace( '%', '', $percent );

                $campaign_item .= '<li class="campaign-item ' . $item_class . '">';
                $campaign_item .= sf_post_thumbnail();
                $campaign_item .= '<div class="details-wrap">';
                $campaign_item .= '<h3><a href="' . $post_permalink . '">' . $post_title . '</a></h3>';
                $campaign_item .= '<div class="excerpt">' . $post_excerpt . '</div>';
                $campaign_item .= '<div class="campaign-details-mini clearfix">';
                $campaign_item .= '<div class="funded-bar progress standard"><div class="bar" data-value="' . $percent_num . '"></div></div>';
                $campaign_item .= '<div class="detail">';
                $campaign_item .= '<data>' . $percent . '</data>';
                $campaign_item .= '<span>' . __( "Funded", "swiftframework" ) . '</span>';
                $campaign_item .= '</div>';
                $campaign_item .= '<div class="detail pledged">';
                $campaign_item .= '<data>' . $campaign->current_amount() . '</data>';
                $campaign_item .= '<span>' . __( "Pledged", "swiftframework" ) . '</span>';
                $campaign_item .= '</div>';
                if ( ! $campaign->is_endless() ) {
                    $campaign_item .= '<div class="detail">';
                    $campaign_item .= '<data>' . $campaign->days_remaining() . '</data>';
                    $campaign_item .= '<span>' . _n( "Day to Go", "Days to Go", $campaign->days_remaining(), "swiftframework" ) . '</span>';
                    $campaign_item .= '</div>';
                }
                $campaign_item .= '</div>';
                $campaign_item .= '</div>';
                $campaign_item .= '</li>';
            }

            return $campaign_item;

        }
    }

?>
